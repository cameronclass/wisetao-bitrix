<?
define("BX_USE_MYSQLI", true);
define("DBPersistent", false);

$DBType = "mysql";
$DBHost = "localhost";
$DBLogin = "localhost";
$DBPassword = "";
$DBName = "bitrix_local";
$DBDebug = false;
$DBDebugToFile = false;

date_default_timezone_set("Asia/Yakutsk");

define("DELAY_DB_CONNECT", true);
define("CACHED_b_file", 3600);
define("CACHED_b_file_bucket_size", 10);
define("CACHED_b_lang", 3600);
define("CACHED_b_option", 3600);
define("CACHED_b_lang_domain", 3600);
define("CACHED_b_site_template", 3600);
define("CACHED_b_event", 3600);
define("CACHED_b_agent", 3660);
define("CACHED_menu", 3600);

define("BX_UTF", true);
define("BX_FILE_PERMISSIONS", 0644);
define("BX_DIR_PERMISSIONS", 0755);
@umask(~BX_DIR_PERMISSIONS);
@ini_set("memory_limit", "512M");
define("BX_DISABLE_INDEX_PAGE", true);
define('LOG_FILENAME', $_SERVER['DOCUMENT_ROOT'] . '/_main.log');


// Минификация CSS/JS
define("BX_COMPRESSED_CSS_JS", true); // Включаем сжатие
define("BX_COMPOSITE_GROUP_SIZE", 8192); // Размер группы для объединения
COption::SetOptionString("main", "compressed_js_css_path", "/upload/compressed/"); // Путь для сохранения
?>