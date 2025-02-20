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
?>
<? foreach ($arResult["ITEMS"] as $key => $arItem): ?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
    <div data-aos="fade-up" class="logistic-reviews__card" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
        <div class="logistic-reviews__card_text"><?= $arItem["PREVIEW_TEXT"]; ?></div>
        <div class="logistic-reviews__card_block">
            <div class="logistic-reviews__card_author"><?=$arItem["PROPERTIES"]["REVIEWER_NAME"]["VALUE"];?></div>
            <div class="logistic-reviews__card_category">Услуга: <?=$arItem["PROPERTIES"]["SERVICES"]["VALUE"];?></div>
        </div>
    </div>
<? endforeach; ?>