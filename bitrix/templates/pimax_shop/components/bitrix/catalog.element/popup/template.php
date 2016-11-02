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

$templateData = array(
	'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css',
	'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME']
);

$strMainID = $this->GetEditAreaId($arResult['ID']);
$arItemIDs = array(
	'ID' => $strMainID,
	'PICT' => $strMainID.'_pict',
	'DISCOUNT_PICT_ID' => $strMainID.'_dsc_pict',
	'STICKER_ID' => $strMainID.'_sticker',
	'BIG_SLIDER_ID' => $strMainID.'_big_slider',
	'BIG_IMG_CONT_ID' => $strMainID.'_bigimg_cont',
	'SLIDER_CONT_ID' => 'carousel1', //$strMainID.'_slider_cont',
	'SLIDER_LIST' => $strMainID.'_slider_list',
	'SLIDER_LEFT' => $strMainID.'_slider_left',
	'SLIDER_RIGHT' => $strMainID.'_slider_right',
	'OLD_PRICE' => $strMainID.'_old_price',
	'PRICE' => $strMainID.'_price',
	'DISCOUNT_PRICE' => $strMainID.'_price_discount',
	'SLIDER_CONT_OF_ID' => $strMainID.'_slider_cont_',
	'SLIDER_LIST_OF_ID' => $strMainID.'_slider_list_',
	'SLIDER_LEFT_OF_ID' => $strMainID.'_slider_left_',
	'SLIDER_RIGHT_OF_ID' => $strMainID.'_slider_right_',
	'QUANTITY' => $strMainID.'_quantity',
	'QUANTITY_DOWN' => $strMainID.'_quant_down',
	'QUANTITY_UP' => $strMainID.'_quant_up',
	'QUANTITY_MEASURE' => $strMainID.'_quant_measure',
	'QUANTITY_LIMIT' => $strMainID.'_quant_limit',
	'BUY_LINK' => $strMainID.'_add_basket_link',
	'ADD_BASKET_LINK' => $strMainID.'_add_basket_link',
	'COMPARE_LINK' => $strMainID.'_compare_link',
	'PROP' => $strMainID.'_prop_',
	'PROP_DIV' => $strMainID.'_skudiv',
	'DISPLAY_PROP_DIV' => $strMainID.'_sku_prop',
	'OFFER_GROUP' => $strMainID.'_set_group_',
	'BASKET_PROP_DIV' => $strMainID.'_basket_prop',
);
$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);
$templateData['JS_OBJ'] = $strObName;

$strTitle = (
	isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]) && '' != $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]
	? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]
	: $arResult['NAME']
);
$strAlt = (
	isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]) && '' != $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]
	? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]
	: $arResult['NAME']
);
?>

