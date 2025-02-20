<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$brand = $arResult['PROPERTIES']['BRAND']['VALUE'];
if ($brand)
{

	$arSelect = Array("ID", "IBLOCK_ID", "NAME", "CODE", "DETAIL_PAGE_URL", "PREVIEW_TEXT", "PREVIEW_PICTURE");//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
	$arFilter = Array("IBLOCK_ID"=>1, "ID"=>$brand, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
	while($ob = $res->GetNextElement()){ 
	 $arFields = $ob->GetFields();  
	}

	$arResult['DISPLAY_PROPERTIES']['BRAND']['FULL'] = $arFields;
}
?>
