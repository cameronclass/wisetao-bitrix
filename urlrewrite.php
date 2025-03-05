<?php

$iblockId = 32;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

if (!\Bitrix\Main\Loader::includeModule("iblock")) {
    die('Error loading iblock module');
}

if (!function_exists('getUniqueLevelCodes')) {
    function getUniqueLevelCodes($iblockId, $depthLevel)
    {
        $levelSections = CIBlockSection::GetList(
            [],
            [
                'IBLOCK_ID' => $iblockId,
                'DEPTH_LEVEL' => $depthLevel,
                'ACTIVE' => 'Y',
            ],
            false,
            ['ID', 'CODE']
        );

        $uniqueCodes = [];
        while ($section = $levelSections->Fetch()) {
            $uniqueCodes[$section['CODE']] = $section['CODE'];
        }

        return array_keys($uniqueCodes);
    }
}

if (!function_exists('getUniqueElementCodes')) {
    function getUniqueElementCodes($iblockId)
    {
        $levelElements = CIBlockElement::GetList(
            [],
            [
                'IBLOCK_ID' => $iblockId,
                'ACTIVE' => 'Y',
            ],
            false,
            false,
            ['ID', 'CODE']
        );

        $uniqueCodes = [];
        while ($element = $levelElements->Fetch()) {
            $uniqueCodes[$element['CODE']] = $element['CODE'];
        }

        return array_keys($uniqueCodes);
    }
}

// Получение уникальных кодов
$secondLevelCodes = getUniqueLevelCodes($iblockId, 2);
$thirdLevelCodes = getUniqueLevelCodes($iblockId, 3);
$fourthLevelCodes = getUniqueElementCodes($iblockId);

// Определение исключенных слов
$excludedWords = ['about', 'logistic']; // Список слов, которые нужно исключить из второго уровня
$excludedThirdLevelWords = ['blog', 'faq', 'reviews', 'contacts', 'company-history'];

// Удаление исключенных слов
$filteredSecondLevelCodes = array_diff($secondLevelCodes, $excludedWords);
$filteredThirdLevelCodes = array_diff($thirdLevelCodes, $excludedThirdLevelWords);

// Преобразование массива кодов в строку для регулярного выражения
$secondLevelElementsString = implode('|', $filteredSecondLevelCodes);
$thirdLevelElementsString = implode('|', $filteredThirdLevelCodes);
$fourthLevelElementsString = implode('|', $fourthLevelCodes);

