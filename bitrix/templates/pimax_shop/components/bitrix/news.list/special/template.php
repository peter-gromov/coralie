<section class="tovar_section">

	<!-- CONTAINER -->
	<div class="container">
		<h2><?=GetMessage("PIMAX_FASHIONSTORE_TRENDY_SEZONA")?></h2>

		<div class="row">
			<div class="tovar_wrapper" data-appear-top-offset='-100' data-animated='fadeInUp'>

					<?
					$i = 1;
					foreach ($arResult['ITEMS'] as $keyRow => $arItem)
					{
						?>

							<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 col-ss-12 padbot40">
								<div class="tovar_item">
									<div class="tovar_img">
										<div class="tovar_img_wrapper">
											<img class="img" src="<? echo $arItem['PREVIEW_PICTURE']['src']; ?>" alt="" />
											<img class="img_h" src="<? echo (
											!empty($arItem['PREVIEW_PICTURE_SECOND'])
												? $arItem['PREVIEW_PICTURE_SECOND']['src']
												: $arItem['PREVIEW_PICTURE']['src']
											); ?>" alt="" />
										</div>
										<div class="tovar_item_btns">
											<div class="open-project-link"><a class="open-project tovar_view" href="<?php echo SITE_DIR?>ajax/product/?ELEMENT_ID=<?php echo $arItem['ID']?>" ><?=GetMessage("PIMAX_FASHIONSTORE_PROSMOTR")?></a></div>
											<div class="open-project-link"><a class="open-project add_bag" href="<?php echo SITE_DIR?>ajax/product/?ELEMENT_ID=<?php echo $arItem['ID']?>" ><i class="fa fa-shopping-cart"></i></a></div>
										</div>
									</div>
									<div class="tovar_description clearfix">
										<a class="tovar_title" href="<? echo $arItem['DETAIL_PAGE_URL']; ?>"><? echo $arItem['NAME']; ?></a>
							<span class="tovar_price"><?php
								$frame = $this->createFrame()->begin();
								echo $arItem['MIN_PRICE']['PRINT_DISCOUNT_VALUE'];

								$frame->end();?></span>
									</div>
								</div>
							</div>
							<?php if ($i == 4){?>
						</div></div>
					<div class="row">
						<div class="tovar_wrapper" data-appear-top-offset='-100' data-animated='fadeInUp'>
							<?php $i = 1; ?>
							<?php } else {
								$i++;
							} ?>
					<?php
					}
					?>

		<?php if ($i != 4):?>
			</div></div>
		<?php endif;?>

	</div>
</section>