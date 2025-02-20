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
<div class="brands">
	<div class="brands_carousel" id="brands_carousel">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
    <?
	$img_205 = CFile::resizeImageGet($arItem['PREVIEW_PICTURE']['ID'],array('width'=>205,'height'=>70), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	?>    
    <div id="<?=$this->GetEditAreaId($arItem['ID']);?>"><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><img border="0" src="<?=$img_205['src']?>" alt="<?=$arItem['NAME']?>"/></a></div>
 <?endforeach;?> 	
	</div>
</div>



