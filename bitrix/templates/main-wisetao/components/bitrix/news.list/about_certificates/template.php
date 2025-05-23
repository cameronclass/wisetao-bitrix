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
$customOffset = isset($arParams['CUSTOM_OFFSET']) ? (int)$arParams['CUSTOM_OFFSET'] : 0;
$counter = 0;
$newsCount = isset($arParams['CUSTOM_COUNT']) ? (int)$arParams['CUSTOM_COUNT'] : 4;
?>

<div class="certificates" data-aos="fade-up">
<? foreach ($arResult["ITEMS"] as $arItem): ?>
    <?
    $counter++;
    if ($counter <= $customOffset) {
        continue;
    }

    // Останавливаем вывод, когда достигнем нужного количества
    if ($counter > $customOffset + $newsCount) {
        break;
    }
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>

        <a class="certificates__card fancy-link" id="<?= $this->GetEditAreaId($arItem['ID']); ?>" href="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" data-fancybox="gallery">
            <img class="certificates__card_img" src="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" alt="">
        </a>
<? endforeach; ?>
</div>

<!--<div class="certificates__card" id="--><?//= $this->GetEditAreaId($arItem['ID']); ?><!--">--><?//= $arItem["PREVIEW_TEXT"]; ?><!--</div>-->
