<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Страница не найдена");?>

<section class="breadcrumb parallax margbot30"></section>
<section class="page_header">	
	<div class="container">
		<h3 class="pull-left"><b><?=$APPLICATION->ShowTitle(false);?></b></h3>
	</div>
</section>

<section class="about_us_info">
	<div class="container">

		<p>Страница, которую вы запросили, не существует.</p>
		<p>Воспользуйтесь поиском по сайту, либо вернитесь на главную страницу и начните с начала.</p>
	</div><!-- //CONTAINER -->
</section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>