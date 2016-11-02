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

$arSection = array();

//echo $arResult["VARIABLES"]["SECTION_CODE"];

if (!empty($arResult["VARIABLES"]["SECTION_CODE"]))
{
	$rsSect = \CIBlockSection::GetList(array('name' => 'asc'), array(
      'IBLOCK_ID' => $arParams['IBLOCK_ID'],
      "CODE" => $arResult["VARIABLES"]["SECTION_CODE"]
    ), false, array("ID",  "NAME", "PICTURE", "UF_*"));

    if ($arSect = $rsSect->Fetch())
    {
       $arSection = $arSect;
	   
	   if (!empty($arSection['PICTURE']))
	   {
	   		$arSection['PICTURE'] = CFile::GetFileArray($arSection['PICTURE']);
	   }
	   
	   if (!empty($arSection['UF_BANNER']))
	   {
	   		$arSection['UF_BANNER'] = CFile::GetFileArray($arSection['UF_BANNER']);
	   }
    } 
}


if (!$arParams['FILTER_VIEW_MODE'])
	$arParams['FILTER_VIEW_MODE'] = 'VERTICAL';
$arParams['USE_FILTER'] = (isset($arParams['USE_FILTER']) && $arParams['USE_FILTER'] == 'Y' ? 'Y' : 'N');
$verticalGrid = ('Y' == $arParams['USE_FILTER'] && $arParams["FILTER_VIEW_MODE"] == "VERTICAL");