<div id="<?php echo $strMainID?>" class="tover_view_page element_fade_in">
	<div class="tover_view_header clearfix">
		<p>Быстрый просмотр</p>
		<a id="tover_view_page_close" href="javascript:void(0);"><?=GetMessage("PIMAX_FASHIONSTORE_ZAKRYTQ")?><i class="fa-product-close" aria-hidden="true"></i></a>
	</div>
	
	<div class="clearfix">
		<div class="tovar_view_fotos clearfix" id="<? echo $arItemIDs['ID']; ?>">
		
		<?if ($arResult["PROPERTIES"]["NEWPRODUCT"]["VALUE"] === "Y"):?>
	        <div class="new-product-icon-new detail">NEW</div>
	    <?endif;?>
	    
	    <?if ($arResult["PROPERTIES"]["SPECIALOFFER"]["VALUE"] === "Y"):?>
	        <div class="new-product-icon-sale detail">-<?php echo $arResult["PROPERTIES"]["SALE_AMOUNT"]["VALUE"]?>%</div>
	    <?endif;?>

		<?php /* Simple product */ ?>
		<?php if (!isset($arResult['OFFERS']) || empty($arResult['OFFERS'])):?>
			<div id="slider1" class="flexslider slider1 " style="display: block;">
				<ul class="slides">
				
					<?php foreach ($arResult['MORE_PHOTO'] as $k => $arOnePhoto):?>
					
						<li><img
								onload="this.parentNode.className='feed-com-img-wrap';"
								src="<? echo $arOnePhoto['FULL']['src']; ?>"
								data-bx-viewer="image"	
								data-bx-height="100%"							 
								data-bx-src="<? echo $arOnePhoto['SRC']; ?>" 
						 <?php if ($k == 0):?>id="<? echo $arItemIDs['PICT']; ?>"<?php endif;?> alt="" class="elevatezoom" />
						 </li>
					<?php endforeach;?>
				</ul>
			</div>
			<div id="<?php echo $strMainID?>_slider_list" class="flexslider carousel1">
				<ul class="slides">
					<?php foreach ($arResult['MORE_PHOTO'] as $arOnePhoto):?>
						<li data-value="<? echo $arOnePhoto['ID']; ?>"> <a href="javascript:void(0);"><img src="<? echo $arOnePhoto['PREVIEW']['src']; ?>" alt="" /></a></li>
					<?php endforeach;?>
				</ul>
			</div>
			
			<script type="text/javascript">

				$('#<?php echo $strMainID?>_slider_list').flexslider({
					animation: "slide",
					controlNav: false,
					directionNav: true,
					prevText: "",
					nextText: "",
					animationLoop: false,
					maxItems: 3,
					minItems: 3,
					slideshow: false,
					direction: "vertical",
					asNavFor: '#slider2'
				});
				$('#slider1').flexslider({
					animation: "fade",
					controlNav: false,
					directionNav: true,
					prevText: "",
					nextText: "",
					animationLoop: false,
					slideshow: false,
					sync: "#<?php echo $strMainID?>_slider_list",
					after:function(slider) {
						alert(13);
					}
				});
				
				$('#<?php echo $strMainID?>_slider_list .slides li').click(function(){
					
					$('#<?php echo $strMainID?>_slider_list .slides li').removeClass('flex-active-slide');
					$(this).addClass('flex-active-slide');
			
			
					return false;
				});
			</script>
		<?php /* Product with SKU */ ?>
		<?php else:?>
		<?php foreach ($arResult['OFFERS'] as $key => $arOneOffer):?>
			<?php if (!isset($arOneOffer['MORE_PHOTO_COUNT']) || 0 >= $arOneOffer['MORE_PHOTO_COUNT'])
				continue;
			$strVisible = ($key == $arResult['OFFERS_SELECTED'] ? '' : 'none');
			if (5 < $arOneOffer['MORE_PHOTO_COUNT'])
			{
				$strClass = 'bx_slider_conteiner full';
				$strOneWidth = (100/$arOneOffer['MORE_PHOTO_COUNT']).'%';
				$strWidth = (20*$arOneOffer['MORE_PHOTO_COUNT']).'%';
				$strSlideStyle = '';
			}
			else
			{
				$strClass = 'bx_slider_conteiner';
				$strOneWidth = '20%';
				$strWidth = '100%';
				$strSlideStyle = 'display: none;';
			}
			?>

			<div id="slider<? echo $arItemIDs['SLIDER_CONT_OF_ID'].$arOneOffer['ID']; ?>" class="flexslider slider1" style="display: <? echo $strVisible; ?>;">
				

				<ul class="slides">
					<?php foreach ($arOneOffer['MORE_PHOTO'] as $k => $arOnePhoto):?>
						<?php $index = rand();?>
						<li>
							<img
								onload="this.parentNode.className='feed-com-img-wrap';"
								src="<? echo $arOnePhoto['FULL']['src']; ?>"
								data-bx-viewer="image"		
								data-bx-height="100%"						 
								data-bx-src="<? echo $arOnePhoto['SRC']; ?>" 
							<?php if ($k == 0):?>id="<? echo $arItemIDs['PICT']; ?>"<?php endif;?> alt="" class="elevatezoom" />

						</li>
					<?php endforeach;?>
				</ul>
			</div>

			<div id="<? echo $arItemIDs['SLIDER_CONT_OF_ID'].$arOneOffer['ID']; ?>" style="display: <? echo $strVisible; ?>;" class="flexslider carousel1">
				<ul class="slides" style="width: <? echo $strWidth; ?>;" id="<? echo $arItemIDs['SLIDER_LIST_OF_ID'].$arOneOffer['ID']; ?>">
					<?php foreach ($arOneOffer['MORE_PHOTO'] as $arOnePhoto):?>
						<li data-value="<? echo $arOneOffer['ID'].'_'.$arOnePhoto['ID']; ?>"> <a href="javascript:void(0);"><img src="<? echo $arOnePhoto['PREVIEW']['src']; ?>" alt="" /></a></li>
					<?php endforeach;?>
				</ul>
			</div>

			<script type="text/javascript">

				$('#<? echo $arItemIDs['SLIDER_CONT_OF_ID'].$arOneOffer['ID']; ?>').flexslider({
					animation: "slide",
					controlNav: false,
					directionNav: true,
					prevText: "",
					nextText: "",
					animationLoop: false,
					maxItems: 3,
					minItems: 3,
					slideshow: false,
					direction: "vertical",
					asNavFor: '#slider<? echo $arItemIDs['SLIDER_CONT_OF_ID'].$arOneOffer['ID']; ?>'
				});
				$('#slider<? echo $arItemIDs['SLIDER_CONT_OF_ID'].$arOneOffer['ID']; ?>').flexslider({
					animation: "fade",
					controlNav: false,
					directionNav: true,
					prevText: "",
					nextText: "",
					animationLoop: false,
					slideshow: false,
					sync: "#<? echo $arItemIDs['SLIDER_CONT_OF_ID'].$arOneOffer['ID']; ?>",
					after:function(slider) {
						$('.slider1 .flex-active-slide .elevatezoom').myElevateZoom();
					}
				});
			</script>

		<?php endforeach;?>
		<?php endif;?>
	</div>
		
		
		
		<div class="tovar_view_description">
		<div class="tovar_view_title"><?php echo $arResult["NAME"]?></div>
		<div class="tovar_article"><?php echo $arResult['DISPLAY_PROPERTIES']['ARTNUMBER']['VALUE']?></div>
		<div class="clearfix tovar_brend_price">
			<div class="pull-left tovar_brend"><?php echo $arResult['DISPLAY_PROPERTIES']['MANUFACTURER']['VALUE']['NAME']?></div>
			<div class="pull-right tovar_view_price" id="<? echo $arItemIDs['PRICE']; ?>"><?php echo $arResult['MIN_PRICE']['PRINT_DISCOUNT_VALUE']?></div>
		</div>
		
		
		
		<?php
		if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS']) && !empty($arResult['OFFERS_PROP']))
{
	$arSkuProps = array();
?>

<div class="item_info_section" id="<? echo $arItemIDs['PROP_DIV']; ?>">
<?
	foreach ($arResult['SKU_PROPS'] as &$arProp)
	{
		if (!isset($arResult['OFFERS_PROP'][$arProp['CODE']]))
			continue;
		$arSkuProps[] = array(
			'ID' => $arProp['ID'],
			'SHOW_MODE' => $arProp['SHOW_MODE'],
			'VALUES_COUNT' => $arProp['VALUES_COUNT']
		);
		if ('TEXT' == $arProp['SHOW_MODE'])
		{
			if (5 < $arProp['VALUES_COUNT'])
			{
				$strClass = 'bx_item_detail_size full';
				$strOneWidth = (100/$arProp['VALUES_COUNT']).'%';
				$strWidth = (20*$arProp['VALUES_COUNT']).'%';
				$strSlideStyle = '';
			}
			else
			{
				$strClass = 'bx_item_detail_size';
				$strOneWidth = '20%';
				$strWidth = '100%';
				$strSlideStyle = 'display: none;';
			}
?>
<div class="tovar_size_select">
	<div id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_cont">
		<p><? echo htmlspecialcharsex($arProp['NAME']); ?></p>
		<ul id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_list">
		<?
			foreach ($arProp['VALUES'] as $arOneValue)
			{
?>
				<li data-treevalue="<? echo $arProp['ID'].'_'.$arOneValue['ID']; ?>"
					data-onevalue="<? echo $arOneValue['ID']; ?>"
					style="width: <? echo $strOneWidth; ?>;">
				<a><? echo htmlspecialcharsex($arOneValue['NAME']); ?></a></li>
<?
			}
?>
</ul>

			<div class="bx_slide_left" style="<? echo $strSlideStyle; ?>" id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_left" data-treevalue="<? echo $arProp['ID']; ?>"></div>
			<div class="bx_slide_right" style="<? echo $strSlideStyle; ?>" id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_right" data-treevalue="<? echo $arProp['ID']; ?>"></div>
			
	</div>
</div>
<?
		}
		elseif ('PICT' == $arProp['SHOW_MODE'])
		{
			if (5 < $arProp['VALUES_COUNT'])
			{
				$strClass = 'bx_item_detail_scu full';
				$strOneWidth = (100/$arProp['VALUES_COUNT']).'%';
				$strWidth = (20*$arProp['VALUES_COUNT']).'%';
				$strSlideStyle = '';
			}
			else
			{
				$strClass = 'bx_item_detail_scu';
				$strOneWidth = '20%';
				$strWidth = '100%';
				$strSlideStyle = 'display: none;';
			}
?>
<div class="tovar_color_select">
	<div id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_cont">
		<p><? echo htmlspecialcharsex($arProp['NAME']); ?></p>
		
		<ul id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_list">
		<?
			foreach ($arProp['VALUES'] as $arOneValue)
			{
?>
				<li data-treevalue="<? echo $arProp['ID'].'_'.$arOneValue['ID'] ?>"
					data-onevalue="<? echo $arOneValue['ID']; ?>"
				title="<? echo htmlspecialcharsbx($arOneValue['NAME']); ?>" 
					>
				<a style="background-image:url('<? echo $arOneValue['PICT']['SRC']; ?>');"></a>
				</li>
<?
			}
?>
</ul>
		
		<div class="bx_slide_left" style="<? echo $strSlideStyle; ?>" id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_left" data-treevalue="<? echo $arProp['ID']; ?>"></div>
			<div class="bx_slide_right" style="<? echo $strSlideStyle; ?>" id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_right" data-treevalue="<? echo $arProp['ID']; ?>"></div>	
	</div>
	
	
	
</div>
<?
		}
	}
	unset($arProp);
?>
<p><?php echo $arResult['PREVIEW_TEXT']?></p>
</div>
<?
}
?>

		<div class="tovar_view_btn">
			<input type="text" class="basic product-quantity-input" id="<? echo $arItemIDs['QUANTITY']; ?>" value="1" />
			<a class="add_bag <? echo $buyBtnClass; ?>" href="javascript:void(0);"  id="<? echo $arItemIDs['ADD_BASKET_LINK']; ?>" ><i class="fa fa-shopping-cart"></i><?php if ($arResult['IN_BASKET']) echo 'Уже в корзине'; else echo GetMessage("PIMAX_FASHIONSTORE_V_KORZINU")?></a>
		</div>
		<div class="tovar_view_btn">
		<a class="add_bag" href="<? echo $arResult['DETAIL_PAGE_URL']; ?>"  >Подробная информация о товаре</a>
		</div>
		<div class="tovar_shared clearfix">
		
		
			<p><?=GetMessage("PIMAX_FASHIONSTORE_PODELITQSA_S_DRUZQAM")?></p>
			<div class="tovat-share-buttons">
				<script type="text/javascript" src="//yastatic.net/share/share.js" charset="utf-8"></script><div class="yashare-auto-init" data-yashareL10n="ru" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir,gplus" data-yashareTheme="counter" data-url="http://<? echo $_SERVER['SERVER_NAME'].$arResult['DETAIL_PAGE_URL']; ?>" data-yasharelink="http://<? echo $_SERVER['SERVER_NAME'].$arResult['DETAIL_PAGE_URL']; ?>"></div>
			</div>
		</div>
	</div>
	</div>
