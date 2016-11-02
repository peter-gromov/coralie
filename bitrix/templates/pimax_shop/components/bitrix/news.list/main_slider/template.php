<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	
	$this->setFrameMode(true);
?>

<?
if (count($arResult["ITEMS"]) < 1)
	return;
?>

<section id="home" class="padbot0">
	<!-- TOP SLIDER -->
	<div class="flexslider top_slider">
		<ul class="slides">
				<?foreach($arResult["ITEMS"] as $arItem):?>
				<?
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('NEWS_ELEMENT_DELETE_CONFIRM')));
					
				?>
					<li class="slide1" style="background-image: url(<?php echo $arItem['PREVIEW_PICTURE']['SRC']?>);">
						
						<!-- CONTAINER -->
						<div class="container">
							<div class="flex_caption1">
								<p class="title1 captionDelay2 FromTop"><?echo $arItem["NAME"]?></p>
								<p class="title2 captionDelay3 FromTop"><?echo $arItem["PREVIEW_TEXT"];?></p>
							</div>
							<div class="flex_caption3 slide_banner_wrapper">
								<?php if (!empty($arItem['PROPERTIES']['BANNER1']['VALUE'])):?>
									<a class="slide_banner slide1_banner1 captionDelay4 FromBottom" href="<?php echo $arItem['PROPERTIES']['BANNER1_LINK']['VALUE']?>" ><img src="<?php echo $arItem['PROPERTIES']['BANNER1']['VALUE']['SRC']?>" alt="" /></a>
								<?php endif;?>
								
								<?php if (!empty($arItem['PROPERTIES']['BANNER2']['VALUE'])):?>
									<a class="slide_banner slide1_banner2 captionDelay5 FromBottom" href="<?php echo $arItem['PROPERTIES']['BANNER2_LINK']['VALUE']?>" ><img src="<?php echo $arItem['PROPERTIES']['BANNER2']['VALUE']['SRC']?>" alt="" /></a>
								<?php endif;?>
								
								<?php if (!empty($arItem['PROPERTIES']['BANNER3']['VALUE'])):?>
									<a class="slide_banner slide1_banner3 captionDelay6 FromBottom" href="<?php echo $arItem['PROPERTIES']['BANNER3_LINK']['VALUE']?>" ><img src="<?php echo $arItem['PROPERTIES']['BANNER3']['VALUE']['SRC']?>" alt="" /></a>
								<?php endif;?>
							</div>
						</div><!-- //CONTAINER -->
					</li>
				<?endforeach;?>				
		</ul>
	</div><!-- //TOP SLIDER -->
</section><!-- //HOME -->