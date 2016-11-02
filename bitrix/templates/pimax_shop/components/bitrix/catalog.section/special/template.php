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
$this->setFrameMode(true);
?>

<section class="tovar_section">

	<!-- CONTAINER -->
	<div class="container">
		<h2>Тренды сезона</h2>

		<div class="row">
			<div class="tovar_wrapper" data-appear-top-offset='-100' data-animated='fadeInUp'>


<?
if (!empty($arResult['ITEMS']))
{
	
	$i = 1;
	foreach ($arResult['ITEMS'] as $key => $arItem)
	{
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
		$strMainID = $this->GetEditAreaId($arItem['ID']);
	
			
		$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);
	
		$productTitle = (
			isset($arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])&& $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] != ''
			? $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
			: $arItem['NAME']
		);
		$imgTitle = (
			isset($arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']) && $arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE'] != ''
			? $arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']
			: $arItem['NAME']
		);
	
		$minPrice = false;
		if (isset($arItem['MIN_PRICE']) || isset($arItem['RATIO_PRICE'])) {
			$minPrice = (isset($arItem['RATIO_PRICE']) ? $arItem['RATIO_PRICE'] : $arItem['MIN_PRICE']);
		}
	
		?>
		
		
		
		<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 col-ss-12 padbot40">
			<div class="tovar_item">
				<?if ($arItem["PROPERTIES"]["NEWPRODUCT"]["VALUE"] === "Y"):?>
			        <div class="new-product-icon-new">NEW</div>
			    <?endif;?>
			    
			    <?if ($arItem["PROPERTIES"]["SPECIALOFFER"]["VALUE"] === "Y"):?>
			        <div class="new-product-icon-sale">-<?php echo $arItem["PROPERTIES"]["SALE_AMOUNT"]["VALUE"]?>%</div>
			    <?endif;?>
				
				<div class="tovar_img">
					<a href="<?=$arItem['DETAIL_PAGE_URL']?>">
					<div class="tovar_img_wrapper">
					
						<img class="img" src="<? echo $arItem['PREVIEW_PICTURE']['SRC']; ?>" alt="" />
						<img class="img_h" src="<? echo $arItem['PREVIEW_PICTURE']['SRC']; ?>" alt="" />
						
					</div>
					</a>
					<div class="tovar_item_btns">
						<div class="open-project-link"><a class="open-project tovar_view" href="<?php echo SITE_DIR?>ajax/product/?ELEMENT_ID=<?php echo $arItem['ID']?>" >Быстрый просмотр</a></div>
					</div>
				</div>
				<div class="tovar_description clearfix">
					<a class="tovar_title" href="<? echo $arItem['DETAIL_PAGE_URL']; ?>"><? echo $arItem['NAME']; ?></a>
					<?php $frame = $this->createFrame()->begin();?>
					<span class="tovar_price "><?php
						
						echo ceil($arItem['PROPERTIES']['MINIMUM_PRICE']['VALUE']). ' руб.';
						
						
							 ?>
						
					
						</span>
						
						<?php $frame->end();?>
				</div>
			</div>
		</div>
		
		<?php if ($i == 4){?>
			</div></div>
			<div class="row">
				<div class="tovar_wrapper" data-appear-top-offset='-100' data-animated='fadeInUp'>
			<?php $i = 1; ?>
		<?php } else	 {
				$i++;
			} ?>

<?php 	}
}

?>

<?php if ($i != 4):?>
	</div></div>
<?php endif;?>

</div></section>