// Создание строки для негативного просмотра вперед
//$negativeLookahead = '(?!'.implode('|', $excludedWords).')';
//$negativeLookaheadThirdLevel = '(?!'.implode('|', $excludedThirdLevelWords).')';
// Обновление правил в массиве $arUrlRewrite
$arUrlRewrite = array(
    17 => array(
        'CONDITION' => '#^/(from-china|in-china)/(' . $secondLevelElementsString . ')/(' . $thirdLevelElementsString . ')/(' . $fourthLevelElementsString . ')((?:/bitrix_include_areas-([YN]))?)/(\?.*)?$#',
        'RULE' => 'direct-china=$1&data-in-level=$3&data-in-menu=$2&name=$4&bitrix_include_areas=$6$7',
        'ID' => '',
        'PATH' => '/marketing.php',
        'SORT' => 100,
    ),
    11 => array(
        'CONDITION' => '#^/(from-china|in-china)/(' . $secondLevelElementsString . ')/(' . $thirdLevelElementsString . ')((?:/bitrix_include_areas-([YN]))*)/(\?.*)?$#',
        'RULE' => 'direct-china=$1&data-in-menu=$2&name=$3&bitrix_include_areas=$5',
        'ID' => '',
        'PATH' => '/marketing.php',
        'SORT' => 100,
    ),
    10 => array(
        'CONDITION' => '#^/(from-china|in-china)/(' . $secondLevelElementsString . ')((?:/bitrix_include_areas-([YN]))*)/(\?.*)?$#',
        'RULE' => 'direct-china=$1&name=$2&bitrix_include_areas=$4',
        'ID' => '',
        'PATH' => '/marketing.php',
        'SORT' => 100,
    ),
    6 =>
        array(
            'CONDITION' => '#^/(from-china|in-china)/(about)/(contacts)((?:/bitrix_include_areas-([YN]))*)/(.*)#',
            'RULE' => 'direct-china=$1&data-in-menu=$2&name=$3&bitrix_include_areas=$5$6',
            'ID' => '',
            'PATH' => '/contacts.php',
            'SORT' => 100,
        ),
    4 =>
        array(
            'CONDITION' => '#^/(from-china|in-china)/(about)/(blog)/([a-zA-Z0-9-]+-([0-9]+))/(.*)#',
            'RULE' => 'direct-china=$1&data-in-menu=$2&name=$3&ID=$5$6',
            'ID' => '',
            'PATH' => '/blog-inside.php',
            'SORT' => 100,
        ),
    3 =>
        array(
            'CONDITION' => '#^/(from-china|in-china)/(about)/(company-history)/(.*)#',
            'RULE' => 'direct-china=$1&data-in-menu=$2&name=$3$4',
            'ID' => '',
            'PATH' => '/about.php',
            'SORT' => 100,
        ),
    13 =>
        array(
            'CONDITION' => '#^/(from-china|in-china)/(about)/(reviews)/(.*)#',
            'RULE' => 'direct-china=$1&data-in-menu=$2&name=$3$4',
            'ID' => '',
            'PATH' => '/reviews.php',
            'SORT' => 100,
        ),
    19 =>
        array(
            'CONDITION' => '#^/(hash-[a-zA-Z0-9-]+)/(data-in-level-[a-zA-Z0-9-]+)/#',
            'RULE' => 'data-in-menu=$1&data-in-level=$2',
            'ID' => '',
            'PATH' => '/index.php',
            'SORT' => 100,
        ),
    5 =>
        array(
            'CONDITION' => '#^/(from-china|in-china)/(about)/(blog)/(.*)#',
            'RULE' => 'direct-china=$1&data-in-menu=$2&name=$3$4',
            'ID' => '',
            'PATH' => '/blog.php',
            'SORT' => 100,
        ),
    8 =>
        array(
            'CONDITION' => '#^/(from-china|in-china)/(about)/(faq)/(.*)#',
            'RULE' => 'direct-china=$1&data-in-menu=$2&name=$3$4',
            'ID' => '',
            'PATH' => '/faq.php',
            'SORT' => 100,
        ),
    9 =>
        array(
            'CONDITION' => '#^/(from-china|in-china)/(logistic)/(.*)$#',
            'RULE' => 'direct-china=$1&data-in-menu=$2',
            'ID' => '',
            'PATH' => '/logistic.php',
            'SORT' => 100,
        ),
    7 =>
        array(
            'CONDITION' => '#^/developing/([a-zA-Z0-9-]+)/(.*)$#',
            'RULE' => 'direct-china=$1$2',
            'ID' => '',
            'PATH' => '/developing.php',
            'SORT' => 100,
        ),
    18 =>
        array(
            'CONDITION' => '#^/bitrix_include_areas-([YN])/$#',
            'RULE' => 'bitrix_include_areas=$1',
            'ID' => '',
            'PATH' => '/index.php',
            'SORT' => 100,
        ),
    16 =>
        array(
            'CONDITION' => '#^/(from-china|in-china)/$#',
            'RULE' => '',
            'ID' => 'bitrix:form.result.new',
            'PATH' => '/marketing.php',
            'SORT' => 100,
        ),
    0 =>
        array(
            'CONDITION' => '#^/bitrix/services/ymarket/#',
            'RULE' => '',
            'ID' => '',
            'PATH' => '/bitrix/services/ymarket/index.php',
            'SORT' => 100,
        ),
    15 =>
        array(
            'CONDITION' => '#^/(hash-[a-zA-Z0-9-]+)/#',
            'RULE' => 'data-in-menu=$1',
            'ID' => '',
            'PATH' => '/index.php',
            'SORT' => 100,
        ),
    1 =>
        array(
            'CONDITION' => '#^/novosti/#',
            'RULE' => '',
            'ID' => 'bitrix:news',
            'PATH' => '/novosti/index.php',
            'SORT' => 100,
        ),
    2 =>
        array(
            'CONDITION' => '#^/rest/#',
            'RULE' => '',
            'ID' => NULL,
            'PATH' => '/bitrix/services/rest/index.php',
            'SORT' => 100,
        ),
    14 =>
        array(
            'CONDITION' => '#^/$#',
            'RULE' => '',
            'ID' => '',
            'PATH' => '/index.php',
            'SORT' => 100,
        ),
);