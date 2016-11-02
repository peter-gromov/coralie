<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Акции и скидки");
?>
<!-- BREADCRUMBS -->
<section class="breadcrumb women parallax margbot30" <?php if (!empty($arSection['PICTURE'])):?>style="background-image: url(<?php echo $arSection['PICTURE']['SRC']?>);"<?php endif;?>>
	
	<!-- CONTAINER -->
	<div class="container">
		<h2>Акции и скидки</h2>
	</div><!-- //CONTAINER -->
</section><!-- //BREADCRUMBS -->

<!-- SHOP BLOCK -->
<section class="shop">
	
	<!-- CONTAINER -->
	<div class="container">

		<!-- ROW -->
		<div class="row">
		
		<!-- SIDEBAR -->
		<div id="sidebar" class="col-lg-3 col-md-3 col-sm-3 padbot50">
		
		<ul class="nav nav-sidebar">
			
			<?$APPLICATION->IncludeComponent("bitrix:menu", "catalog_vertical", array(
								"ROOT_MENU_TYPE" => "left",
								"MENU_CACHE_TYPE" => "A",
								"MENU_CACHE_TIME" => "36000000",
								"MENU_CACHE_USE_GROUPS" => "Y",
								"MENU_THEME" => "site",
								"CACHE_SELECTED_ITEMS" => "N",
								"MENU_CACHE_GET_VARS" => array(
								),
								"MAX_LEVEL" => "1",
								"CHILD_MENU_TYPE" => "left",
								"USE_EXT" => "Y",
								"DELAY" => "N",
								"ALLOW_MULTI_SELECT" => "N",
							),
							false
						);?>
			
          </ul>
		
		</div>
		
		<div class="col-lg-9 col-sm-9 col-sm-9 padbot20">
<?
global $arrFilter2;
$dbProductDiscounts = CCatalogDiscount::GetList(array("SORT" => "ASC"),   array("ACTIVE" => "Y"),false,false,array());
       while ($arProductDiscounts = $dbProductDiscounts->Fetch()) {
          $arProductDiscounts["CONDITIONS"]=unserialize($arProductDiscounts["CONDITIONS"]);
		  if($arProductDiscounts['SECTION_ID']){
          $arDiscounts[$arProductDiscounts['ID']]['SECTION_ID'][]=$arProductDiscounts['SECTION_ID'];
		  }elseif($arProductDiscounts['PRODUCT_ID']){
           $arDiscounts[$arProductDiscounts['ID']]['PRODUCT_ID'][]=$arProductDiscounts['PRODUCT_ID'];
		  }elseif($arProductDiscounts['IBLOCK_ID']){
		   $arDiscounts[$arProductDiscounts['ID']]['IBLOCK_ID'][]=$arProductDiscounts['IBLOCK_ID'];
		  }
       }
$i=0;
if(count($arDiscounts)>0){
   $arrFilter2[] = array(
      "LOGIC"=>"OR",
   );
   foreach($arDiscounts as $arDiscountFilter){
      $arrFilter2[0][$i++] = $arDiscountFilter;
      if(count($arDiscountFilter["SECTION_ID"])>0)
         $arrFilter2[0][$i-1]["INCLUDE_SUBSECTIONS"] = "Y";
   }
   }
	     $arrFilter2[0]['PROPERTY_SPECIALOFFER_VALUE'] = "да";

		if($_GET['sort']){
		$SORT = $_GET['sort'];
		$ORDER = $_GET['order'];
		}else{
		$SORT = 'NAME';
		$ORDER = 'asc';		
		}
?>
<?
$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"action", 
	array(
		"IBLOCK_TYPE_ID" => "catalog_electronics",
		"IBLOCK_ID" => "4",
		"BASKET_URL" => "#/personal/cart/",
		"COMPONENT_TEMPLATE" => "action",
		"IBLOCK_TYPE" => "pimax_fashionstore_catalog",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_CODE" => $_REQUEST["SECTION_CODE"],
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"ELEMENT_SORT_FIELD" => $SORT,
		"ELEMENT_SORT_ORDER" => $ORDER,
		"ELEMENT_SORT_FIELD2" => "id",
		"DISPLAY_COMPARE" => "Y",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "arrFilter2",
		"INCLUDE_SUBSECTIONS" => "Y",
		"SHOW_ALL_WO_SECTION" => "Y",
		"HIDE_NOT_AVAILABLE" => "N",
		"PAGE_ELEMENT_COUNT" => "15",
		"LINE_ELEMENT_COUNT" => "3",
		"PROPERTY_CODE" => array(
			0 => "NEWPRODUCT",
			1 => "SALELEADER",
			2 => "SPECIALOFFER",
			3 => "",
		),
		"OFFERS_FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_PICTURE",
			2 => "DETAIL_PICTURE",
			3 => "",
		),
		"OFFERS_PROPERTY_CODE" => array(
			0 => "ARTNUMBER",
			1 => "COLOR_REF",
			2 => "SIZES_SHOES",
			3 => "SIZES_CLOTHES",
			4 => "MORE_PHOTO",
			5 => "",
		),
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_ORDER" => "desc",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER2" => "desc",
		"OFFERS_LIMIT" => "5",
		"TEMPLATE_THEME" => "site",
		"PRODUCT_DISPLAY_MODE" => "Y",
		"ADD_PICT_PROP" => "MORE_PHOTO",
		"LABEL_PROP" => "-",
		"OFFER_ADD_PICT_PROP" => "-",
		"OFFER_TREE_PROPS" => array(
			0 => "COLOR_REF",
			1 => "SIZES_SHOES",
			2 => "SIZES_CLOTHES",
		),
		"PRODUCT_SUBSCRIPTION" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "Y",
		"SHOW_CLOSE_POPUP" => "Y",
		"COMMON_SHOW_CLOSE_POPUP" => "Y",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SEF_MODE" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"SET_TITLE" => "Y",
		"SET_BROWSER_TITLE" => "Y",
		"BROWSER_TITLE" => "-",
		"SET_META_KEYWORDS" => "Y",
		"META_KEYWORDS" => "-",
		"SET_META_DESCRIPTION" => "Y",
		"META_DESCRIPTION" => "-",
		"SET_LAST_MODIFIED" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_FILTER" => "N",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"CONVERT_CURRENCY" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"ADD_PROPERTIES_TO_BASKET" => "N",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRODUCT_PROPERTIES" => array(
		),
		"OFFERS_CART_PROPERTIES" => array(
			0 => "COLOR_REF,SIZES_SHOES,SIZES_CLOTHES",
		),
		"ADD_TO_BASKET_ACTION" => "ADD",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Товары",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"MESS_BTN_COMPARE" => "Сравнить",
		"COMPARE_NAME" => "CATALOG_COMPARE_LIST",
		"COMPARE_PATH" => SITE_DIR."catalog/compare/",
		"LIST" => $_GET["LIST"],
		"BACKGROUND_IMAGE" => "-",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N"
	),
	false
);?>
</div>
</div>
</div></section>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>