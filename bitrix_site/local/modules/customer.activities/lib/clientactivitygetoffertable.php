<?php

namespace Customer\Activities;

use Bitrix\Main\Entity;
use Bitrix\Main\Application;

class ClientActivityGetOfferTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return 'b_client_activity_get_offer';
    }

    public static function getMap()
    {
        return [
            new Entity\IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true,
                'title' => 'Уникальный идентификатор',
            ]),
            new Entity\IntegerField('CLIENT_ID', [
                'required' => true,
                'title' => 'ID клиента',
            ]),
            new Entity\StringField('PDF_FILE_URL', [
                'title' => 'Ссылка на файл PDF OFFER',
            ]),
            new Entity\StringField('EXCEL_FILE_URL', [
                'title' => 'Ссылка на файл Excel Redeem',
            ]),
        ];
    }
}