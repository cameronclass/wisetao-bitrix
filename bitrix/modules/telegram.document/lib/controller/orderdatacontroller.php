<?php
namespace Telegram\Document\Controller;

use Bitrix\Main\Context;
use Bitrix\Main\Engine\ActionFilter\Csrf;
use Bitrix\Main\Engine\Controller;
use Telegram\Document\ContactHandling;
use GuzzleHttp\Client;

class OrderDataController extends Controller
{
    public function configureActions(): array
    {
        return [
            'send_order_data_by_email' => [
                'prefilters' => [
                    new Csrf(bitrix_sessid()),
                ]
            ],
            'send_offer_to_deal_bitrix24' => [
                'prefilters' => [
                    new Csrf(bitrix_sessid()),
                ]
            ],
        ];
    }

    public function send_offer_to_deal_bitrix24Action()
    {
        $request = Context::getCurrent()->getRequest();

        $offerFile = $request->getFile("OFFER");
        $offerFileData = $this->prepFiletoBitrix24($offerFile);
        $responseContact = ContactHandling::getContactByPhone($request->getPost("phone"));
        $contactId = $responseContact['ID'] ?? null;

        if ($contactId) {
            $filteredDealsResponse = ContactHandling::getFilteredDealsByContactId($contactId);
            $openDealId = $filteredDealsResponse[0]['ID'] ?? null;
            if ($openDealId) {
                $this->updateDealAddOffer($openDealId, $filteredDealsResponse[0]['STAGE_ID'], $filteredDealsResponse[0]['CATEGORY_ID'], $offerFileData);
                return ['status' => 'success', 'dealId' => $openDealId];
            } else {
                return ['status' => 'error', 'message' => 'сделка не найдена'];
            }

        } else {
            return [
                "status" => "error",
                "message" => "Контакт не найден в системе, пожалуйста, проверьте данные."
            ];
        }
    }

    public function send_order_data_by_emailAction()
    {
        $request = Context::getCurrent()->getRequest();

        $arEventFields = $this->prepareEventFields($request);
        $contactData = [
            'PHONE' => ContactHandling::handlePhone($request->getPost('phone')),
            'NAME' => $request->getPost('name'),
            'EXIST' => $request->getPost('isClientExist'),
        ];

        $redeemFile = $request->getFile("redeemFile");
        $redeemFileData = $this->prepFiletoBitrix24($redeemFile);
        if ($redeemFileData) {
            $arEventFields['REDEEM_FILE'] = $redeemFileData;
        }

        $resultBitrix24 = $this->handleContactAndCreateDeal($contactData, $arEventFields);

        if ($resultBitrix24['status'] === 'error') {
            return $resultBitrix24;
        }

        if ($resultBitrix24['status'] === 'success') {
            return [
                "status" => "success",
                "message" => "Данные успешно отправлены по email и контакт создан в Bitrix24",
            ];
        } else {
            return [
                "status" => "error",
                "message" => "Ошибка создания контакта в Bitrix24: " . $resultBitrix24['message'],
            ];
        }
    }

    protected function handleContactAndCreateDeal($contactData, $arEventFields)
    {

        if ($contactData['EXIST'] === 'true') {
            $responseContact = ContactHandling::getContactByPhone($contactData['PHONE']);
            $contactId = $responseContact['ID'] ?? null;

            if ($contactId) {
                $filteredDealsResponse = ContactHandling::getFilteredDealsByContactId($contactId);
//                AddMessage2Log(print_r($filteredDealsResponse, true));
                $openDealId = $filteredDealsResponse[0]['ID'] ?? null;
                if ($openDealId) {
                    $this->updateDeal($openDealId, $arEventFields, $filteredDealsResponse[0]['STAGE_ID'], $filteredDealsResponse[0]['CATEGORY_ID']);
                    return ['status' => 'success', 'dealId' => $openDealId];
                } else {
                    $this->createDeal($contactId, $arEventFields);
                    return ['status' => 'success', 'contactId' => $contactId];
                }
            } else {
                return [
                    "status" => "error",
                    "message" => "Контакт не найден в системе, пожалуйста, проверьте данные."
                ];
            }
        } else {
            $newContactId = ContactHandling::createContact($contactData);
//            AddMessage2Log(print_r($newContactId, true));
            if ($newContactId) {
                $this->createDeal($newContactId, $arEventFields);
                return ['status' => 'success', 'contactId' => $newContactId];
            } else {
                return [
                    "status" => "error",
                    "message" => "Ошибка при создании нового контакта."
                ];
            }
        }
    }

