<?
$this->queryExecute("SET NAMES 'utf8'");
$this->queryExecute('SET collation_connection = "utf8_unicode_ci"');

$connection = Bitrix\Main\Application::getConnection();
$this->queryExecute("SET LOCAL time_zone='".date('P')."'");
?>