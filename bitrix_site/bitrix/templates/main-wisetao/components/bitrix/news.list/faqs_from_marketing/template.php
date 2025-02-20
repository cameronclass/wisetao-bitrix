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
$have_question = true;
?>
<? foreach ($arResult["ITEMS"] as $key => $arItem): ?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
    <? if (is_array($arItem["PROPERTIES"]["TITLE"]["VALUE_XML_ID"])
        && (in_array($_GET['data-in-menu'], $arItem["PROPERTIES"]["TITLE"]["VALUE_XML_ID"])
            || in_array($_GET['name'], $arItem["PROPERTIES"]["TITLE"]["VALUE_XML_ID"]))):?>
        <? if ($have_question):?>
            <div class="group-title" data-aos="fade-up" style="margin-bottom: 5px; margin-top: 50px; line-height: 1.3; font-weight: 500;">ПОПУЛЯРНЫЕ ВОПРОСЫ ПО ТЕМЕ</div>
            <div class="accordion-js">
            <ul class="accordion-js__list">
        <?endif;?>
        <li data-aos="fade-up" class="accordion-js__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
            <div class="accordion-js__head">
                <?= $arItem["NAME"]; ?>
            </div>
            <div class="accordion-js__body">
                <?= $arItem["PREVIEW_TEXT"]; ?>
            </div>
        </li>
        <?$have_question = false?>
    <?endif;?>
<? endforeach;?>
<? if (!$have_question):?>
    </ul>
    </div>
<?endif;?>