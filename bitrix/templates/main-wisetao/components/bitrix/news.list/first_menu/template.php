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
$this->setFrameMode(false);

// Функция для рекурсивного обхода разделов и элементов
    // Запрос к базе данных для разделов
$rootSectionCodes = [
    74 => 'from-china',
    75 => 'in-china',
];
$sectionsQuery = CIBlockSection::GetList(
    [],
    [
        'IBLOCK_ID' => 32,
        'SECTION_ID' => $arParams['SECTION_ID'],
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
        'EDIT_LINK' => '/bitrix/admin/iblock_section_edit.php?IBLOCK_ID=' . $sectionRow['IBLOCK_ID'] . '&type=menu' . '&ID=' . $sectionRow['ID'] . '&lang=' . LANGUAGE_ID . '&force_catalog=&filter_section=0&bxpublic=Y&from_module=iblock',
        'PROPERTIES' => [], // Создаем массив для хранения свойств
        'ELEMENTS' => [], // Создаем массив для хранения элементов
    ];
}
?>
<? foreach ($sectionsAndElements as $section): ?>
    <?
    $this->AddEditAction($section['ID'], $section['EDIT_LINK'], CIBlock::GetArrayByID($section["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($section['ID'], $section['DELETE_LINK'], CIBlock::GetArrayByID($section["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
    <li class="main-select__menu_item">
        <a href="<?= ($section['UF_LINK'] ?
            '/' . $section["PARENT_SECTION_CODE"] .
            '/' . $section["CODE"] . '/': '#' . $section["CODE"]); ?>" id="<?= $this->GetEditAreaId($section['ID']); ?>" class="main-select__menu_link"><?= $section["NAME"]; ?></a>
    </li>
<? endforeach; ?>

