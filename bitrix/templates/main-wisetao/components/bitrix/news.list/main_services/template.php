<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

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

$this->setFrameMode(true);

$customOffset = isset($arParams['CUSTOM_OFFSET']) ? (int)$arParams['CUSTOM_OFFSET'] : 0;
$counter = 0;
$newsCount = isset($arParams['CUSTOM_COUNT']) ? (int)$arParams['CUSTOM_COUNT'] : 4;

if(!empty($arResult["ITEMS"])) {
    ?>
    <div class="block-mainServices">
        <div class="block-mainServices__body">
            <h1 class="group-title block-mainServices__title" data-aos="fade-up">Наши услуги</h1>
            <div class="block-mainServices__swiper swiper" data-aos="fade-up">
                <div class="swiper-wrapper">

                    <?php foreach($arResult["ITEMS"] as $item) {

                        $counter++;
                        if ($counter <= $customOffset) {
                            continue;
                        }

                        // Останавливаем вывод, когда достигнем нужного количества
                        if ($counter > $customOffset + $newsCount) {
                            break;
                        }

                        $name = $item['NAME'];
                        $description = $item['PREVIEW_TEXT'];
                        $img = $item['PREVIEW_PICTURE'];

                        $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => "Подтвердить")); ?>
                        <div class="swiper-slide" itemscope itemtype="https://schema.org/Service">
                            <div class="mainService-item" id="<?=$this->GetEditAreaId($item['ID']);?>">
                                <div class="mainService-item__offer">
                                    <?php if($name) { ?>
                                        <h2 itemprop="name" class="mainService-item__name block-title" style="text-transform: uppercase;"><?= $name; ?></h2>
                                    <?php }
                                    if($description) { ?>
                                        <div itemprop="description" class="mainService-item__description block-text" style="font-weight: 400;">
                                            <?php echo $description; ?>
                                        </div>
                                    <?php } ?>
                                    <a href="<?=SITE_TEMPLATE_PATH?>/assets/file/presentation.pdf" target="_blank"  class="mainService-item__btn main-btn">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7 7H17M17 7V17M17 7L7 17" stroke="#E8E8E8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        Подробнее в презентации
                                    </a>
                                </div>
                                <div class="mainService-item__bg">
                                    <?php if($img) { ?>
                                        <div class="mainService-item__image">
                                            <img src="<?= CFile::GetPath($img['ID']); ?>" alt="<?= $name; ?>">
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="block-mainServices__navigations navigations">
                <div class="navigations__left">
                    <div class="swiper-pagination"></div>
                </div>
                <div class="navigations__right">
                    <div class="swiper-button-prev">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 5L5 12L12 19M5 12L19 12" stroke="#828282" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="swiper-button-next">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 19L19 12L12 5M19 12L5 12" stroke="#828282" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}