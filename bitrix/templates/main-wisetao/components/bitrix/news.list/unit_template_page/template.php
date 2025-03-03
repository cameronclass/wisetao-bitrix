<?
if (!\Bitrix\Main\Loader::includeModule("iblock"))
    return;
use Bitrix\Iblock\SectionTable;
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
$openElements = [
    'TEXT' => [
        'open' => '<div class="row mb-5" data-aos="fade-up">',
        'close' => '</div>',
    ],
    'TEXT_IMAGE' => [
        'open' => '<div data-aos="fade-up">',
        'close' => '</div>',
    ],
    'TEXT_IMAGE_MINI' => [
        'open' => '<div class="row mb-5" data-aos="fade-up">',
        'close' => '</div>',
    ],
    'CARD_ICON' => [
        'open' => '<div class="translate-cards mb-5" data-aos="fade-up">',
        'close' => '</div>',
    ],
    'TEXT_IMAGE_BUTTON' => [
        'open' => '<div>',
        'close' => '</div>',
    ],
    'NORMAL_CARDS' => [
        'open' => '<div class="row mb-5" data-aos="fade-up">',
        'close' => '</div>',
    ],
    'NORMAL_CARDS_BORDERED' => [
        'open' => '<div class="row mt-5 mb-5" data-aos="fade-up">',
        'close' => '</div>',
    ],
    'TIMELINE_FIRST' => [
        'open' => '<div class="timeline-first mb-5" data-aos="fade-up">',
        'close' => '</div>',
    ],
    'TIMELINE_SECOND' => [
        'open' => '<div class="timeline-second mb-5" data-aos="fade-up"><div class="timeline-second__outer">',
        'close' => '</div></div>',
    ],
    'BUTTON' => [
        'open' => '<div data-aos="fade-up">',
        'close' => '</div>',
    ],
    'TEXT_IMAGE_GALLERY' => [
        'open' => '<div data-aos="fade-up">',
        'close' => '</div>',
    ],
    'GALLERY_TILES' => [
        'open' => '<div class="row" data-aos="fade-up">',
        'close' => '</div>',
    ],
    'GALLERY_SWIPER_ONE_PIC' => [
        'open' => '<div class="gallery-block__swiper" data-aos="fade-up">
                        <div class="swiper">
                            <div class="swiper-wrapper">',
        'close' => '</div>
                </div>
                <div class="gallery-block__swiper_arrows" data-aos="fade-up">
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>',
    ],
    'GALLERY_SWIPER_MANY_PICS' => [
        'open' => '<div class="photo-studio my-4" data-aos="fade-up">
                        <div class="swiper">
                            <div class="swiper-wrapper">',
        'close' => '</div>
                </div>
                <div class="photo-studio__arrows" data-aos="fade-up">
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>',
    ],
    'FOOTNOTE' => [
        'open' => '<div class="quote-block my-5" data-aos="fade-up">',
        'close' => '</div>',
    ],

];
$firstOpen = $openElements[
    $arResult["ITEMS"][0]["PROPERTIES"]['ELEMENT_TYPE']['VALUE_XML_ID']
]
['open'];
$arParams['left'] = true;
$arParams['prevPositionTimelineFirst'] = 'left';
$arParams['prevPositionTimelineSecond'] = 'left';
$arParams['prevElementType'] = $arResult["ITEMS"][0]["PROPERTIES"]['ELEMENT_TYPE']['VALUE_XML_ID'];
?>

<? foreach ($arResult["ITEMS"] as $key => $arItem): ?>
<?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>

<?if ($key == 0):?>
<?if ($arItem["PROPERTIES"]['USE_TITTLE']['VALUE'] == "Да"):?>
<h1 class="group-title" data-aos="fade-up"><?= $arItem["PROPERTIES"]['TITTLE']['VALUE'] ?></h1>
<?endif;?>
<?= $firstOpen ?>
<?endif;?>
<?if ($arParams['prevElementType'] != $arItem["PROPERTIES"]['ELEMENT_TYPE']['VALUE_XML_ID']):?>
<?
            $close = $openElements[
                $arParams['prevElementType']
            ]
            ['close'];
            $open = $openElements[
                $arItem["PROPERTIES"]['ELEMENT_TYPE']['VALUE_XML_ID']
            ]
            ['open'];
        ?>
