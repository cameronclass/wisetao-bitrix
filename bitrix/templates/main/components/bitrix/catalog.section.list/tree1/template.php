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

<div class="subnav_content submenu_<?=$arParams['IBLOCK_ID']?>" <? if($arParams['IBLOCK_ID']==2) echo 'style="display:block;"' ?>>
<? $col = 1; ?>
<? $col_a = array(1,5,9,12)?>

<? if($arParams['IBLOCK_ID']==3) $col_a = array(1,3,5,7); ?>

<? $max = count($arResult['SECTIONS']);?>
<? for($i=0;$i<$max;$i++) {?>

    <? if($arResult['SECTIONS'][$i]['DEPTH_LEVEL']==1){
	$img_41 = CFile::resizeImageGet($arResult['SECTIONS'][$i]['PICTURE']['ID'],array('width'=>41,'height'=>41), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	
	
	if (in_array($col,$col_a)) {
	 if ($col!=1) echo "</div>";
	 echo "<div class='subnav_col'>";
	}

	?>
    
<div class="subnav_submenu"> <a href="<?=$arResult['SECTIONS'][$i]["SECTION_PAGE_URL"]?>" class="type2214 type2216 ">
		<div class="subnav_submenu__header">
		  <div class="subnav_submenu__image"> <img src="<?=$img_41['src']?>" alt="<?=$arResult['SECTIONS'][$i]["NAME"]?>" /> </div>
		</div>
		<strong><?=$arResult['SECTIONS'][$i]["NAME"]?></strong></a>  
         <ul> 
    <? } else { ?>

		
		  <li><a href="<?=$arResult['SECTIONS'][$i]["SECTION_PAGE_URL"]?>" class="type2214 type2216 "><?=$arResult['SECTIONS'][$i]["NAME"]?></a></li>
		
    <? }?>    
        
    <? if($arResult['SECTIONS'][$i+1]['DEPTH_LEVEL']==1){ $col++?>
    	</ul>
</div>
    <? }  ?>
    
    <? if ($i==($max-1)) echo "</div>"; ?>

<? }?>
</div>
</div>