    protected function createDeal($contactId, $arEventFields)
    {
        $client = new Client();
        $baseUrl = 'https://b24-etsy4e.bitrix24.ru/rest/41/k2o1rlkx39t62w9b/';

        $arEventFields['CONTACT_ID'] = $contactId;
        try {
            $response = $client->request('POST', $baseUrl . 'crm.deal.add.json', [
                'json' => [
                    'fields' => [
                        'TITLE' => "Просчет в онлайн калькуляторе " . (($arEventFields['CLAUSE'] === 'Да') ? "с выкупом" : "без выкупа"),
                        'CONTACT_ID' => $arEventFields['CONTACT_ID'],
                        'ASSIGNED_BY_ID' => !$arEventFields['REDEEM_FILE'] ? 55 : 11,
                        'STAGE_ID' => 'C11:AMO_36540761',
                        "CATEGORY_ID" => 11,
                        'UF_CRM_1727620881' => $arEventFields['ARRIVAL_LOCATION'],
                        'OPPORTUNITY' => $arEventFields['TOTAL_COST_FOR_DEAL'],
                        'UF_CRM_1727623622' => $arEventFields['TOTAL_VOLUME'],
                        'UF_CRM_1727623658' => $arEventFields['TOTAL_WEIGHT'],
                        'UF_CRM_1727623689' => (float)$arEventFields['COUNT'],
                        'UF_CRM_1727623700' => $arEventFields['MAX_DIMENSION'],
                        'UF_CRM_1727623715' => $arEventFields['TYPE_OF_GOODS'],
                        'UF_CRM_1727623723' => $arEventFields['BOXING'],
                        'UF_CRM_1727623734' => $arEventFields['CLAUSE'],
                        'UF_CRM_1727623742' => $arEventFields['BRAND'],
                        'UF_CRM_1727623761' => $arEventFields['CURRENCY_SIGN'],
                        'CURRENCY_ID' => $arEventFields['CURRENCY_SIGN_ID'],
                        'UF_CRM_1727623773' => $arEventFields['INSURANCE'],
                        'UF_CRM_1727623784' => $arEventFields['COUNTRY'],
                        'UF_CRM_1727697655' => $arEventFields['REDEEM_FILE'],
                        'UF_CRM_1727801223' => $arEventFields['CARGO_SPACE_LIST'],
                        'UF_CRM_1727848311' => $arEventFields['WHITE_SPACE_LIST'],
                        'UF_CRM_1727801567' => $arEventFields['GOODS_CARGO_SPACE'],
                    ],
                    'params' => ['REGISTER_SONET_EVENT' => 'Y']
                ]
            ]);

            $result = json_decode($response->getBody(), true);

            if (isset($result['result']) && $result['result'] > 0) {
                $this->addCommentToDeal($result['result'], $arEventFields, true);
            }

            return $result['result'] ?? null;
        } catch (\Exception $e) {
            AddMessage2Log("Ошибка создания сделки: " . $e->getMessage());
            return null;
        }
    }

    public function updateDeal($dealId, $arEventFields, $stage_id, $category_id)
    {
        $client = new Client();
        $response = $client->request('POST', 'https://b24-etsy4e.bitrix24.ru/rest/41/ncpxgxphz88u0n6w/crm.deal.update.json', [
            'json' => [
                'id' => $dealId,
                'fields' => [
                    'TITLE' => "Просчет в онлайн калькуляторе " . (($arEventFields['CLAUSE'] === 'Да') ? "с выкупом" : "без выкупа"),
                    'CONTACT_ID' => $arEventFields['CONTACT_ID'],
                    'ASSIGNED_BY_ID' => !$arEventFields['REDEEM_FILE'] ? 55 : 11,
                    'STAGE_ID' => $stage_id,
                    "CATEGORY_ID" => $category_id,
                    'UF_CRM_1727620881' => $arEventFields['ARRIVAL_LOCATION'],
                    'OPPORTUNITY' => $arEventFields['TOTAL_COST_FOR_DEAL'],
                    'UF_CRM_1727623622' => $arEventFields['TOTAL_VOLUME'],
                    'UF_CRM_1727623658' => $arEventFields['TOTAL_WEIGHT'],
                    'UF_CRM_1727623689' => (float)$arEventFields['COUNT'],
                    'UF_CRM_1727623700' => $arEventFields['MAX_DIMENSION'],
                    'UF_CRM_1727623715' => $arEventFields['TYPE_OF_GOODS'],
                    'UF_CRM_1727623723' => $arEventFields['BOXING'],
                    'UF_CRM_1727623734' => $arEventFields['CLAUSE'],
                    'UF_CRM_1727623742' => $arEventFields['BRAND'],
                    'UF_CRM_1727623761' => $arEventFields['CURRENCY_SIGN'],
                    'CURRENCY_ID' => $arEventFields['CURRENCY_SIGN_ID'],
                    'UF_CRM_1727623773' => $arEventFields['INSURANCE'],
                    'UF_CRM_1727623784' => $arEventFields['COUNTRY'],
                    'UF_CRM_1727697655' => $arEventFields['REDEEM_FILE'],
                    'UF_CRM_1727801223' => $arEventFields['CARGO_SPACE_LIST'],
                    'UF_CRM_1727848311' => $arEventFields['WHITE_SPACE_LIST'],
                    'UF_CRM_1727801567' => $arEventFields['GOODS_CARGO_SPACE'],
                ],
                'params' => ['REGISTER_SONET_EVENT' => 'Y']
            ]
        ]);
        $responseArray = json_decode($response->getBody(), true);

        if (isset($responseArray['result']) && $responseArray['result'] > 0) {
            $this->addCommentToDeal($dealId, $arEventFields, false);
        }
        return $responseArray;
    }

