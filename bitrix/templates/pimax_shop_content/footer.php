<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
?>
</div></div></div>
</section>

<!-- FOOTER -->
<footer>

    <!-- CONTAINER -->
    <div class="container" data-animated='fadeInUp'>

        <!-- ROW -->
        <div class="row">

            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 col-ss-12 padbot30">
                <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/company_contacts.php"), false);?>
            </div>

            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 col-ss-12 padbot30">
                <h4><?=GetMessage("PIMAX_FASHIONSTORE_INFORMACIA")?></h4>
                <?$APPLICATION->IncludeComponent("bitrix:menu", "footer_menu", array(
                    "ROOT_MENU_TYPE" => "top_inner",
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
            </div>

            <div class="respond_clear_480"></div>

            <div class="col-lg-4 col-md-4 col-sm-6 padbot30">
                <h4><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/about_title.php"), false);?></h4>
                <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/company_about.php"), false);?>
            </div>

            <div class="respond_clear_768"></div>

            <div class="col-lg-4 col-md-4 padbot30">
                <h4><?=GetMessage("PIMAX_FASHIONSTORE_RASSYLKA")?></h4>

                <?$APPLICATION->IncludeComponent(
                    "bitrix:subscribe.form",
                    "",
                    Array(
                        "USE_PERSONALIZATION" => "Y",
                        "SHOW_HIDDEN" => "N",
                        "PAGE" => SITE_DIR."personal/subscribe/",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "3600"
                    )
                );?>

                <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/social.php"), false);?>

            </div>
        </div><!-- //ROW -->
    </div><!-- //CONTAINER -->

    <!-- COPYRIGHT -->
    <div class="copyright">

        <!-- CONTAINER -->
        <div class="container clearfix">
            <div class="foot_logo">Copyright <?php echo date("Y")?> by Coralie Shop</div>

            <div class="copyright_inf">
	            <a style="margin-right: 80px;" href="/map/">Карта сайта</a>
                <?php /*<div class="pi-footer">
				            <a target="_blank" href="http://ipimax.ru">
				                разработка сайта<br>
				                pimax interactive
				            </a>
				        </div> |
                <a class="back_top" href="javascript:void(0);" ><?=GetMessage("PIMAX_FASHIONSTORE_NAVERH")?><i class="fa fa-angle-up"></i></a> */ ?>
            </div>
        </div><!-- //CONTAINER -->
    </div><!-- //COPYRIGHT -->
</footer><!-- //FOOTER -->
</div><!-- //PAGE -->
</div>

<!-- TOVAR MODAL CONTENT -->
<div id="modal-body" class="clearfix">
    <div id="tovar_content"></div>
    <div class="close_block"></div>
</div><!-- TOVAR MODAL CONTENT -->


<div style="display: none;">
  <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/subscribe_modal.php"), false);?>
</div>

<script>
(function($) {
	$(function() {
	
	  // Проверим, есть ли запись в куках о посещении посетителя
	  // Если запись есть - ничего не делаем
	  if (!$.cookie('was')) {
	
	    // Покажем всплывающее окно
	    $('#boxUserFirstInfo').arcticmodal({
	      closeOnOverlayClick: true,
	      closeOnEsc: true
	    });
	
	  }
	
	  // Запомним в куках, что посетитель к нам уже заходил
	  $.cookie('was', true, {
	    expires: 365,
	    path: '/'
	  });
	
	})
})(jQuery)
</script>	

<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/counters.php"), false);?>
</body>
</html>