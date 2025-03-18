<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
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
if (!isset($_SESSION['ajax_reviews_inc'])) {
    $_SESSION['ajax_reviews_inc'] = 0;
}
$name = explode('?', $_GET['name'])[0];
$_SESSION['ajax_reviews_inc']++;
//$title = '';

$arTopics = array();
$rsEnum = CIBlockPropertyEnum::GetList(
    array(),
    array(
        "IBLOCK_ID" => "21",
        "CODE" => "MAIN_TOPIC" // Код свойства "MAIN_TOPIC"
    )
);
while ($enumValue = $rsEnum->GetNext()) {
    $arTopics[] = $enumValue;
}

?>
<div class="reviews">
    <ul class="reviews__menu">
        <? foreach ($arTopics as $arTopic): ?>
        <li data-aos="fade-up" class="reviews__menu_list"><a class="reviews__menu_item"
                href="/<?= $_GET['direct-china'] ?>/<?= $_GET['data-in-menu'] ?>/reviews/?tag=<?= $arTopic['VALUE'] ?>"><?= $arTopic['VALUE'] ?></a>
        </li>
        <? endforeach; ?>
    </ul>
    <div class="reviews__items" data-ajax_reviews_inc="<?= $_SESSION['ajax_reviews_inc'] ?>">

        <? foreach ($arResult["ITEMS"] as $key => $arItem): ?>
        <? if ($arItem['PROPERTIES']['REVIEW_TYPE']['VALUE_XML_ID'] != "REVIEW_FROM_SOCIAL_NET"): ?>
        <?
                $this_tag = false;
                if (isset($_REQUEST['tag']) && str_contains($arItem['PROPERTIES']['MAIN_TOPIC']['VALUE'], $_REQUEST['tag'])) {
                    $this_tag = true;
                }
                $text = $arItem["PREVIEW_TEXT"];
                ?>
        <!--                -->
        <?// if ($arItem["PROPERTIES"]["TOPICS"]["VALUE_XML_ID"] && $arItem["PROPERTIES"]["TOPICS"]["VALUE_XML_ID"] != $title): ?>
        <!--                    -->
        <?// $title = $arItem["PROPERTIES"]["TOPICS"]["VALUE_XML_ID"]; ?>
        <!--                    <h2 class="group-title" style="margin-bottom: 0; margin-top: 30px; text-transform: uppercase; font-size: 25px;">--><?php //= $arItem["PROPERTIES"]["TOPICS"]["VALUE"] ?>
        <!--</h2>-->
        <!--                -->
        <?//endif; ?>
        <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
        <? if ((isset($_REQUEST['tag']) && $this_tag || !isset($_REQUEST['tag']) || $_REQUEST['tag'] == 'Все') && $news_count < $_SESSION['n_count_requested']): ?>
        <div itemscope itemtype="https://schema.org/Review" data-aos="fade-up" class="reviews__item"
            id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
            <? if (mb_strlen($arItem["PREVIEW_TEXT"]) <= 304): ?>
            <div class="reviews__item_text" itemprop="reviewBody"><?= $text; ?></div>
            <? $button_opacity = 'transparent-button' ?>
            <? else: ?>
            <div class="reviews__item_text" itemprop="reviewBody"><?= mb_substr($text, 0, 304) . '...'; ?></div>
            <span style="display: none;"
                class="hide-part-review"><?= mb_substr($text, 304, mb_strlen($text) - 304); ?></span>
            <? $button_opacity = '' ?>
            <? endif; ?>
            <div class="reviews__item_block">
                <div class="reviews__item_category">
                    <div
                        class="reviews__item_category_tag <?= $arItem["PROPERTIES"]["MAIN_TOPIC"]["VALUE_XML_ID"]; ?>-tag">
                        <?= $arItem["PROPERTIES"]["MAIN_TOPIC"]["VALUE"]; ?>
                    </div>
                    <div class="reviews__item_category_service">Услуга:
                        <?= $arItem["PROPERTIES"]["SERVICES"]["VALUE"]; ?>
                    </div>
                </div>
                <button class="reviews__item_more <?= $button_opacity ?>">
                    <span>Развернуть</span>
                    <img class="reviews__item_more_icon"
                        src="<?= SITE_TEMPLATE_PATH ?>/assets/images/icons/arrow-down.svg" alt="">
                </button>
                <div itemscope itemprop="author" itemtype="https://schema.org/Person" class="reviews__item_author">
                    <span itemprop="name"><?= $arItem["PROPERTIES"]["REVIEWER_NAME"]["VALUE"]; ?></span>
                </div>
                <div itemprop="itemReviewed" itemscope itemtype="https://schema.org/Organization">
                    <meta itemprop="name" content="Wisetao">
                </div>
            </div>

        </div>
        <? $news_count++ ?>
        <? endif; ?>
        <? endif; ?>
        <? endforeach; ?>

        <? if ($news_count == 0): ?>
        <span data-aos="fade-up" style="margin-left: 16px;">Отзывов по выбранной теме нет</span>
        <? endif; ?>
    </div>
</div>
<div class="blog-page__articles_more" data-aos="fade-up">
    <button type="button" class="blog-page__articles_more_btn">
        <?
        $str_tag = '';
        if (isset($_REQUEST['tag'])) {
            $str_tag = '&tag=' . $_REQUEST['tag'];
        }
        ?>
        <a class="not-clickable"
            href="/<?= $_GET['direct-china'] ?>/<?= $_GET['data-in-menu'] ?>/reviews/?more=<?= $str_tag ?>"
            style="display: flex;">
            <span style="margin-right: 10px;">Еще</span>
            <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/icons/arrow-down.svg" alt="">
        </a>
    </button>
</div>