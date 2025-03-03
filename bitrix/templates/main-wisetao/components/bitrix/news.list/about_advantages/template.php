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
$left = true;
$width = "23.5%";
if (explode('/', $APPLICATION->GetCurPage(false))[1] == 'logistic') {
    $width = "17.8%";
}
?>
<div class="advantages" data-aos="fade-up">
    <h3 class="group-title" style="margin-top: auto; margin-bottom: auto;">О компании:</h3>
    <? foreach ($arResult["ITEMS"] as $arItem): ?>
    <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
    <div class="advantages-card" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
        <div class="advantages-card__bg">
            <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/contacts-bg.png" alt="">
        </div>
        <div class="advantages-card__wrapper">
            <div class="advantages-card__block">
                <div class="advantages-card__title"><?= $arItem["NAME"]; ?></div>
                <div class="advantages-card__text"><?= $arItem["PREVIEW_TEXT"]; ?></div>
            </div>
        </div>

    </div>
    <? endforeach; ?>
</div>