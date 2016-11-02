<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
?>
<div class="subscribe-form"  id="subscribe-form">
<?
$frame = $this->createFrame("subscribe-form", false)->begin();
?>
	<form class="newsletter_form " action="<?=$arResult["FORM_ACTION"]?>">

		<?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
			<input type="hidden" name="sf_RUB_ID[]" id="sf_RUB_ID_<?=$itemValue["ID"]?>" value="<?=$itemValue["ID"]?>" checked="" /> 
		<?endforeach;?>
		
		<input type="text" placeholder="<?=GetMessage("PIMAX_FASHIONSTORE_VVEDITE_SVOY")?>" name="sf_EMAIL" size="20" value="" title="<?=GetMessage("subscr_form_email_title")?>" />
		<input class="btn newsletter_btn" type="submit" name="OK" value="<?=GetMessage("subscr_form_button")?>" />

	</form>
<?
$frame->beginStub();
?>
	<form class="newsletter_form " action="<?=$arResult["FORM_ACTION"]?>">

		<?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
			<input type="hidden" name="sf_RUB_ID[]" id="sf_RUB_ID_<?=$itemValue["ID"]?>" value="<?=$itemValue["ID"]?>" checked="" /> 
		<?endforeach;?>
		
		<input type="text" placeholder="<?=GetMessage("PIMAX_FASHIONSTORE_VVEDITE_SVOY")?>" name="sf_EMAIL" size="20" value="" title="<?=GetMessage("subscr_form_email_title")?>" />
		<input class="btn newsletter_btn" type="submit" name="OK" value="<?=GetMessage("subscr_form_button")?>" />

	</form>
<?
$frame->end();
?>
</div>