<?= $close ?>
<?if ($arItem["PROPERTIES"]['USE_TITTLE']['VALUE'] == "Да"):?>
<h2 class="group-title" data-aos="fade-up"><?= $arItem["PROPERTIES"]['TITTLE']['VALUE'] ?></h2>
<?endif;?>
<?= $open ?>
<?endif;?>

<? $arParams['prevElementType'] = $arItem["PROPERTIES"]['ELEMENT_TYPE']['VALUE_XML_ID'];?>

<?if ($arItem["PROPERTIES"]['ELEMENT_TYPE']['VALUE_XML_ID'] == "TEXT"):?>
<div class="col-md-12 marketing-text__text" data-aos="fade-up" id="<?= $this->GetEditAreaId($arItem['ID']); ?>"><?= $arItem["PREVIEW_TEXT"]; ?></div>
<?endif;?>
<?if ($arItem["PROPERTIES"]['ELEMENT_TYPE']['VALUE_XML_ID'] == "TEXT_IMAGE"):?>
<? if (!empty($arItem["PREVIEW_PICTURE"]["SRC"])): ?>
<div class="row my-5" data-aos="fade-up" id="<?= $this->GetEditAreaId($arItem['ID']); ?>" style="align-items: center;">
    <?if ($arItem["PROPERTIES"]['IMAGE_SIDE']['VALUE_XML_ID'] == "LEFT" || $arParams['left'] && !$arItem["PROPERTIES"]['IMAGE_SIDE']['VALUE_XML_ID']):?>
    <div class="col-md-5">
        <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" alt="<?= $arItem["NAME"]; ?>">
    </div>
    <div class="col-md-7">
        <h3><?= $arItem["NAME"]; ?></h3>
        <p class="marketing-text__text"><?= $arItem["PREVIEW_TEXT"]; ?></p>
    </div>
    <?$arParams['left'] = false?>
    <?elseif ($arItem["PROPERTIES"]['IMAGE_SIDE']['VALUE_XML_ID'] == "RIGHT" || !$arParams['left']  && !$arItem["PROPERTIES"]['IMAGE_SIDE']['VALUE_XML_ID']):?>
    <div class="col-md-7">
        <h3><?= $arItem["NAME"]; ?></h3>
        <p class="marketing-text__text"><?= $arItem["PREVIEW_TEXT"]; ?></p>
    </div>
    <div class="col-md-5">
        <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" alt="<?= $arItem["NAME"]; ?>">
    </div>
    <?$arParams['left'] = true?>
    <? endif; ?>
</div>
<? else: ?>
<h3><?= $arItem["NAME"]; ?></h3>
<p id="<?= $this->GetEditAreaId($arItem['ID']); ?>" class="marketing-text__text"><?= $arItem["PREVIEW_TEXT"]; ?></p>
<? endif; ?>
<?endif;?>
<?if ($arItem["PROPERTIES"]['ELEMENT_TYPE']['VALUE_XML_ID'] == "TEXT_IMAGE_MINI"):?>
<div data-aos="fade-up" class="col-md-6 mb-4 <?= ($arItem["PROPERTIES"]['BORDERED']['VALUE'] == 'Да' ? 'bordered-element bordered-image-mini' : ''); ?>" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
    <div class="marketing-social">
        <img class="marketing-social__img" src="<?= CFile::GetPath($arItem["PROPERTIES"]['SOCIAL_NETWORK_ICON']['VALUE']); ?>" alt="">
        <div class="marketing-social__content">
            <h3 class="marketing-social__title"><?= $arItem["NAME"]; ?></h3>
            <p class="marketing-social__text"><?= $arItem["PREVIEW_TEXT"]; ?></p>
        </div>
    </div>
