<?php
	
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

session_start();

header("Content-type: text/json");
$res = array('status' => 'failed');

if (!empty($_SESSION['verification_code']) && !empty($_POST['code']) && $_SESSION['verification_code'] == $_POST['code']) {
	
	$res['status'] = 'success';
	unset($_SESSION['verification_code']);
}
echo  json_encode($res);

?>