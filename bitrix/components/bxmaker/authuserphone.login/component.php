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

$arParams['FRAME_MODE'] = ($arParams['FRAME_MODE'] == 'N' ? false : true);

$this->setFrameMode($arParams['FRAME_MODE']);


CJSCore::Init();
//CUtil::InitJSCore('jquery');

\Bitrix\Main\Localization\Loc::loadMessages(__FILE__);


$PARTNER_COMPONENT_ID = 'BXMAKER.AUTHUSERPHONE.LOGIN';
$MODULE_ID = "bxmaker.authuserphone";


if (!Loader::includeSharewareModule($MODULE_ID)) {
    ShowError(GetMessage($PARTNER_COMPONENT_ID . "_MODULE_NOT_INSTALLED"));
    return 0;
}
Loader::includeModule($MODULE_ID);

// AJAX
$app = \Bitrix\Main\Application::getInstance();
$req = $app->getContext()->getRequest();
if ($req->isPost() && check_bitrix_sessid('sessid') && ($req->getPost('component') == 'bxmaker.authuserphone.login')) {

    $APPLICATION->RestartBuffer();

    $oManager = \Bxmaker\AuthUserPhone\Manager::getInstance();
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


        switch ($req->getPost('method')) {
            case 'auth': {

                if ($USER->IsAuthorized()) {
                    $arResp['response'] = array(
                        'MSG' => GetMessage($PARTNER_COMPONENT_ID . '.AJAX.METHOD_AUTH.OK'),
                    );
                    break 2;
                }

                if (!$req->getPost('phone')) {
                    $arResp['error'] = array(
                        'CODE' => '0',
                        'MSG'  => GetMessage($PARTNER_COMPONENT_ID . '.AJAX.METHOD_AUTH.EMPTY_PHONE'),
                        'MORE' => ''
                    );
                    break;
                }

                if (!$req->getPost('password')) {
                    $arResp['error'] = array(
                        'CODE' => '1',
                        'MSG'  => GetMessage($PARTNER_COMPONENT_ID . '.AJAX.METHOD_AUTH.EMPTY_PASSWORD'),
                        'MORE' => ''
                    );
                    break 2;
                }


                // пробуем авторизовать
                $result = $oManager->login($req->getPost('phone'), $req->getPost('password'), ($req->getPost('remember') && $req->getPost('remember') == 'Y' ? true : false));
                if ($result->isSuccess()) {
                    $arResp['response'] = $result->getMore();
                } else {
                    $arError = $result->getErrors();
                    foreach($arError as $obError)
                    {
                        $arResp['error']  = array(
                            'CODE' => $obError->getCode(),
                            'MSG'  => $obError->getMessage(),
                            'MORE' => $obError->getMore()
                        );
                    }
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
            case 'sendEmail': {

                if (!$req->getPost('phone')) {
                    $arResp['error'] = array(
                        'CODE' => '0',
                        'MSG'  => GetMessage($PARTNER_COMPONENT_ID . '.AJAX.METHOD_AUTH.EMPTY_PHONE'),
                        'MORE' => ''
                    );
                    break;
                }

                $result = $oManager->sendEmail($req->getPost('phone'));
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
            'error'  =>  $oManager->prepareForJson($arResp['error'])
        ));
    } else {
        echo json_encode(array(
            'response' => $oManager->prepareForJson($arResp['response'])
        ));
    }
    die();

}

$arResult['USER_IS_AUTHORIZED'] = ($USER->IsAuthorized() ? 'Y' : 'N');

// standard output
$this->IncludeComponentTemplate();

