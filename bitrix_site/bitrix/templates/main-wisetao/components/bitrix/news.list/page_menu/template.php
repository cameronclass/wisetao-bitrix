<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
use Bitrix\Main\Web\HttpClient;
$this->setFrameMode(false);

if (!function_exists('traverseSectionsAndElements')) {
    function traverseSectionsAndElements($parentId, &$sectionsAndElements, $iblockId)
    {
        // Запрос к базе данных для разделов
        $rootSectionCodes = [
            74 => 'from-china',
            75 => 'in-china',
        ];
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
            ]
        );

        // Добавляем разделы в структуру
        while ($sectionRow = $sectionsQuery->Fetch()) {
            $sectionRow['UF_ICON'] = CFile::GetPath($sectionRow['UF_ICON']);
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
                'EDIT_LINK' => '/bitrix/admin/iblock_section_edit.php?IBLOCK_ID=' . $sectionRow['IBLOCK_ID'] . '&type=menu' . '&ID=' . $sectionRow['ID'] . '&lang=' . LANGUAGE_ID . '&force_catalog=&filter_section=' . $parentId . '&bxpublic=Y&from_module=iblock',
                'PROPERTIES' => [], // Создаем массив для хранения свойств
                'ELEMENTS' => [], // Создаем массив для хранения элементов
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
$sectionsAndElementsOne = [];
$sectionsAndElementsTwo = [];
$iblockId = 32;
// Обходим корневые разделы и элементы
traverseSectionsAndElements(74, $sectionsAndElementsOne, $iblockId);
traverseSectionsAndElements(75, $sectionsAndElementsTwo, $iblockId);


?>
<div class="page-menu__menu">
    
    <div class="page-menu__menu_category <?=$_GET['direct-china'] == 'from-china' ? 'active' : ''?>" data-page="from-china">
        <a href="#">Из Китая</a>
    </div>
    <div class="page-menu__menu_category <?=$_GET['direct-china'] == 'in-china' ? 'active' : ''?>" data-page="in-china">
        <a href="#">В Китай</a>
    </div>

    <div class="page-menu__menu_group_items <?=$_GET['direct-china'] == 'from-china' ? 'active' : ''?>" data-page="from-china">
        <? foreach ($sectionsAndElementsOne as $section): ?>
            <?
            $this->AddEditAction($section['ID'], $section['EDIT_LINK'], CIBlock::GetArrayByID($section["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($section['ID'], $section['DELETE_LINK'], CIBlock::GetArrayByID($section["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="page-menu__menu_item <?= ($section["CODE"] == $arParams['DATA_IN_MENU'] ? 'active' : '') ?>">
                <<?= $section['UF_ELEMENT']; ?> data-in-menu="<?= $section["CODE"]; ?>"
                href="<?= $section["CODE"] !== 'logistic' ? '/hash-left-' . $section["CODE"] . '/' : '/' . $section["PARENT_SECTION_CODE"] . '/' . $section["CODE"] . '/'?>" id="<?= $this->GetEditAreaId($section['ID']); ?>" class="page-menu__menu_link <?= ($section["CODE"] == $arParams['DATA_IN_MENU'] ? 'active' : '') ?>"><?= $section["NAME"]; ?></<?=$section['UF_ELEMENT']; ?>>
                <div class="page-menu__menu_drop <?= ($section["CODE"] == $arParams['DATA_IN_MENU'] ? 'active' : '') ?>" data-in-content="<?= $section["CODE"]; ?>">
                    <? foreach ($section['ELEMENTS'] as $sOrE): ?>
                        <?
                        $this->AddEditAction($sOrE['ID'], $sOrE['EDIT_LINK'], CIBlock::GetArrayByID($sOrE["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($sOrE['ID'], $sOrE['DELETE_LINK'], CIBlock::GetArrayByID($sOrE["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                        ?>
                        <a class="page-menu__menu_drop_link <?= ($sOrE["CODE"] == ($arParams['DATA_IN_LEVEL'] ?: $arParams['DATA_THIRD_ACTIVE']) ? 'active' : '') ?>" data-in-level="<?= $sOrE['CODE']; ?>" id="<?= $this->GetEditAreaId($sOrE['ID']); ?>"
                            href="<?= '/' . $section["PARENT_SECTION_CODE"] .
                                '/' . $section["CODE"] .
                                '/' . $sOrE['CODE'] . '/'; ?>">
                            <?= $sOrE['NAME']; ?>
                        </a>
                        <?if ($sOrE['ELEMENTS']): ?>
                            <div class="page-menu__inside <?= ($sOrE["CODE"] == $arParams['DATA_IN_LEVEL'] ? 'active' : '') ?>">
                                <div data-in-level-content="<?= $sOrE['CODE']; ?>" class="page-menu__inside_block <?= ($sOrE["CODE"] == $arParams['DATA_IN_LEVEL'] ? 'active' : '') ?>">
                                    <? foreach ($sOrE['ELEMENTS'] as $element): ?>
                                        <?
                                        $this->AddEditAction($element['ID'], $element['EDIT_LINK'], CIBlock::GetArrayByID($element["IBLOCK_ID"], "ELEMENT_EDIT"));
                                        $this->AddDeleteAction($element['ID'], $element['DELETE_LINK'], CIBlock::GetArrayByID($element["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                                        ?>
                                        <a href="<?= '/' . $section["PARENT_SECTION_CODE"] .
                                            '/' . $section["CODE"] .
                                            '/' . $sOrE['CODE'] .
                                            '/' . $element["CODE"] . '/'; ?>" class="page-menu__menu_drop_link <?= ($element["CODE"] == $arParams['DATA_THIRD_ACTIVE'] ? 'active' : '') ?>" id="<?= $this->GetEditAreaId($element['ID']); ?>">
                                            <?= $element["NAME"]; ?>
                                        </a>
                                    <?endforeach;?>
                                </div>
                            </div>
                        <?endif;?>
                    <?endforeach;?>
                </div>
            </div>
        <? endforeach; ?>
    </div>

    <div class="page-menu__menu_group_items <?=$_GET['direct-china'] == 'in-china' ? 'active' : ''?>" data-page="in-china">
        <? foreach ($sectionsAndElementsTwo as $section): ?>
            <?
            $this->AddEditAction($section['ID'], $section['EDIT_LINK'], CIBlock::GetArrayByID($section["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($section['ID'], $section['DELETE_LINK'], CIBlock::GetArrayByID($section["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="page-menu__menu_item <?= ($section["CODE"] == $arParams['DATA_IN_MENU'] ? 'active' : '') ?>">
                <<?= $section['UF_ELEMENT']; ?> data-in-menu="<?= $section["CODE"]; ?>"
                href="<?= $section["CODE"] !== 'logistic' ? '/hash-right-' . $section["CODE"] . '/' : '/' . $section["PARENT_SECTION_CODE"] . '/' . $section["CODE"] . '/'?>" id="<?= $this->GetEditAreaId($section['ID']); ?>" class="page-menu__menu_link <?= ($section["CODE"] == $arParams['DATA_IN_MENU'] ? 'active' : '') ?>"><?= $section["NAME"]; ?></<?=$section['UF_ELEMENT']; ?>>
            <div class="page-menu__menu_drop <?= ($section["CODE"] == $arParams['DATA_IN_MENU'] ? 'active' : '') ?>" data-in-content="<?= $section["CODE"]; ?>">
                <? foreach ($section['ELEMENTS'] as $sOrE): ?>
                <?
                $this->AddEditAction($sOrE['ID'], $sOrE['EDIT_LINK'], CIBlock::GetArrayByID($sOrE["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($sOrE['ID'], $sOrE['DELETE_LINK'], CIBlock::GetArrayByID($sOrE["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <<?= $sOrE['UF_ELEMENT'] ?: 'a'; ?> class="page-menu__menu_drop_link <?= ($sOrE["CODE"] == ($arParams['DATA_IN_LEVEL'] ?: $arParams['DATA_THIRD_ACTIVE']) ? 'active' : '') ?>" data-in-level="<?= $sOrE['CODE']; ?>" id="<?= $this->GetEditAreaId($sOrE['ID']); ?>"
                href="<?= '/' . $section["PARENT_SECTION_CODE"] .
                '/' . $section["CODE"] .
                '/' . $sOrE['CODE'] . '/'; ?>">
                <?= $sOrE['NAME']; ?>
            </<?= $sOrE['UF_ELEMENT'] ?: 'a'; ?>>
        <?if ($sOrE['ELEMENTS']): ?>
            <div class="page-menu__inside <?= ($sOrE["CODE"] == $arParams['DATA_IN_LEVEL'] ? 'active' : '') ?>">
                <div data-in-level-content="<?= $sOrE['CODE']; ?>" class="page-menu__inside_block <?= ($sOrE["CODE"] == $arParams['DATA_IN_LEVEL'] ? 'active' : '') ?>">
                    <? foreach ($sOrE['ELEMENTS'] as $element): ?>
                        <?
                        $this->AddEditAction($element['ID'], $element['EDIT_LINK'], CIBlock::GetArrayByID($element["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($element['ID'], $element['DELETE_LINK'], CIBlock::GetArrayByID($element["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                        ?>
                        <a href="<?= '/' . $section["PARENT_SECTION_CODE"] .
                        '/' . $section["CODE"] .
                        '/' . $sOrE['CODE'] .
                        '/' . $element["CODE"] . '/'; ?>" class="page-menu__menu_drop_link <?= ($element["CODE"] == $arParams['DATA_THIRD_ACTIVE'] ? 'active' : '') ?>" id="<?= $this->GetEditAreaId($element['ID']); ?>">
                            <?= $element["NAME"]; ?>
                        </a>
                    <?endforeach;?>
                </div>
            </div>
        <?endif;?>
        <?endforeach;?>
        </div>
        </div>
    <? endforeach; ?>
    </div>
</div>