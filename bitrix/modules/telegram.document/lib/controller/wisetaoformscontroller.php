<?php
namespace Telegram\Document\Controller;

use Bitrix\Main\Context;
use Bitrix\Main\Engine\ActionFilter\Csrf;
use Bitrix\Main\Engine\Controller;
use Telegram\Document\ContactHandling;
use GuzzleHttp\Client;

class WisetaoFormsController extends Controller
{
    public function configureActions(): array
    {
        return [
            'send_wisetao_forms_data_to_deal_bitrix24' => [
                'prefilters' => [
                    new Csrf(bitrix_sessid()),
                ]
            ],
        ];
    }

    protected function prepFormData($request) {
        return [
            'name' => $request->getPost("name"),
            'phone' => ContactHandling::handlePhone($request->getPost("phone")),
            'email' => $request->getPost("email"),
            'formName' => $request->getPost("formName"),
            'serviceName' => $request->getPost("serviceName"),
            'serviceQuestion' => $request->getPost("serviceQuestion"),
            'currentPageUrl' => $request->getPost("currentPageUrl"),
        ];
    }

    public function send_wisetao_forms_data_to_deal_bitrix24Action() {
        $request = Context::getCurrent()->getRequest();
        $arrFormData = $this->prepFormData($request);
//        AddMessage2Log(print_r($arrFormData, true));
        if ($request->getPost("isClientExist") === 'true') {
            $contactPhone = ContactHandling::getContactByPhone($request->getPost("phone"));
            $contactId = $contactPhone['ID'] ?? null;

            if ($contactId) {
                $filteredDealsResponse = ContactHandling::getFilteredDealsByContactId($contactId, 'общая');
                $openDealId = $filteredDealsResponse[0]['ID'] ?? null;
                if ($openDealId) {
                    $this->updateDeal($openDealId, $arrFormData, $filteredDealsResponse[0]['STAGE_ID'], $filteredDealsResponse[0]['CATEGORY_ID']);
                    return ['status' => 'success', 'dealId' => $openDealId];
                } else {
                    $this->createDeal($contactId, $arrFormData);
                    return ['status' => 'success', 'contactId' => $contactId];
                }
            } else {
                return [
                    "status" => "error",
                    "message" => "Контакт не найден в системе, пожалуйста, проверьте данные."
                ];
            }
        }
        else {
            $contactData = [
                'PHONE' => ContactHandling::handlePhone($request->getPost('phone')),
                'NAME' => $request->getPost('name'),
                'EXIST' => $request->getPost('isClientExist'),
            ];

            $newContactId = ContactHandling::createContact($contactData);
            if ($newContactId) {
                AddMessage2Log(print_r($arrFormData, true));
                $this->createDeal($newContactId, $arrFormData);
                return ['status' => 'success', 'contactId' => $newContactId];
            } else {
                return [
                    "status" => "error",
                    "message" => "Ошибка при создании нового контакта."
                ];
            }
        }
    }

    protected function createDeal($contactId, $arrFormData)
    {
        $client = new Client();
        $baseUrl = 'https://b24-etsy4e.bitrix24.ru/rest/41/k2o1rlkx39t62w9b/';

        $arrFormData['CONTACT_ID'] = $contactId;
        try {
            $response = $client->request('POST', $baseUrl . 'crm.deal.add.json', [
                'json' => [
                    'fields' => [
                        'TITLE' => $arrFormData['formName'] === 'question' ? "Отправка контактов через общую форму на сайте" : "Запрос стоимости услуги: {$arrFormData['serviceName']}",
                        'CONTACT_ID' => $arrFormData['CONTACT_ID'],
                        'ASSIGNED_BY_ID' => 55,
                        'STAGE_ID' => 'PREPARATION',
                        'UF_CRM_1728203988' => $arrFormData['email'],
                        'UF_CRM_1728203918' => $arrFormData['serviceName'],
                        'UF_CRM_1728206330' => $arrFormData['serviceQuestion'],
                        'UF_CRM_1728216861' => $arrFormData['currentPageUrl'],
                        "CATEGORY_ID" => 0,
                    ],
                    'params' => ['REGISTER_SONET_EVENT' => 'Y']
                ]
            ]);

            $result = json_decode($response->getBody(), true);

            if (isset($result['result']) && $result['result'] > 0) {
                $this->addCommentToDeal($result['result'], $arrFormData, true);
            }

            return $result['result'] ?? null;
        } catch (\Exception $e) {
            AddMessage2Log("Ошибка создания сделки: " . $e->getMessage());
            return null;
        }
    }

    public function updateDeal($dealId, $arrFormData, $stage_id, $category_id)
    {
        $client = new Client();
        $response = $client->request('POST', 'https://b24-etsy4e.bitrix24.ru/rest/41/ncpxgxphz88u0n6w/crm.deal.update.json', [
            'json' => [
                'id' => $dealId,
                'fields' => [
                    'TITLE' => "Сделка обновлена: " . ($arrFormData['formName'] === 'question' ? "отправка контактов через общую форму на сайте" : "запрос стоимости услуги: {$arrFormData['serviceName']}"),
                    'CONTACT_ID' => $arrFormData['CONTACT_ID'],
                    'ASSIGNED_BY_ID' => 55,
                    'STAGE_ID' => $stage_id,
                    'UF_CRM_1728203988' => $arrFormData['email'],
                    'UF_CRM_1728203918' => $arrFormData['serviceName'],
                    'UF_CRM_1728206330' => $arrFormData['serviceQuestion'],
                    'UF_CRM_1728216861' => $arrFormData['currentPageUrl'],
                    "CATEGORY_ID" => $category_id,
                ],
                'params' => ['REGISTER_SONET_EVENT' => 'Y']
            ]
        ]);
        $responseArray = json_decode($response->getBody(), true);

        if (isset($responseArray['result']) && $responseArray['result'] > 0) {
            $this->addCommentToDeal($dealId, $arrFormData, false);
        }
        return $responseArray;
    }

    public function addCommentToDeal($dealId, $arrFormData, $isNewDeal = true)
    {
        $client = new Client();

        $commentHeader = $isNewDeal ? "Отправка контактов через общую форму на сайте" : "Сделка обновлена:";

        $commentText = $this->prepareCommentFields($arrFormData, $commentHeader);

        $client->request('POST', 'https://b24-etsy4e.bitrix24.ru/rest/41/t7v1j73j4c51z0w3/crm.timeline.comment.add.json', [
            'json' => [
                'fields' => [
                    'ENTITY_ID' => $dealId,
                    'ENTITY_TYPE' => 'deal',
                    'COMMENT' => $commentText,
                ]
            ]
        ]);
    }

    private function prepareCommentFields($arrFormData, $commentHeader)
    {
        $commentText = $commentHeader . "\n";
        $commentText .= 'Имя: ' . $arrFormData['name'] . "\n";
        $commentText .= 'Телефон: ' . $arrFormData['phone'] . "\n";
        $commentText .= 'E-mail: ' . $arrFormData['email'] . "\n";
        $commentText .= 'Услуга: ' . $arrFormData['serviceName'] . "\n";
        $commentText .= 'Ссылка на страницу услуги на сайте: ' . $arrFormData['currentPageUrl'] . "\n";
        $commentText .= 'Дополнительный вопрос: ' . $arrFormData['serviceName'] . "\n";
        return $commentText;
    }
}
