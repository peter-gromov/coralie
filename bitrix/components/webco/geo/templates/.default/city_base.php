<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if(CModule::IncludeModule("sale"))
?>
   <?
   $db_vars = CSaleLocation::GetList(
        array(
                "SORT" => "ASC",
                "COUNTRY_NAME_LANG" => "ASC",				
                "CITY_NAME_LANG" => "ASC"
            ),
        array("LID" => LANGUAGE_ID, "%CITY_NAME" => $_GET['city_name'], ),
        false,
        false,
        array()
    );
   while ($vars = $db_vars->Fetch()):
      ?>
	  <?if($vars["CITY_NAME"]==true){?>

	 <option  value="<?= $vars["CITY_NAME"]?>"><?= $vars["CITY_NAME"]?>(<?= $vars["REGION_NAME"]?>)</option>

	  <?}?>
      <?
   endwhile;
   ?>а
						
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>