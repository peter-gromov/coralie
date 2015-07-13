<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arParams['MAP_ID'] = 
	(strlen($arParams["MAP_ID"])<=0 || !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["MAP_ID"])) ? 
	'MAP_'.RandString() : $arParams['MAP_ID']; 

$current_search = $_GET['ys'];

if (($strPositionInfo = $arParams['~MAP_DATA']) && CheckSerializedData($strPositionInfo) && ($arResult['POSITION'] = unserialize($strPositionInfo)))
{
	$arParams['INIT_MAP_LON'] = $arResult['POSITION']['google_lon'];
	$arParams['INIT_MAP_LAT'] = $arResult['POSITION']['google_lat'];
	$arParams['INIT_MAP_SCALE'] = $arResult['POSITION']['google_scale'];

	$this->IncludeComponentTemplate();
}
else
{
	ShowError(GetMessage('MYMS_NO_POSITION'));
	return;
}
?>