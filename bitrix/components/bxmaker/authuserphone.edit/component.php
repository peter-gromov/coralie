<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */
/** @global CCacheManager $CACHE_MANAGER */

global $CACHE_MANAGER;
use Bitrix\Main\Loader;

$this->setFrameMode(true);


CJSCore::Init();
CUtil::InitJSCore('jquery');

\Bitrix\Main\Localization\Loc::loadMessages(__FILE__);


$PARTNER_COMPONENT_ID = 'BXMAKER.AUTHUSERPHONE.EDIT';
$MODULE_ID = "bxmaker.authuserphone";


if (!Loader::includeSharewareModule($MODULE_ID)) {
    ShowError(GetMessage($PARTNER_COMPONENT_ID . "_MODULE_NOT_INSTALLED"));
    return 0;
}
Loader::includeModule($MODULE_ID);

$oManager = \Bxmaker\AuthUserPhone\Manager::getInstance();

// AJAX
$app = \Bitrix\Main\Application::getInstance();
$req = $app->getContext()->getRequest();
if ($req->isPost() && check_bitrix_sessid('sessid') && ($req->getPost('component') == 'bxmaker.authuserphone.edit')) {

    $APPLICATION->RestartBuffer();

    $oUser = new CUser();
    $arResp = array(
        'response' => array(),
        'error'    => array()
    );


    do {

        if (!$req->getPost('method')) {
            $arResp['error'] = array(
                'CODE' => '',
                'MSG'  => GetMessage($PARTNER_COMPONENT_ID . '.AJAX.NEED_METHOD'),
                'MORE' => ''
            );
            break;
        }

        if (!$USER->IsAuthorized()) {
            $arResp['error'] = array(
                'CODE' => '',
                'MSG'  => GetMessage($PARTNER_COMPONENT_ID . '.AJAX.NEED_AUTH'),
                'MORE' => ''
            );
            break;
        }


        switch ($req->getPost('method')) {
            case 'setPhone': {


                if (!$req->getPost('phone')) {
                    $arResp['error'] = array(
                        'CODE' => '0',
                        'MSG'  => GetMessage($PARTNER_COMPONENT_ID . '.AJAX.METHOD_AUTH.EMPTY_PHONE'),
                        'MORE' => ''
                    );
                    break;
                }

                if (!$req->getPost('code')) {
                    $arResp['error'] = array(
                        'CODE' => '1',
                        'MSG'  => GetMessage($PARTNER_COMPONENT_ID . '.AJAX.METHOD_AUTH.EMPTY_CODE'),
                        'MORE' => ''
                    );
                    break 2;
                }


                $phone = $oManager->getPreparePhone($req->getPost('phone'));
                if (!$oManager->isValidPhone($phone)) {
                    $arResp['error'] = array(
                        'CODE' => '2',
                        'MSG'  => GetMessage($PARTNER_COMPONENT_ID . '.AJAX.METHOD_AUTH.ERROR_VALID_PHONE'),
                        'MORE' => ''
                    );
                    break 2;
                }

                if ($phone == $oManager->getPhone($USER->GetID())) {
                    $arResp['error'] = array(
                        'CODE' => '3',
                        'MSG'  => GetMessage($PARTNER_COMPONENT_ID . '.AJAX.METHOD_AUTH.ERROR_PHONE_EQUAL'),
                        'MORE' => ''
                    );
                    break 2;
                }


                if ($oManager->isValidCode($req->getPost('phone'), $req->getPost('code'))) {
                    $result = $oManager->setPhone($USER->GetID(), $req->getPost('phone'));
                    if ($result->isSuccess()) {
                        $arResp['response'] = $result->getMore();
                    } else {
                        $arError = $result->getErrors();
                        foreach ($arError as $obError) {
                            $arResp['error'] = array(
                                'CODE' => $obError->getCode(),
                                'MSG'  => $obError->getMessage(),
                                'MORE' => $obError->getMore()
                            );
                        }
                    }

                } else {
                    $arResp['error'] = array(
                        'CODE' => '4',
                        'MSG'  => GetMessage($PARTNER_COMPONENT_ID . '.AJAX.METHOD_AUTH.ERROR_VALID_CODE'),
                        'MORE' => ''
                    );
                }


                break;
            }
            case 'sendCode': {

                if (!$req->getPost('phone')) {
                    $arResp['error'] = array(
                        'CODE' => '0',
                        'MSG'  => GetMessage($PARTNER_COMPONENT_ID . '.AJAX.METHOD_AUTH.EMPTY_PHONE'),
                        'MORE' => ''
                    );
                    break;
                }

                $phone = $oManager->getPreparePhone($req->getPost('phone'));
                if (!$oManager->isValidPhone($phone)) {
                    $arResp['error'] = array(
                        'CODE' => '2',
                        'MSG'  => GetMessage($PARTNER_COMPONENT_ID . '.AJAX.METHOD_AUTH.ERROR_VALID_PHONE'),
                        'MORE' => ''
                    );
                    break 2;
                }

                if ($phone == $oManager->getPhone($USER->GetID())) {
                    $arResp['error'] = array(
                        'CODE' => '3',
                        'MSG'  => GetMessage($PARTNER_COMPONENT_ID . '.AJAX.METHOD_AUTH.ERROR_PHONE_EQUAL'),
                        'MORE' => ''
                    );
                    break 2;
                }


                $result = $oManager->sendCode($req->getPost('phone'));
                if ($result->isSuccess()) {
                    $arResp['response'] = $result->getMore();
                } else {
                    /**
                     * @var \Bxmaker\AuthUserPhone\Error $error
                     */
                    foreach ($result->getErrors() as $obError) {
                        $arResp['error'] = array(
                            'CODE' => $obError->getCode(),
                            'MSG'  => $obError->getMessage(),
                            'MORE' => $obError->getMore()
                        );
                        break;
                    }
                }
                break;
            }
            case 'getCaptcha': {
                $arResp['response'] = $oManager->getCaptchaForErrorMore();
                break;
            }
            default: {
            $arResp['error'] = array(
                'CODE' => '',
                'MSG'  => GetMessage($PARTNER_COMPONENT_ID . '.AJAX.UNDEFINED_METHOD'),
                'MORE' => ''
            );
            break;
            }
        }


    } while (false);


    header('Content-Type: application/json');
    if (!empty($arResp['error'])) {
        echo json_encode(array(
            'error' => $oManager->prepareForJson($arResp['error'])
        ));
    } else {
        echo json_encode(array(
            'response' => $oManager->prepareForJson($arResp['response'])
        ));
    }
    die();
}


$arResult['USER_IS_AUTHORIZED'] = 'N';
if($USER->IsAuthorized())
{
    $arResult['USER_IS_AUTHORIZED'] = 'Y';
    $arResult['PHONE'] = $oManager->getPhone($USER->GetID());
}

$this->IncludeComponentTemplate();


