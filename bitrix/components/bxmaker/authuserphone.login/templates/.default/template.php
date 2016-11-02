<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$CPN = 'bxmaker.authuserphone.login';

if ($arParams['FRAME_MODE'] == false) {
    $this->setFrameMode(false);
}
?>
    <div class="c-bxmaker-authuserphone_login-default-box" id="c-bxmaker-authuserphone_login-default-box">
        <span class="cbaup_btn_reg"><?= GetMessage($CPN . 'BTN_REGISTER'); ?></span>

        <?if (\Bxmaker\AuthUserPhone\Manager::getInstance()->isExpired()): ?>
            <p style="color:red; padding:0;margin:0 ;"><?= GetMessage($CPN . 'DEMO_EXPIRED'); ?></p>
        <? endif; ?>
        



        <?
        if ($arParams['FRAME_MODE']) {
            $frame = $this->createFrame()->begin();
            $frame->setAnimation(true);
        }
        ?>


        <? if ($arResult['USER_IS_AUTHORIZED'] == 'Y'): ?>
            <div class="msg success" style="margin-bottom:0;">
                <?= GetMessage($CPN . 'USER_IS_AUTHORIZED'); ?>
            </div>
        <? else: ?>

            <div class="msg ">

            </div>

            <div class="cbaup_row">
                <input type="text" name="phone" class="phone" placeholder="<?= GetMessage($CPN . 'INPUT_PHONE'); ?>"/>
            </div>
            <div class="cbaup_row">
                <input type="password" name="password" class="password" placeholder="<?= GetMessage($CPN . 'INPUT_PASSWORD'); ?>"/>
            <span class="btn_show_password" title="<?= GetMessage($CPN . 'BTN_SHOW_PASSWORD'); ?>" data-title-show="<?= GetMessage($CPN . 'BTN_SHOW_PASSWORD'); ?>"
                  data-title-hide="<?= GetMessage($CPN . 'BTN_HIDE_PASSWORD'); ?>"></span>
            </div>

            <div class="cbaup_row captcha">
                <?
                /*
                <input type="hidden" name="captcha_sid" value="0b853532ea27dba6a71666bb89ab6760"/>
                <img src="/bitrix/tools/captcha.php?captcha_sid=0b853532ea27dba6a71666bb89ab6760" title="<?= GetMessage($CPN . 'UPDATE_CAPTCHA_IMAGE');?>" alt=""/>
                <span class="btn_captcha_reload" title="<?= GetMessage($CPN . 'UPDATE_CAPTCHA_IMAGE');?>"></span>
                <input type="text" name="captcha_word" class="captcha_word" placeholder="<?= GetMessage($CPN . 'INPUT_CAPTHCA');?>"/>
                */
                ?>
            </div>

            <div class="cbaup_row mini ">
                <input type="checkbox" name="remember" id="cbaup_remember" value="Y"/>
                <label for="cbaup_remember"><?= GetMessage($CPN . 'REMEMBER_ME'); ?></label>
            </div>

            <div class="cbaup_row ">
                <span class="cbaup_btn_link"><?= GetMessage($CPN . 'BTN_SEND_CODE'); ?></span>
            </div>

            <?/*
        <div class="cbaup_row ">
            <span class="cbaup_btn_send_email" ><?= GetMessage($CPN . 'BTN_SEND_EMAIL');?></span>
        </div>
        */
            ?>
            <div class="cbaup_row btn_box">
                <div class="cbaup_btn "><?= GetMessage($CPN . 'BTN_INTER'); ?></div>
            </div>

        <?endif; ?>


        <?
        if ($arParams['FRAME_MODE']) {

            $frame->beginStub();
            ?>
            <div class="msg success" style="margin-bottom:0;">
                <?= GetMessage($CPN . 'USER_IS_AUTHORIZED'); ?>
            </div>
            <?

            $frame->end();
        }
        ?>

    </div>

    <script type="text/javascript">
        BX.message({
            'UPDATE_CAPTCHA_IMAGE': '<?= GetMessage($CPN . 'UPDATE_CAPTCHA_IMAGE');?>',
            'INPUT_CAPTHCA': '<?= GetMessage($CPN . 'INPUT_CAPTHCA');?>',
            'REGISTER_INFO': '<?= GetMessage($CPN . 'REGISTER_INFO');?>',
            'BTN_SEND_CODE': '<?= GetMessage($CPN . 'BTN_SEND_CODE');?>',
            'BTN_SEND_EMAIL': '<?= GetMessage($CPN . 'BTN_SEND_EMAIL');?>',
            'BTN_SEND_CODE_TIMEOUT': '<?= GetMessage($CPN . 'BTN_SEND_CODE_TIMEOUT');?>'
        });
    </script>
<?
