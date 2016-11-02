<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	
	$this->setFrameMode(true);
	
?>

<?
if (count($arResult["ITEMS"]) < 1)
	return;
?>

<!-- BRANDS -->
<section class="brands_carousel">
	
	<!-- CONTAINER -->
	<div class="container">
		
		<!-- JCAROUSEL -->
		<div class="jcarousel-wrapper">
			
			<!-- NAVIGATION -->
			<div class="jCarousel_pagination">
				<a href="javascript:void(0);" class="jcarousel-control-prev" ><i class="fa fa-angle-left"></i></a>
				<a href="javascript:void(0);" class="jcarousel-control-next" ><i class="fa fa-angle-right"></i></a>
			</div><!-- //NAVIGATION -->
			
			<div class="jcarousel" data-appear-top-offset='-100' data-animated='fadeInUp'>
				<ul>
			
				<?foreach($arResult["ITEMS"] as $arItem):?>
				<?
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('NEWS_ELEMENT_DELETE_CONFIRM')));
					
				?>
				
					<li><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" ><img alt="" src="<?php echo $arItem['PREVIEW_PICTURE']['SRC']?>"></a></li>
					
				<?endforeach;?>				
			</ul>
					</div>
				</div><!-- //JCAROUSEL -->
			</div><!-- //CONTAINER -->
		</section><!-- //BRANDS -->