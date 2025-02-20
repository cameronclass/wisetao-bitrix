<?php
namespace Telegram\Document\Controller;

use Bitrix\Main\Engine\ActionFilter\Csrf;
use CURLFile;
use Telegram\Document\ExportRedeemData;
use Telegram\Document\ContactHandling;
use Bitrix\Main\Context;
use Bitrix\Main\Loader;
use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Engine\Response\File;
use Customer\Activities\ClientsTable;
use Customer\Activities\ClientActivityGetOfferTable;
use CFormResult;
use function Symfony\Component\Translation\t;

class RedeemDataController extends Controller
{

    public function configureActions(): array
    {
        return [
            'export_redeem_data' => [
                'prefilters' => [
                    // здесь указываются опциональные фильтры, например:
                    new Csrf(bitrix_sessid()), // проверяет авторизован ли пользователь
                ]
            ],
            'export_received_excel_redeem_data' => [
                'prefilters' => [
                    // здесь указываются опциональные фильтры, например:
                    new Csrf(bitrix_sessid()), // проверяет авторизован ли пользователь
                ]
            ],
            'create_client' => [
                'prefilters' => [
                    // здесь указываются опциональные фильтры, например:
                    new Csrf(bitrix_sessid()), // проверяет авторизован ли пользователь
                ]
            ],
            'create_client_activity' => [
                'prefilters' => [
                    // здесь указываются опциональные фильтры, например:
                    new Csrf(bitrix_sessid()), // проверяет авторизован ли пользователь
                ]
            ],
            'download_redeem_blank' => [
                'prefilters' => [
                    // здесь указываются опциональные фильтры, например:
                    new Csrf(bitrix_sessid()), // проверяет авторизован ли пользователь
                ]
            ]

        ];
    }

    public function export_redeem_dataAction()
    {
        // Ваш код для отправки документа
        $request = Context::getCurrent()->getRequest();
        $export = new ExportRedeemData();
        $filePath = $_SERVER['DOCUMENT_ROOT'] . '/upload/tmp/redeem-data.xlsx';
        $fileURL = 'http://' . $_SERVER['HTTP_HOST'] . '/upload/tmp/redeem-data.xlsx';
        $export->saveToFile($filePath);

//        $telegramUserId = '1503015956';
//        $token = '6718064862:AAG0PjgOMyr4Z5cce01IcC8WvxgA2RGbyMs';

//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot".$token."/sendDocument?chat_id=" . $telegramUserId);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($ch, CURLOPT_POST, 1);
//
//        // Create CURLFile
//        $finfo = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $filePath);
//        $cFile = new CURLFile($filePath, $finfo, 'Данные для выкупа заказа.xlsx');
//
//        // Add CURLFile to CURL request
//        curl_setopt($ch, CURLOPT_POSTFIELDS, [
//            "document" => $cFile,
//            'caption' => 'Новый заказ с выкупом'
//        ]);
//
//        // Call
//        $result = curl_exec($ch);
//
//        // Show result and close curl
//        curl_close($ch);
// Отправка файла и его удаление после отправки
        return new File($filePath, urlencode('redeem-data.xlsx'), [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'inline; filename="'.urlencode('redeem-data.xlsx').'"',
        ]);
    }

