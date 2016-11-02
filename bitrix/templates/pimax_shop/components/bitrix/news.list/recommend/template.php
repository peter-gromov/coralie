<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	
	$this->setFrameMode(true);
?>

<?
if (count($arResult["ITEMS"]) < 1)
	return;
?>

<h3><b><?=GetMessage("PIMAX_FASHIONSTORE_REKOMENDUEM")?></b></h3>
<ul class="tovar_items_small clearfix">

	<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('NEWS_ELEMENT_DELETE_CONFIRM')));

	?>
		<li class="clearfix">
			<a href="<? echo $arItem['DETAIL_PAGE_URL']; ?>"><img class="tovar_item_small_img" src="<? echo $arItem['PREVIEW_PICTURE']['src']; ?>" alt="" /></a>
			<a href="<? echo $arItem['DETAIL_PAGE_URL']; ?>" class="tovar_item_small_title"><? echo $arItem['NAME']; ?></a>
			<span class="tovar_item_small_price"><?php echo $arItem['MIN_PRICE']['PRINT_DISCOUNT_VALUE']?></span>
		</li>
	<?endforeach;?>
</ul>