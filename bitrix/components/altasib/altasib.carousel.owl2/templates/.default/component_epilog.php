<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(!$_POST["altasib_owl_page"] || $_POST["ALTASIB_OWL_COUNTER"] != $arParams["COUNTER"])
{
	if($arParams['JQUERY_EN'] == 'jquery2')
		CJSCore::Init(array('jquery2'));
	elseif($arParams['JQUERY_EN'] != 'N')
		CJSCore::Init(array("jquery"));

	//include js scripts
	$APPLICATION->AddHeadScript("/bitrix/js/altasib.carousel.owl2/owl.carousel.min.js");
	$APPLICATION->AddHeadScript("/bitrix/js/altasib.carousel.owl2/jquery.mousewheel.min.js");
	//include style
	$APPLICATION->SetAdditionalCSS("/bitrix/css/altasib.carousel.owl2/owl.carousel.min.css");
	$APPLICATION->SetAdditionalCSS("/bitrix/css/altasib.carousel.owl2/owl.theme.default.min.css");
	$APPLICATION->SetAdditionalCSS("/bitrix/css/altasib.carousel.owl2/animate/_base.min.css");

	if(!empty($arParams['ANIMATE_OUT_OWL']))
		foreach($arParams['ANIMATE_OUT_OWL'] as $value)
		{
			$APPLICATION->SetAdditionalCSS("/bitrix/css/altasib.carousel.owl2/animate/".$value.".min.css");
		}

	if(!empty($arParams['ANIMATE_IN_OWL']))
		foreach($arParams['ANIMATE_IN_OWL'] as $value)
		{
			$APPLICATION->SetAdditionalCSS("/bitrix/css/altasib.carousel.owl2/animate/".$value.".min.css");
		}
}
?>