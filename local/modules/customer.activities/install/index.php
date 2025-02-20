<?php

use Bitrix\Main\Application;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Loader;
use Customer\Activities\ClientsTable;
use Customer\Activities\ClientActivityGetOfferTable;

Loc::loadMessages(__FILE__);

class customer_activities extends CModule
{
    public function __construct()
    {
        $arModuleVersion = array();
        include(__DIR__."/version.php");

        $this->MODULE_ID = "customer.activities";
        $this->MODULE_NAME = Loc::getMessage("customer.activities_module_name");

        $this->MODULE_VERSION = $arModuleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        $this->MODULE_DESCRIPTION = Loc::getMessage("customer.activities_module_description");
        $this->PARTNER_NAME = Loc::getMessage('customer.activities_partner_name');
        $this->PARTNER_URI = Loc::getMessage('customer.activities_partner_uri');
    }

    // Метод для установки модуля
    public function doInstall()
    {
        global $APPLICATION;

        ModuleManager::registerModule($this->MODULE_ID);

        // Создание таблиц
        $this->createTables();

        $APPLICATION->IncludeAdminFile("Установка модуля", $_SERVER["DOCUMENT_ROOT"]."/local/modules/customer.activities/install/step.php");
    }

    // Метод для удаления модуля
    public function doUninstall()
    {
        global $APPLICATION;

        // Удаляем таблицу
        $this->deleteTables();

        ModuleManager::unregisterModule($this->MODULE_ID);

        $APPLICATION->IncludeAdminFile("Удаление модуля", $_SERVER["DOCUMENT_ROOT"]."/local/modules/customer.activities/install/unstep.php");
    }

    // Создание таблиц
    private function createTables()
    {
        if (Loader::includeModule($this->MODULE_ID)) {
            $entity_clients_table = ClientsTable::getEntity();
            $entity_client_activity_get_offer_table = ClientActivityGetOfferTable::getEntity();
            if (!Application::getConnection()->isTableExists($entity_clients_table->getDBTableName())) {
                $entity_clients_table->createDbTable();
            }
            if (!Application::getConnection()->isTableExists($entity_client_activity_get_offer_table->getDBTableName())) {
                $entity_client_activity_get_offer_table->createDbTable();
            }
        }
    }

    // Удаление таблиц
    private function deleteTables()
    {
        if (Loader::includeModule($this->MODULE_ID)) {
            $connection = Application::getConnection();
            $entity_clients_table = ClientsTable::getEntity();
            $entity_client_activity_get_offer_table = ClientActivityGetOfferTable::getEntity();
            AddMessage2Log('include.php загружен');
            if ($connection->isTableExists($entity_clients_table->getDBTableName())) {
                $connection->dropTable($entity_clients_table->getDBTableName());

            }
            if ($connection->isTableExists($entity_client_activity_get_offer_table->getDBTableName())) {
                $connection->dropTable($entity_client_activity_get_offer_table->getDBTableName());
            }
        }
    }
}