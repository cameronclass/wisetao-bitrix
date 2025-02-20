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
$height = '160px';
if (!isset($_SESSION['show_title'])) {
    $_SESSION['show_title'] = false;
}
$transliterationParams = array(
    "max_len" => 255, // максимальная длина результирующей строки
    "change_case" => 'L', // 'L' - привести к нижнему регистру, 'U' - к верхнему
    "replace_space" => '-', // замена пробела на символ
    "replace_other" => '-', // замена других символов на символ
    "delete_repeat_replace" => true, // удаление повторяющихся заменяемых символов
    "use_google" => false, // использовать Google для транслитерации (deprecated)
);
?>

        <? foreach ($arResult["ITEMS"] as $key => $arItem): ?>
            <?if ($key == 1):?>
                <div class="blog-inside__panel_title" data-aos="fade-up">Статьи по теме</div>
            <?endif;?>
            <?

            $transliteratedName = CUtil::translit($arItem['NAME'], "ru", $transliterationParams);
            if ($key > 1) {
                $height = 'auto';
            }
            ?>
            <? if ($key > 0): ?>
                <?
                $_SESSION['show_title'] = true;
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div itemscope itemtype="https://schema.org/BlogPosting" class="blog-article" data-aos="fade-up" id="<?= $this->GetEditAreaId($arItem['ID']); ?>" style="height: <?= $height; ?>">
                    <?if ($key == 1):?>
<a class="blog-article__wide_link" href="/<?=$_GET["direct-china"]?>
/<?=$_GET["data-in-menu"]?>
/<?=$_GET["name"]?>
/<?=$transliteratedName?>-<?=$arItem["ID"]?>/">
</a>
                        <div class="blog-article__img">
                            <img class="blog-article__img_pic" src="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" alt="">
                        </div>
                    <?endif;?>
                    <div class="blog-article__block" style="height: <?= $height; ?>">
                        <div class="blog-article__tags">
                            <span class="article-dot article-dot-yellow"></span>
                            <a class="article-tag" href="#">
                                <? if (!empty($arItem["PROPERTIES"]["TAGS"]["VALUE"])): ?>
                                    <?=$arItem["PROPERTIES"]["TAGS"]["VALUE"][0];?>
                                <? endif; ?>
                            </a>
                        </div>
                        <div class="blog-article__content">
                            <div class="blog-article__date" itemprop="datePublished" datetime="<?= date("d.m.Y", strtotime($arItem["DATE_CREATE"])); ?>"><?= date("d.m.Y", strtotime($arItem["DATE_CREATE"])); ?></div>
<a href="/<?=$_GET["direct-china"]?>
/about
/blog
/<?=$transliteratedName?>-<?=$arItem["ID"]?>/" class="blog-article__title_second" itemprop="headline"><?= $arItem["NAME"]; ?></a>
                        </div>
                    </div>
                </div>
            <? endif; ?>
        <? endforeach; ?>

