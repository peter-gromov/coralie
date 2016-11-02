<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>

<?php $frame = $this->createFrame('pimax_location', false)->begin();?>



<script type="text/javascript">
	BX.ready(function(){
		$(document).on("click", '.usercity', function(e) {	
			
				
			$('#modal-body').addClass('modal-active');
			$('#tovar_content').html('');

			$('#tovar_content').animate({opacity:0},function(){

				$.ajax({
					url: '/bitrix/components/pimax/location/templates/.default/ajax.php'
				}).done(function(data){


					$('#tovar_content').append(data);

				
				});

				$('#tovar_content').animate({opacity:1});
			});				
			
		});
	});
</script>

<div class="geo2 col-md-12">
<?if($_COOKIE['cookie_city']!=true){?>
<script src="http://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU" type="text/javascript"></script>
 <div class="col-md-1 ic-city"><i class="fa fa-truck"></i></div> Доставка в город <div class="usercity col-md-11" id="usercity-cok"><div class="" id="usercity"></div></div>
<script type="text/javascript">
  window.onload = function () {
      jQuery("#usercity").text(ymaps.geolocation.city);	
	jQuery.cookie('cookie_city', ymaps.geolocation.city,{ expires: 7, path:'/' });	
	
 var name = "cookie_city" // имя cookie
 var tmp = "cookie!"; // записываемое значение
 expires = new Date(); // получаем текущую дату
 expires.setTime(expires.getTime() + (1000 * 86400 * 365)); // вычисляем срок хранения cookie
 set_cookie(name, tmp, expires); // устанавливаем cookie с помощью функции set_cookie

  }  
     
	 
	 
</script>
<?}else{?>	
	<i class="fa fa-truck"></i> Доставка в город <span class="usercity" id="usercity-cok"><?=($_COOKIE['cookie_city'])?></span>

<?php }?>
</div>

<div class="col-md-12">	
   <?
   $db_vars = CSaleLocation::GetList(
        array(
                "SORT" => "ASC",
                "COUNTRY_NAME_LANG" => "ASC",				
                "CITY_NAME_LANG" => "ASC"
            ),
        array("LID" => LANGUAGE_ID, "CITY_NAME" => $_COOKIE['cookie_city'], ),
        false,
        false,
        array()
    );
   while ($vars = $db_vars->Fetch()):
      ?>
	  <?if($vars["CITY_NAME"]==true){
		  
		  $ID = $vars["ID"];
		  
	  }?>
      <?
   endwhile;
   ?>

<?php if ($ID == 32):?>
	Курьерская доставка с примеркой - 200 руб, 1-2 рабочих дня<br />
	Самовывоз со склада в СПб с примеркой - бесплатно, ежедневно
<?php else:?>
	Почтовое отправление - 200 руб (бесплатно при заказе от 2000), от 7 дней <br />
	Ускоренное отправление - 400 руб (200 руб. при заказе от 2000), от 5 дней<br />
	Экспресс-доставка - 600 руб, 1-3 дня
<?php endif;?>

<?
	
	
	
/*	
	
if ($ID == 32) {

	$db_dtype = CSaleDelivery::GetList(
	    array(
	            "SORT" => "ASC",
	            "NAME" => "ASC"
	        ),
	    array(
	            "LID" => SITE_ID,
	            "ACTIVE" => "Y",
	            "LOCATION" => $ID
	        ),
	    false,
	    false,
	    array()
	);
} else {
	
	$arOrder = array(
	  "WEIGHT" => "1000", // вес заказа в граммах
	  "PRICE" => "1000", // стоимость заказа в базовой валюте магазина
	  "LOCATION_FROM" => COption::GetOptionInt('sale', 'location'), // местоположение магазина
	  "LOCATION_TO" => $ID, // местоположение доставки
	  "ITEMS" => array(
		  array(
			  "ID" => "temp",
			  "WEIGHT" =>1000,
			  "PRICE" => 1000,
			  "QUANTITY" => 1,
			  "DIMENSIONS" => array(100, 100, 100)
			  
		  )
	  )
	);
	
	$currency = CSaleLang::GetLangCurrency(SITE_ID);
	
	$arHandler = CSaleDeliveryHandler::GetBySID('rus_post')->GetNext();
	
	//echo '<pre>', print_r($arHandler), '</pre>';
	
	$delivery_price = 0;
	
	$arProfiles = CSaleDeliveryHandler::GetHandlerCompability($arOrder, $arHandler);
	  if (is_array($arProfiles) && count($arProfiles) > 0)
	  {
	    $arProfiles = array_keys($arProfiles);
	    $arReturn = CSaleDeliveryHandler::CalculateFull(
	      'rus_post', // идентификатор службы доставки
	      $arProfiles[1], // идентификатор профиля доставки
	      $arOrder, // заказ
	      $currency // валюта, в которой требуется вернуть стоимость
	    );
	    
	   
	
	    if ($arReturn["RESULT"] == "OK")
	    {
	      $delivery_price = CurrencyFormat($arReturn["VALUE"], $currency);
	      
	    }
	  }
	
	$db_dtype = CSaleDelivery::GetList(
	    array(
	            "SORT" => "ASC",
	            "NAME" => "ASC"
	        ),
	    array(
	            "ID" => 4
	        ),
	    false,
	    false,
	    array()
	);

}

if ($ar_dtype = $db_dtype->Fetch())
{
   do
   {
      echo $ar_dtype["NAME"]." - стоимость ".CurrencyFormat($ar_dtype["PRICE"], $ar_dtype["CURRENCY"])."<br>";
   }
   while ($ar_dtype = $db_dtype->Fetch());
}
else if(!empty($arHandler)) 
{
	echo $arHandler['NAME'].'<br />';
}
else
{
   echo "Доступных способов доставки не найдено";
   if ($delivery_price) {
	   echo ' - стоимость '.$delivery_price;
   }
   
   echo '<br />';
}*/
?>
</div>

<?$frame->end();?>