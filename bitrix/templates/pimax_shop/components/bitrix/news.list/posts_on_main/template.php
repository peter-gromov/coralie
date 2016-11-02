<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	
	$this->setFrameMode(true);
?>

<?
if (count($arResult["ITEMS"]) < 1)
	return;
?>

<!-- RECENT POSTS -->
<section class="recent_posts padbot40">
	
	<!-- CONTAINER -->
	<div class="container">
		<h2><?=GetMessage("PIMAX_FASHIONSTORE_NOVOE_V_BLOGE")?></h2>
		
		<!-- ROW -->
		<div class="row" data-appear-top-offset='-100' data-animated='fadeInUp'>
			
				<?foreach($arResult["ITEMS"] as $arItem):?>
				<?
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('NEWS_ELEMENT_DELETE_CONFIRM')));
					
				?>
					<div class="col-lg-6 col-md-6 padbot30">
						
						<?php if (!empty($arItem['PREVIEW_PICTURE'])):?>
							<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" class="recent_post_img">
								<img alt="" src="<?php echo $arItem['PREVIEW_PICTURE']['SRC']?>">
							</a>
						<?php endif;?>
						
						<a class="recent_post_title" href="<?echo $arItem["DETAIL_PAGE_URL"]?>" ><?echo $arItem["NAME"]?></a>
						<div class="recent_post_content"><?echo $arItem["PREVIEW_TEXT"];?></div>
						<ul class="post_meta">
							<li><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></li>
							<li><i class="fa fa-comments"></i><?=GetMessage("PIMAX_FASHIONSTORE_KOMMENTARII")?><span class="sep">|</span> <?php echo (int) $arItem['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE']?></li>
						</ul>
					</div>
				<?endforeach;?>				
		</div>
	</div>
</section>