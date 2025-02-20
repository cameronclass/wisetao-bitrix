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

//$parentCatalogId = CIBlockSection::GetList($arResult["ITEMS"][0]["IBLOCK_SECTION_ID"])->Fetch()['IBLOCK_SECTION_ID'];
$sectionList = CIBlockSection::GetList([], [
    'IBLOCK_ID' => 31,
    'SECTION_ID' => $arResult['SECTION']['PATH'][0]['ID']
]);

function contentNumber($caseNumber, $elementId) {
    for ($i = 1; $i < $caseNumber; $i++) {
        $elementId .= $elementId;
    }
    return $elementId;
}

?>
<div class="swiper-wrapper">
    <? while ($section = $sectionList->Fetch()): ?>
        <?
        $first = true;
        $show = true;
        ?>
        <div class="swiper-slide" data-aos="fade-up">
            <div class="case-block">
                <div class="case-tabs">
                    <?
                    $elementIterator = CIBlockElement::GetList([], [
                        'IBLOCK_ID' => 31,
                        'SECTION_ID' => $section['ID'],
                    ]);
                    ?>
                    <? while ($element = $elementIterator->Fetch()): ?>
                        <?
                        $elementProps = CIBlockElement::GetProperty(31, $element['ID']);
                        $elementProperties = [];

                        while ($prop = $elementProps->Fetch()) {
                            $elementProperties[$prop['CODE']] = $prop['VALUE'];
                        }
                        ?>
                        <button class="tab-btn <?=($first ? 'active' : '')?> case-tabs__btn" content-id="<?= contentNumber(substr($section['CODE'], strlen($section['CODE']) - 1, 1), $element['ID']) ?>">
                            <img class="case-tabs__icon" src="<?=CFile::GetPath($elementProperties['ICON']) ;?>">
                            <div class="case-tabs__text"><?=$element['NAME']?></div>
                        </button>
                        <?$first = false?>
                    <? endwhile; ?>
                </div>
                <div class="case-tabs-content">
                    <?
                    $elementIterator = CIBlockElement::GetList([], [
                        'IBLOCK_ID' => 31,
                        'SECTION_ID' => $section['ID'],
                    ]);
                    ?>
                    <? while ($element = $elementIterator->Fetch()): ?>
                        <?
                        $editLink = '/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=' . $element['IBLOCK_ID'] . '&type=cases' . '&ID=' . $element['ID'] . '&lang=' . LANGUAGE_ID . '&force_catalog=&filter_section=' . $section['ID'] . '&bxpublic=Y&from_module=iblock';
                        $this->AddEditAction($element['ID'], $editLink, CIBlock::GetArrayByID($element["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($element['ID'], $element['DELETE_LINK'], CIBlock::GetArrayByID($element["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                        ?>
                        <div class="content <?=($show ? 'show' : '')?>" id="<?= contentNumber(substr($section['CODE'], strlen($section['CODE']) - 1, 1), $element['ID']) ?>">
                            <div class="tabs-card"  id="<?= $this->GetEditAreaId($element['ID']); ?>">
                                <div class="tabs-card__img">
                                    <img class="tabs-card__img_item" src="<?=CFile::GetPath($element['PREVIEW_PICTURE'])?>" alt="">
                                </div>
                                <div class="tabs-card__content">
                                    <div class="js-read-smore" data-read-smore-chars="850">
                                        <p><?=$element['PREVIEW_TEXT']?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?$show = false?>
                    <? endwhile; ?>
                </div>
            </div>
        </div>
    <?endwhile;?>
</div>

