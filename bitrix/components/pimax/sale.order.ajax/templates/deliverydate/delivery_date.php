<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?

function PrintPropsFormDelivery($arSource = Array(), $locationTemplate = ".default", $arDatesAllowDelivery = array(), $arTimeIntervalsDelivery = array()) {
	if (!empty($arSource) && !empty($arDatesAllowDelivery)) {
		foreach ($arSource as $k => $arProperties) {
			if ($arProperties['CODE'] != "F_DELIVERY_DATE" && $arProperties['CODE'] != "F_DELIVERY_TIME")
				unset($arSource[$k]);
		}
		foreach ($arSource as $arProperties) {
			?>
			<tr>
				<td class="name">
					<?= $arProperties["NAME"] ?>:<?
					if ($arProperties["REQUIED_FORMATED"] == "Y") {
						?><span class="sof-req">*</span><?
					}
					?>
				</td>
				<td>
					<?
					if ($arProperties["CODE"] == "F_DELIVERY_DATE") {
						?>
						<select name="<?= $arProperties["FIELD_NAME"] ?>" id="F_DELIVERY_DATE" size="<?= $arProperties["SIZE1"] ?>">
							<?
							foreach ($arDatesAllowDelivery as $curDate) {
								?>
								<option value="<?= $curDate ?>"<? if ($arProperties["VALUE"] == $curDate) { ?> selected="selected"<? } ?>><?= $curDate ?></option>
								<?
							}
							?>
						</select>
						<div id="div_F_DELIVERY_DATE" class="order-calendar"></div>
						<?
						/*
						  ?>
						  <input type="text" maxlength="250" size="<?= $arProperties["SIZE1"] ?>" value="<?= $arProperties["VALUE"] ?>" name="<?= $arProperties["FIELD_NAME"] ?>" id="<?= $arProperties["FIELD_NAME"] ?>">
						  <?
						 * 
						 */
					} elseif ($arProperties["CODE"] == "F_DELIVERY_TIME") {
						?>
						<select name="<?= $arProperties["FIELD_NAME"] ?>" id="F_DELIVERY_TIME" size="<?= $arProperties["SIZE1"] ?>">
							<?
							foreach ($arTimeIntervalsDelivery as $curTime) {
								?>
								<option value="<?= trim($curTime) ?>"<? if (trim($arProperties["VALUE"]) == trim($curTime)) { ?> selected="selected"<? } ?>><?= trim($curTime) ?></option>
								<?
							}
							?>
						</select>
						<div id="div_F_DELIVERY_TIME" class="order-time"></div>
						<?
					}
					if (strlen($arProperties["DESCRIPTION"]) > 0) {
						?>
						<div class="desc"><? echo $arProperties["DESCRIPTION"] ?></div>
						<?
					}
					?>
				</td>
			</tr>
			<?
		}
		?>
		<?
		return true;
	}
	return false;
}

CModule::IncludeModule("webavk.deliverydate");
$arElementsID = array();
foreach ($arResult["BASKET_ITEMS"] as $arBasketItem) {
	$arElementsID[$arBasketItem['PRODUCT_ID']] = $arBasketItem['QUANTITY'];
}
//$arElementsID = array_unique($arElementsID);
$arDatesAllowDelivery = CWebavkDeliveryDateTools::GetAllowDeliveryDatesForOrder($arResult['USER_VALS']['DELIVERY_ID'], 30, $arElementsID);

$currentDeliveryDate = '';
foreach ($arResult["ORDER_PROP"] as $arOrderProperties) {
	foreach ($arOrderProperties as $arProperties) {
		if ($arProperties["CODE"] == "F_DELIVERY_DATE") {
			foreach ($arDatesAllowDelivery as $curDate) {
				if ($arProperties["VALUE"] == $curDate)
					$currentDeliveryDate = $curDate;
			}
		}
	}
}
$arTimeIntervalsDelivery = array();
if ($currentDeliveryDate == '')
	$currentDeliveryDate = $arDatesAllowDelivery[0];
if (strlen($currentDeliveryDate) > 0) {
	$arTimeIntervalsDelivery = CWebavkDeliveryDateTools::GetTimeIntervalsForOrder($arResult['USER_VALS']['DELIVERY_ID'], MakeTimeStamp($currentDeliveryDate), $arElementsID);
}
?>
<script type="text/javascript">
	<!--
	var webavkDeliveryAllowDates =<?= CUtil::PhpToJSObject($arDatesAllowDelivery) ?>;
-->
</script>
<?
if (!empty($arDatesAllowDelivery)) {
	?>
	<div class="section">
		<div class="title"><?= GetMessage("SOA_TEMPL_PROP_INFO") ?></div>
		<table class="sale_order_table props" id="sale_order_props_delivery">
			<?
			PrintPropsFormDelivery($arResult["ORDER_PROP"]["USER_PROPS_N"], $arParams["TEMPLATE_LOCATION"], $arDatesAllowDelivery, $arTimeIntervalsDelivery);
			PrintPropsFormDelivery($arResult["ORDER_PROP"]["USER_PROPS_Y"], $arParams["TEMPLATE_LOCATION"], $arDatesAllowDelivery, $arTimeIntervalsDelivery);
			?>
		</table>
	</div>
	<?
}?>