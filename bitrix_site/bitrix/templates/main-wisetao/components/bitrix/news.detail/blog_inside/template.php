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
$detailTextArray = explode('#SPLIT#', $arResult["DETAIL_TEXT"]);
$file = CFile::GetFileArray($arResult["PROPERTIES"]["HEADER_PIC"]["VALUE"]);
$APPLICATION->SetPageProperty("title", $arResult["NAME"]);
?>
<div class="content-page__content_center" data-aos="fade-up">
    <div class="blog-inside__header">
        <a href="/from-china/about/blog/" class="blog-inside__return">
            <img class="blog-inside__return_icon" src="<?=SITE_TEMPLATE_PATH?>/assets/images/icons/arrow-left.svg" alt="">
            <span class="blog-inside__return_text">Назад</span>
        </a>
        <div class="blog-inside__header_img" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
            <img itemprop="url" content="<?=$file["SRC"];?>" class="blog-inside__header_pic" src="<?=$file["SRC"];?>" alt="">
            <div class="blog-inside__header_block">
                <div class="blog-inside__header_tags">
                    <? foreach ($arResult["PROPERTIES"]["TAGS"]["VALUE"] as $tag): ?>
                        <a class="blog-inside__header_link" href="#"><?=$tag;?></a>
                    <? endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-page__content">
    <div class="content-page__content_left">
        <div class="blog-inside__content" itemscope itemtype="https://schema.org/BlogPosting" data-aos="fade-up">
            <div class="blog-inside__content_share mb-4">
                <a class="blog-inside__content_share_link" href="https://vk.me/wisetao" target="_blank">
                    <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/icons/vk.svg" alt="">
                </a>
                <a class="blog-inside__content_share_link" href="#" target="_blank">
                    <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/icons/okru.svg" alt="">
                </a>
                <a class="blog-inside__content_share_link" href="https://t.me/+79676433973" target="_blank">
                    <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/icons/telegram.svg" alt="">
                </a>
                <a class="blog-inside__content_share_link" href="https://api.whatsapp.com/send?phone=8613154567328" target="_blank">
                    <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/icons/whatsapp.svg" alt="">
                </a>
<!--                <a class="blog-inside__content_share_link blog-inside__content_share_icon" href="#">-->
<!--                    <img src="--><?//=SITE_TEMPLATE_PATH?><!--/assets/images/icons/arrow-down.svg" alt="">-->
<!--                </a>-->
            </div>
            <div  class="blog-inside__content_title">
                <h1 itemprop="headline" class="blog-inside__content_title_text"><?= $arResult["NAME"]; ?></h1>
                <span itemprop="datePublished" datetime="<?= date("d.m.Y", strtotime($arResult["DATE_CREATE"])); ?>" class="blog-inside__content_title_date"><?= date("d.m.Y", strtotime($arResult["DATE_CREATE"])); ?></span>
            </div>
            <div itemprop="description" class="blog-inside__content_text">
                <p>
                    <?= $detailTextArray[0] ?>
                </p>
                <img src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>" alt="">
                <p>
                    <?= $detailTextArray[1] ?>
                </p>
            </div>
            <div class="blog-inside__content_action">
                <div class="blog-inside__content_author" itemprop="author" itemscope itemtype="https://schema.org/Person"><?=$arResult["PROPERTIES"]["AUTHOR_OF_THE_ARTICLE"]["VALUE"]?></div>
                <div class="blog-inside__content_share">
                    <a class="blog-inside__content_share_link" href="https://vk.me/wisetao">
                        <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/icons/vk.svg" alt="">
                    </a>
                    <a class="blog-inside__content_share_link" href="#">
                        <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/icons/okru.svg" alt="">
                    </a>
                    <a class="blog-inside__content_share_link" href="https://t.me/+79676433973">
                        <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/icons/telegram.svg" alt="">
                    </a>
                    <a class="blog-inside__content_share_link" href="https://api.whatsapp.com/send?phone=8613154567328">
                        <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/icons/whatsapp.svg" alt="">
                    </a>
<!--                    <a class="blog-inside__content_share_link blog-inside__content_share_icon" href="#">-->
<!--                        <img src="--><?//=SITE_TEMPLATE_PATH?><!--/assets/images/icons/arrow-down.svg" alt="">-->
<!--                    </a>-->
                </div>
            </div>
        </div>
