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
global $APPLICATION;
?>

<section class="tovar_section">
	
	<!-- CONTAINER -->
	<div class="container">
		<h2><?=GetMessage("PIMAX_FASHIONSTORE_TRENDY_SEZONA")?></h2>
		
		<div class="row">
			<div class="tovar_wrapper" data-appear-top-offset='-100' data-animated='fadeInUp'>
			
<?
$i = 1;
foreach ($arResult['ITEMS'] as $key => $arItem)
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

	<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 col-ss-12 padbot40">
		<div class="tovar_item">
			<div class="tovar_img">
				<div class="tovar_img_wrapper">
					<img class="img" src="<? echo $arItem['PREVIEW_PICTURE']['SRC']; ?>" alt="" />
					<img class="img_h" src="<? echo (
						!empty($arItem['PREVIEW_PICTURE_SECOND'])
						? $arItem['PREVIEW_PICTURE_SECOND']['SRC']
						: $arItem['PREVIEW_PICTURE']['SRC']
					); ?>" alt="" />
				</div>
				<div class="tovar_item_btns">
					<div class="open-project-link"><a class="open-project tovar_view" href="#SITE_DIR#ajax/product/?ELEMENT_ID=<?php echo $arItem['ID']?>" ><?=GetMessage("PIMAX_FASHIONSTORE_PROSMOTR")?></a></div>
					<div class="open-project-link"><a class="open-project add_bag" href="#SITE_DIR#ajax/product/?ELEMENT_ID=<?php echo $arItem['ID']?>" ><i class="fa fa-shopping-cart"></i></a></div>
				</div>
			</div>
			<div class="tovar_description clearfix">
				<a class="tovar_title" href="<? echo $arItem['DETAIL_PAGE_URL']; ?>"><? echo $arItem['NAME']; ?></a>
				<span class="tovar_price"><?php 
				$frame = $this->createFrame()->begin(); 
				echo $arItem['MIN_PRICE']['PRINT_DISCOUNT_VALUE'];
				
				$frame->end();?></span>
			</div>
		</div>
	</div>
	<?php if ($i == 4){?>
		</div></div>
		<div class="row">
			<div class="tovar_wrapper" data-appear-top-offset='-100' data-animated='fadeInUp'>
			<?php $i = 1; ?>
	<?php } else {
		$i++;
	} ?>
<?php }
?>
<?php if ($i != 4):?>
	</div></div>
<?php endif;?>
</div></section>