    function export_received_excel_redeem_dataAction()
    {
        $request = Context::getCurrent()->getRequest();
        $filePath = $_SERVER['DOCUMENT_ROOT'] . '/upload/tmp/redeem-data.xlsx';
        $file = $request->getFile('file');
        if ($file && $file['error'] == UPLOAD_ERR_OK) {
            move_uploaded_file($file['tmp_name'], $filePath);
        }
//        $telegramUserId = '368502506';
//        $token = '6718064862:AAG0PjgOMyr4Z5cce01IcC8WvxgA2RGbyMs';
//
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot" . $token . "/sendDocument?chat_id=" . $telegramUserId);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($ch, CURLOPT_POST, 1);
//
//        $finfo = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $filePath);
//        $cFile = new CURLFile($filePath, $finfo, 'Данные для выкупа заказа.xlsx');
//
//        curl_setopt($ch, CURLOPT_POSTFIELDS, [
//            "document" => $cFile,
//            'caption' => 'Новый заказ с выкупом'
//        ]);
//
//        $result = curl_exec($ch);
//        curl_close($ch);

        return new File(
            $filePath,
            'redeem-data.xlsx',
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="redeem-data.xlsx"',
            ]
        );
    }

    function create_clientAction() {
        if (Loader::includeModule('customer.activities')) {
            $request = Context::getCurrent()->getRequest();

            $clientData = [
                'NAME' => $request->getPost('NAME'),
                'PHONE' => ContactHandling::handlePhone($request->getPost('PHONE')),
            ];
            // Проверка на существование клиента с таким же номером телефона или email
            $existingClient = ClientsTable::getList([
                'filter' => [
                    'PHONE' => $clientData['PHONE'],
                ],
                'select' => ['ID'] // Достаточно выбрать ID для проверки
            ])->fetch();

            if ($existingClient) {
                // Запись уже существует, ничего не делаем
                return [
                    'status' => 'exists',
                    'message' => 'Клиент с таким номером телефона или email уже существует.',
                ];
            }

            // Пытаемся добавить клиента
            $result = ClientsTable::add($clientData);

            if ($result->isSuccess()) {
                // Успешно добавлено
                return [
                    'status' => 'success',
                    'message' => 'Клиент успешно добавлен.',
                ];
            }

            // Обработка ошибок
            return [
                'status' => 'error',
                'messages' => $result->getErrorMessages(),
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Модуль customer.activities не загружен.',
            ];
        }
    }

    function create_client_activityAction() {
        $response = '';
        if (Loader::includeModule('customer.activities')) {
            if (!Loader::includeModule('form')) {
                throw new \Exception('Модуль форм не загружен');
            }

            $request = Context::getCurrent()->getRequest();

            $phoneValue = ContactHandling::handlePhone($request->getPost('PHONE'));
            $formId = 3;
//            AddMessage2Log(print_r($phoneValue, true));
            // Запрос последней записи по паре телефон и email
            $lastClientGetOffer = CFormResult::GetList(
                $formId, // ID формы
                "s_timestamp", // Сортировка
                "desc", // Убывание
                [
                    'FIELDS' => [
                        [
                            'SID' => 'SIMPLE_QUESTION_960', // Телефон
                            'PARAMETER_NAME' => 'USER_TEXT',
                            'VALUE' => $phoneValue,
                            'FILTER_TYPE' => 'text',
                            'EXACT_MATCH' => 'Y'
                        ],
                    ]
                ],
                true,
            );

            $arResult = [];
            $arAnswer2 = [];
            // Получаем данные из результата формы

            if ($lastClientGetOffer) {
                $clientResultId = $lastClientGetOffer->Fetch()['ID']; // ID последней записи

                // Получаем данные о файлах из результата формы
                $arAnswer = CFormResult::GetDataByID($clientResultId,
                    array('SIMPLE_QUESTION_780', 'SIMPLE_QUESTION_673'), // Коды полей для файлов
                    $arResult,
                    $arAnswer2,
                );

                // Инициализируем переменные для хранения ссылок на файлы
                $goodsDataLink = '';
                $commercialOfferLink = '';
                // Проверка наличия данных о товаре/грузе
                if (!empty($arAnswer['SIMPLE_QUESTION_780'])) {
                    $goodsDataLink = \CFile::GetPath($arAnswer['SIMPLE_QUESTION_780'][0]['USER_FILE_ID']); // Ссылка на файл
                }

                // Проверка наличия коммерческого предложения
                if (!empty($arAnswer['SIMPLE_QUESTION_673'])) {
                    $commercialOfferLink = \CFile::GetPath($arAnswer['SIMPLE_QUESTION_673'][0]['USER_FILE_ID']); // Ссылка на файл
                }
//                AddMessage2Log(print_r($goodsDataLink, true));
//                AddMessage2Log(print_r($commercialOfferLink, true));
                // Формируем данные для записи в таблицу ClientActivityGetOfferTable
                $clientData = [
                    'CLIENT_ID' => $clientResultId, // ID клиента из ClientsTable
                    'PDF_FILE_URL' => $commercialOfferLink, // Ссылка на файл данных о товаре/грузе
                    'EXCEL_FILE_URL' => $goodsDataLink ?? 'Без выкупа', // Ссылка на файл коммерческого предложения
                ];

                // Записываем данные в таблицу ClientActivityGetOfferTable
                $result = ClientActivityGetOfferTable::add($clientData);

                if ($result->isSuccess()) {
                    $response = [
                        'status' =>  'error',
                        'message' =>  "Данные успешно добавлены в таблицу активности клиента."
                    ];
                } else {
                    // Логирование ошибки
//                    AddMessage2Log("Ошибка добавления данных: " . implode(', ', $result->getErrorMessages()), "ClientActivityGetOfferTable");
                }
            } else {
                $response = [
                    'status' =>  'error',
                    'message' =>  "Клиент с данным телефоном и email не найден."
                ];
            }
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Модуль customer.activities не загружен.',
            ];
        }
        return $response;
    }

    function download_redeem_blankAction() {
        $filePath = $_SERVER['DOCUMENT_ROOT'] . '/upload/redeem-blank.xlsx';
        if (!file_exists($filePath)) {
//            AddMessage2Log($filePath, true);
            throw new \Exception('Файл не найден');
        }
        elseif (!is_readable($filePath)) {
//            AddMessage2Log('Файл существует, но недоступен для чтения!', true);
            throw new \Exception('Файл недоступен для чтения');
        }
        return new File(
            $filePath,
            'Данные для выкупа заказа.xlsx',
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename=Данные для выкупа заказа.xlsx',
            ]
        );
    }
}