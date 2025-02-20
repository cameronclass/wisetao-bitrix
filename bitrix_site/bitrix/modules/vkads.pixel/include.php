<?php
declare(strict_types=1);

use Bitrix\Main\Loader;

Loader::registerAutoLoadClasses(
    'vkads.pixel',
    [
        'Vkpixel\\Main' => 'lib/Main.php',
    ]
);
