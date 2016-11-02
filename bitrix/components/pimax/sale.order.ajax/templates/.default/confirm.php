<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 * @var array $arResult
 * @var $APPLICATION CMain
 */

if ($arParams["SET_TITLE"] == "Y")
	$APPLICATION->SetTitle("СПАСИБО ЗА ЗАКАЗ!");
?>

<div class="order-summary">
	<? if (!empty($arResult["ORDER"])): ?>
	
	
	
		<?php 
			$weekDays = array("Воскресенье", "Понедельник", "Вторник", "Среду", "Четверг", "Пятницу", "Субботу");
			$months = array("", "Января","Февраля","Марта","Апреля","Мая","Июня","Июля","Августа","Сентября","Октября","Ноября","Декабря");
			$pickupDate = false; $pickupTime = false;
			$deliveryDate = false; $deliveryTime = false;
			
			
			$db_props = CSaleOrderPropsValue::GetOrderProps($arResult['ORDER']['ID']);
			while ($arProps = $db_props->Fetch())
			{
				if ($arProps['ID'] == 133) {
					$pickupDate = $weekDays[date("w", strtotime($arProps['VALUE']))]. " ".date("j", strtotime($arProps['VALUE']))." ".$months[date("n", strtotime($arProps['VALUE']))];
				}
				
				if ($arProps['ID'] == 134) {
					$arVal = CSaleOrderPropsVariant::GetByValue($arProps["ORDER_PROPS_ID"], $arProps['VALUE']);
			
					$pickupTime = htmlspecialchars($arVal["NAME"]);
				}
				
				if ($arProps['ID'] == 147) {
					$deliveryDate = $weekDays[date("w", strtotime($arProps['VALUE']))]. " ".date("j", strtotime($arProps['VALUE']))." ".$months[date("n", strtotime($arProps['VALUE']))];
				}
				
				if ($arProps['ID'] == 148) {
					$arVal = CSaleOrderPropsVariant::GetByValue($arProps["ORDER_PROPS_ID"], $arProps['VALUE']);
			
					$deliveryTime = htmlspecialchars($arVal["NAME"]);
				}
				
				//echo '<pre>', print_r($arProps), '</pre>';
	
			}
			
			//echo '<pre>', print_r($pickupDate), '</pre>';
			
		?>
	
	
		
		<table class="sale_order_full_table">
			<tr>
				<td>
					<?=Loc::getMessage("SOA_ORDER_SUC", array(
						"#ORDER_DATE#" => $arResult["ORDER"]["DATE_INSERT"],
						"#ORDER_ID#" => $arResult["ORDER"]["ACCOUNT_NUMBER"]
					))?>
					
					<? if (!empty($arResult['ORDER']["PAYMENT_ID"])): ?>
						<?=Loc::getMessage("SOA_PAYMENT_SUC", array(
							"#PAYMENT_ID#" => $arResult['PAYMENT'][$arResult['ORDER']["PAYMENT_ID"]]['ACCOUNT_NUMBER']
						))?>
					<? endif ?>
					<br /><br />
					
					<?php if ($arResult['ORDER']['DELIVERY_ID'] == 9):?>
						<p>Вы оформили самовывоз с примеркой в <span><?php echo $pickupDate?></span> в период <span><?php echo $pickupTime?></span>
							<br />Адрес выбранного пункта самовывоза: Казанская улица, дом 45, квартира 55
							<br />Контактный телефон магазина: +7 (952) 370-44-00
						</p>
					
					<?php endif;?>
					
					<?php if ($arResult['ORDER']['DELIVERY_ID'] == 23):?>
						<p>Вы заказали доставку на <span><?php echo $deliveryDate?></span> в период <span><?php echo $deliveryTime?></span>
							<br />Вам надо иметь возможность принять курьера в течение всего выбранного промежутка времени.
							<br />Наш курьер заранее позвонит вам.
						</p>
					
					<?php endif;?>
					
					
					<?=Loc::getMessage("SOA_ORDER_SUC1", array("#LINK#" => $arParams["PATH_TO_PERSONAL"]))?>
				</td>
			</tr>
		</table>
		
		
		
	
		<?
			//echo '<pre>', print_r($arResult['ORDER']['ID']), '</pre>';
		if (!empty($arResult["PAYMENT"]))
		{
			foreach ($arResult["PAYMENT"] as $payment)
			{
				if($payment['PAY_SYSTEM_ID'] != 8) continue;
				
				if ($payment["PAID"] != 'Y')
				{
					if (!empty($arResult['PAY_SYSTEM_LIST'])
						&& array_key_exists($payment["PAY_SYSTEM_ID"], $arResult['PAY_SYSTEM_LIST'])
					)
					{
						$arPaySystem = $arResult['PAY_SYSTEM_LIST'][$payment["PAY_SYSTEM_ID"]];
	
						if (empty($arPaySystem["ERROR"]))
						{
						?>
							<br /><br />
							
							<?php if ($payment['PAY_SYSTEM_ID'] == 8):?>
								<p>Обратите внимание, что обработка заказа начнется только после его оплаты.</p>
							<?php endif;?>
	
							<table class="sale_order_full_table">
								<tr>
									<td class="ps_logo">
										<div class="pay_name"><?= Loc::getMessage("SOA_PAY") ?></div>
										<?= CFile::ShowImage($arPaySystem["LOGOTIP"], 100, 100, "border=0\" style=\"width:100px\"", "", false) ?>
										<div class="paysystem_name"><?= $arPaySystem["NAME"] ?></div>
										<br/>
									</td>
								</tr>
								<tr>
									<td>
										<? if (strlen($arPaySystem["ACTION_FILE"]) > 0 && $arPaySystem["NEW_WINDOW"] == "Y" && $arPaySystem["IS_CASH"] != "Y"): ?>
											<?
											$orderAccountNumber = urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]));
											$paymentAccountNumber = $payment["ACCOUNT_NUMBER"];
											?>
											<script>
												window.open('<?=$arParams["PATH_TO_PAYMENT"]?>?ORDER_ID=<?=$orderAccountNumber?>&PAYMENT_ID=<?=$paymentAccountNumber?>');
											</script>
											<?=Loc::getMessage("SOA_PAY_LINK", array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".$orderAccountNumber."&PAYMENT_ID=".$paymentAccountNumber))?>
											<? if (CSalePdf::isPdfAvailable() && $arPaySystem['IS_AFFORD_PDF']): ?>
												<br/>
												<?=Loc::getMessage("SOA_PAY_PDF", array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".$orderAccountNumber."&pdf=1&DOWNLOAD=Y"))?>
											<? endif ?>
										<? else: ?>
											<?=$arPaySystem["BUFFERED_OUTPUT"]?>
										<? endif ?>
									</td>
								</tr>
							</table>
							
							<?php if ($payment['PAY_SYSTEM_ID'] == 8):?>
								<p>Вы можете оплатить заказ прямо сейчас, нажав на кнопку, либо позднее, перейдя по ссылке, отправленной на указанный Вами e-mail. <br />
									Ссылка для оплаты действительна в течение 3 часов с момента оформления заказа. По истечению этого периода заказ аннулируется.</p>
							<?php endif;?>
						<?
						}
						else
						{
						?>
							<span style="color:red;"><?= Loc::getMessage("SOA_ORDER_PS_ERROR")?></span>
						<?
						}
					}
					else
					{
					?>
						<span style="color:red;"><?= Loc::getMessage("SOA_ORDER_PS_ERROR")?></span>
					<?
					}
				}
			}
		}
		?>
		
		<br />
		
	<? else: ?>
		
		<b><?=Loc::getMessage("SOA_ERROR_ORDER")?></b>
		<br /><br />
	
		<table class="sale_order_full_table">
			<tr>
				<td>
					<?=Loc::getMessage("SOA_ERROR_ORDER_LOST", array("#ORDER_ID#" => $arResult["ACCOUNT_NUMBER"]))?>
					<?=Loc::getMessage("SOA_ERROR_ORDER_LOST1")?>
				</td>
			</tr>
		</table>
		
	<? endif ?>
</div>