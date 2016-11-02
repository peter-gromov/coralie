<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @var string $strElementEdit */
/** @var string $strElementDelete */
/** @var array $arElementDeleteParams */
/** @var array $arSkuTemplate */
/** @var array $templateData */
$intRowsCount = count($arResult['ITEMS']);
$strContID = 'cat_top_cont_'.mt_rand(0, 1000000);
?>

<h3><b><?=GetMessage("PIMAX_FASHIONSTORE_REKOMENDUEM")?></b></h3>
<ul class="tovar_items_small clearfix">



<?
$boolFirst = true;
$arRowIDs = array();
foreach ($arResult['ITEMS'] as $keyRow => $arOneRow)
{
	$strRowID = 'cat-top-'.$keyRow.'_'.mt_rand(0, 1000000);
	$arRowIDs[] = $strRowID;
?>
<?
	foreach ($arOneRow as $keyItem => $arItem)
	{
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
		$strMainID = $this->GetEditAreaId($arItem['ID']);

		$arItemIDs = array(
			'ID' => $strMainID,
			'PICT' => $strMainID.'_pict',
			'SECOND_PICT' => $strMainID.'_secondpict',
			'MAIN_PROPS' => $strMainID.'_main_props',

			'QUANTITY' => $strMainID.'_quantity',
			'QUANTITY_DOWN' => $strMainID.'_quant_down',
			'QUANTITY_UP' => $strMainID.'_quant_up',
			'QUANTITY_MEASURE' => $strMainID.'_quant_measure',
			'BUY_LINK' => $strMainID.'_buy_link',
			'SUBSCRIBE_LINK' => $strMainID.'_subscribe',

			'PRICE' => $strMainID.'_price',
			'DSC_PERC' => $strMainID.'_dsc_perc',
			'SECOND_DSC_PERC' => $strMainID.'_second_dsc_perc',

			'PROP_DIV' => $strMainID.'_sku_tree',
			'PROP' => $strMainID.'_prop_',
			'DISPLAY_PROP_DIV' => $strMainID.'_sku_prop',
			'BASKET_PROP_DIV' => $strMainID.'_basket_prop'
		);

		$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);
		$strTitle = (
			isset($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"]) && '' != isset($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"])
			? $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"]
			: $arItem['NAME']
		);
?>

<li class="clearfix">
	<img class="tovar_item_small_img" src="<? echo $arItem['PREVIEW_PICTURE']['SRC']; ?>" alt="" />
	<a href="<? echo $arItem['DETAIL_PAGE_URL']; ?>" class="tovar_item_small_title"><? echo $arItem['NAME']; ?></a>
	<span class="tovar_item_small_price"><?php echo $arItem['MIN_PRICE']['PRINT_DISCOUNT_VALUE']?></span>
</li>


<?php
} }
?>
</ul>