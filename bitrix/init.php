<?php
// Файл: /bitrix/init.php

// Регистрация обработчика события
AddEventHandler("iblock", "OnAfterIBlockElementAdd", "OnAfterIBlockElementAddHandler");
AddEventHandler("iblock", "OnAfterIBlockSectionAdd", "OnAfterIBlockSectionAddHandler");
AddEventHandler("main", "OnBeforeChangeFile", "SaveDynamicParamsFileHandler");

// Обработчик события
require_once($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/form_handlers.php");

function SaveDynamicParamsFileHandler($abs_path, &$content) {
    if (strpos($abs_path, "/wisetaonov/public_html/marketing.php") !== false) {
        //Для кейсов second component
        $searchString = "//SECOND_INCLUDE\n                " . '$APPLICATION->IncludeComponent' . "(\n\t\"bitrix:news.list\", \n\t\"cases_marketing\",";

        $replaceString = '//SECOND_INCLUDE
                $APPLICATION->IncludeComponent("bitrix:news.list", $templateIblockNames[\'second\'][\'template\'],';

        $content = str_replace($searchString, $replaceString, $content);

        $searchString = "\"SECOND_INCLUDE_IBLOCK_TYPE\" => \"SECOND_INCLUDE\",\n\t\t\"IBLOCK_TYPE\" => \"blog\"";
        $replaceString = "\"SECOND_INCLUDE_IBLOCK_TYPE\" => \"SECOND_INCLUDE\",\n\t\t\"IBLOCK_TYPE\" => \$templateIblockNames['second']['IBLOCK_TYPE']";
        $content = str_replace($searchString, $replaceString, $content);

        $searchString = "\"SECOND_INCLUDE_COMPONENT_TEMPLATE\" => \"SECOND_INCLUDE\",\n\t\t\"COMPONENT_TEMPLATE\" => \"cases_marketing\",";
        $replaceString = "\"SECOND_INCLUDE_COMPONENT_TEMPLATE\" => \"SECOND_INCLUDE\",\n\t\t\"COMPONENT_TEMPLATE\" => \$templateIblockNames['second']['template'],";
        $content = str_replace($searchString, $replaceString, $content);

        //Для сервисов second component
        $searchString = "//SECOND_INCLUDE\n                " . '$APPLICATION->IncludeComponent' . "(\n\t\"bitrix:news.list\", \n\t\"marketing_services\",";

        $replaceString = '//SECOND_INCLUDE
                $APPLICATION->IncludeComponent("bitrix:news.list", $templateIblockNames[\'second\'][\'template\'],';

        $content = str_replace($searchString, $replaceString, $content);

        $searchString = "\"SECOND_INCLUDE_COMPONENT_TEMPLATE\" => \"SECOND_INCLUDE\",\n\t\t\"COMPONENT_TEMPLATE\" => \"marketing_services\",";
        $replaceString = "\"SECOND_INCLUDE_COMPONENT_TEMPLATE\" => \"SECOND_INCLUDE\",\n\t\t\"COMPONENT_TEMPLATE\" => \$templateIblockNames['second']['template'],";
        $content = str_replace($searchString, $replaceString, $content);




        //Для кейсов first component
        $searchString = "//FIRST_INCLUDE\n                " . '$APPLICATION->IncludeComponent' . "(\n\t\"bitrix:news.list\", \n\t\"cases_marketing\",";

        $replaceString = '//FIRST_INCLUDE
                $APPLICATION->IncludeComponent("bitrix:news.list", $templateIblockNames[\'first\'][\'template\'],';

        $content = str_replace($searchString, $replaceString, $content);

        $searchString = "\"FIRST_INCLUDE_IBLOCK_TYPE\" => \"FIRST_INCLUDE\",\n\t\t\"IBLOCK_TYPE\" => \"blog\"";
        $replaceString = "\"FIRST_INCLUDE_IBLOCK_TYPE\" => \"FIRST_INCLUDE\",\n\t\t\"IBLOCK_TYPE\" => \$templateIblockNames['first']['IBLOCK_TYPE']";
        $content = str_replace($searchString, $replaceString, $content);

        $searchString = "\"FIRST_INCLUDE_COMPONENT_TEMPLATE\" => \"FIRST_INCLUDE\",\n\t\t\"COMPONENT_TEMPLATE\" => \"cases_marketing\",";
        $replaceString = "\"FIRST_INCLUDE_COMPONENT_TEMPLATE\" => \"FIRST_INCLUDE\",\n\t\t\"COMPONENT_TEMPLATE\" => \$templateIblockNames['first']['template'],";
        $content = str_replace($searchString, $replaceString, $content);

        //Для сервисов first component
        $searchString = "//FIRST_INCLUDE\n                " . '$APPLICATION->IncludeComponent' . "(\n\t\"bitrix:news.list\", \n\t\"marketing_services\",";

        $replaceString = '//FIRST_INCLUDE
                $APPLICATION->IncludeComponent("bitrix:news.list", $templateIblockNames[\'first\'][\'template\'],';

        $content = str_replace($searchString, $replaceString, $content);

        $searchString = "\"FIRST_INCLUDE_COMPONENT_TEMPLATE\" => \"FIRST_INCLUDE\",\n\t\t\"COMPONENT_TEMPLATE\" => \"marketing_services\",";
        $replaceString = "\"FIRST_INCLUDE_COMPONENT_TEMPLATE\" => \"FIRST_INCLUDE\",\n\t\t\"COMPONENT_TEMPLATE\" => \$templateIblockNames['first']['template'],";
        $content = str_replace($searchString, $replaceString, $content);
    }
    return true;
}

function OnAfterIBlockElementAddHandler(&$arFields) {
    $sectionCodeNum = 0;
    // Проверка на тип информационного блока (если необходимо)
    if ($arFields['IBLOCK_ID'] == '32') {

        $section = new CIBlockSection;
        $arSectionsFields = Array(
            Array(
                "ACTIVE" => "Y",
                "IBLOCK_ID" => 35,
                "NAME" => $arFields['NAME'],
                "CODE" => $arFields['CODE'],
            ),
        );
        foreach ($arSectionsFields as $arSectionFields) {
            $sectionId = $section->Add($arSectionFields);
        }
    }
    if ($arFields['IBLOCK_ID'] == '31') {
        $sectionList = CIBlockSection::GetList([], [
            'IBLOCK_ID' => 31,
            'SECTION_ID' => $arFields['IBLOCK_SECTION'][0]
        ]);
        if ($sectionList->SelectedRowsCount() == 0) {
            $sectionCode = CIBlockSection::GetList([], [
                'IBLOCK_ID' => 31,
                'ID' => $arFields['IBLOCK_SECTION'][0]
            ])->Fetch()['CODE'];
            if (!str_contains($sectionCode, "CASE")) {
                createSectionInsertElement("Кейс 1", "CASE 1", $arFields['ID'], $arFields['IBLOCK_SECTION'][0]);
            }
        }
        while ($section = $sectionList->Fetch()) {
            $sectionCodeNum++;
        }
        if ($sectionCodeNum != 0) {
            createSectionInsertElement('Кейс ' . $sectionCodeNum + 1, 'CASE ' . $sectionCodeNum + 1, $arFields['ID'], $arFields['IBLOCK_SECTION'][0]);
        }
    }
}

function createSectionInsertElement($name, $code, $id, $parentId) {
    $newSection = new CIBlockSection;
    $newSectionId = $newSection->Add([
        'IBLOCK_ID' => 31,
        'IBLOCK_SECTION_ID' => $parentId,
        'NAME' => $name,
        'CODE' => $code,
        // Здесь можно добавить другие параметры раздела
    ]);
    if ($newSectionId) {
        $newElement = new CIBlockElement;
        $newElement->Update($id, [
            'IBLOCK_SECTION_ID' => $newSectionId,
            'IBLOCK_SECTION' => array($newSectionId)
        ]);
    }
}

function OnAfterIBlockSectionAddHandler(&$arFields) {
    // Проверка на тип информационного блока (если необходимо)
    if ($arFields['IBLOCK_ID'] == '32' && $arFields['UF_ELEMENT'] == 12 && $arFields['UF_LINK'] == '/marketing.php') {

        $section = new CIBlockSection;
        $arSectionsFields = Array(
            Array(
                "ACTIVE" => "Y",
                "IBLOCK_ID" => 35,
                "NAME" => $arFields['NAME'],
                "CODE" => $arFields['CODE'],
            ),
            // Другие необходимые поля раздела
        );
        foreach ($arSectionsFields as $arSectionFields) {
            $sectionId = $section->Add($arSectionFields);
        }
    }
}