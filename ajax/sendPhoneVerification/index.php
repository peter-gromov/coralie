<?php
	
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

session_start();

\Bitrix\Main\Loader::includeModule('bxmaker.smsnotice');

$oManager = \Bxmaker\SmsNotice\Manager::getInstance();

$code = rand(10000, 99999);

$result = $oManager->send($_POST['phone'], 'Coralie код подтверждения - '.$code);

header("Content-type: text/json");
$res = array();

/* если  смс успешно отправлено */
if($result->isSuccess())
{
	$_SESSION['verification_code'] = $code;
    /* Получение статуса отправки, подробнее в описании класса \Bxmaker\SmsNotic\Result */
    $res['status'] = $result->getResult();
}
/* иначе, если есть ошибки */
else
{
    /* вывод сообщений об ошибке, ошибках */
   $res['errors'] = $result->getErrorMessages();
}

echo  json_encode($res);

?>