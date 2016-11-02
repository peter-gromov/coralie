<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


$this->setFrameMode(true);


//if ($arResult["READY"]=="Y" || $arResult["DELAY"]=="Y" || $arResult["NOTAVAIL"]=="Y" || $arResult["SUBSCRIBE"]=="Y")
//{

	$frame = $this->createFrame()->begin();

	?>

	<a class="shopping_bag_btn" href="javascript:void(0);" ><i class="fa fa-shopping-cart"></i><p><?=GetMessage("PIMAX_FASHIONSTORE_KORZINA")?></p><span><?php echo $arResult['COUNT']?></span></a>
	<div class="cart">
		<ul class="cart-items">
			<?
			if ($arResult["READY"]=="Y")
			{

				foreach ($arResult["ITEMS"] as $k => &$v)
				{
					if ($k <= 2) {
						?>

						<li class="clearfix">
							<?php if ($v['PICTURE']): ?>
								<img class="cart_item_product" src="<?php echo $v['PICTURE'] ?>" alt=""/>
							<?php endif; ?>
							<a href="<?echo $v["DETAIL_PAGE_URL"]; ?>" class="cart_item_title"><?echo $v["NAME"] ?></a>
							<span class="cart_item_price"><?echo (int)$v["QUANTITY"] ?> x <?echo $v["PRICE_FORMATED"] ?></span>
						</li>

					<?
					}
				}
			}

			?>
		</ul>
		<div class="cart_total">
			<?php if ($arResult['AMOUNT']):?>
				<div class="clearfix"><span class="cart_subtotal"><?=GetMessage("PIMAX_FASHIONSTORE_ITOGO")?><b><?php echo $arResult['AMOUNT']?></b></span></div>
				<a class="btn active" href="<?=$arParams["PATH_TO_BASKET"]?>"><?=GetMessage("PIMAX_FASHIONSTORE_V_KORZINU")?></a>
			<?php else:?>
				<div>Ваша корзина пуста!</div>
			<?php endif;?>
		</div>
	</div>

	<?php // <?= $arParams["PATH_TO_ORDER"] ?>

	<?
	$frame->beginStub(); ?>

	<a class="shopping_bag_btn" href="javascript:void(0);" ><i class="fa fa-shopping-cart"></i><p><?=GetMessage("PIMAX_FASHIONSTORE_KORZINA")?></p><span>0</span></a>

	<?php $frame->end();
//}
?>