</div>




<?
if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS']))
{
	foreach ($arResult['JS_OFFERS'] as &$arOneJS)
	{
		if ($arOneJS['PRICE']['DISCOUNT_VALUE'] != $arOneJS['PRICE']['VALUE'])
		{
			$arOneJS['PRICE']['PRINT_DISCOUNT_DIFF'] = GetMessage('ECONOMY_INFO', array('#ECONOMY#' => $arOneJS['PRICE']['PRINT_DISCOUNT_DIFF']));
			$arOneJS['PRICE']['DISCOUNT_DIFF_PERCENT'] = -$arOneJS['PRICE']['DISCOUNT_DIFF_PERCENT'];
		}
		$strProps = '';
		if ($arResult['SHOW_OFFERS_PROPS'])
		{
			if (!empty($arOneJS['DISPLAY_PROPERTIES']))
			{
				foreach ($arOneJS['DISPLAY_PROPERTIES'] as $arOneProp)
				{
					$strProps .= '<dt>'.$arOneProp['NAME'].'</dt><dd>'.(
						is_array($arOneProp['VALUE'])
						? implode(' / ', $arOneProp['VALUE'])
						: $arOneProp['VALUE']
					).'</dd>';
				}
			}
		}
		$arOneJS['DISPLAY_PROPERTIES'] = $strProps;
	}
	if (isset($arOneJS))
		unset($arOneJS);
	$arJSParams = array(
		'CONFIG' => array(
			'USE_CATALOG' => $arResult['CATALOG'],
			'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
			'SHOW_PRICE' => true,
			'SHOW_DISCOUNT_PERCENT' => ('Y' == $arParams['SHOW_DISCOUNT_PERCENT']),
			'SHOW_OLD_PRICE' => ('Y' == $arParams['SHOW_OLD_PRICE']),
			'DISPLAY_COMPARE' => ('Y' == $arParams['DISPLAY_COMPARE']),
			'SHOW_SKU_PROPS' => $arResult['SHOW_OFFERS_PROPS'],
			'OFFER_GROUP' => $arResult['OFFER_GROUP'],
			'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE']
		),
		'PRODUCT_TYPE' => $arResult['CATALOG_TYPE'],
		'VISUAL' => array(
			'ID' => $arItemIDs['ID'],
		),
		'DEFAULT_PICTURE' => array(
			'PREVIEW_PICTURE' => $arResult['DEFAULT_PICTURE'],
			'DETAIL_PICTURE' => $arResult['DEFAULT_PICTURE']
		),
		'PRODUCT' => array(
			'ID' => $arResult['ID'],
			'NAME' => $arResult['~NAME']
		),
		'BASKET' => array(
			'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
			'BASKET_URL' => $arParams['BASKET_URL'],
			'SKU_PROPS' => $arResult['OFFERS_PROP_CODES']
		),
		'OFFERS' => $arResult['JS_OFFERS'],
		'OFFER_SELECTED' => $arResult['OFFERS_SELECTED'],
		'TREE_PROPS' => $arSkuProps
	);
}
else
{
	$emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
	if ('Y' == $arParams['ADD_PROPERTIES_TO_BASKET'] && !$emptyProductProperties)
	{
?>
<div id="<? echo $arItemIDs['BASKET_PROP_DIV']; ?>" style="display: none;">
<?
		if (!empty($arResult['PRODUCT_PROPERTIES_FILL']))
		{
			foreach ($arResult['PRODUCT_PROPERTIES_FILL'] as $propID => $propInfo)
			{
?>
	<input
		type="hidden"
		name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"
		value="<? echo htmlspecialcharsbx($propInfo['ID']); ?>"
	>
<?
				if (isset($arResult['PRODUCT_PROPERTIES'][$propID]))
					unset($arResult['PRODUCT_PROPERTIES'][$propID]);
			}
		}
		$emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
		if (!$emptyProductProperties)
		{
?>
	<table>
<?
			foreach ($arResult['PRODUCT_PROPERTIES'] as $propID => $propInfo)
			{
?>
	<tr><td><? echo $arResult['PROPERTIES'][$propID]['NAME']; ?></td>
	<td>
<?
				if(
					'L' == $arResult['PROPERTIES'][$propID]['PROPERTY_TYPE']
					&& 'C' == $arResult['PROPERTIES'][$propID]['LIST_TYPE']
				)
				{
					foreach($propInfo['VALUES'] as $valueID => $value)
					{
						?><label><input
							type="radio"
							name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"
							value="<? echo $valueID; ?>"
							<? echo ($valueID == $propInfo['SELECTED'] ? '"checked"' : ''); ?>
						><? echo $value; ?></label><br><?
					}
				}
				else
				{
					?><select name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"><?
					foreach($propInfo['VALUES'] as $valueID => $value)
					{
						?><option
							value="<? echo $valueID; ?>"
							<? echo ($valueID == $propInfo['SELECTED'] ? '"selected"' : ''); ?>
						><? echo $value; ?></option><?
					}
					?></select><?
				}
?>
	</td></tr>
<?
			}
?>
	</table>
<?
		}
?>
</div>
<?
	}
	if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS']))
{
	foreach ($arResult['JS_OFFERS'] as &$arOneJS)
	{
		if ($arOneJS['PRICE']['DISCOUNT_VALUE'] != $arOneJS['PRICE']['VALUE'])
		{
			$arOneJS['PRICE']['PRINT_DISCOUNT_DIFF'] = GetMessage('ECONOMY_INFO', array('#ECONOMY#' => $arOneJS['PRICE']['PRINT_DISCOUNT_DIFF']));
			$arOneJS['PRICE']['DISCOUNT_DIFF_PERCENT'] = -$arOneJS['PRICE']['DISCOUNT_DIFF_PERCENT'];
		}
		$strProps = '';
		if ($arResult['SHOW_OFFERS_PROPS'])
		{
			if (!empty($arOneJS['DISPLAY_PROPERTIES']))
			{
				foreach ($arOneJS['DISPLAY_PROPERTIES'] as $arOneProp)
				{
					$strProps .= '<dt>'.$arOneProp['NAME'].'</dt><dd>'.(
						is_array($arOneProp['VALUE'])
						? implode(' / ', $arOneProp['VALUE'])
						: $arOneProp['VALUE']
					).'</dd>';
				}
			}
		}
		$arOneJS['DISPLAY_PROPERTIES'] = $strProps;
	}
	if (isset($arOneJS))
		unset($arOneJS);
	$arJSParams = array(
		'CONFIG' => array(
			'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
			'SHOW_DISCOUNT_PERCENT' => ('Y' == $arParams['SHOW_DISCOUNT_PERCENT']),
			'SHOW_OLD_PRICE' => ('Y' == $arParams['SHOW_OLD_PRICE']),
			'DISPLAY_COMPARE' => ('Y' == $arParams['DISPLAY_COMPARE']),
			'SHOW_SKU_PROPS' => $arResult['SHOW_OFFERS_PROPS'],
			'OFFER_GROUP' => $arResult['OFFER_GROUP'],
			'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE']
		),
		'PRODUCT_TYPE' => $arResult['CATALOG_TYPE'],
		'VISUAL' => array(
			'ID' => $arItemIDs['ID'],
		),
		'DEFAULT_PICTURE' => array(
			'PREVIEW_PICTURE' => $arResult['DEFAULT_PICTURE'],
			'DETAIL_PICTURE' => $arResult['DEFAULT_PICTURE']
		),
		'PRODUCT' => array(
			'ID' => $arResult['ID'],
			'NAME' => $arResult['~NAME']
		),
		'BASKET' => array(
			'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
			'BASKET_URL' => $arParams['BASKET_URL'],
			'SKU_PROPS' => $arResult['OFFERS_PROP_CODES']
		),
		'OFFERS' => $arResult['JS_OFFERS'],
		'OFFER_SELECTED' => $arResult['OFFERS_SELECTED'],
		'TREE_PROPS' => $arSkuProps
	);
}
else
{
	$emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
	
	$arJSParams = array(
		'CONFIG' => array(
			'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
			'SHOW_PRICE' => true,
			'SHOW_DISCOUNT_PERCENT' => ('Y' == $arParams['SHOW_DISCOUNT_PERCENT']),
			'SHOW_OLD_PRICE' => ('Y' == $arParams['SHOW_OLD_PRICE']),
			'DISPLAY_COMPARE' => ('Y' == $arParams['DISPLAY_COMPARE']),
			'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE']
		),
		'VISUAL' => array(
			'ID' => $arItemIDs['ID'],
		),
		'PRODUCT_TYPE' => $arResult['CATALOG_TYPE'],
		'PRODUCT' => array(
			'ID' => $arResult['ID'],
			'PICT' => array(
				'SRC' => $arResult['MORE_PHOTO'][0]['PREVIEW']['src']
			),
			'NAME' => $arResult['~NAME'],
			'SUBSCRIPTION' => true,
			'PRICE' => $arResult['MIN_PRICE'],
			'SLIDER_COUNT' => $arResult['MORE_PHOTO_COUNT'],
			'SLIDER' => $arResult['MORE_PHOTO'],
			'CAN_BUY' => $arResult['CAN_BUY'],
			'CHECK_QUANTITY' => $arResult['CHECK_QUANTITY'],
			'QUANTITY_FLOAT' => is_double($arResult['CATALOG_MEASURE_RATIO']),
			'MAX_QUANTITY' => $arResult['CATALOG_QUANTITY'],
			'STEP_QUANTITY' => $arResult['CATALOG_MEASURE_RATIO'],
			'BUY_URL' => $arResult['~BUY_URL'],
		),
		'BASKET' => array(
			'ADD_PROPS' => ('Y' == $arParams['ADD_PROPERTIES_TO_BASKET']),
			'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
			'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
			'EMPTY_PROPS' => $emptyProductProperties,
			'BASKET_URL' => $arParams['BASKET_URL']
		)
	);
	unset($emptyProductProperties);
}
}
?>
<script type="text/javascript">


