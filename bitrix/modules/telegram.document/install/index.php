<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;

Loc::loadMessages(__FILE__);

class telegram_document extends CModule
{
    public function __construct()
    {
        $arModuleVersion = array();
        include(__DIR__."/version.php");

        $this->MODULE_ID = 'telegram.document';
        $this->MODULE_VERSION = $arModuleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];

        $this->MODULE_NAME = Loc::getMessage("TELEGRAM_DOCUMENT_MODULE_NAME");
        $this->MODULE_DESCRIPTION = Loc::getMessage("TELEGRAM_DOCUMENT_MODULE_DESC");
    }

    public function DoInstall()
    {
        ModuleManager::registerModule($this->MODULE_ID);
    }

    public function DoUninstall()
    {
        ModuleManager::unregisterModule($this->MODULE_ID);
    }
}
