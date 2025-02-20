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

$rootDirectMenu = [
    74 => 'left',
    75 => 'right',
];

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
$sectionsAndElements = [];
$iblockId = 32;
// Обходим корневые разделы и элементы
traverseSectionsAndElements($arParams['SECTION_ID'], $sectionsAndElements, $iblockId);
?>
<ul class="footer__menu_links">
    <? foreach ($sectionsAndElements as $section): ?>
        <?
        $this->AddEditAction($section['ID'], $section['EDIT_LINK'], CIBlock::GetArrayByID($section["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($section['ID'], $section['DELETE_LINK'], CIBlock::GetArrayByID($section["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <li>
            <a href="<?= ($section['UF_LINK'] ?
                '/' . ($section["PARENT_SECTION_CODE"] ?: $_GET['direct-china']) .
                ($arParams['SECTION_ID'] == '85' ? '/about' : '') .
                '/' . $section["CODE"] . '/': '/hash-' . $rootDirectMenu[$arParams['SECTION_ID']] . '-' . $section["CODE"] . '/'); ?>" id="<?= $this->GetEditAreaId($section['ID']); ?>" class="footer__menu_link">
                <?= $section["NAME"]; ?>
            </a>
        </li>
    <? endforeach; ?>
</ul>

