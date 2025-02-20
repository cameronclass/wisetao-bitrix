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
    <?$transliteratedName = CUtil::translit($arItem['NAME'], "ru", $transliterationParams);?>
    <? if ($key > 0): ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="logistic-blog__card" data-aos="fade-up" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
            <div class="logistic-blog__card_block">
                <img class="logistic-blog__card_img" src="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" alt="">
                <div class="logistic-blog__card_overlay">
<a href="/<?=$_GET["direct-china"]?>
/about
/blog
/<?=$transliteratedName?>-<?=$arItem["ID"]?>/" style="display: inline-block;height: 100%;width: 100%;"></a>
                </div>
                <div class="logistic-blog__card_tags">
                    <span class="logistic-blog__card_tag">
                        <? if (!empty($arItem["PROPERTIES"]["TAGS"]["VALUE"])): ?>
                            <?=$arItem["PROPERTIES"]["TAGS"]["VALUE"][0];?>
                        <? endif; ?>
                    </span>
                </div>
            </div>
<a href="/<?=$_GET["direct-china"]?>
/about
/blog
/<?=$transliteratedName?>-<?=$arItem["ID"]?>/" class="logistic-blog__card_title"><?= $arItem["NAME"]; ?></a>
        </div>
    <? endif; ?>
<? endforeach; ?>