    public function addCommentToDeal($dealId, $arEventFields, $isNewDeal = true)
    {
        $client = new Client();

        $commentHeader = $isNewDeal ? "Новый просчет в калькуляторе:" : "Сделка обновлена:";

        $commentText = $this->prepareCommentFields($arEventFields, $commentHeader);

        $client->request('POST', 'https://b24-etsy4e.bitrix24.ru/rest/41/t7v1j73j4c51z0w3/crm.timeline.comment.add.json', [
            'json' => [
                'fields' => [
                    'ENTITY_ID' => $dealId,
                    'ENTITY_TYPE' => 'deal',
                    'COMMENT' => $commentText,
                    'FILES' => [
                        [
                            $arEventFields['REDEEM_FILE']['fileData'][0],
                            $arEventFields['REDEEM_FILE']['fileData'][1],
                        ]
                    ],
                ]
            ]
        ]);
    }

    private function prepareCommentFields($arEventFields, $commentHeader)
    {
        $fieldNames = [
            'COUNT' => 'Количество грузомест',
            'ARRIVAL_LOCATION' => 'Пункт прибытия',
            'TOTAL_VOLUME' => 'Общий объем',
            'TOTAL_WEIGHT' => 'Общий вес',
            'MAX_DIMENSION' => 'Максимальный размер',
            'TYPE_OF_GOODS' => 'Тип товаров',
            'BOXING' => 'Упаковка',
            'CLAUSE' => 'Выкуп',
            'BRAND' => 'Бренд',
            'CURRENCY_SIGN_ID' => 'Валюта выбранная для расчета',
            'INSURANCE' => 'Страховка',
            'COUNTRY' => 'Страна',
            'TOTAL_COST_FOR_DEAL' => 'Стоимость товаров'
        ];

        $commentText = $commentHeader . "\n";
        $commentText .= 'Грузовые места/Товары: ' . $arEventFields['GOODS_CARGO_SPACE'] . "\n";
        if (is_array($arEventFields['CARGO_SPACE_LIST']) && !empty($arEventFields['CARGO_SPACE_LIST'])) {
            $commentText .= "Список грузомест:\n";
            foreach ($arEventFields['CARGO_SPACE_LIST'] as $cargoSpace) {
                $commentText .= '       ' . $cargoSpace . "\n";
            }
        } else {
            $commentText .= "Список грузомест: не заполнено\n";
        }

        if (is_array($arEventFields['WHITE_SPACE_LIST']) && !empty($arEventFields['WHITE_SPACE_LIST'])) {
            $commentText .= "ТН ВЭД Данные товаров:\n";
            foreach ($arEventFields['WHITE_SPACE_LIST'] as $whiteSpace) {
                $commentText .= '       ' . $whiteSpace . "\n";
            }
        } else {
            $commentText .= "ТН ВЭД Данные товаров: не заполнено\n";
        }

        foreach ($fieldNames as $key => $fieldName) {
            if (isset($arEventFields[$key])) {
                $commentText .= $fieldName . ": " . $arEventFields[$key] . "\n";
            }
        }

        return $commentText;
    }

