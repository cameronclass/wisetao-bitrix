<?php

use Bitrix\Main\Loader;

Loader::registerAutoLoadClasses('customer.activities', array(
    'Customer\\Activities\\ClientsTable' => '/lib/clientstable.php',
    'Customer\\Activities\\ClientActivityGetOfferTable' => '/lib/clientactivitygetoffertable.php',
));
