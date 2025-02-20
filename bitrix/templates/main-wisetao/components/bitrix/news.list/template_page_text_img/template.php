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
?>
<? foreach ($arResult["ITEMS"] as $arItem): ?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>

    <? if (!empty($arItem["PREVIEW_PICTURE"]["SRC"])): ?>
        <div data-aos="fade-up" class="row my-5" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
            <? if ($left): ?>
                <div class="col-md-5">
                    <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" alt="<?= $arItem["NAME"]; ?>">
                </div>
                <div class="col-md-7">
                    <h3><?= $arItem["NAME"]; ?></h3>
                    <p><?= $arItem["PREVIEW_TEXT"]; ?></p>
                </div>
                <?$left = false?>
            <? else : ?>
                <div class="col-md-7">
                    <h3><?= $arItem["NAME"]; ?></h3>
                    <p><?= $arItem["PREVIEW_TEXT"]; ?></p>
                </div>
                <div class="col-md-5">
                    <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" alt="<?= $arItem["NAME"]; ?>">
                </div>
                <?$left = true?>
            <? endif; ?>
        </div>
    <? else: ?>
        <h3><?= $arItem["NAME"]; ?></h3>
        <p id="<?= $this->GetEditAreaId($arItem['ID']); ?>"><?= $arItem["PREVIEW_TEXT"]; ?></p>
    <? endif; ?>
<? endforeach; ?>