    public function updateDealAddOffer($dealId, $stage_id, $category_id, $offerFile)
    {
        $client = new Client();
        $response = $client->request('POST', 'https://b24-etsy4e.bitrix24.ru/rest/41/ncpxgxphz88u0n6w/crm.deal.update.json', [
            'json' => [
                'id' => $dealId,
                'fields' => [
                    'STAGE_ID' => $stage_id,
                    "CATEGORY_ID" => $category_id,
                    'UF_CRM_1727697688' => $offerFile,
                ],
            ]
        ]);
        // Проверяем результат обновления сделки
        $dealUpdateResult = json_decode($response->getBody(), true);
        if (isset($dealUpdateResult['error'])) {
            echo "Ошибка обновления сделки: " . $dealUpdateResult['error_description'];
            return;
        }

        $commentData = $this->getLastCommentIdByDeal($dealId);

        if ($commentData['ID']) {
            $this->addOfferFileToComment($commentData, $offerFile);
        } else {
            echo "Комментарий не найден для сделки с ID: {$dealId}";
        }
    }

    public function getLastCommentIdByDeal($dealId)
    {
        $client = new Client();

        // Получаем последний комментарий
        $response = $client->request('POST', 'https://b24-etsy4e.bitrix24.ru/rest/41/ncpxgxphz88u0n6w/crm.timeline.comment.list.json', [
            'json' => [
                'filter' => [
                    'ENTITY_ID' => $dealId,
                    'ENTITY_TYPE' => 'deal',
                ],
                'order' => [
                    'ID' => 'DESC'
                ],
                'select' => [
                    'ID',
                    'COMMENT',
                ]
            ]
        ]);

        $comments = json_decode($response->getBody(), true);
        // Возвращаем ID последнего комментария
        if (!empty($comments['result'][0]['ID'])) {
            return $comments['result'][0];
        }

        return null;  // Если комментариев нет
    }

    public function addOfferFileToComment($commentData, $offerFileData)
    {
        $client = new Client();

        $response = $client->request('POST', 'https://b24-etsy4e.bitrix24.ru/rest/41/ncpxgxphz88u0n6w/crm.timeline.comment.update.json', [
            'json' => [
                'id' => $commentData['ID'],
                'fields' => [
                    'COMMENT' => $commentData['COMMENT'],
                    'FILES' => [
                        [
                            $offerFileData['fileData'][0],
                            $offerFileData['fileData'][1],
                        ],
                    ]
                ]
            ]
        ]);
//        AddMessage2Log(print_r($response, true));
        return json_decode($response->getBody(), true);
    }

    protected function prepareEventFields($request)
    {
        $cargoSpaceList = $this->formatCargoList(json_decode($request->getPost('goodsForBitrix')));
        $whiteSpaceList = $this->formatWhileList(json_decode($request->getPost('itemsForBitrix')));
        $total_cost = $cargoSpaceList['total_cost'] ?: $whiteSpaceList['total_cost_white'];
        $currency = $cargoSpaceList['currency'] ?: $whiteSpaceList['currency_white'];
        $count = $cargoSpaceList['count'] ?: $whiteSpaceList['count_white'];

        unset($cargoSpaceList['total_cost']);
        unset($cargoSpaceList['currency']);
        unset($cargoSpaceList['count']);

        unset($whiteSpaceList['total_cost_white']);
        unset($whiteSpaceList['currency_white']);
        unset($whiteSpaceList['count_white']);

        return [
            "ARRIVAL_LOCATION" => $request->getPost("arrival"),
            "TOTAL_COST" => !$total_cost ? $request->getPost("total_cost") . $request->getPost("currency_sign") : $total_cost,
            "TOTAL_COST_FOR_DEAL" => !$total_cost ? (float)$request->getPost("total_cost") : (float)$total_cost,
            "TOTAL_VOLUME" => $request->getPost("total_volume"),
            "TOTAL_WEIGHT" => $request->getPost("total_weight"),
            "COUNT" => !$count ? $request->getPost("count") : $count,
            "MAX_DIMENSION" => $request->getPost("max_dimension"),
            "TYPE_OF_GOODS" => $request->getPost("type_of_goods"),
            "BOXING" => $request->getPost("boxing") !== 'null' ? $request->getPost("boxing") : "Скотч",
            "CLAUSE" => $request->getPost("clause"),
            "BRAND" => $request->getPost("brand") !== 'null' ? $request->getPost("brand") : "нет",
            "CURRENCY_SIGN" => !$currency ? ($request->getPost("currency_sign") == "$" ? "$ (Доллар)" :
                ($request->getPost("currency_sign") == "¥" ? "¥ (Юань)" :
                    ($request->getPost("currency_sign") == "₽" ? "₽ (Рубль)" :
                        $request->getPost("currency_sign") . " (Неизвестная валюта)"))) : $currency,
            "CURRENCY_SIGN_ID" => !$currency ? ($request->getPost("currency_sign") == "$" ? "USD" :
                ($request->getPost("currency_sign") == "¥" ? "CNY" :
                    ($request->getPost("currency_sign") == "₽" ? "RUB" :
                        $request->getPost("currency_sign") . " (Неизвестная валюта)"))) :
                            ($currency == "$" || $currency == "USD" ? "USD" :
                                ($currency == "¥" || $currency == "CNY" ? "CNY" :
                                    ($currency == "₽" || $currency == "RUB" ? "RUB" :
                                        $currency . " (Неизвестная валюта)"))),
            "INSURANCE" => $request->getPost("insurance") !== 'null' ? 'Да' : "нет",
            "COUNTRY" => $request->getPost("country"),
            "CONTACT_ID" => null,
            "PHONE" => ContactHandling::handlePhone($request->getPost("phone")),
            "NAME" => $request->getPost("name"),
            "GOODS_CARGO_SPACE" => $request->getPost("calc_type") ?: ($request->getPost("good") === 'good' ? 'Товары' : ($request->getPost("dimensions") === 'dimensions' ? 'Грузовые места' : 'Общий вес и объём')),
            'CARGO_SPACE_LIST' => $cargoSpaceList,
            'WHITE_SPACE_LIST' => $whiteSpaceList,
        ];

    }

