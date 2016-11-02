<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?>
	<p><b>Телефон:</b> +7 (495) 123 45 67<br>
		<b>Адрес:</b> г. Москва, Кремль, дом. 1<br></p>


	<iframe width="640" height="490" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2245.3729660932454!2d37.617498999999995!3d55.752022999999994!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46b54a50b315e573%3A0xa886bf5a3d9b2e68!2z0JzQvtGB0LrQvtCy0YHQutC40Lkg0JrRgNC10LzQu9GM!5e0!3m2!1sru!2sru!4v1417002873582"></iframe><br><a href="https://www.google.ru/maps/place/%D0%9C%D0%BE%D1%81%D0%BA%D0%BE%D0%B2%D1%81%D0%BA%D0%B8%D0%B9+%D0%9A%D1%80%D0%B5%D0%BC%D0%BB%D1%8C/@55.752023,37.617499,17z/data=!3m1!4b1!4m2!3m1!1s0x46b54a50b315e573:0xa886bf5a3d9b2e68?hl=ru" style="color:#0000FF;text-align:left">Просмотреть увеличенную карту</a>

	<h2>Задать вопрос</h2>
<?$APPLICATION->IncludeComponent(
	"bitrix:main.feedback",
	".default",
	Array(
		"USE_CAPTCHA" => "Y",
		"OK_TEXT" => "Спасибо, ваше сообщение принято.",
		"EMAIL_TO" => "sale@coralie.ru",
		"REQUIRED_FIELDS" => array(),
		"EVENT_MESSAGE_ID" => array()
	)
);?><br />
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php")?>