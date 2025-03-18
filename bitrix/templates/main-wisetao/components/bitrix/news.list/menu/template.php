<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(false);

if (!function_exists('traverseSectionsAndElements')) {
    function traverseSectionsAndElements($parentId, &$sectionsAndElements, $iblockId)
    {
        $rootSectionCodes = [
            74 => 'from-china',
            75 => 'in-china',
        ];
        // Запрос к базе данных для разделов
        $sectionsQuery = CIBlockSection::GetList(
            [],
            [
                'IBLOCK_ID' => $iblockId,
                'SECTION_ID' => $parentId,
                'ACTIVE' => 'Y',
            ],
            false,
            [
                'ID',
                'IBLOCK_ID',
                'NAME',
                'IBLOCK_SECTION_ID',
                'CODE', // Символьный код раздела или элемента
                'PROPERTY_*', // Загружаем все свойства
                'UF_LINK',
                'UF_IN_DEV',
                'UF_SECOND_TITTLE',
                'UF_SERVICE_TITTLE',
                'UF_ELEMENT',
                'UF_ICON',
                'UF_MENU_ICON',
                'UF_TITLE_IMG',
            ]
        );

        // Добавляем разделы в структуру
        while ($sectionRow = $sectionsQuery->Fetch()) {
            $sectionRow['UF_ICON'] = CFile::GetPath($sectionRow['UF_ICON']);
            $sectionRow['UF_MENU_ICON'] = CFile::GetPath($sectionRow['UF_MENU_ICON']);
            $sectionRow['UF_TITLE_IMG'] = CFile::GetPath($sectionRow['UF_TITLE_IMG']);
            $sectionsAndElements[$sectionRow['ID']] = [
                'ID' => $sectionRow['ID'],
                'IBLOCK_ID' => $sectionRow['IBLOCK_ID'],
                'IBLOCK_SECTION_ID' => $sectionRow['IBLOCK_SECTION_ID'],
                'PARENT_SECTION_CODE' => $rootSectionCodes[$sectionRow['IBLOCK_SECTION_ID']],
                'NAME' => $sectionRow['NAME'],
                'CODE' => $sectionRow['CODE'],
                'UF_LINK' => $sectionRow['UF_LINK'],
                'UF_IN_DEV' => CUserFieldEnum::GetList([], ['ID' => $sectionRow['UF_IN_DEV'], 'USER_FIELD_NAME' => 'UF_IN_DEV',])->Fetch()['XML_ID'],
                'UF_ELEMENT' => CUserFieldEnum::GetList([], ['ID' => $sectionRow['UF_ELEMENT'], 'USER_FIELD_NAME' => 'UF_ELEMENT',])->Fetch()['XML_ID'],
                'UF_ICON' => $sectionRow['UF_ICON'],
                'UF_MENU_ICON' => $sectionRow['UF_MENU_ICON'],
                'UF_TITLE_IMG' => $sectionRow['UF_TITLE_IMG'],
                'UF_SECOND_TITTLE' => $sectionRow['UF_SECOND_TITTLE'],
                'UF_SERVICE_TITTLE' => $sectionRow['UF_SERVICE_TITTLE'],
                'EDIT_LINK' => '/bitrix/admin/iblock_section_edit.php?IBLOCK_ID=' . $sectionRow['IBLOCK_ID'] . '&type=menu' . '&ID=' . $sectionRow['ID'] . '&lang=' . LANGUAGE_ID . '&force_catalog=&filter_section=' . $parentId . '&bxpublic=Y&from_module=iblock',
                'PROPERTIES' => [], // Создаем массив для хранения свойств
                'ELEMENTS' => [] // Создаем массив для хранения элементов
            ];
            // Рекурсивно вызываем функцию для обхода подразделов
            traverseSectionsAndElements($sectionRow['ID'], $sectionsAndElements[$sectionRow['ID']]['ELEMENTS'], $iblockId);
        }

        // Запрос к базе данных для элементов
        $elementsQuery = CIBlockElement::GetList(
            [],
            [
                'IBLOCK_ID' => $iblockId,
                'SECTION_ID' => $parentId,
                'ACTIVE' => 'Y',
            ],
            false,
            false,
            [
                'ID',
                'IBLOCK_ID',
                'NAME',
                'IBLOCK_SECTION_ID',
                'CODE', // Символьный код раздела или элемента
            ]
        );

        // Добавляем элементы в структуру
        while ($elementRow = $elementsQuery->Fetch()) {
            $elementProperties = [];

            // Получаем свойства элемента
            $elementProps = CIBlockElement::GetProperty($iblockId, $elementRow['ID']);
            while ($prop = $elementProps->Fetch()) {
                $elementProperties[$prop['CODE']] = $prop['VALUE'];
                if ($prop['CODE'] == 'IN_DEV') {
                    $elementProperties[$prop['CODE']] = $prop['VALUE_XML_ID'];
                }
            }
            $elementProperties['ICON'] = CFile::GetPath($elementProperties['ICON']);
            $sectionsAndElements[$elementRow['ID']] = [
                'ID' => $elementRow['ID'],
                'IBLOCK_ID' => $elementRow['IBLOCK_ID'],
                'NAME' => $elementRow['NAME'],
                'CODE' => $elementRow['CODE'],
                'EDIT_LINK' => '/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=' . $elementRow['IBLOCK_ID'] . '&type=menu' . '&ID=' . $elementRow['ID'] . '&lang=' . LANGUAGE_ID . '&force_catalog=&filter_section=' . $parentId . '&bxpublic=Y&from_module=iblock',
                'PROPERTIES' => $elementProperties, // Создаем массив для хранения свойств
            ];
        }
    }
}
// Инициализируем массив
$sectionsAndElements = [];
$iblockId = 32;

