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
$this->setFrameMode(true);
?>
<div class="section_list catalog_subsections_list">
<? foreach($arResult['SECTIONS'] as $section){ ?>
<? $img_300 = CFile::resizeImageGet($section['PICTURE']['ID'],array('width'=>300,'height'=>300), BX_RESIZE_IMAGE_PROPORTIONAL, true); ?>
    <div class="section_list__col">
        <a href="<?=$section['SECTION_PAGE_URL']?>" style="width: 100%;" title="<?=$section['SECTION_PAGE_URL']?>">

        <div align="center" style="height: 150px; margin-bottom: 20px;">
                <img src="<?=$img_300['src']?>" alt="" style="vertical-align: middle; max-height: 150px; max-width: 100%;">
        </div>
        </a>
        <h3><a href="<?=$section['SECTION_PAGE_URL']?>"><?=$section['NAME']?></a></h3>
    </div>
<? } ?>
</div>