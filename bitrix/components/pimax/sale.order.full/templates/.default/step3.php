<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<table border="0" cellspacing="0" cellpadding="5">
<tr>
	<td valign="top" width="60%" align="right">
		
	</td>
	<td valign="top" width="5%" rowspan="3">&nbsp;</td>
	<td valign="top" width="35%" rowspan="3">
		
		<?echo GetMessage("STOF_DELIVERY_NOTES")?><br /><br />
		<?echo GetMessage("STOF_PRIVATE_NOTES")?>
		
	</td>
</tr>
<tr>
	<td valign="top" width="60%">
		
		<h2><?echo GetMessage("STOF_DELIVERY_PROMT")?></h2>
		<table class="sale_order_full_table sale_order_delivery_table">
			<tr>
				<td colspan="2"><?echo GetMessage("STOF_SELECT_DELIVERY")?><br /><br /></td>
			</tr>
			<?
				foreach ($arResult["DELIVERY"] as $delivery_id => $arDelivery)
				{
					if ($delivery_id !== 0 && intval($delivery_id) <= 0):
				?>
				<tr>
					<td style="font-size: 16px;" colspan="2">
						
						<b><?=$arDelivery["TITLE"]?></b><br /><br /><?if (strlen($arDelivery["DESCRIPTION"]) > 0):?><br />
						<?=nl2br($arDelivery["DESCRIPTION"])?><br /><?endif;?>
						<table border="0" cellspacing="0" cellpadding="3">
						
					<?
						foreach ($arDelivery["PROFILES"] as $profile_id => $arProfile)
						{
							?>
					<tr>
						<td width="20" nowrap="nowrap">&nbsp;</td>
						<td width="0%" valign="top"><input type="radio" id="ID_DELIVERY_<?=$delivery_id?>_<?=$profile_id?>" name="<?=$arProfile["FIELD_NAME"]?>" value="<?=$delivery_id.":".$profile_id;?>" <?=$arProfile["CHECKED"] == "Y" ? "checked=\"checked\"" : "";?> /></td>
						<td width="50%" valign="top"  style="font-size: 16px;">
							<label class="label-delivery" for="ID_DELIVERY_<?=$delivery_id?>_<?=$profile_id?>">
								<b><?=$arProfile["TITLE"]?></b><?if (strlen($arProfile["DESCRIPTION"]) > 0):?></<br />
								<?=nl2br($arProfile["DESCRIPTION"])?><?endif;?>
							</label>
						</td>
						<td width="50%" valign="top" align="right">
						<?
							$APPLICATION->IncludeComponent('bitrix:sale.ajax.delivery.calculator', '', array(
								"NO_AJAX" => $arParams["SHOW_AJAX_DELIVERY_LINK"] == 'S' ? 'Y' : 'N',
								"DELIVERY" => $delivery_id,
								"PROFILE" => $profile_id,
								"ORDER_WEIGHT" => $arResult["ORDER_WEIGHT"],
								"ORDER_PRICE" => $arResult["ORDER_PRICE"],
								"LOCATION_TO" => $arResult["DELIVERY_LOCATION"],
								"LOCATION_ZIP" => $arResult['DELIVERY_LOCATION_ZIP'],
								"CURRENCY" => $arResult["BASE_LANG_CURRENCY"],
							));
						?>
						<?if ($arParams["SHOW_AJAX_DELIVERY_LINK"] == 'N'):?>
						<script type="text/javascript">deliveryCalcProceed({STEP:1,DELIVERY:'<?=CUtil::JSEscape($delivery_id)?>',PROFILE:'<?=CUtil::JSEscape($profile_id)?>',WEIGHT:'<?=CUtil::JSEscape($arResult["ORDER_WEIGHT"])?>',PRICE:'<?=CUtil::JSEscape($arResult["ORDER_PRICE"])?>',LOCATION:'<?=intval($arResult["DELIVERY_LOCATION"])?>',CURRENCY:'<?=CUtil::JSEscape($arResult["BASE_LANG_CURRENCY"])?>'})</script>
						<?endif;?>
						</td>
					</tr>
							<?
						} // endforeach
					?>
						</table>

						
					</td>
				</tr>
				<?
					else:
?>
					<tr>
						<td valign="top" width="0%">
							<?php /* if (!empty($arDelivery["LOGOTIP"])):?>
								<img class="delivery-icon" src="<?php echo $arDelivery["LOGOTIP"]['SRC']?>" alt="" />
							<?php endif; */?>
							<input  type="radio" id="ID_DELIVERY_ID_<?= $arDelivery["ID"] ?>" name="<?=$arDelivery["FIELD_NAME"]?>" value="<?= $arDelivery["ID"] ?>"<?if ($arDelivery["CHECKED"]=="Y") echo " checked";?>>
						</td>
						<td valign="top" width="100%">
							<label class="label-delivery" for="ID_DELIVERY_ID_<?= $arDelivery["ID"] ?>">
							<b><?= $arDelivery["NAME"] ?></b><br />
							<?
							if (strlen($arDelivery["PERIOD_TEXT"])>0)
							{
								echo $arDelivery["PERIOD_TEXT"];
								?><br /><?
							}
							?>
							<?=GetMessage("SALE_DELIV_PRICE");?> <?=$arDelivery["PRICE_FORMATED"]?><br />
							<?
							if (strlen($arDelivery["DESCRIPTION"])>0)
							{
								?>
								<?=nl2br($arDelivery["DESCRIPTION"])?><br />
								<?
							}
							?>
							</label>
						</td>
					</tr>
					<?
					endif;
				
				} // endforeach
			?>
			<?
			//endif;
			?>
		</table>
	</td>
</tr>
<tr>
	<td valign="top" width="60%" align="right">
	<?if(!($arResult["SKIP_FIRST_STEP"] == "Y" && $arResult["SKIP_SECOND_STEP"] == "Y"))
	{
		?>
		<input type="submit" name="backButton" value="&lt;&lt; <?echo GetMessage("SALE_BACK_BUTTON")?>">
		<?
	}
	?>
		<input type="submit" name="contButton" id="order-delivery-next" value="<?= GetMessage("SALE_CONTINUE")?> &gt;&gt;">
	</td>
</tr>
</table>

<input type="hidden" id="data-phone-number" value="<?php echo $arResult['POST']['ORDER_PROP_3']?>" />


<div aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade" style="display: none;" aria-hidden="true">
  <div role="document" class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
		<h4 id="myModalLabel" class="modal-title">Подтверждение номера телефона</h4>
	  </div>
	  <div class="modal-body text-center">
		  <div id="phone-verification-error" class="alert alert-danger alert-dismissable" style="display: none;">
				
				Код введен не верно.
			</div>
		<div id="phone-verification-alert" class="alert alert-success alert-dismissable" style="display: none;">
			Новый код отправлен!
		</div>
		При курьерской доставке, необходимо подтвердить номер телефона.<br />
		На ваш номер <strong><?php echo $arResult['POST']['ORDER_PROP_3']?></strong> был отправлен код подтверждения.<br />
		Введите его в форму ниже:
		<input id="phone-verification-code" type="text" value="" />
		<a id="phone-verification-get-new-code" href="#" style="display: none;">Получить новый код</a>
	  </div>
	  <div class="modal-footer">
		<button data-dismiss="modal" class="btn btn-default" type="button">Отменить</button>
		<button id="btn-verification-phone" class="btn btn-primary" type="button">Подтвердить</button>
	  </div>
	</div>
  </div>
</div>