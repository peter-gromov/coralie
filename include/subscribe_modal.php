<noindex>
<div class="box-modal" id="boxUserFirstInfo">
	
		
		<img src="/images/subscribes.jpg" />
						
		<div class="subscribe-form-wrapper">
			<?$APPLICATION->IncludeComponent(
				"bitrix:subscribe.form",
				"",
				Array(
					"USE_PERSONALIZATION" => "Y",
					"SHOW_HIDDEN" => "N",
					"PAGE" => SITE_DIR."personal/subscribe/",
					"AJAX_OPTION_STYLE" => "Y",
					"CACHE_TYPE" => "A",
					"CACHE_TIME" => "3600"
				)
			);?>
		</div>
		
		<div class="arcticmodal-close btn-return">
			<a class="btn btn-default" href="#">Вернуться</a>
		</div>
						
</div>
</noindex>