<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("WEBAVK_DELIVERYDATE_NAME"),
	"DESCRIPTION" => GetMessage("WEBAVK_DELIVERYDATE_DESCRIPTION"),
	"ICON" => "/images/component.gif",
	"CACHE_PATH" => "Y",
	"SORT" => 100,
	"PATH" => array(
		"ID" => "webavk",
		"NAME" => GetMessage("WEBAVK_DESC_COMPONENTS"),
		"SORT" => 100,
		"CHILD" => array(
			"ID" => "delivery",
			"NAME" => GetMessage("WEBAVK_DESC_COMPONENTS_DELIVERY"),
			"SORT" => 100,
			"CHILD" => array(
				"ID" => "webavk_deliverydate",
			),
		),
	),
);

?>