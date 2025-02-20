<?php

use Bitrix\Main\Loader;

require_once __DIR__ . '/../../../vendor/autoload.php';

if (class_exists('telegram_document')) {
    return;
}

Loader::registerAutoLoadClasses('telegram.document', array(
    'RedeemDataController' => '/lib/controller/redeemdatacontroller.php',
    'OrderDataController' => '/lib/controller/orderdatacontroller.php',
    'ContactHandlingController' => '/lib/controller/contacthandlingcontroller.php',
    'WisetaoFormsController' => '/lib/controller/wisetaoformscontroller.php',
    'Telegram\\Document' => '/lib/exportredeemdata.php',
    'Telegram\\Document' => '/lib/contacthandling.php',
));

include __DIR__ . '/.settings.php';