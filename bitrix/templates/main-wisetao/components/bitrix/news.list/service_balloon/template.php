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


?>
<div class="block-banner__points">
    <? foreach ($arResult["ITEMS"] as $key => $arItem): ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div data-aos="fade-up" class="point-item <?="service-balloon-position{$key}"?>" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
            <div class="point-item__dot">
                <div class="dot"></div>
            </div>
            <div class="point-item__body">
                <div class="point-item__name">
                    <?=$arItem['NAME']?>
                </div>
                <div class="point-item__description">
                    <?=$arItem['PREVIEW_TEXT']?>
                </div>
            </div>
        </div>
    <? endforeach; ?>
</div>

