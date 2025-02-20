<?php

namespace Telegram\Document;

use libphonenumber\PhoneNumberUtil;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberFormat;
use GuzzleHttp\Client;

class ContactHandling {
    public static function handlePhone($phone)
    {
        return self::normalizePhoneNumber($phone);
    }

    protected static function normalizePhoneNumber($phone) {
        $phoneUtil = PhoneNumberUtil::getInstance();
        try {
            $phone = preg_replace(['/(?!^\+)[^\d]/', '/^8/', '/^0/'], ['', '+7', '+996'], $phone);
            $numberProto = $phoneUtil->parse($phone);
//            AddMessage2Log(print_r($phone, true));
            if ($phoneUtil->isValidNumber($numberProto)) {
                return $phoneUtil->format($numberProto, PhoneNumberFormat::E164);
            } else {
                return 'Неверный номер.';
            }
        } catch (NumberParseException $e) {
            return 'Ошибка парсинга номера: ' . $e->getMessage();
        }
    }

    public static function getContactByPhone($phone) {
        $client = new Client();
        $baseUrl = 'https://b24-etsy4e.bitrix24.ru/rest/41/yi3s5n7wv33q0foh/';
        $phone = self::handlePhone($phone);
        try {
            $response = $client->request('GET', $baseUrl . 'crm.contact.list.json', [
                'query' => [
                    'filter' => ['PHONE' => $phone],
                    'select' => ['ID']
                ]
            ]);
            $result = json_decode($response->getBody(), true);
            return $result['result'] ? $result['result'][0] : null;
        } catch (\Exception $e) {
            return null;
        }
    }

    public static function createContact($contactData)
    {
        $client = new Client();
        $baseUrl = 'https://b24-etsy4e.bitrix24.ru/rest/41/mpsh9pjb35h1npez/';
        try {
            $bitrix24Contact = self::getContactByPhone($contactData['PHONE']);
            if (!$bitrix24Contact) {
                $response = $client->request('POST', $baseUrl . 'crm.contact.add.json', [
                    'json' => [
                        'fields' => [
                            'PHONE' => [['VALUE' => $contactData['PHONE'], 'VALUE_TYPE' => 'WORK']],
                            'NAME' => $contactData['NAME']
                        ],
                        'params' => ['REGISTER_SONET_EVENT' => 'Y']
                    ]
                ]);
            }
            $result = !$bitrix24Contact ? json_decode($response->getBody(), true)['result'] : $bitrix24Contact['ID'];

            return $result ?? null;
        } catch (\Exception $e) {
            AddMessage2Log("Ошибка создания сделки: " . $e->getMessage());
            return null;
        }
    }

    public static function getFilteredDealsByContactId($contactId, $funnel = 'прогрев')
    {
        $client = new Client();

        $stageIds = $funnel === 'общая'
            ? [
                "PREPARATION",
                "PREPAYMENT_INVOICE",
                "EXECUTING",
                "FINAL_INVOICE",
                "UC_ZTQZTH",
                "LOSE",
                "APOLOGY",
            ]
            : [
                "C11:AMO_36540761",
                "C11:AMO_98F79F9C",
                "C11:AMO_CAB2CB55",
                "C11:AMO_839B16CD",
                "C11:AMO_CFE467C8",
                "C11:AMO_B146190F",
                "C11:AMO_08645A9D",
                "C11:AMO_398F3F8C",
                "C11:NEW"
            ];
        try {
            $response = $client->request('GET', 'https://b24-etsy4e.bitrix24.ru/rest/41/ubnnkccx0186m3oo/crm.deal.list.json', [
                'query' => [
                    'filter' => [
                        'CONTACT_ID' => $contactId,
                        '=STAGE_ID' => $stageIds,
                    ],
                    'select' => ['ID', 'STAGE_ID', 'CATEGORY_ID'],
                    'order' => [
                        'DATE_CREATE' => 'DESC'
                    ]
                ]
            ]);
            return json_decode($response->getBody(), true)['result'] ?? [];
        } catch (Exception $e) {
            AddMessage2Log('Error: ' . $e->getMessage());
            AddMessage2Log(print_r($e, true));
            return $e;
        }
    }
}