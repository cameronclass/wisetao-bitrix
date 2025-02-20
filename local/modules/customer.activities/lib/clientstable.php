<?php

namespace Customer\Activities;

use Bitrix\Main\Entity;
use Bitrix\Main\Application;

class ClientsTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return 'b_clients';
    }

    public static function getMap()
    {
        return [
            new Entity\IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true,
                'title' => 'ID клиента',
            ]),
            new Entity\StringField('NAME', [
                'required' => true,
                'title' => 'Имя клиента',
            ]),
            new Entity\StringField('PHONE', [
                'required' => true,
                'title' => 'Телефон клиента',
                'unique' => true,
            ]),
        ];
    }
}