<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
CUtil::InitJSCore();
CJSCore::Init(array("fx", "viewer"));

$curPage = $APPLICATION->GetCurPage(true);

$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/components/bitrix/catalog.element/popup/script.js");
?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<?php
	$APPLICATION->ShowMeta("robots", false, true);
	$APPLICATION->ShowMeta("keywords", false, true);
	$APPLICATION->ShowMeta("description", false, true);
	$APPLICATION->ShowCSS(true, true);


	?>
	<title><?$APPLICATION->ShowTitle()?></title>

	<link rel="shortcut icon" type="image/png" href="<?=SITE_DIR?>favicon.png">

	<!-- CSS -->
	<link href="<?php echo SITE_TEMPLATE_PATH?>/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo SITE_TEMPLATE_PATH?>/css/flexslider.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo SITE_TEMPLATE_PATH?>/css/fancySelect.css" rel="stylesheet" media="screen, projection" />
	<link href="<?php echo SITE_TEMPLATE_PATH?>/css/animate.css" rel="stylesheet" type="text/css" media="all" />
	<!--link href="<?php echo SITE_TEMPLATE_PATH?>/js/easyzoom/easyzoom.css?v1" rel="stylesheet" type="text/css" /-->
	<link href="<?php echo SITE_TEMPLATE_PATH?>/css/style.css?v3.0" rel="stylesheet" type="text/css" />
	<link href="<?php echo SITE_TEMPLATE_PATH?>/css/jquery.arcticmodal-0.3.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo SITE_TEMPLATE_PATH?>/css/themes/simple.css" rel="stylesheet" type="text/css" />
	<!-- FONTS -->
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
	<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

	<!-- SCRIPTS -->
	<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<!--[if IE]><html class="ie" lang="en"> <![endif]-->

	<script src="<?php echo SITE_TEMPLATE_PATH?>/js/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo SITE_TEMPLATE_PATH?>/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?php echo SITE_TEMPLATE_PATH?>/js/jquery.sticky.js" type="text/javascript"></script>
	<script src="<?php echo SITE_TEMPLATE_PATH?>/js/parallax.js" type="text/javascript"></script>
	<script src="<?php echo SITE_TEMPLATE_PATH?>/js/jquery.flexslider.js" type="text/javascript"></script>
	<script src="<?php echo SITE_TEMPLATE_PATH?>/js/jquery.jcarousel.js" type="text/javascript"></script>
	<script src="<?php echo SITE_TEMPLATE_PATH?>/js/jqueryui.custom.min.js" type="text/javascript"></script>
	<script src="<?php echo SITE_TEMPLATE_PATH?>/js/fancySelect.js"></script>
	<script src="<?php echo SITE_TEMPLATE_PATH?>/js/animate.js" type="text/javascript"></script>
	<!--script src="<?php echo SITE_TEMPLATE_PATH?>/js/easyzoom/easyzoom.js?v9" type="text/javascript"></script-->
	<script src="<?php echo SITE_TEMPLATE_PATH?>/js/elevatezoom/jquery.elevatezoom.js?v56" type="text/javascript"></script>
	<script src="<?php echo SITE_TEMPLATE_PATH?>/js/jquery.arcticmodal-0.3.min.js"></script>	
	<script src="<?php echo SITE_TEMPLATE_PATH?>/js/masked.js?v82" type="text/javascript"></script>


	<script src="<?php echo SITE_TEMPLATE_PATH?>/js/myscript.js?v82" type="text/javascript"></script>

	<script src="<?php echo SITE_TEMPLATE_PATH?>/js/jquery.easing.js"></script>
	<script src="<?php echo SITE_TEMPLATE_PATH?>/js/jquery.mousewheel.js"></script>
	<script src="//yandex.st/jquery/cookie/1.0/jquery.cookie.min.js"></script>
	

	<?php
	$APPLICATION->ShowHeadStrings();
	$APPLICATION->ShowHeadScripts();

	?>

	<script>
		if (top != self) top.location.replace(self.location.href);
	</script>
	
