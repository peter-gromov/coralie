<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
if (!CModule::IncludeModule("sale"))
	return;
if (!CModule::IncludeModule("catalog"))
	return;
if (!CModule::IncludeModule("webavk.deliverydate"))
	return;
$arSaleDeliverys = array();
$rSaleDelivery = CSaleDelivery::GetList(array("SORT" => "ASC", "NAME" => "ASC"), array());
while ($arSaleDelivery = $rSaleDelivery->Fetch()) {
	$arSaleDeliverys[$arSaleDelivery['ID']] = '(' . $arSaleDelivery['LID'] . ') ' . $arSaleDelivery['NAME'];
}
$rSaleDelivery = CSaleDeliveryHandler::GetList(array("SORT" => "ASC", "NAME" => "ASC"), array());
while ($arSaleDelivery = $rSaleDelivery->Fetch()) {
	if (strlen($arSaleDelivery['LID']) > 0) {
		$arSaleDeliverys[$arSaleDelivery['SID']] = '(' . $arSaleDelivery['LID'] . ') ' . $arSaleDelivery['NAME'];
	} else {
		$arSaleDeliverys[$arSaleDelivery['SID']] = $arSaleDelivery['NAME'];
	}
}
$arSaleSklad = array();
$rSaleStore = CCatalogStore::GetList(array("SORT" => "ASC", "TITLE" => "ASC"), array());
while ($arSaleStore = $rSaleStore->Fetch()) {
	$arSaleSklad[$arSaleStore['ID']] = "[" . $arSaleStore['ID'] . "] " . $arSaleStore['TITLE'];
}

$arComponentParameters = array(
	"GROUPS" => array(
	),
	"PARAMETERS" => array(
		"DELIVERY_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("WEBAVK_DELIVERYDATE_DELIVERY_ID"),
			"TYPE" => "LIST",
			"VALUES" => $arSaleDeliverys,
			"MULTIPLE" => "Y",
		),
		"ELEMENT_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("WEBAVK_DELIVERYDATE_ELEMENT_ID"),
			"TYPE" => "STRING",
			"DEFAULT" => '={$_REQUEST["ELEMENT_ID"]}',
		),
		"SKLAD_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("WEBAVK_DELIVERYDATE_SKLAD_ID"),
			"TYPE" => "LIST",
			"VALUES" => $arSaleSklad,
			"MULTIPLE" => "Y",
		),
		"CACHE_TIME" => Array("DEFAULT" => 600),
	)
);
?>