if ($verticalGrid)
{
	
	
	
	?>

<!-- BREADCRUMBS -->
<section class="breadcrumb women parallax margbot30" <?php if (!empty($arSection['PICTURE'])):?>style="background-image: url(<?php echo $arSection['PICTURE']['SRC']?>);"<?php endif;?>>
	
	<!-- CONTAINER -->
	<div class="container">
		<h2><?php echo !empty($arSection) ? $arSection['NAME'] : GetMessage("PIMAX_FASHIONSTORE_KATALOG_TOVAROV")?></h2>
	</div><!-- //CONTAINER -->
</section><!-- //BREADCRUMBS -->

<!-- SHOP BLOCK -->
<section class="shop">
	
	<!-- CONTAINER -->
	<div class="container">

		<!-- ROW -->
		<div class="row">


<?
}
if ($arParams['USE_FILTER'] == 'Y')
{

	$arFilter = array(
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ACTIVE" => "Y",
		"GLOBAL_ACTIVE" => "Y",
	);
	if (0 < intval($arResult["VARIABLES"]["SECTION_ID"]))
	{
		$arFilter["ID"] = $arResult["VARIABLES"]["SECTION_ID"];
	}
	elseif ('' != $arResult["VARIABLES"]["SECTION_CODE"])
	{
		$arFilter["=CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];
	}

	$obCache = new CPHPCache();
	if ($obCache->InitCache(36000, serialize($arFilter), "/iblock/catalog"))
	{
		$arCurSection = $obCache->GetVars();
	}
	elseif ($obCache->StartDataCache())
	{
		$arCurSection = array();
		if (\Bitrix\Main\Loader::includeModule("iblock"))
		{
			$dbRes = CIBlockSection::GetList(array(), $arFilter, false, array("ID"));

			if(defined("BX_COMP_MANAGED_CACHE"))
			{
				global $CACHE_MANAGER;
				$CACHE_MANAGER->StartTagCache("/iblock/catalog");

				if ($arCurSection = $dbRes->Fetch())
				{
					$CACHE_MANAGER->RegisterTag("iblock_id_".$arParams["IBLOCK_ID"]);
				}
				$CACHE_MANAGER->EndTagCache();
			}
			else
			{
				if(!$arCurSection = $dbRes->Fetch())
					$arCurSection = array();
			}
		}
		$obCache->EndDataCache($arCurSection);
	}
	if (!isset($arCurSection))
	{
		$arCurSection = array();
	}
	if ($verticalGrid)
	{
		?>
		<!-- SIDEBAR -->
		<div id="sidebar" class="col-lg-3 col-md-3 col-sm-3 padbot50">

		<?php


		$db_list = CIBlockSection::GetList(Array("name"=>"asc"), array(
			'IBLOCK_ID' => $arParams["IBLOCK_ID"],
			'SECTION_ID' => $arSection['ID']
		), true);

		if ($row = $db_list->GetNext()) {
			?>

			<div class="sidepanel widget_brands">
				<h3 class="bx_filter_container_title"><span class="bx_filter_container_modef"></span><?php echo GetMessage("PIMAX_FASHIONSTORE_NAVIGATION")?></h3>

				<div class="bx_filter_block">
					<ul>
						<li><a href="<?php echo $row['SECTION_PAGE_URL']?>"><?php echo $row['NAME']?></a></li>
						<?php while($row = $db_list->GetNext()):?>
							<li><a href="<?php echo $row['SECTION_PAGE_URL']?>"><?php echo $row['NAME']?></a></li>
						<?php endwhile;?>
					</ul>
				</div>
			</div>


		<?
		}
	}
	?><?
	$APPLICATION->IncludeComponent(
		"bitrix:catalog.smart.filter",
		"visual_".($arParams["FILTER_VIEW_MODE"] == "HORIZONTAL" ? "horizontal" : "vertical"),
		Array(
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"SECTION_ID" => $arCurSection['ID'],
			"FILTER_NAME" => $arParams["FILTER_NAME"],
			"PRICE_CODE" => $arParams["PRICE_CODE"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"SAVE_IN_SESSION" => "N",
			"XML_EXPORT" => "Y",
			"SECTION_TITLE" => "NAME",
			"SECTION_DESCRIPTION" => "DESCRIPTION",
			'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
			"TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"]
		),
		$component,
		array('HIDE_ICONS' => 'Y')
	);?><?
	if ($verticalGrid)
	{
		?></div><?
	}
}
if ($verticalGrid)
{
	?>
	<!-- SHOP PRODUCTS -->
	<div class="col-lg-9 col-sm-9 col-sm-9 padbot20"><?
}
?><?/*$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"",
	array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
		"TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
		"SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
		"HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
		"ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : '')
	),
	$component
);*/?><?
if($arParams["USE_COMPARE"]=="Y")
{
	?><?$APPLICATION->IncludeComponent(
		"bitrix:catalog.compare.list",
		"",
		array(
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"NAME" => $arParams["COMPARE_NAME"],
			"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
			"COMPARE_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["compare"],
		),
		$component
	);?><?
}

$intSectionID = 0;
?>

<?php if (!empty($arSection['UF_BANNER'])):?>
	<div class="banner_block margbot15">
		<?php if (!empty($arSection['UF_BANNER_LINK'])):?>
			<a class="banner nobord" href="<?php echo $arSection['UF_BANNER_LINK']?>" >
				<img src="<?php echo $arSection['UF_BANNER']['SRC']?>" alt="" />
			</a>
		<?php else:?>
			<img src="<?php echo $arSection['UF_BANNER']['SRC']?>" alt="" />
		<?php endif;?>
	</div>
<?php endif;?>

<?php 
	$sort = !empty($_GET['sort']) ? $_GET['sort'] : "name";
	$sort_field = "name";
	$sort_direction = "asc";
	
	$aSorts = array(
		/*"name" => array(
			"name", "asc"
		), 
		"name_desc" => array(
			"name", "desc"
		), */
		"price" => array(
			"PROPERTY_MINIMUM_PRICE", "asc"
		),
		"price_desc" => array(
			"PROPERTY_MINIMUM_PRICE", "desc"
		)
	);
	
	if (!empty($aSorts[$sort])) {
		$sort_field = $aSorts[$_GET['sort']][0];
		$sort_direction = $aSorts[$_GET['sort']][1];
	}
	
	
?>


<!-- SORTING TOVAR PANEL -->
<div class="sorting_options clearfix">
	
	<!-- COUNT TOVAR ITEMS -->
	<div class="count_tovar_items">
		<p><?php echo !empty($arSection) ? $arSection['NAME'] : GetMessage("PIMAX_FASHIONSTORE_KATALOG_TOVAROV")?></p>
	</div><!-- //COUNT TOVAR ITEMS -->
	
	<!-- TOVAR FILTER -->
	<div class="product_sort">
		<p><?=GetMessage("PIMAX_FASHIONSTORE_SORTIROVATQ_PO")?></p>
		<form action="" method="get">
			<select name="sort" class="basic">
				<?php /*<option <?php if ($sort == 'name'):?>selected=""<?php endif;?> value="name"><?=GetMessage("PIMAX_FASHIONSTORE_NAIMENOVANIU_PO_VOZR")?></option>
				<option <?php if ($sort == 'name_desc'):?>selected=""<?php endif;?> value="name_desc"><?=GetMessage("PIMAX_FASHIONSTORE_NAIMENOVANIU_PO_UBYV")?></option> */ ?>
				<option <?php if ($sort == 'price'):?>selected=""<?php endif;?> value="price"><?=GetMessage("PIMAX_FASHIONSTORE_CENE_PO_VOZRASTANIU")?></option>
				<option <?php if ($sort == 'price_desc'):?>selected=""<?php endif;?> value="price_desc"><?=GetMessage("PIMAX_FASHIONSTORE_CENE_PO_UBYVANIU")?></option>
			</select>
		</form>
	</div><!-- //TOVAR FILTER -->
	
	<!-- PRODUC SIZE -->
	<div id="toggle-sizes">
		<a class="view_box active" href="javascript:void(0);"><i class="fa fa-th-large"></i></a>
		<a class="view_full" href="javascript:void(0);"><i class="fa fa-th-list"></i></a>
	</div><!-- //PRODUC SIZE -->
</div><!-- //SORTING TOVAR PANEL -->

<?$intSectionID = $APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"",
	array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ELEMENT_SORT_FIELD" => $sort_field,
		"ELEMENT_SORT_ORDER" => $sort_direction,
		"ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
		"ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
		"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
		"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
		"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
		"BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
		"INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
		"BASKET_URL" => $arParams["BASKET_URL"],
		"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
		"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
		"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
		"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
		"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
		"FILTER_NAME" => $arParams["FILTER_NAME"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_FILTER" => $arParams["CACHE_FILTER"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
		"PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
		"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
		"PRICE_CODE" => $arParams["PRICE_CODE"],
		"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
		"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

		"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
		"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
		"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
		"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
		"PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],

		"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE" => $arParams["PAGER_TITLE"],
		"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
		"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
		"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
		"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
		"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],

		"OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
		"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
		"OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
		"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
		"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
		"OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
		"OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
		"OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],

		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
		'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
		'CURRENCY_ID' => $arParams['CURRENCY_ID'],
		'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],

		'LABEL_PROP' => $arParams['LABEL_PROP'],
		'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
		'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],

		'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
		'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
		'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
		'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
		'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
		'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
		'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'],
		'MESS_BTN_SUBSCRIBE' => $arParams['MESS_BTN_SUBSCRIBE'],
		'MESS_BTN_DETAIL' => $arParams['MESS_BTN_DETAIL'],
		'MESS_NOT_AVAILABLE' => $arParams['MESS_NOT_AVAILABLE'],

		'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
		"ADD_SECTIONS_CHAIN" => "N"
	),
	$component
);?><?
if ($verticalGrid)
{
	?></div>
</div></section>


<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.viewed.products",
	"",
	Array(
		"ACTION_VARIABLE" => "action_cvp",
		"ADDITIONAL_PICT_PROP_4" => "MORE_PHOTO",
		"ADDITIONAL_PICT_PROP_5" => "MORE_PHOTO",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"BASKET_URL" => "/personal/cart/",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CART_PROPERTIES_4" => array("",""),
		"CART_PROPERTIES_5" => array("",""),
		"CONVERT_CURRENCY" => "N",
		"DEPTH" => "",
		"DETAIL_URL" => "",
		"HIDE_NOT_AVAILABLE" => "N",
		"IBLOCK_ID" => "4",
		"IBLOCK_TYPE" => "pimax_fashionstore_catalog",
		"LABEL_PROP_4" => "-",
		"LINE_ELEMENT_COUNT" => "3",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"OFFER_TREE_PROPS_5" => array(),
		"PAGE_ELEMENT_COUNT" => "5",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array("BASE"),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"PRODUCT_SUBSCRIPTION" => "N",
		"PROPERTY_CODE_4" => array("",""),
		"PROPERTY_CODE_5" => array("",""),
		"SECTION_CODE" => "",
		"SECTION_ELEMENT_CODE" => "",
		"SECTION_ELEMENT_ID" => "",
		"SECTION_ID" => "",
		"SHOW_DISCOUNT_PERCENT" => "Y",
		"SHOW_FROM_SECTION" => "N",
		"SHOW_IMAGE" => "Y",
		"SHOW_NAME" => "Y",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_PRODUCTS_4" => "Y",
		"TEMPLATE_THEME" => "blue",
		"USE_PRODUCT_QUANTITY" => "N"
	)
);?>



<?
}
?>
<?
if (\Bitrix\Main\ModuleManager::isModuleInstalled("sale"))
{
	$arRecomData = array();
	$recomCacheID = array('IBLOCK_ID' => $arParams['IBLOCK_ID']);
	$obCache = new CPHPCache();
	if ($obCache->InitCache(36000, serialize($recomCacheID), "/sale/bestsellers"))
	{
		$arRecomData = $obCache->GetVars();
	}
	elseif ($obCache->StartDataCache())
	{
		if (\Bitrix\Main\Loader::includeModule("catalog"))
		{
			$arSKU = CCatalogSKU::GetInfoByProductIBlock($arParams['IBLOCK_ID']);
			$arRecomData['OFFER_IBLOCK_ID'] = (!empty($arSKU) ? $arSKU['IBLOCK_ID'] : 0);
		}
		$obCache->EndDataCache($arRecomData);
	}
	
}
?>