</div>
<?endif;?>
<?if ($arItem["PROPERTIES"]['ELEMENT_TYPE']['VALUE_XML_ID'] == "CARD_ICON"):?>
<div data-aos="fade-up" class="translate-card <?= ($arItem["PROPERTIES"]['OUR']['VALUE'] == 'Да' ? '_bordered' : ''); ?>" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
    <div class="translate-card-head">
        <div class="translate-card__title"><?= $arItem["NAME"]; ?></div>
        <div class="translate-card__icon <?= $arItem["PROPERTIES"]['OUR']['VALUE_XML_ID']; ?>">
            <img class="translate-card__icon_img" src="<?= CFile::GetPath($arItem["PROPERTIES"]['SOCIAL_NETWORK_ICON']['VALUE']); ?>" alt="">
        </div>
    </div>
    <div class="translate-card__lists">
        <? foreach ($arItem["PROPERTIES"]['POINTS']['VALUE'] as $POINT): ?>
        <div class="translate-card__list">
            <span class="translate-card__list_circle"></span>
            <span class="translate-card__list_title"><?= htmlspecialchars_decode($POINT['TEXT'], ENT_QUOTES); ?></span>
        </div>
        <? endforeach; ?>
    </div>
</div>
<?endif;?>
<?if ($arItem["PROPERTIES"]['ELEMENT_TYPE']['VALUE_XML_ID'] == "TEXT_IMAGE_BUTTON"):?>
<div data-aos="fade-up" class="row align-items-center mb-5 <?= ($arItem["PROPERTIES"]['BORDERED']['VALUE'] == 'Да' ? 'bordered-element' : ''); ?>">
    <div class="col-md-6">
        <img src="<?= CFile::GetPath($arItem["PROPERTIES"]['SOCIAL_NETWORK_ICON']['VALUE']); ?>" alt="">
    </div>
    <div class="col-md-6" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
        <h3><?= $arItem["NAME"]; ?></h3>
        <p class="marketing-text__text"><?= $arItem["PREVIEW_TEXT"]; ?></p>
        <a class="main-btn _big" href="#" onclick="toggleCalcForm(event)"><?= $arItem["PROPERTIES"]['BUTTON_NAME']['VALUE']; ?></a>
    </div>
</div>
<?endif;?>
<?if ($arItem["PROPERTIES"]['ELEMENT_TYPE']['VALUE_XML_ID'] == "NORMAL_CARDS"):?>
<div data-aos="fade-up" class="col-md-4 mb-4" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
    <div class="normal-card">
        <img class="normal-card__img" src="<?= CFile::GetPath($arItem["PROPERTIES"]['SOCIAL_NETWORK_ICON']['VALUE']); ?>" alt="">
        <div class="normal-card__text">
            <?= $arItem["PREVIEW_TEXT"]; ?>
        </div>
    </div>
</div>
<?endif;?>
<?if ($arItem["PROPERTIES"]['ELEMENT_TYPE']['VALUE_XML_ID'] == "NORMAL_CARDS_BORDERED"):?>
<div class="col-md-4 mb-4" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
    <div data-aos="fade-up" class="normal-card normal-card-bordered">
        <img class="normal-card__img" src="<?= CFile::GetPath($arItem["PROPERTIES"]['SOCIAL_NETWORK_ICON']['VALUE']); ?>" alt="">
        <div class="normal-card__title"><?= $arItem["NAME"]; ?></div>
        <div class="normal-card__lists">
            <? foreach ($arItem["PROPERTIES"]['POINTS']['VALUE'] as $POINT): ?>
            <div class="normal-card__list"><?= htmlspecialchars_decode($POINT['TEXT'], ENT_QUOTES); ?></div>
            <? endforeach; ?>
        </div>
        <a class="main-btn _big" href="<?= $arItem["PROPERTIES"]['BUTTON_LINK']['VALUE']; ?>"><?= $arItem["PROPERTIES"]['BUTTON_NAME']['VALUE']; ?></a>
    </div>
</div>
<?endif;?>
<?if ($arItem["PROPERTIES"]['ELEMENT_TYPE']['VALUE_XML_ID'] == "TIMELINE_FIRST"):?>
<div data-aos="fade-up" class="timeline-first__container <?=$arParams['prevPositionTimelineFirst']?>" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
    <div class="timeline-first__icon">
        <img class="timeline-first__icon_item" src="<?= CFile::GetPath($arItem["PROPERTIES"]['SOCIAL_NETWORK_ICON']['VALUE']); ?>" alt="">
    </div>
    <div class="timeline-first__content">
        <h3><?= $arItem["NAME"]; ?></h3>
        <p class="marketing-text__text">
            <?= $arItem["PREVIEW_TEXT"]; ?>
        </p>
    </div>
