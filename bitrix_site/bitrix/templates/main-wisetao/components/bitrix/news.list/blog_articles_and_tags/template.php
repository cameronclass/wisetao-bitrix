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
$first = true;
$second = true;
$third = true;
$fourth = true;
$tags = true;
$news_count = 0;
$begin_old_articles = false;
session_start();
$_SESSION['ajax_from_blog'] = '1';


$transliterationParams = array(
    "max_len" => 255, // максимальная длина результирующей строки
    "change_case" => 'L', // 'L' - привести к нижнему регистру, 'U' - к верхнему
    "replace_space" => '-', // замена пробела на символ
    "replace_other" => '-', // замена других символов на символ
    "delete_repeat_replace" => true, // удаление повторяющихся заменяемых символов
    "use_google" => false, // использовать Google для транслитерации (deprecated)
);


?>
<? foreach ($arResult["ITEMS"] as $arItem): ?>
    <?
    $transliteratedName = CUtil::translit($arItem['NAME'], "ru", $transliterationParams);
    $this_search = false;
    $this_tag = false;
    $currentDate = new DateTime();
    $fewDaysAgo = $currentDate->modify($arItem['PROPERTIES']["MAX_AGE_NEW_ARTICLE"]['DEFAULT_VALUE']);
    $itemDate = DateTime::createFromFormat('m/d/Y h:i:s A', $arItem["DATE_CREATE"]);
    if (!empty($_GET['search'])) {
        $foundInTags = false;
        foreach ($arItem['PROPERTIES']['TAGS']['VALUE'] as $tag) {
            if (str_contains($tag, $_GET['search']) !== false) {
                $foundInTags = true;
                break;
            }
        }
        if (
            str_contains($arItem['NAME'], $_GET['search']) ||
            str_contains($arItem['PREVIEW_TEXT'], $_GET['search']) ||
            str_contains($arItem['DETAIL_TEXT'], $_GET['search']) ||
            in_array($_GET['search'], $arItem['PROPERTIES']['TAGS']['VALUE']) ||
            $foundInTags
        ) {
            $this_search = true;
        }
    }

    // Проверка на соответствие тегу
    if (isset($_REQUEST['tag']) && in_array($_REQUEST['tag'], $arItem['PROPERTIES']['TAGS']['VALUE'])) {
        $this_tag = true;
    }
    ?>
    <? if ($tags): ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="blog-page__search" data-aos="fade-up" data-ajax_from_blog="<?=$_SESSION['ajax_from_blog']?>">
            <form class="blog-page__search_form" method="get" action="/<?= $_GET['direct-china']; ?>/<?= $_GET['data-in-menu']; ?>/blog/">
                <input class="blog-page__search_input" type="text" placeholder="Поиск по названию статьи или событию" name="search">
                <button class="blog-page__search_btn" type="submit"><img src="<?=SITE_TEMPLATE_PATH?>/assets/images/search-icon.svg" alt=""></button>
            </form>
        </div>
        <div class="blog-page__menu" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
            <ul class="blog-page__menu_list" data-aos="fade-up">
                <? foreach ($arItem["PROPERTIES"]["TAGS"]["VALUE"] as $key => $tag): ?>
                    <? if ($key < 6): ?>
                        <li><a class="blog-page__menu_list_link" href="/<?= $_GET['direct-china']; ?>/<?= $_GET['data-in-menu']; ?>/blog/?tag=<?= $tag; ?>"><?= $tag; ?></a></li>
                    <? endif; ?>
                <? endforeach; ?>
            </ul>
            <div class="blog-page__menu_more" data-aos="fade-up">
                <a class="blog-page__menu_more_link blog-page__menu_more_link_dots" href="#"><img class="blog-page__menu_more_icon" src="<?=SITE_TEMPLATE_PATH?>/assets/images/3-dots.svg" alt=""></a>
                <? foreach ($arItem["PROPERTIES"]["TAGS"]["VALUE"] as $key => $tag): ?>
                    <? if ($key >= 6): ?>
                        <a class="blog-page__menu_more_link" href="/<?= $_GET['direct-china']; ?>/<?= $_GET['data-in-menu']; ?>/blog/?tag=<?= $tag; ?>"><?= $tag; ?></a>
                    <? endif; ?>
                <? endforeach; ?>
            </div>
        </div>
        <?$tags = false?>
        <div class="blog-page__start" >
            <h2 class="group-title" data-aos="fade-up">НОВОЕ</h2>
            <div class="row">
    <? else : ?>
        <? if (isset($_REQUEST['tag']) && $this_tag || isset($_REQUEST['search']) && $this_search || !isset($_REQUEST['tag']) && !isset($_REQUEST['search']) || $_REQUEST['tag'] == 'Все'): ?>
            <? if ($news_count < 4 && $itemDate >= $fewDaysAgo): ?>
                <? if ($first || $fourth && !$second && !$third): ?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div class="col-xl-8 col-lg-12 mb-4" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                        <div class="blog-article-full" itemtype="https://schema.org/BlogPosting" data-aos="fade-up">
                            <div class="blog-article-full__img">
                                <meta itemprop="mainEntityOfPage" content="/<?=$_GET["direct-china"]?>
