<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>

<?php $frame = $this->createFrame('pimax_location', false)->begin();?>



<script type="text/javascript">
	BX.ready(function(){
		$(document).on("click", '.user-city', function(e) {	
			
				
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

<div class="geo">
<?if($_COOKIE['cookie_city'] != true){?>
	<script src="http://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU" type="text/javascript"></script>
	<i class="fa fa-map-marker"></i> <div class="user-city" id="user-city"></div>
	<script type="text/javascript">
	  window.onload = function () {
	    jQuery("#user-city").text(ymaps.geolocation.city);	
		jQuery.cookie('cookie_city', ymaps.geolocation.city,{ expires: 7, path:'/' });
	  }  
	</script>
<? } else { ?>	
	<i class="fa fa-map-marker"></i> <div class="user-city" id="user-city-cok"><?=$_COOKIE['cookie_city']?></div>
<?php }?>
</div>

<?$frame->end();?>