</head>
<body>
<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<div>
	
	<!-- PAGE -->
	<div id="page">
		<!-- HEADER -->
		<header>
			
			<!-- TOP INFO -->
			<div class="top_info">
				
				<!-- CONTAINER -->
				<div class="container clearfix">
					<?$APPLICATION->IncludeComponent("bitrix:menu", "top_menu", array(
							"ROOT_MENU_TYPE" => "top",
							"MENU_CACHE_TYPE" => "A",
							"MENU_CACHE_TIME" => "36000000",
							"MENU_CACHE_USE_GROUPS" => "Y",
							"MENU_THEME" => "site",
							"CACHE_SELECTED_ITEMS" => "N",
							"MENU_CACHE_GET_VARS" => array(
							),
							"MAX_LEVEL" => "1",
							"CHILD_MENU_TYPE" => "left",
							"USE_EXT" => "N",
							"DELAY" => "N",
							"ALLOW_MULTI_SELECT" => "N",
						),
						false
					);?>
					
					<div class="phone_top">
					<?$APPLICATION->IncludeComponent(
	"pimax:location",
	"",
	Array(
		"COMPONENT_TEMPLATE" => ".default"
	)
);?>
					</div>
				</div><!-- //CONTAINER -->
			</div><!-- TOP INFO -->
			
			
			<!-- MENU BLOCK -->
			<div class="menu_block">
			
				<!-- CONTAINER -->
				<div class="container clearfix">
					
					<!-- LOGO -->
					<div class="logo">
						<a href="<?php echo SITE_DIR?>" ><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/company_name.php"), false);?></a>
					</div><!-- //LOGO -->
					
					
					<!-- SEARCH FORM -->
					<div class="top_search_form">
						<a class="top_search_btn" href="javascript:void(0);" ><i class="fa fa-search"></i></a>
						<form method="get" action="<?php echo SITE_DIR?>search/">
							<input type="text" name="q" value="<?=GetMessage("PIMAX_FASHIONSTORE_POISK")?>" onFocus="if (this.value == '<?=GetMessage("PIMAX_FASHIONSTORE_POISK1")?>') this.value = '';" onBlur="if (this.value == '') this.value = '<?=GetMessage("PIMAX_FASHIONSTORE_POISK2")?>') this.value = '';" />
						</form>
					</div><!-- SEARCH FORM -->
					
					
					<!-- SHOPPING BAG -->
					<div id="shopping-basket-top" class="shopping_bag">
						<?$APPLICATION->IncludeComponent(
							"bitrix:sale.basket.basket.small",
							".default",
							Array(
								"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
								"PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
								"SHOW_DELAY" => "N",
								"SHOW_NOTAVAIL" => "N",
								"SHOW_SUBSCRIBE" => "N"
							)
						);?>						
					</div><!-- //SHOPPING BAG -->
					
									
					
					<!-- MENU -->
					<?$APPLICATION->IncludeComponent("bitrix:menu", "catalog_horizontal", array(
								"ROOT_MENU_TYPE" => "left",
								"MENU_CACHE_TYPE" => "A",
								"MENU_CACHE_TIME" => "36000000",
								"MENU_CACHE_USE_GROUPS" => "Y",
								"MENU_THEME" => "site",
								"CACHE_SELECTED_ITEMS" => "N",
								"MENU_CACHE_GET_VARS" => array(
								),
								"MAX_LEVEL" => "3",
								"CHILD_MENU_TYPE" => "left",
								"USE_EXT" => "Y",
								"DELAY" => "N",
								"ALLOW_MULTI_SELECT" => "N",
							),
							false
						);?>
						
				</div><!-- //MENU BLOCK -->
			</div><!-- //CONTAINER -->
		</header><!-- //HEADER -->
		
		