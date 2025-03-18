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
?>
<div class="row mb-3">
    <? foreach ($arResult["ITEMS"] as $key => $arItem): ?>
    <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
    <div class="col-xl-6 mb-4" itemscope itemtype="https://schema.org/Service" data-aos="fade-up">
        <div class="marketing-service" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
            <div class="marketing-service__bg">
                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/review-form.png" alt="">
            </div>
            <img class="marketing-service__img" src="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" alt="">
            <div class="marketing-service__content">
                <h3 class="marketing-service__title" itemprop="name"><?= $arItem["NAME"]; ?></h3>
                <p class="marketing-service__text" itemprop="description"><?= $arItem["PREVIEW_TEXT"]; ?></p>
            </div>
        </div>
    </div>
    <? endforeach; ?>
</div>