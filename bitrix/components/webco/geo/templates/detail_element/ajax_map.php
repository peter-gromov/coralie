<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
				$APPLICATION->IncludeComponent("bitrix:map.google.view", ".default", array(
						"INIT_MAP_TYPE" => "MAP",
						"MAP_DATA" => serialize(array("google_lat"=>$_GET['map_1'],"google_lon"=>$_GET['map_2'],"google_scale"=>13,"PLACEMARKS" => array( 0=>array("LON"=>$_GET['map_2'],"LAT"=>$_GET['map_1'],"TEXT"=>$_GET['adres'])))),
						"MAP_WIDTH" => "100%",
						"MAP_HEIGHT" => "500",
						"CONTROLS" => array(
					0 => "ZOOM",
					1 => "MINIMAP",
					2 => "TYPECONTROL",
					3 => "SCALELINE",
						),
						"OPTIONS" => array(
					0 => "ENABLE_DBLCLICK_ZOOM",
					1 => "ENABLE_DRAGGING"
						),
						"MAP_ID" => ""
					),
					false
				);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>