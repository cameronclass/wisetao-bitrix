<?
/**
 * Company developer: ALTASIB
 * Developer: Sypachev
 * Site: http://www.altasib.ru
 * E-mail: dev@altasib.ru
 * @copyright (c) 2006-2016 ALTASIB
 */

global $MESS;

$strPath2Lang = str_replace("\\", "/", __FILE__);
$strPath2Lang = substr($strPath2Lang, 0, strlen($strPath2Lang)-18);
@include(GetLangFileName($strPath2Lang."/lang/", "/install/index.php"));
IncludeModuleLangFile($strPath2Lang."/install/index.php");

Class altasib_carouselowl2 extends CModule
{
	var $MODULE_ID = "altasib.carouselowl2";
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	var $MODULE_CSS;
	var $MODULE_GROUP_RIGHTS = "Y";

	function altasib_carouselowl2()
	{
		$arModuleVersion = array();
		$path = str_replace("\\", "/", __FILE__);
		$path = substr($path, 0, strlen($path) - strlen("/index.php"));
		include($path."/version.php");
		if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion))
		{
			$this->MODULE_VERSION = $arModuleVersion["VERSION"];
			$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
		}
		else
		{
			$this->MODULE_VERSION = $arModuleVersion['VERSION'];
			$this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
		}
		$this->MODULE_NAME = GetMessage("ALTASIB_CAROUSEL_OWL2_REG_MODULE_NAME");
		$this->MODULE_DESCRIPTION = GetMessage("ALTASIB_CAROUSEL_OWL2_REG_MODULE_DESCRIPTION");
		$this->PARTNER_NAME = "ALTASIB";
		$this->PARTNER_URI = "http://www.altasib.ru/";
	}
	function DoInstall()
	{
		global $APPLICATION, $step;
		$step = IntVal($step);
		$this->InstallFiles();
		$this->InstallDB();
		$this->InstallIblock();
		$GLOBALS["errors"] = $this->errors;
		RegisterModule($this->MODULE_ID);
		$APPLICATION->IncludeAdminFile(GetMessage("ALTASIB_CAROUSEL_OWL2_REG_INSTALL_TITLE"), $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/altasib.carouselowl2/install/step1.php");
	}
	function DoUninstall()
	{
		global $APPLICATION, $step;
		$step = IntVal($step);
		if($step<2)
		{
			$APPLICATION->IncludeAdminFile(GetMessage("ALTASIB_CAROUSEL_OWL2_REG_UNINSTALL_TITLE"), $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/altasib.carouselowl2/install/unstep1.php");
		}
		elseif($step==2)
		{
			$this->UnInstallDB();
			$this->UnInstallFiles();
			$this->UnInstallEvents();
			UnRegisterModule($this->MODULE_ID);
			$APPLICATION->IncludeAdminFile(GetMessage("ALTASIB_CAROUSEL_OWL2_REG_UNINSTALL_TITLE"), $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/altasib.carouselowl2/install/unstep2.php");
		}
	}
	function InstallDB()
	{

	}
	function UnInstallDB()
	{

	}
	function InstallFiles()
	{
		CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/altasib.carouselowl2/install/components", $_SERVER["DOCUMENT_ROOT"]."/bitrix/components", true, true);
		CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/altasib.carouselowl2/install/css",$_SERVER["DOCUMENT_ROOT"]."/bitrix/css/altasib.carousel.owl2",true,true);
		CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/altasib.carouselowl2/install/js",$_SERVER["DOCUMENT_ROOT"]."/bitrix/js/altasib.carousel.owl2",true,true);
		return true;
	}
	function UnInstallFiles()
	{
		DeleteDirFilesEx("/bitrix/components/altasib/altasib.carousel.owl2");
		DeleteDirFilesEx("/bitrix/css/altasib.carousel.owl2");
		DeleteDirFilesEx("/bitrix/js/altasib.carousel.owl2");
		return true;
	}
	function InstallIblock()
	{

	}
	function UnInstallEvents()
	{

	}
}
?>