/<?=$_GET["data-in-menu"]?>
/<?=$_GET["name"]?>
/<?=$transliteratedName?>-<?=$arItem["ID"]?>/">
<a itemprop="mainEntityOfPage" href="/<?=$_GET["direct-china"]?>
/<?=$_GET["data-in-menu"]?>
/<?=$_GET["name"]?>
/<?=$transliteratedName?>-<?=$arItem["ID"]?>/"><img itemprop="image" itemscope itemtype="https://schema.org/ImageObject" class="blog-article-full__img_pic" src="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" alt="<?= $arItem["NAME"]; ?>"></a>
                                <div class="blog-article-full__img_dot">
                                    <span class="article-dot article-dot-yellow"></span>
                                </div>
                            </div>
                            <div class="blog-article-full__content">
                                <div class="blog-article-full__tags">
                                    <? foreach ($arItem["PROPERTIES"]["TAGS"]["VALUE"] as $tag): ?>
                                        <a class="article-tag" href="#"><?= $tag ?></a>
                                    <? endforeach; ?>
                                </div>
                                <div itemprop="headline" class="blog-article-full__title">
<a href="/<?=$_GET["direct-china"]?>
/<?=$_GET["data-in-menu"]?>
/<?=$_GET["name"]?>
/<?=$transliteratedName?>-<?=$arItem["ID"]?>/" class="blog-article-full__title_text"><?= $arItem["NAME"]; ?></a>
                                    <div class="blog-article-full__date" itemprop="datePublished" datetime="<?= date("d.m.Y", strtotime($arItem["DATE_CREATE"])); ?>"><?= date("d.m.Y", strtotime($arItem["DATE_CREATE"])); ?></div>
                                </div>
                                <p itemprop="description" class="blog-article-full__text"><?= $arItem["PREVIEW_TEXT"]; ?></p>
                            </div>
                        </div>
                    </div>
                    <?
                    if (!$first && !$second && !$third) {
                        $fourth = false;
                    }
                    $first = false;
                    ?>
                <? elseif ($second || $third) : ?>
                    <?
                    if (!$second) {
                        $third = false;
                    }
                    $second = false;
                    ?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div class="col-xl-4 col-lg-6 col-md-6 col-12 mb-4" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                        <div class="blog-article" itemscope itemtype="https://schema.org/BlogPosting" data-aos="fade-up">
                            <meta itemprop="mainEntityOfPage" content="/<?=$_GET["direct-china"]?>
/<?=$_GET["data-in-menu"]?>
/<?=$_GET["name"]?>
/<?=$transliteratedName?>-<?=$arItem["ID"]?>/">
<a class="blog-article__wide_link blog-article__wide_link_new" href="/<?=$_GET["direct-china"]?>
/<?=$_GET["data-in-menu"]?>
/<?=$_GET["name"]?>
/<?=$transliteratedName?>-<?=$arItem["ID"]?>/">
</a>
                            <div class="blog-article__img" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                                <img class="blog-article__img_pic" itemprop="url" content="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" src="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" alt="">
                            </div>
                            <div class="blog-article__block">
                                <div class="blog-article__tags">
                                    <span class="article-dot article-dot-yellow"></span>
                                    <a class="article-tag" href="#"><? if (!empty($arItem["PROPERTIES"]["TAGS"]["VALUE"])): ?>
                                        <?=$arItem["PROPERTIES"]["TAGS"]["VALUE"][0];?>
                                        <? endif; ?>
                                    </a>
                                </div>
                                <div class="blog-article__content">