var <? echo $strObName; ?> = new JCCatalogElementPopup(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
BX.message({
	MESS_BTN_BUY: '<? echo ('' != $arParams['MESS_BTN_BUY'] ? CUtil::JSEscape($arParams['MESS_BTN_BUY']) : GetMessageJS('CT_BCE_CATALOG_BUY')); ?>',
	MESS_BTN_ADD_TO_BASKET: '<? echo ('' != $arParams['MESS_BTN_ADD_TO_BASKET'] ? CUtil::JSEscape($arParams['MESS_BTN_ADD_TO_BASKET']) : GetMessageJS('CT_BCE_CATALOG_ADD')); ?>',
	MESS_NOT_AVAILABLE: '<? echo ('' != $arParams['MESS_NOT_AVAILABLE'] ? CUtil::JSEscape($arParams['MESS_NOT_AVAILABLE']) : GetMessageJS('CT_BCE_CATALOG_NOT_AVAILABLE')); ?>',
	TITLE_ERROR: '<? echo GetMessageJS('CT_BCE_CATALOG_TITLE_ERROR') ?>',
	TITLE_BASKET_PROPS: '<? echo GetMessageJS('CT_BCE_CATALOG_TITLE_BASKET_PROPS') ?>',
	BASKET_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCE_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
	BTN_SEND_PROPS: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_SEND_PROPS'); ?>',
	BTN_MESSAGE_CLOSE: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE') ?>',
	SITE_ID: '<? echo SITE_ID; ?>'
});

BX.ready(function(){
   var obImageView = BX.viewElementBind(
      '<? echo $arItemIDs['ID']; ?>',
      {showTitle: true, lockScroll: false},
      function(node){
         return BX.type.isElementNode(node) && (node.getAttribute('data-bx-viewer') || node.getAttribute('data-bx-image'));
      }
   );
});
</script>