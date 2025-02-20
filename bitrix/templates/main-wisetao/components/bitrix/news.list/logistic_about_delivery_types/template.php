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
            <div data-aos="fade-up" class="logistic-shipping__card" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <img class="logistic-shipping__card_img" src="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" alt="">
                <div class="logistic-shipping__card_block">
                    <div class="logistic-shipping__card_title"><?= $arItem["NAME"]; ?></div>
                    <div class="logistic-shipping__card_text"><?= $arItem["PREVIEW_TEXT"]; ?></div>
                    <a href="<?= $arItem["PROPERTIES"]['LINK']['VALUE']; ?>" class="logistic-shipping__card_link">
                        <img class="logistic-shipping__card_link_icon" src="<?=SITE_TEMPLATE_PATH?>/assets/images/icons/log-blog-arrow.svg" alt="">
                        <span>ПОДРОБНЕЕ</span>
                    </a>
                </div>
            </div>
        <? endforeach; ?>