<a href="/<?=$_GET["direct-china"]?>
/<?=$_GET["data-in-menu"]?>
/<?=$_GET["name"]?>
/<?=$transliteratedName?>-<?=$arItem["ID"]?>/" class="blog-article__title" itemprop="headline"><?= $arItem["NAME"]; ?></a>
                                    <div class="blog-article__date" itemprop="datePublished" datetime="<?= date("d.m.Y", strtotime($arItem["DATE_CREATE"])); ?>"><?= date("d.m.Y", strtotime($arItem["DATE_CREATE"])); ?></div>
                                    <div class="blog-article__text" itemprop="description"><?= $arItem["PREVIEW_TEXT"]; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <? endif; ?>
                <?
                $news_count++
                ?>
            <? elseif ($news_count < $_SESSION['n_count_requested']) : ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <? if (!$begin_old_articles): ?>
                    <? if ($news_count == 0): ?>
                        <span data-aos="fade-up" style="margin-left: 16px;">Новых статей в выбранной категории нет</span>
                    <? endif; ?>
                        </div>
                    </div>
                    <div class="blog-page__articles">
                        <h2 class="group-title" data-aos="fade-up">СТАТЬИ</h2>
                        <div class="row">
                    <?
                    $begin_old_articles = true;
                    ?>
                <? endif; ?>
                <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-4" data-aos="fade-up" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                    <div class="blog-article">
                        <meta itemprop="mainEntityOfPage" content="/<?=$_GET["direct-china"]?>
/<?=$_GET["data-in-menu"]?>
/<?=$_GET["name"]?>
/<?=$transliteratedName?>-<?=$arItem["ID"]?>/">
<a class="blog-article__wide_link" href="/<?=$_GET["direct-china"]?>
/<?=$_GET["data-in-menu"]?>
/<?=$_GET["name"]?>
/<?=$transliteratedName?>-<?=$arItem["ID"]?>/">
</a>
                        <div class="blog-article__img" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                            <img class="blog-article__img_pic" itemprop="url" content="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" src="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" alt="<?= $arItem["NAME"]; ?>">
                        </div>
                        <div class="blog-article__block">
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
/<?=$_GET["data-in-menu"]?>
/<?=$_GET["name"]?>
/<?=$transliteratedName?>-<?=$arItem["ID"]?>/" class="blog-article__title_second" itemprop="headline"><?= $arItem["NAME"]; ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <? $news_count++ ?>
            <? endif; ?>
        <? endif; ?>
    <? endif; ?>
<? endforeach; ?>
    <? if (!$begin_old_articles || $news_count == 0): ?>
        <? if ($news_count == 0): ?>
            <span data-aos="fade-up" style="margin-left: 16px;">Новых статей в выбранной категории нет</span>
        <? endif; ?>
            </div>
        </div>
        <div class="blog-page__articles">
            <h2 class="group-title" data-aos="fade-up">СТАТЬИ</h2>
            <div class="blog-page__articles_block" data-aos="fade-up">
                <span>Статей в выбранной категории нет</span>
    <? endif; ?>
    </div>
    <div class="blog-page__articles_more" data-aos="fade-up">
        <button type="button" class="blog-page__articles_more_btn">
            <?
            $str_tag_or_search = '';
            if (isset($_REQUEST['tag'])) {
                $str_tag_or_search = '&tag='.$_REQUEST['tag'];
            }
            elseif (isset($_REQUEST['search'])) {
                $str_tag_or_search = '&search='.$_REQUEST['search'];
            }
            ?>
            <a class="not-clickable" href="/<?= $_GET['direct-china']; ?>/about/blog/?more=<?=$str_tag_or_search?>" style="display: flex;">
                <span style="margin-right: 10px;">Еще</span>
                <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/icons/arrow-down.svg" alt="">
            </a>
        </button>
    </div>
</div>