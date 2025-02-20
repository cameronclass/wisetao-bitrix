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
if (!isset($_GET['more'])) {
    $fade = 'data-aos="fade-up"';
}
else {
    $fade = '';
}
?>
<div class="timeline__block">
    <? foreach ($arResult["ITEMS"] as $key => $arItem): ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="timeline__card" itemscope itemtype="https://schema.org/Event" <?=$fade?> id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
            <div class="timeline__card_head">
                <div class="timeline__card_title" itemprop="startDate"><?= $arItem["NAME"]; ?></div>
                <div class="timeline__card_dot"></div>
            </div>
            <div class="timeline__card_content" itemprop="name">
                <?= $arItem["PREVIEW_TEXT"]; ?>
            </div>
            <meta itemprop="location" content="Китай">
        </div>
    <? endforeach; ?>
    <a href="<?= $APPLICATION->GetCurPage(false); ?>?more=" class="more-btn timeline__more" <?=$fade?>>
        <span class="more-btn__text">Еще</span>
        <img class="more-btn__img" src="<?=SITE_TEMPLATE_PATH?>/assets/images/icons/arrow-down.svg" alt="">
    </a>
</div>
