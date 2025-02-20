<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("catalog");

echo Add2BasketByProductID( $_POST['id'], $QUANTITY = 1, $arRewriteFields = array(), $arProductParams = false);
?>				
