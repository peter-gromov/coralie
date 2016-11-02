<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	
	$this->setFrameMode(true);
?>

<!-- BREADCRUMBS -->
<section class="breadcrumb parallax margbot30"></section>
<!-- //BREADCRUMBS -->

<!-- PAGE HEADER -->
<section class="page_header">
	
	<!-- CONTAINER -->
	<div class="container">
		<h3 class="pull-left"><b><?=GetMessage("PIMAX_FASHIONSTORE_BRENDY")?></b></h3>
		
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
						<script type="text/javascript" src="//yandex.st/share/share.js"
						charset="utf-8"></script>
						<div class="yashare-auto-init" data-yashareL10n="ru"
						 data-yashareQuickServices="yaru,vkontakte,facebook,twitter,odnoklassniki,moimir,gplus" data-yashareTheme="counter"
						
						></div> 
					</div>
				</div>
							
			
		</div><!-- //ROW -->
	</div><!-- //CONTAINER -->
</section><!-- //BLOG BLOCK -->