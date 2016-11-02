<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

class CWebAVKDeliveryDateComponent extends CBitrixComponent {

	public function onPrepareComponentParams($arParams) {
		global $USER;
		$result = array(
			"DELIVERY_ID" => $arParams["DELIVERY_ID"],
			"ELEMENT_ID" => intval($arParams["ELEMENT_ID"]),
			"SKLAD_ID" => array_flip($arParams['SKLAD_ID']),
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => isset($arParams["CACHE_TIME"]) ? $arParams["CACHE_TIME"] : 36000,
		);
		$arDelivery = array();
		foreach ($result['DELIVERY_ID'] as $val) {
			$val = trim($val);
			if (strlen($val) > 0)
				$arDelivery[] = $val;
		}
		$result['DELIVERY_ID'] = $arDelivery;
		return $result;
	}

	public function executeComponent() {
		global $APPLICATION, $USER;

		return parent::executeComponent();
	}

	public function getResultItems() {
		$arResult = array();
		$replaceDeliveryDays = false;
		$replaceDeliveryDate = false;
		$arSaleDeliverys = array();
		$rSaleDelivery = CSaleDelivery::GetList(array("SORT" => "ASC", "NAME" => "ASC"), array());
		while ($arSaleDelivery = $rSaleDelivery->Fetch()) {
			$arSaleDeliverys[$arSaleDelivery['ID']] = $arSaleDelivery['NAME'];
		}
		$rSaleDelivery = CSaleDeliveryHandler::GetList(array("SORT" => "ASC", "NAME" => "ASC"), array());
		while ($arSaleDelivery = $rSaleDelivery->Fetch()) {
			$arSaleDeliverys[$arSaleDelivery['SID']] = $arSaleDelivery['NAME'];
		}
		if ($this->arParams['ELEMENT_ID'] > 0) {
			$rEl = CIBlockElement::GetList(array(), array("ID" => $this->arParams['ELEMENT_ID']), false, false, array("ID", "IBLOCK_ID", "PROPERTY_DELIVERY_DATE", "PROPERTY_DELIVERY_DAYS"));
			if ($arEl = $rEl->Fetch()) {
				if (strlen($arEl['PROPERTY_DELIVERY_DAYS_VALUE']) > 0) {
					$replaceDeliveryDays = $arEl['PROPERTY_DELIVERY_DAYS_VALUE'];
				}
				if (strlen($arEl['PROPERTY_DELIVERY_DATE_VALUE']) > 0) {
					$replaceDeliveryDate = $arEl['PROPERTY_DELIVERY_DATE_VALUE'];
				}
			}
		}
		foreach ($this->arParams['DELIVERY_ID'] as $deliveryID) {
			$minDate = $replaceDeliveryDate;
			$minDays = ($replaceDeliveryDays !== false ? $replaceDeliveryDays : COption::GetOptionString("webavk.deliverydate", "deliverydays_" . $deliveryID, ''));
			$date = CWebavkDeliveryDateTools::getEarliestDate($deliveryID, $minDays, $minDate, $this->arParams['SKLAD_ID'], $this->arParams['ELEMENT_ID']);
			if ($date !== false) {
				$arResult[$deliveryID] = array(
					"DATE_DELIVERY" => $date,
					"DELIVERY_ID" => $deliveryID,
					"DELIVERY_NAME" => $arSaleDeliverys[$deliveryID]
				);
			}
		}
		return $arResult;
	}

}

?>