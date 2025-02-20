<?php
declare(strict_types=1);

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Config\Option;
use Bitrix\Main\EventManager;
use Bitrix\Main\Application;
use Bitrix\Main\IO\Directory;

Loc::loadMessages(__FILE__);

class vkads_pixel extends CModule
{
  /*
  var $MODULE_ID = "vkads.pixel";
  var $MODULE_VERSION;
  var $MODULE_VERSION_DATE;
  var $MODULE_NAME;
  var $MODULE_DESCRIPTION;
  */
    public function __construct()
    {
        if (is_file(__DIR__ . '/version.php')) {
            $arModuleVersion = [];
            include __DIR__ . '/version.php';
            $this->MODULE_ID = 'vkads.pixel';
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
            $this->MODULE_NAME = Loc::getMessage('VKPIXEL_NAME');
            $this->MODULE_DESCRIPTION = Loc::getMessage('VKPIXEL_DESCRIPTION');
            $this->PARTNER_NAME = Loc::getMessage('VKPIXEL_PARTNER_NAME');
            $this->PARTNER_URI = Loc::getMessage('VKPIXEL_PARTNER_URI');
        }
        else {
            CAdminMessage::showMessage(
                Loc::getMessage('VKPIXEL_FILE_NOT_FOUND') . ' version.php'
            );
        }

        return false;
    }

    public function DoInstall()
    {
        global $APPLICATION;

        if (CheckVersion(ModuleManager::getVersion('main'), '14.00.00')) {
            $this->InstallDB();

            ModuleManager::registerModule($this->MODULE_ID);

            $this->InstallCode();
        } else {
            CAdminMessage::showMessage(
                Loc::getMessage('VKPIXEL_INSTALL_ERROR_VERSION')
            );
            return false;
        }

        $APPLICATION->includeAdminFile(
            Loc::getMessage('VKPIXEL_INSTALL_TITLE') . ' «' . Loc::getMessage('VKPIXEL_NAME') . '»',
            __DIR__ . '/step.php'
        );

        return false;
    }

    public function InstallDB()
    {
        return false;
    }

    public function InstallCode()
    {
        EventManager::getInstance()->registerEventHandler(
            'main',
            'OnBeforeEndBufferContent',
            $this->MODULE_ID,
            'Vkpixel\Main',
            'appendScriptsToPage'
        );

        return false;
    }

    public function DoUninstall()
    {
        global $APPLICATION;

        $this->UnInstallDB();
        $this->UnInstallCode();

        ModuleManager::unRegisterModule($this->MODULE_ID);

        $APPLICATION->includeAdminFile(
            Loc::getMessage('VKPIXEL_UNINSTALL_TITLE') . ' «' . Loc::getMessage('VKPIXEL_NAME') . '»',
            __DIR__ . '/unstep.php'
        );

        return false;
    }

    public function UnInstallDB()
    {
        Option::delete($this->MODULE_ID);

        return false;
    }

    public function UnInstallCode()
    {
        EventManager::getInstance()->unRegisterEventHandler(
            'main',
            'OnBeforeEndBufferContent',
            $this->MODULE_ID,
            'Vkpixel\Main',
            'appendScriptsToPage'
        );

        return false;
    }
}
