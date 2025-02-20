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
<div class="row mb-5">
    <? foreach ($arResult["ITEMS"] as $key => $arItem): ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div data-aos="fade-up" class="col-md-6 mb-4" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
            <div class="marketing-social">
                <img class="marketing-social__img" src="<?= $arItem["DISPLAY_PROPERTIES"]["SOCIAL_NETWORK_ICON"]["FILE_VALUE"]['SRC']; ?>" alt="">
                <div class="marketing-social__content">
                    <div class="marketing-social__title"><?= $arItem["NAME"]; ?></div>
                    <div class="marketing-social__text"><?= $arItem["PREVIEW_TEXT"]; ?></div>
                </div>
            </div>
        </div>
    <? endforeach; ?>
</div>