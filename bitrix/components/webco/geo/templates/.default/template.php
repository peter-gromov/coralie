<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();
$frame = $this->createFrame('city_geo', false)->begin();
CJSCore::Init(array('fx', 'popup', 'window', 'ajax'));

if(LANG_CHARSET=="windows-1251"){								
								$_COOKIE['cookie_city'] = iconv ('utf-8', 'windows-1251', $_COOKIE['cookie_city']);
								}

if(CModule::IncludeModule("iblock"))
				$res = CIBlock::GetList(
					Array(), 
					Array(
						"CODE"=>'geo'
					), true
				);
				while($arIBlock = $res->Fetch())
				{
					$IBLOCK_ID = $arIBlock['ID'];
				}
$arSelect = Array("ID", "NAME", "PROPERTY_TEL", "PROPERTY_EMAIL", "PROPERTY_ADRESS", "PROPERTY_MAPS");
$arFilter = Array("IBLOCK_ID"=>$IBLOCK_ID, "ACTIVE"=>"Y", "NAME"=>$_COOKIE['cookie_city']);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1), $arSelect);
while($ob = $res->GetNextElement())
{
$arFields = $ob->GetFields();
$tel = $arFields["PROPERTY_TEL_VALUE"];
$email = $arFields["PROPERTY_EMAIL_VALUE"];
$adress = $arFields["PROPERTY_ADRESS_VALUE"];
$maps = $arFields["PROPERTY_MAPS_VALUE"];
$map = explode(',', $maps);
$geo = true;
}
?>	

<div id="my-city" style="display:none;">   

<div class="city-bx-input-group">

</div>

</div> 
<?
if (CModule::IncludeModule("sale"))
   $db_vars = CSaleLocation::GetList(
        array(
                "SORT" => "ASC",
                "COUNTRY_NAME_LANG" => "ASC",
                "CITY_NAME_LANG" => "ASC"
            ),
        array("LID" => LANGUAGE_ID, "CITY_NAME" => $_COOKIE['cookie_city'],),
        false,
        false,
        array()
    );
   while ($vars = $db_vars->Fetch()){
   $id_city = $vars['ID'];
   }
$db_sales = CSaleOrderUserProps::GetList(
        array("DATE_UPDATE" => "DESC"),
        array("USER_ID" => $USER->GetID())
    );
$USER_PROPS_ID = array();
while ($ar_sales = $db_sales->Fetch())
{
	$USER_PROPS_ID[] = $ar_sales['ID'];

	} 

foreach ($USER_PROPS_ID as $USER_PROPS){
	
$db_propVals = CSaleOrderUserPropsValue::GetList(array("ID" => "ASC"), Array("USER_PROPS_ID"=>$USER_PROPS, "PROP_CODE"=>'LOCATION'));
while ($arPropVals = $db_propVals->Fetch())
{
$arField = array( 
"USER_PROPS_ID" => $arPropVals['USER_PROPS_ID'], 
"ORDER_PROPS_ID" => $arPropVals['ORDER_PROPS_ID'], 
"NAME" => $arPropVals['NAME'], 
"VALUE" => $id_city 
); 
$res = CSaleOrderUserPropsValue::Update($arPropVals['ID'] , $arField);    
}	
}
?>	
<script>
	BX.ready(function(){
	$(document).on("click", '.user-city', function(e){								
	BX.ajax.insertToNode('<?=$templateFolder?>/ajax.php?TEMP=<?=$templateFolder?>', 'popup-window-content-call_city'); 
	});
	});
    window.BXDEBUG = true;
BX.ready(function(){
   var oPopup = new BX.PopupWindow('call_city', window.body, {
      autoHide : true,
      offsetTop : 1,
      offsetLeft : 0,
      lightShadow : true,
      closeIcon : true,	
	  titleBar: {content: BX.create("span", {html: '<?=GetMessage('C1'); ?>', 'props': {'className': 'access-title-bar'}})}, 
      closeByEsc : true,
      overlay: {
         backgroundColor: '#333', opacity: '80'
      }
   });
   oPopup.setContent(BX('my-city').innerHTML);
   BX.bindDelegate(
      document.body, 'click', {className: 'user-city' },
         BX.proxy(function(e){	
setTimeout(function() {		 
            if(!e)
               e = window.event;
            oPopup.show();
            return BX.PreventDefault(e);	
}, 300); 			
         }, oPopup)
   );
   
   
});
</script>
<script type="text/javascript" src="<?=$templateFolder?>/jquery.cookie.js"></script>
<div class="geo">
<?if($_COOKIE['cookie_city']!=true){?>
<script src="http://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU" type="text/javascript"></script>
<i class="fa fa-map-marker"></i> <div class="user-city" id="user-city"></div>
<script type="text/javascript">
  window.onload = function () {
      jQuery("#user-city").text(ymaps.geolocation.city);	
	jQuery.cookie('cookie_city', ymaps.geolocation.city,{ expires: 7, path:'/' });	
	
 var name = "cookie_city" // имя cookie
 var tmp = "cookie!"; // записываемое значение
 expires = new Date(); // получаем текущую дату
 expires.setTime(expires.getTime() + (1000 * 86400 * 365)); // вычисляем срок хранения cookie
 set_cookie(name, tmp, expires); // устанавливаем cookie с помощью функции set_cookie

  }  
     
	 
	 
</script>
<?}else{?>	
 <i class="fa fa-map-marker"></i> <div class="user-city" id="user-city-cok"><?=$_COOKIE['cookie_city']?></div>
<?if($geo){?>
<script>
window.onload=function(){
var phoneDok = document.getElementsByClassName('GeoPhone')[0], 
phone='<?=$tel?>';
phoneDok.innerHTML = phone;
var EmailDok = document.getElementsByClassName('GeoEmail')[0], 
Email='<?=$email?>';
EmailDok.innerHTML = Email;
var AdressDok = document.getElementsByClassName('GeoAdress')[0], 
Adress='<?=$adress?>';
AdressDok.innerHTML = Adress;
BX.ready(function(){
BX.ajax.insertToNode('<?=$templateFolder?>/ajax_map.php?map_1=<?=$map[0]?>&map_2=<?=$map[1]?>&adres=<?=$adress?>', 'GeoMaps');
});
var phoneDok = document.getElementsByClassName('GeoPhone')[1], 
phone='<?=$tel?>';
phoneDok.innerHTML = phone;
var EmailDok = document.getElementsByClassName('GeoEmail')[1], 
Email='<?=$email?>';
EmailDok.innerHTML = Email;
var AdressDok = document.getElementsByClassName('GeoAdress')[1], 
Adress='<?=$adress?>';
var phoneDok = document.getElementsByClassName('GeoPhone')[2], 
phone='<?=$tel?>';
phoneDok.innerHTML = phone;
var EmailDok = document.getElementsByClassName('GeoEmail')[2], 
Email='<?=$email?>';
EmailDok.innerHTML = Email;
var AdressDok = document.getElementsByClassName('GeoAdress')[2], 
Adress='<?=$adress?>';
}
</script>
<?}}?>
</div>



<?$frame->end();?>	

			
