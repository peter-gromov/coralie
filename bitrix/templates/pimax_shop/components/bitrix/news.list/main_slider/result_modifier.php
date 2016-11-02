<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?php 
if (!empty($arResult['ITEMS'])) 
{
	foreach ($arResult['ITEMS'] as $k => $arItem)
	{
		if (!empty($arItem['PROPERTIES']['BANNER1']['VALUE']))
		{
			$arResult['ITEMS'][$k]['PROPERTIES']['BANNER1']['VALUE'] = CFile::GetFileArray($arItem['PROPERTIES']['BANNER1']['VALUE']);
		}
		
		if (!empty($arItem['PROPERTIES']['BANNER2']['VALUE']))
		{
			$arResult['ITEMS'][$k]['PROPERTIES']['BANNER2']['VALUE'] = CFile::GetFileArray($arItem['PROPERTIES']['BANNER2']['VALUE']);
		}
		
		if (!empty($arItem['PROPERTIES']['BANNER3']['VALUE']))
		{
			$arResult['ITEMS'][$k]['PROPERTIES']['BANNER3']['VALUE'] = CFile::GetFileArray($arItem['PROPERTIES']['BANNER3']['VALUE']);
		}
 	}
}

//echo '<pre>', print_r($arResult, true), '</pre>';
	