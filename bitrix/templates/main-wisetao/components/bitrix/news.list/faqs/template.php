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
session_start();
$news_count = 0;
$introduction = true;
if (!isset($_SESSION['ajax_FAQ_inc'])) {
    $_SESSION['ajax_FAQ_inc'] = 0;
}
$_SESSION['ajax_FAQ_inc']++;
?>
<form class="blog-page__search_form" data-aos="fade-up" method="get" action="/<?=$_GET['direct-china']?>/about/faq/">
    <input class="blog-page__search_input" type="text" placeholder="Поиск по FAQ" name="search">
    <button class="blog-page__search_btn" type="submit"><img src="<?=SITE_TEMPLATE_PATH?>/assets/images/search-icon.svg" alt=""></button>
</form>
<? foreach ($arResult["ITEMS"] as $key => $arItem): ?>
<?
$this_search = false;
if (!empty($_GET['search'])) {
    if (
        str_contains($arItem['NAME'], $_GET['search']) ||
        str_contains($arItem['PREVIEW_TEXT'], $_GET['search'])
    ) {
        $this_search = true;
    }
}
?>
<?
$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>
<? if ($introduction): ?>
<div data-aos="fade-up" class="faq-page__content" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
    <p><?= $arItem["PREVIEW_TEXT"]; ?></p>
</div>
<div class="accordion-js">
    <ul class="accordion-js__list" data-ajax_FAQ_inc=<?=$_SESSION['ajax_FAQ_inc']?>>
        <?$introduction = false;?>
        <? else:?>
            <? if (isset($_REQUEST['search']) && $this_search || !isset($_REQUEST['search'])): ?>
                <li itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="accordion-js__item" data-aos="fade-up" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                    <div class="accordion-js__head" itemprop="name">
                        <?= $arItem["NAME"]; ?>
                    </div>
                    <div class="accordion-js__body" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <span itemprop="text"><?= $arItem["PREVIEW_TEXT"]; ?></span>
                    </div>
                </li>
                <? $news_count++ ?>
            <? endif; ?>
        <? endif; ?>
        <? endforeach;?>
    </ul>
    <? if ($news_count == 0): ?>
        <span data-aos="fade-up" style="margin-left: 5px;">Ничего не найдено</span>
    <? endif; ?>
</div>