    protected function prepFiletoBitrix24($file)
    {
        if (is_array($file) && $file['error'] === UPLOAD_ERR_OK) {
            $fileArray = \CFile::MakeFileArray($file['tmp_name']);
            $fileArray['name'] = $file['name'];
            $fileId = \CFile::SaveFile($fileArray, "bitrix24_deal_attachments");

            if ($fileId > 0) {
                $savedFileArray = \CFile::GetFileArray($fileId);

                if ($savedFileArray) {
                    $fileContent = file_get_contents($_SERVER['DOCUMENT_ROOT'] . $savedFileArray['SRC']);
                    $fileBase64 = base64_encode($fileContent);
                    return [
                        'fileData' => [
                            $savedFileArray['ORIGINAL_NAME'],
                            $fileBase64
                        ]
                    ];
                }
            }
        }
        return null;
    }

    protected function formatCargoList($goodsList)
    {
        $cargoList = [];
        $total_cost = 0;
        $count = 0;
        $currency = '';
        foreach ($goodsList as $goods) {
            $cargoItem = sprintf(
                "Тип товара: %s, Длина: %.2f м, Ширина: %.2f м, Высота: %.2f м, Цена: %.2f %s, Вес: %.2f кг, Количество: %d, Бренд: %s",
                $goods->type_of_goods,
                $goods->length,
                $goods->width,
                $goods->height,
                $goods->price,
                trim($goods->currency_sign),
                $goods->weight,
                $goods->count,
                $goods->brand ? 'да' : 'нет',
            );
            $total_cost += $goods->price;
            $count += $goods->count;
            $cargoList[] = $cargoItem;
            $currency = trim($goods->currency_sign);
        }
        $cargoList['total_cost'] = $total_cost;
        $cargoList['currency'] = $currency;
        $cargoList['count'] = $count;
        return $cargoList;
    }

    protected function formatWhileList($itemsList)
    {
        $itemsFormattedList = [];
        $total_cost = 0;
        $count = 0;
        $currency = '';

        foreach ($itemsList as $item) {
            $itemFormatted = sprintf(
                "Наименование: %s, Код товара: %s, Цена: %.2f %s, Вес: %.3f кг, Объем: %.3f м³",
                $item->good_name,
                $item->code,
                $item->price,
                trim($item->{'price-currency'}),
                $item->weight,
                $item->volume,
            );

            $total_cost += $item->price;

            $count++;

            $itemsFormattedList[] = $itemFormatted;

            $currency = trim($item->{'price-currency'});
        }
        $itemsFormattedList['total_cost_white'] = $total_cost;
        $itemsFormattedList['currency_white'] = $currency;
        $itemsFormattedList['count_white'] = $count;

        return $itemsFormattedList;
    }
}
