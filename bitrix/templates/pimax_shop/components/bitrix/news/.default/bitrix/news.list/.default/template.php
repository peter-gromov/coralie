<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
if (count($arResult["ITEMS"]) < 1)
	return;
?>

<section class="breadcrumb parallax margbot30"></section>

<section class="page_header">
	<div class="container">
		<h3 class="pull-left"><b><?=GetMessage("PIMAX_FASHIONSTORE_BLOG")?></b></h3>
	</div>
</section>

<section class="blog">
	<div class="container">
		<div class="row">

				<?foreach($arResult["ITEMS"] as $arItem):?>
				<?
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('NEWS_ELEMENT_DELETE_CONFIRM')));
					
				?>
					<article class="post large_image clearfix margbot30" data-appear-top-offset='-100' data-animated='fadeInUp'>
						
						<?php if (!empty($arItem['PREVIEW_PICTURE'])):?>
							<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" class="post_image pull-left">
								<img alt="" src="<?php echo $arItem['PREVIEW_PICTURE']['SRC']?>">
							</a>
						<?php endif;?>
						
						<a class="post_title" href="<?echo $arItem["DETAIL_PAGE_URL"]?>" ><?echo $arItem["NAME"]?></a>
						<div class="post_content"><?echo $arItem["PREVIEW_TEXT"];?></div>
						<ul class="post_meta">
							<li><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></li>
							<li><?php 
							$frame = $this->createFrame()->begin();?>
							<i class="fa fa-comments"></i><?=GetMessage("PIMAX_FASHIONSTORE_KOMMENTARII")?><span class="sep">|</span> <?php echo (int) $arItem['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE'];
							$frame->beginStub();
							?>
							<i class="fa fa-comments"></i><?=GetMessage("PIMAX_FASHIONSTORE_KOMMENTARII")?><span class="sep">|</span> 0
							<?php $frame->end();?></li>
						</ul>
					</article>
				<?endforeach;?>			
			
				<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
					<?=$arResult["NAV_STRING"]?>
				<?endif;?>		
			
		</div>
	</div>
</section>