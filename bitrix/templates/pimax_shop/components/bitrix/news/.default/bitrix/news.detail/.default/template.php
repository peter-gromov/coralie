<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<!-- BREADCRUMBS -->
<section class="breadcrumb parallax margbot30"></section>
<!-- //BREADCRUMBS -->

<!-- PAGE HEADER -->
<section class="page_header">
	
	<!-- CONTAINER -->
	<div class="container">
		<h3 class="pull-left"><b><?=GetMessage("PIMAX_FASHIONSTORE_BLOG")?></b></h3>
		
		<div class="pull-right">
			<a href="<?php echo $arParams['IBLOCK_URL']?>" ><?=GetMessage("PIMAX_FASHIONSTORE_VERNUTQSA_V_SPISOK")?><i class="fa fa-angle-right"></i></a>
		</div>
	</div><!-- //CONTAINER -->
</section><!-- //PAGE HEADER -->


<!-- BLOG BLOCK -->
<section class="blog">
	
	<!-- CONTAINER -->
	<div class="container">
	
		<!-- ROW -->
		<div class="row">
			
			
				<article class="post blog_post clearfix margbot20" data-appear-top-offset='-100' data-animated='fadeInUp'>
					<div class="post_title"><?=$arResult["NAME"]?></div>
					<ul class="post_meta">
						<li><?echo $arResult["DISPLAY_ACTIVE_FROM"]?></li>
						<li><?php 
						
						$frame = $this->createFrame()->begin();?>
						<i class="fa fa-comments"></i><?=GetMessage("PIMAX_FASHIONSTORE_KOMMENTARII")?><span class="sep">|</span> <?php echo (int) $arResult['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE'];
						
						$frame->beginStub();?>
						<i class="fa fa-comments"></i><?=GetMessage("PIMAX_FASHIONSTORE_KOMMENTARII")?><span class="sep">|</span> 0
						<?php $frame->end();?></li>
					</ul>
					
					<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
						<div class="post_large_image">
							<img class="detail_picture" border="0" src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>" height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["NAME"]?>"  title="<?=$arResult["NAME"]?>" />
						</div>
					<?endif?>
					
					<div class="blog_post_content">
						<?php if(strlen($arResult["DETAIL_TEXT"])>0):?>
							<?echo $arResult["DETAIL_TEXT"];?>
					 	<?else:?>
							<?echo $arResult["PREVIEW_TEXT"];?>
						<?endif?>
					</div>
					
				</article>
				
				<div class="shared_tags_block clearfix" data-appear-top-offset='-100' data-animated='fadeInUp'>
					<div class="pull-right tovar_shared clearfix">
						<p><?=GetMessage("PIMAX_FASHIONSTORE_PODELITQSA_S_DRUZQAM")?></p>
						<?php $frame = $this->createFrame()->begin();?>
							<script type="text/javascript" src="//yandex.st/share/share.js"
							charset="utf-8"></script>
							<div class="yashare-auto-init" data-yashareL10n="ru"
							 data-yashareQuickServices="yaru,vkontakte,facebook,twitter,odnoklassniki,moimir,gplus" data-yashareTheme="counter"
							
							></div> 
						<?php $frame->end(); ?>
					</div>
				</div>
				
				
				<?php $frame = $this->createFrame()->begin();?>
				<!-- COMMENTS -->
				<h2><?=GetMessage("PIMAX_FASHIONSTORE_KOMMENTARII1")?></h2>
				<?$APPLICATION->IncludeComponent(
					"bitrix:forum.topic.reviews",
					"",
					Array(
						"CACHE_TYPE" => 3600,
						"CACHE_TIME" => "A",
						"MESSAGES_PER_PAGE" => 10,
						"USE_CAPTCHA" => "Y",
						"PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
						"FORUM_ID" => $arParams['FORUM_ID'],
						"URL_TEMPLATES_READ" => "",
						"SHOW_LINK_TO_FORUM" => "N",
						"DATE_TIME_FORMAT" => "",
						"ELEMENT_ID" => $arResult['ID'],
						"IBLOCK_ID" => $arParams["IBLOCK_ID"]
					)					
				);?>
				<?php $frame->end(); ?>
			
		</div><!-- //ROW -->
	</div><!-- //CONTAINER -->
</section><!-- //BLOG BLOCK -->