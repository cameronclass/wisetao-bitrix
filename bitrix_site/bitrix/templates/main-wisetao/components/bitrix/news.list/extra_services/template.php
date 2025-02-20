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

$customOffset = isset($arParams['CUSTOM_OFFSET']) ? (int)$arParams['CUSTOM_OFFSET'] : 0;
$counter = 0;
$newsCount = isset($arParams['CUSTOM_COUNT']) ? (int)$arParams['CUSTOM_COUNT'] : 0;

?>
<? foreach ($arResult["ITEMS"] as $arItem): ?>
    <?
    $counter++;
    if ($counter <= $customOffset) {
        continue;
    }

    // Останавливаем вывод, когда достигнем нужного количества
    if ($counter > $customOffset + $newsCount) {
        break;
    }
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
    <article class="service-item" itemscope itemtype="https://schema.org/Service">
        <h4 itemprop="name" class="service-item__name logistic-shipping__card_title"><?= $arItem["NAME"]; ?></h4>
        <p itemprop="description" class="service-item__description logistic-shipping__card_text">
            <?= $arItem["PREVIEW_TEXT"]; ?>
        </p>
        <a href="<?= $arItem["PROPERTIES"]['LINK']['VALUE'] ?>" class="service-item__btn logistic-shipping__card_link">
            <svg class="logistic-shipping__card_link_icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7 7H17M17 7V17M17 7L7 17" stroke="#E8E8E8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
            <span>ПОДРОБНЕЕ</span>
        </a>
    </article>
<? endforeach; ?>