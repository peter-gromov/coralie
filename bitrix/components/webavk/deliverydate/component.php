<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

if (!CModule::IncludeModule("webavk.deliverydate")) {
	ShowError(GetMessage("WEBAVK_DELIVERYDATE_MODULE_NOT_INSTALLED"));
	return;
}
if (!CModule::IncludeModule("sale")) {
	ShowError(GetMessage("WEBAVK_DELIVERYDATE_SALE_MODULE_NOT_INSTALLED"));
	return;
}
if (!CModule::IncludeModule("iblock")) {
	ShowError(GetMessage("WEBAVK_DELIVERYDATE_IBLOCK_MODULE_NOT_INSTALLED"));
	return;
}

$strError = implode("<br />", $this->arErrors);

if (strlen($strError) > 0) {
	ShowError($strError);
	//return;
}
/*
  if ($_REQUEST['addok'] == "Y") {
  ShowMessage(array("TYPE" => "OK", "MESSAGE" => GetMessage("WEBAVK_IBCOMMENTS_NOTE_ADDOK")));
  } elseif ($_REQUEST['addmodok'] == "Y") {
  ShowMessage(array("TYPE" => "OK", "MESSAGE" => GetMessage("WEBAVK_IBCOMMENTS_NOTE_ADDMODOK")));
  } elseif ($_REQUEST['editdok'] == "Y") {
  ShowMessage(array("TYPE" => "OK", "MESSAGE" => GetMessage("WEBAVK_IBCOMMENTS_NOTE_EDITOK")));
  } elseif ($_REQUEST['editmodok'] == "Y") {
  ShowMessage(array("TYPE" => "OK", "MESSAGE" => GetMessage("WEBAVK_IBCOMMENTS_NOTE_EDITMODOK")));
  } elseif ($_REQUEST['answerok'] == "Y") {
  ShowMessage(array("TYPE" => "OK", "MESSAGE" => GetMessage("WEBAVK_IBCOMMENTS_NOTE_ANSWEROK")));
  }
 */
if ($this->StartResultCache(false, false,"/webavk.deliverydate/".$arParams['ELEMENT_ID']."/")) {
	$arResult['ITEMS'] = $this->getResultItems();
	$this->SetResultCacheKeys(array());
	$this->IncludeComponentTemplate();
}
?>