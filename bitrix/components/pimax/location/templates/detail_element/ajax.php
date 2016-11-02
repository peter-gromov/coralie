		<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
IncludeModuleLangFile(__FILE__);
if(CModule::IncludeModule("sale"))
if(CModule::IncludeModule("iblock")) ?>

<div id="pimax-location-dialog" class="tover_view_page element_fade_in">
	<div class="tover_view_header clearfix">
		<p>Выбор города</p>
		<a id="tover_view_page_close" href="javascript:void(0);">Закрыть<i>X</i></a>
	</div>
	
	<div class="dialog-content" class="clearfix">
<?
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
?>

   <form onsubmit="formSubmitLocation(); return false;"> 
  <br />
        <input id="city" name="city" class="bx-form-control" value="" size="30" autocomplete="OFF" onkeyup='PressKey(event)' />
		<div class="bx-ui-sls-clear close-input" title="Отменить выбор" style="display: block;" onClick='getObj("info").style.visibility = "hidden"'></div>
        <select id="info" class='bx-form-control' size=5 style='visibility:hidden;z-index:999;position: absolute;'
                onchange="getObj('city').value=ot=this.options[this.selectedIndex].value"
                onkeyup='PressKey2(event)' onclick='this.form.onsubmit()'
				>
        </select>
        <br />
		<select class='bx-form-control-2' size=11 
				onchange="getObj('city').value=ot=this.options[this.selectedIndex].value"
                onkeyup='PressKey2(event)' onclick='this.form.onsubmit()'>
<?
$arSelect = Array("ID", "NAME");
$arFilter = Array("IBLOCK_ID"=>$IBLOCK_ID, "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>20), $arSelect);
$index = 0;
while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();?>
  <option  value="<?=$arFields['NAME']; ?>"><?=$arFields['NAME']; ?></option>
<?
	$index++;
	if ($index == 5) break;
	
	}
?> 
		</select>
		
		<select class='bx-form-control-2' size=11 
				onchange="getObj('city').value=ot=this.options[this.selectedIndex].value"
                onkeyup='PressKey2(event)' onclick='this.form.onsubmit()'>
<?
while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();?>
  <option  value="<?=$arFields['NAME']; ?>"><?=$arFields['NAME']; ?></option>
<?}
?> 
		</select>
		
		<br class="clear" />
 <input class="btn-upper btn btn-primary checkout-page-button" type="submit" name="submit" value="Выбрать">
</form>
							
<script type="text/javascript"><!--
    var ot="", timer=0, x=-1,y=0;
    function formSubmitLocation()
    {
	    $.cookie('cookie_city', getObj('city').value,{ expires: 7, path:'/' });
	    $('.user-city').text(''+getObj('city').value+''); 
	    $('.usercity').text('' + getObj('city').value + ''); 
	    SetText();
	    
	    $('#tovar_content').animate({opacity:0}, 400,function(){
			$('#modal-body').removeClass('modal-active').hide(400);
		});
		
		document.location.reload();
    }
    
	function SetText()
	{
		document.getElementById('city').value = getObj('city').value;
	}

    function PressKey2(e){ 
        e=e||window.event;
        t=(window.event) ? window.event.srcElement : e.currentTarget; 
        if(e.keyCode==13){ 
            t=(window.event) ? window.event.srcElement : e.currentTarget; 
            t.form.onsubmit();
            return;}
        if(e.keyCode==38&&t.selectedIndex==0){ 
            getObj('city').focus();
            getObj('info').style.visibility = 'hidden'; 
        }
    }
    function pageX(elem) {
        return elem.offsetParent ?
            elem.offsetLeft + pageX( elem.offsetParent ) :
            elem.offsetLeft;
    }
    function pageY(elem) {
        return elem.offsetParent ?
            elem.offsetTop + pageY( elem.offsetParent ) :
            elem.offsetTop;
    }

    function PressKey(e){
        e=e||window.event;
        t=(window.event) ? window.event.srcElement : e.currentTarget; 
        g=getObj('info');

        if(e.keyCode==40){g.focus();g.selectedIndex=0;return;}
        if(ot==t.value)return;
        ot=t.value;
        if(timer){clearTimeout(timer);timer=0;}
        if(ot.length<3){
            getObj('info').style.visibility = 'hidden';
            return;}
        timer=window.setTimeout('Load()',1000);  
    }

    function Load(){
        timer=0;
        o=getObj('info');
        o.options.length=0;
        ajaxLoad('info', '<?=$_GET['TEMP']?>/city_base.php?city_name='+ot, '','','');
        o.style.visibility='visible';
    }
    getObj('city').focus();

    function getObj(objID)
    {if (document.getElementById) {return document.getElementById(objID);}
    else if (document.all) {return document.all[objID];}
    else if (document.layers) {return document.layers[objID];}
    }

    function ajaxLoad(obj,url,defMessage,post,callback){
        var ajaxObj;
        if (defMessage) document.getElementById(obj).innerHTML=defMessage;
        if(window.XMLHttpRequest){
            ajaxObj = new XMLHttpRequest();
        } else if(window.ActiveXObject){
            ajaxObj = new ActiveXObject("Microsoft.XMLHTTP");
        } else {
            return;
        }
        ajaxObj.open ((post?'POST':'GET'), url);
        if (post&&ajaxObj.setRequestHeader)
            ajaxObj.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=windows-1251;");

        ajaxObj.onreadystatechange = ajaxCallBack(obj,ajaxObj,(callback?callback:null));
        ajaxObj.send(post);
        return false;
    }

    function updateObj(obj, data, bold, blink){
        if(bold)data=data.bold();
        if(blink)data=data.blink();
        document.getElementById(obj).innerHTML = data; 
    }

    function ajaxCallBack(obj, ajaxObj, callback){
        return function(){
            if(ajaxObj.readyState == 4){
                if(callback) if(!callback(obj,ajaxObj))return;
                if (ajaxObj.status==200)
                    updateObj(obj, ajaxObj.responseText);
                else updateObj(obj, ajaxObj.status+' '+ajaxObj.statusText,1,1);
            }
        }}


    //-->
</script>


	</div>
		

</div>