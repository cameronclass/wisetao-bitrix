<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

<div class="about-workers photo-studio my-4" data-aos="fade-up">
    <div class="swiper">
        <div class="swiper-wrapper">
            <? foreach ($arResult["ITEMS"] as $arItem): ?>
                <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div class="swiper-slide" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                    <a class="fancy-link" href="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" data-fancybox="gallery">
                        <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" class="photo-studio__item" alt="">
                    </a>
                    <span class="about-workers__block">
                        <span class="about-workers__title"><?=$arItem['NAME']?></span>
                        <span class="about-workers__text"><?=$arItem['PREVIEW_TEXT']?></span>
                    </span>
                </div>
            <? endforeach; ?>
        </div>
    </div>
</div>

<!--<div class="certificates__card" id="--><?//= $this->GetEditAreaId($arItem['ID']); ?><!--">--><?//= $arItem["PREVIEW_TEXT"]; ?><!--</div>-->
