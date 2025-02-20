<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//delayed function must return a string


if(empty($arResult))
	return "";
	
$strReturn = '<div class="breadcrumbs"><a href="/" title="Главная страница">Главная страница</a>';

$num_items = count($arResult);



for($index = 0, $itemSize = $num_items; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	
	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
		$strReturn .= '<i class="icon icon-breadcrumbs_arrow"></i><a href="'.$arResult[$index]["LINK"].'" title="'.$title.'">'.$title.'</a></li>';
	else
		$strReturn .= '<i class="icon icon-breadcrumbs_arrow"></i><span>'.$title.'</span></li>';
}

$strReturn .= '</div>';

return $strReturn;
?>