</div>
<?$arParams['prevPositionTimelineFirst'] = $arParams['prevPositionTimelineFirst'] == 'left' ? 'right' : 'left'?>
<?endif;?>
<?if ($arItem["PROPERTIES"]['ELEMENT_TYPE']['VALUE_XML_ID'] == "TIMELINE_SECOND"):?>
<div class="timeline-second__card" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
    <div class="timeline-second__info">
        <h3 class="timeline-second__title"><?= $arItem["NAME"]; ?></h3>
        <p class="timeline-second__text"><?= $arItem["PREVIEW_TEXT"]; ?></p>
        <div class="timeline-second__img">
            <img class="timeline-second__img_item" src="<?= CFile::GetPath($arItem["PROPERTIES"]['SOCIAL_NETWORK_ICON']['VALUE']); ?>" alt="">
        </div>
    </div>
</div>
<?endif;?>
<?if ($arItem["PROPERTIES"]['ELEMENT_TYPE']['VALUE_XML_ID'] == "BUTTON"):?>
<? $align = $arItem["PROPERTIES"]['BUTTON_ALIGNMENT']['VALUE_XML_ID'] == 'LEFT' ? 'button-left' : ($arItem["PROPERTIES"]['BUTTON_ALIGNMENT']['VALUE_XML_ID'] == 'RIGHT' ? 'button-right' : 'button-center')?>
<div data-aos="fade-up" class="<?= $align ?>" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
    <a class="main-btn _big " href="#" onclick="toggleCalcForm(event)"><?= $arItem["PROPERTIES"]['BUTTON_NAME']['VALUE']; ?></a>
</div>
<?endif;?>
<?if ($arItem["PROPERTIES"]['ELEMENT_TYPE']['VALUE_XML_ID'] == "TEXT_IMAGE_GALLERY"):?>
<div data-aos="fade-up" class="row align-items-center my-5" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
    <div class="col-md-4">
        <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" class="gallery-block__img" alt="">
    </div>
    <div class="col-md-8">
        <p><?= $arItem["PREVIEW_TEXT"]; ?></p>
    </div>
</div>
<?endif;?>
<?if ($arItem["PROPERTIES"]['ELEMENT_TYPE']['VALUE_XML_ID'] == "GALLERY_TILES"):?>
<? $aspect_ratio = $arItem["PROPERTIES"]['ASPECT_RATIO']['VALUE_XML_ID'] == 'SQUARE' ? 'col-md-4' : 'col-md-8'?>
<div data-aos="fade-up" class="<?= $aspect_ratio ?> mb-4" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
    <a class="fancy-link" href="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" data-fancybox="gallery">
        <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" class="gallery-block__img" alt="">
    </a>
</div>
<?endif;?>
<?if ($arItem["PROPERTIES"]['ELEMENT_TYPE']['VALUE_XML_ID'] == "GALLERY_SWIPER_ONE_PIC"):?>
<div class="swiper-slide" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
    <a class="fancy-link" href="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" data-fancybox="gallery">
        <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" class="gallery-block__swiper_item" alt="">
    </a>
</div>
<?endif;?>
<?if ($arItem["PROPERTIES"]['ELEMENT_TYPE']['VALUE_XML_ID'] == "GALLERY_SWIPER_MANY_PICS"):?>
<div class="swiper-slide" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
    <a class="fancy-link" href="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" data-fancybox="gallery">
        <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" class="photo-studio__item" alt="">
    </a>
</div>
<?endif;?>
<?if ($arItem["PROPERTIES"]['ELEMENT_TYPE']['VALUE_XML_ID'] == "FOOTNOTE"):?>
<img class="quote-block__icon" src="<?=SITE_TEMPLATE_PATH?>/assets/images/marketing/quote.svg" alt="">
<div class="quote-block__text" id="<?= $this->GetEditAreaId($arItem['ID']); ?>"><?= $arItem["PREVIEW_TEXT"]; ?></div>
<?endif;?>
<?if ($key == count($arResult["ITEMS"]) - 1):?>
<?
            $close = $openElements[
                $arItem["PROPERTIES"]['ELEMENT_TYPE']['VALUE_XML_ID']
            ]
            ['close'];
        ?>
<?= $close ?>
<?endif;?>
<? endforeach; ?>