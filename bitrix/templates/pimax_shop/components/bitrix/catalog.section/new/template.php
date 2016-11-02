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

<!-- NEW ARRIVALS -->
<section class="new_arrivals padbot50">

	<!-- CONTAINER -->
	<div class="container">
		<h2>Новые поступления</h2>

		<!-- JCAROUSEL -->
		<div class="jcarousel-wrapper">

			<!-- NAVIGATION -->
			<div class="jCarousel_pagination">
				<a href="javascript:void(0);" class="jcarousel-control-prev" ><i class="fa fa-angle-left"></i></a>
				<a href="javascript:void(0);" class="jcarousel-control-next" ><i class="fa fa-angle-right"></i></a>
			</div><!-- //NAVIGATION -->

			<div class="jcarousel" data-appear-top-offset='-100' data-animated='fadeInUp'>
				<ul>

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
		
		
		
		<li>
			<div class="tovar_item_new">
				<?if ($arItem["PROPERTIES"]["NEWPRODUCT"]["VALUE"] === "Y"):?>
			        <div class="new-product-icon-new small">NEW</div>
			    <?endif;?>
			    
			    <?if ($arItem["PROPERTIES"]["SPECIALOFFER"]["VALUE"] === "Y"):?>
			        <div class="new-product-icon-sale small">-<?php echo $arItem["PROPERTIES"]["SALE_AMOUNT"]["VALUE"]?>%</div>
			    <?endif;?>
				
				<div class="tovar_img">
															

					<a href="<? echo $arItem['DETAIL_PAGE_URL']; ?>">
					
						<img class="img" src="<? echo $arItem['PREVIEW_PICTURE']['SRC']; ?>" alt="" />
						<div class="open-project-link"><a class="open-project tovar_view" href="<?php echo SITE_DIR?>ajax/product/?ELEMENT_ID=<?php echo $arItem['ID']?>" >Быстрый просмотр</a></div>
					</a>
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
		</li>
		

<?php 	}
}

?>
</ul></div></div></div></section>