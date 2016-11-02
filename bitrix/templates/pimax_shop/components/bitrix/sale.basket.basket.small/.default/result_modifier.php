<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?php 

CModule::IncludeModule("iblock");
CModule::IncludeModule("sale");
CModule::IncludeModule("catalog");

$arResult['COUNT'] = 0;
$arResult['AMOUNT'] = 0;

if (!empty($arResult['ITEMS']))
{
	foreach ($arResult['ITEMS'] as $k => $item)
	{
		$ar_res = CCatalogProduct::GetByIDEx($item['PRODUCT_ID'], true);

		if ($ar_res['DETAIL_PICTURE']) {
			$file = CFile::ResizeImageGet($ar_res['DETAIL_PICTURE'], array('width'=>60, 'height'=>80), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);  
			
			$arResult['ITEMS'][$k]['PICTURE'] = $file['src'];
		} else {
			$ar_res2 = CCatalogProduct::GetByIDEx($ar_res['PROPERTIES']['CML2_LINK']['VALUE'], true);

			if ($ar_res2['DETAIL_PICTURE']) {
				$file = CFile::ResizeImageGet($ar_res2['DETAIL_PICTURE'], array('width' => 60, 'height' => 80), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);

				$arResult['ITEMS'][$k]['PICTURE'] = $file['src'];
			}
		}
		
		if ($item['CAN_BUY'] == 'Y') {
			$arResult['AMOUNT'] += $item['PRICE'] * $item['QUANTITY'];
			$arResult['COUNT'] += $item['QUANTITY'];
		}
 	}
	
	$arResult['AMOUNT'] = SaleFormatCurrency($arResult['AMOUNT'], $arResult['ITEMS'][0]["CURRENCY"]);
}
	