<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!empty($arResult['ERROR']))
{
	echo $arResult['ERROR'];
	return false;
}

$GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/js/highloadblock/css/highloadblock.css');

//$GLOBALS['APPLICATION']->SetTitle('Highloadblock List');

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
					<? foreach ($arResult['rows'] as $row): ?>
					
						
						<?
						$url = str_replace(
							array('#ID#', '#BLOCK_ID#'),
							array($row['ID'], intval($arParams['BLOCK_ID'])),
							$arParams['DETAIL_URL']
						);
				
						?>				
					
						<li><a href="<?php echo $url?>" ><?php echo $row['UF_FILE']?></a></li>
					<? endforeach; ?>
						</ul>
					</div>
				</div><!-- //JCAROUSEL -->
			</div><!-- //CONTAINER -->
		</section><!-- //BRANDS -->