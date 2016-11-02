<!-- NEW ARRIVALS -->
<section class="new_arrivals padbot50">

	<!-- CONTAINER -->
	<div class="container">
		<h2><?=GetMessage("PIMAX_FASHIONSTORE_NOVYE_POSTUPLENIA")?></h2>

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
					$boolFirst = true;
					$arRowIDs = array();
					foreach ($arResult['ITEMS'] as $keyRow => $arItem)
					{
						?>

							<li>
								<!-- TOVAR -->
								<div class="tovar_item_new">
									<div class="tovar_img">
										<img src="<? echo $arItem['PREVIEW_PICTURE']['src']; ?>" alt="" />
										<div class="open-project-link"><a class="open-project tovar_view" href="<?php echo SITE_DIR?>ajax/product/?ELEMENT_ID=<?php echo $arItem['ID']?>" ><?=GetMessage("PIMAX_FASHIONSTORE_PROSMOTR")?></a></div>
									</div>
									<div class="tovar_description clearfix">
										<a class="tovar_title" href="<? echo $arItem['DETAIL_PAGE_URL']; ?>" ><? echo $arItem['NAME']; ?></a>
						<span class="tovar_price"><?php
							$frame = $this->createFrame()->begin();
							echo $arItem['MIN_PRICE']['PRINT_DISCOUNT_VALUE'];
							$frame->end();?></span>
									</div>
								</div><!-- //TOVAR -->
							</li>
					<?php
					}
					?>
				</ul></div></div></div></section>