<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
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
$col = '12';
$col2 = '3';
if ($_SERVER['REAL_FILE_PATH'] == '/marketing.php') {
    $col = '9';
    $col2 = '4';
}
$have_question = true;
$count = 0;
?>

<? foreach ($arResult["ITEMS"] as $key => $arItem): ?>
<?

    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    if ($arItem["PROPERTIES"]["REVIEW_TYPE"]["VALUE_XML_ID"] === "REVIEW_ON_THE_SITE"):
        if (
            is_array($arItem["PROPERTIES"]["TOPICS"]["VALUE_XML_ID"])
            && (in_array($_GET['data-in-menu'], $arItem["PROPERTIES"]["TOPICS"]["VALUE_XML_ID"])
                || in_array($_GET['name'], $arItem["PROPERTIES"]["TOPICS"]["VALUE_XML_ID"]))
        ):
            if ($count < 3):
                $count++;
                ?>
<? if ($have_question): ?>
<div class="group-title" data-aos="fade-up" style="font-weight: 600;">Отзывы</div>
<div class="marketing-review row mb-4" data-aos="fade-up">
    <div class="col-xl-9">
        <div class="row" style="margin: 0;">
            <? endif; ?>
            <div class="col-md-4 mb-4" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <div class="marketing-review-card">
                    <div class="marketing-review-card__category"><?= $arItem["PROPERTIES"]["SERVICES"]["VALUE"]; ?>
                    </div>
                    <div class="marketing-review-card__name"><?= $arItem["PROPERTIES"]["REVIEWER_NAME"]["VALUE"]; ?>
                    </div>
                    <div class="marketing-review-card__text"><?= $arItem["PREVIEW_TEXT"]; ?></div>
                    <div class="marketing-review-card__bottom">
                        <div class="marketing-review-card__service">Услуга:
                            <?= $arItem["PROPERTIES"]["SERVICES"]["VALUE"]; ?>
                        </div>
                        <button type="button" class="marketing-review-card__more">
                            <span>Развернуть</span>
                            <img class="marketing-review-card__more_icon"
                                src="<?= SITE_TEMPLATE_PATH ?>/assets/images/icons/arrow-down.svg" alt="">
                        </button>
                    </div>
                </div>
            </div>
            <? $have_question = false ?>
            <? endif; ?>
            <? endif; ?>

            <? endif; ?>
            <? endforeach; ?>
            <? if (!$have_question): ?>
        </div>
    </div>
    <? endif; ?>
    <? if (!$have_question): ?>
    <!--        -->
    <?// if ($_SERVER['REAL_FILE_PATH'] == '/marketing.php'): ?>
    <div class="col-xl-3">
        <div class="marketing-review-links">
            <div class="marketing-review-links__title">Другие отзывы о нас:</div>
            <div class="marketing-review-links__block">
                <a href="/in-china/about/reviews/" class="marketing-review-links__item main-btn">ЧИТАТЬ ВСЕ ОТЗЫВЫ</a>
                <!--                    -->
                <?// foreach ($arResult["ITEMS"] as $key => $arItem): ?>
                <!--                        -->
                <?//if ($arItem["PROPERTIES"]["REVIEW_TYPE"]["VALUE_XML_ID"] === "REVIEW_FROM_SOCIAL_NET"): ?>
                <!--                            <a href="#" class="marketing-review-links__item --><?php //= $arItem["PROPERTIES"]["CLASS_COLOR"]["VALUE"]; ?>
                <!--">--><?php //= $arItem["NAME"]; ?>
                <!--</a>-->
                <!--                        -->
                <?//endif; ?>
                <!--                    -->
                <?// endforeach; ?>
            </div>
        </div>
    </div>
    <!--        -->
    <?//endif; ?>
    <? endif; ?>
    <? if (!$have_question): ?>
</div>
<? endif; ?>