<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$PARTNER_ID = "bxmaker";
$PARTNER_COMPONENT_ID = 'BXMAKER.AUTHUSERPHONE.EIDT';

$arComponentDescription = array(
    "NAME" => GetMessage($PARTNER_COMPONENT_ID."_COMPONENT_NAME"),
    "DESCRIPTION" => GetMessage($PARTNER_COMPONENT_ID."_COMPONENT_DESCRIPTION"),
    "ICON" => "",
    "PATH" => array(
        "ID" => $PARTNER_ID,
        "NAME" => GetMessage($PARTNER_COMPONENT_ID.'_DEVELOP_GROUP'),
        "CHILD" => array(
            "ID" => "user",
            "NAME" => GetMessage($PARTNER_COMPONENT_ID.'_USER_COMPONENT_GROUP')
        )
    ),
);
unset($PARTNER_ID,$PARTNER_COMPONENT_ID);
