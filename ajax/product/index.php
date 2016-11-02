<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.element",
	"popup",
	Array(
        "IBLOCK_TYPE" => "pimax_fashionstore_catalog",
        "IBLOCK_ID" => "4",
		"ELEMENT_ID" => $_REQUEST["ELEMENT_ID"],
		"ELEMENT_CODE" => "",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_CODE" => "",
		"HIDE_NOT_AVAILABLE" => "N",
		"PROPERTY_CODE" => array(
			0 => "MANUFACTURER",
			1 => "NEWPRODUCT",
			2 => "ARTNUMBER",
			3 => "MATERIAL",
		),
		"OFFERS_LIMIT" => "0",
		"TEMPLATE_THEME" => "",
		"DISPLAY_NAME" => "Y",
		"DETAIL_PICTURE_MODE" => "IMG",
		"ADD_DETAIL_TO_SLIDER" => "Y",
		"DISPLAY_PREVIEW_TEXT_MODE" => "H",
		"PRODUCT_SUBSCRIPTION" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_MAX_QUANTITY" => "N",
		"DISPLAY_COMPARE" => "N",
		"MESS_BTN_BUY" => "Добавить в корзину",
		"MESS_BTN_ADD_TO_BASKET" => "Добавить в корзину",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"USE_VOTE_RATING" => "N",
		"USE_COMMENTS" => "N",
		"BRAND_USE" => "N",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"SET_TITLE" => "Y",
		"SET_STATUS_404" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"ADD_ELEMENT_CHAIN" => "N",
		"USE_ELEMENT_COUNTER" => "Y",
		"PRICE_CODE" => array("BASE"),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"CONVERT_CURRENCY" => "N",
		"BASKET_URL" => "/personal/cart/",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"USE_PRODUCT_QUANTITY" => "Y",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRODUCT_PROPERTIES" => array(),
		"LINK_IBLOCK_TYPE" => "",
		"LINK_IBLOCK_ID" => "",
		"LINK_PROPERTY_SID" => "",
		"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
		"OFFERS_FIELD_CODE" =>  array("PREVIEW_TEXT", ""),
		"OFFERS_PROPERTY_CODE" => array(
			"ARTNUMBER",
			
			"MORE_PHOTO",
			"SIZE",
			"COLOR_REF"
			),
		"OFFERS_SORT_FIELD" => "",
		"OFFERS_SORT_ORDER" => "",
		"OFFERS_SORT_FIELD2" => "",
		"OFFERS_SORT_ORDER2" => "",
		"ADD_PICT_PROP" => "MORE_PHOTO",
		"LABEL_PROP" => "-",
		"OFFER_ADD_PICT_PROP" => "-",
		"OFFER_TREE_PROPS" => array(
			"SIZE",
			"COLOR_REF"
		),
		"MESS_BTN_COMPARE" => "Сравнение",
		"OFFERS_CART_PROPERTIES" => array(
			//0 => "SIZES_SHOES",
			//1 => "SIZES_CLOTHES",
			//2 => "COLOR_REF",
		)
	)
);?>