// Обходим корневые разделы и элементы
traverseSectionsAndElements($arParams['SECTION_ID'], $sectionsAndElements, $iblockId);
?>
<div class="main-menu__main">
    <div class="main-menu__main_list">
        <? foreach ($sectionsAndElements as $section): ?>
        <?
            $this->AddEditAction($section['ID'], $section['EDIT_LINK'], CIBlock::GetArrayByID($section["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($section['ID'], $section['DELETE_LINK'], CIBlock::GetArrayByID($section["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
        <<?= $section['UF_ELEMENT']; ?> href="<?= ($section['UF_LINK'] ?
                   '/' . $section["PARENT_SECTION_CODE"] .
                   '/' . $section["CODE"] . '/' : '#' . $section["CODE"]); ?>"
            id="<?= $this->GetEditAreaId($section['ID']); ?>"
            class="main-menu__main_link <?= ($section["CODE"] == $arParams['DATA_IN_MENU'] ? 'active' : '') ?>"
            data-menu="<?= $section["CODE"]; ?>">
            <? if (!empty($section['UF_MENU_ICON'])): ?>
            <span class="main-menu__main_link_icon">
                <img src="<?= $section['UF_MENU_ICON']; ?>" alt="<?= htmlspecialchars($section['NAME']); ?>">
            </span>
            <? endif; ?>
            <?= $section["NAME"]; ?>
        </<?= $section['UF_ELEMENT']; ?>>
        <? endforeach; ?>
    </div>
    <div class="main-menu__main_divide"></div>
</div>
<div class="main-menu__second">
    <? foreach ($sectionsAndElements as $section): ?>

    <div class="main-menu-item <?= ($section["CODE"] == $arParams['DATA_IN_MENU'] ? 'active' : '') ?>"
        data-menu-content="<?= $section["CODE"]; ?>">
        <div class="main-menu-item__cards">
            <? foreach ($section['ELEMENTS'] as $sOrE): ?>
            <?
                    $this->AddEditAction($sOrE['ID'], $sOrE['EDIT_LINK'], CIBlock::GetArrayByID($sOrE["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($sOrE['ID'], $sOrE['DELETE_LINK'], CIBlock::GetArrayByID($sOrE["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
            <<?= $sOrE['UF_ELEMENT'] ?: 'a'; ?> id="<?= $this->GetEditAreaId($sOrE['ID']); ?>"
                data-drop="<?= $sOrE['CODE'] ?: ''; ?>" <?= ($sOrE['UF_ELEMENT'] === 'a') ? 'href="/' . $section["PARENT_SECTION_CODE"] .
                                '/' . $section["CODE"] .
                                '/' . $sOrE['CODE'] . '/"' : ''; ?> class="main-menu-item__card">
                <span class="main-menu-item__card_badge"></span>
                <span class="main-menu-item__card_badge2"></span>
                <span class="main-menu-item__card_img">
                    <img src="<?= $sOrE['UF_ICON'] ?: $sOrE["PROPERTIES"]['ICON']; ?>" alt="">
                </span>
                <span class="main-menu-item__card_title"><?= $sOrE["NAME"]; ?></span>
            </<?= $sOrE['UF_ELEMENT'] ?: 'a'; ?>>
            <? endforeach; ?>
        </div>
        <div class="main-menu-item__dropdown">
            <? foreach ($section['ELEMENTS'] as $sOrE): ?>
            <? if ($sOrE['ELEMENTS']): ?>
            <div data-drop-content="<?= $sOrE["CODE"]; ?>" class="main-menu-item__dropdown_block">
                <? foreach ($sOrE['ELEMENTS'] as $element): ?>
                <?
                                $this->AddEditAction($element['ID'], $element['EDIT_LINK'], CIBlock::GetArrayByID($element["IBLOCK_ID"], "ELEMENT_EDIT"));
                                $this->AddDeleteAction($element['ID'], $element['DELETE_LINK'], CIBlock::GetArrayByID($element["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                                ?>
                <a href="<?= '/' . $section["PARENT_SECTION_CODE"] .
                                    '/' . $section["CODE"] .
                                    '/' . $sOrE['CODE'] .
                                    '/' . $element["CODE"] . '/'; ?>" class="main-menu-item__dropdown_item"
                    id="<?= $this->GetEditAreaId($element['ID']); ?>">
                    <span class="main-menu-item__dropdown_item_block">
                        <span class="main-menu-item__dropdown_item_badge"></span>
                        <span class="main-menu-item__dropdown_item_title"><?= $element["NAME"]; ?></span>
                    </span>
                    <span class="main-menu-item__dropdown_item_icon">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/icons/arrow-right.svg" alt="">
                    </span>
                </a>
                <? endforeach; ?>
            </div>
            <? else: ?>
            <div></div>
            <? endif; ?>
            <? endforeach; ?>
        </div>

    </div>

    <? endforeach; ?>
</div>