;(function(){

    console.log('go');

    if (window.frameCacheVars !== undefined)
    {
        BX.addCustomEvent("onFrameDataReceived" , function(json) {
            Working();
        });
    } else {
        BX.ready(function() {
            Working();
        });
    }


    function Working(){
        if(!!window.jQuery == false)
        {
            console.log('bxmaker.authuserphone.login - need jQuery');
            return true;
        }

        jQuery(document).ready(function () {
            $('.c-bxmaker-authuserphone_login-default-box').each(function () {

                console.log('bxmaker.authuserphone.login - start');
                 new BxmakerAuthUserphone(jQuery(this), jQuery);
            })
        });

    }


    function BxmakerAuthUserphone(b, $) {
        if (b == undefined || b.hasClass('js_init_complete')) {
            return false;
        }

        var self = this, box = b, msgBox = box.find('.msg');

        box.addClass('js_init_complete');

        // show errors and messages
        self.showMsg = function (msg, error) {
            var msg = msg || null,
                error = error || false;

            if (!!msgBox === false) return;
            msgBox.removeClass('error success').empty();

            if (msg) {
                if (error) msgBox.addClass('error').html(msg);
                else msgBox.addClass('success').html(msg);
            }
        };

        // показываем капчу
        self.showCaptcha = function(param){
            var cb = box.find('.cbaup_row.captcha');

            param.CAPTCHA_SID = param.CAPTCHA_SID || '';
            param.CAPTCHA_SRC = param.CAPTCHA_SRC || '';

            if(!cb.find('input[name="captcha_sid"]').length)
            {
                var html = '<input type="hidden" name="captcha_sid" value="' + param.CAPTCHA_SID + '"/>' +
                    '<img src="' + param.CAPTCHA_SRC + '" title="' + BX.message('UPDATE_CAPTCHA_IMAGE') +'" alt=""/>' +
                    '<span class="btn_captcha_reload" title="' + BX.message('UPDATE_CAPTCHA_IMAGE') + '"></span>' +
                    '<input type="text" name="captcha_word" class="captcha_word" placeholder="' + BX.message('INPUT_CAPTHCA') + '"/>';

                cb.append(html).fadeIn(300);
            }
            else
            {
                cb.find('input[name="captcha_sid"]').val(param.CAPTCHA_SID);
                cb.find('img').attr('src',param.CAPTCHA_SRC);
            }
        };



        //registr
        box.find('.cbaup_btn_reg').on("click", function(){
            self.showMsg(BX.message('REGISTER_INFO'));
        });

        // btn show password
        box.find('.btn_show_password').on("click", function(){
            var btn = $(this);
            if(btn.hasClass("active"))
            {
                btn.removeClass('active').attr('title', btn.attr('data-title-show'));
                btn.parent().find('input[name="password"]').prop('type', 'password');
            }
            else
            {
                btn.addClass('active').attr('title', btn.attr('data-title-hide'));
                btn.parent().find('input[name="password"]').prop('type', 'text');
            }
        });

        // btn enter
        box.find(".cbaup_btn").on("click", function () {
            var btn = $(this);

            if (btn.hasClass("preloader")) return false;
            btn.addClass("preloader");

            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: {
                    component: 'bxmaker.authuserphone.login',
                    sessid: BX.bitrix_sessid(),
                    method: 'auth',
                    phone: box.find('input[name="phone"]').val(),
                    password: box.find('input[name="password"]').val(),
                    remember: box.find('input[name="remember"]:checked').val(),
                    captcha_sid : box.find('input[name="captcha_sid"]').val(),
                    captcha_word : box.find('input[name="captcha_word"]').val()
                },
                error: function (r) {
                    self.showMsg('Error connect to server!', true);
                    btn.removeClass("preloader");
                },
                success: function (r) {
                    if (!!r.response) {
                        self.showMsg(r.response.MSG);

                        if(!!r.response.REDIRECT)
                        {
                            location.href = r.response.REDIRECT;
                        }
                        else
                        {
                            location.reload();
                        }
                    }
                    else if (!!r.error) {
                        self.showMsg(r.error.MSG, true);

                        //captcha
                        if(!!r.error.MORE.CAPTCHA_SID)
                        {
                            self.showCaptcha(r.error.MORE);
                        }

                        if(!!r.error.MORE.EMAIL_RESTORE)
                        {
                            var btn_send_code = box.find('.cbaup_btn_link');
                            if(btn_send_code.length && !box.find('.cbaup_btn_send_email').length)
                            {
                                var btn_parent = btn_send_code.parent();
                                var btn_send_email = $('<div class="cbaup_row "><span class="cbaup_btn_send_email" >' + BX.message('BTN_SEND_EMAIL') + '</span></div>');
                                btn_send_email.insertAfter(btn_parent);
                                //btn_parent.hide();
                            }
                        }
                    }
                    btn.removeClass("preloader");
                }
            });
        });

        // btn send code
        box.find('.cbaup_btn_link').on("click", function () {
            var btn = $(this);

            if (btn.hasClass('preloader') || btn.hasClass('timeout')) return false;
            btn.addClass('preloader');

            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: {
                    component: 'bxmaker.authuserphone.login',
                    sessid: BX.bitrix_sessid(),
                    method: 'sendCode',
                    phone: box.find('input[name="phone"]').val()
                },
                error: function (r) {
                    self.showMsg('Error connect to server!', true);
                    btn.removeClass("preloader");
                },
                success: function (r) {

                    if (!!r.response) {
                        self.showMsg(r.response.MSG);

                        btn.removeClass("preloader");

                        if(!!r.response.TIME)
                        {
                            var timeout =  ( !!r.response.TIME ? r.response.TIME :  59);

                            // индикатор
                            var smsInterval = setInterval(function(){
                                if(--timeout > 0)
                                {
                                    btn.text( BX.message('BTN_SEND_CODE_TIMEOUT').replace(/#TIMEOUT#/, timeout ) );
                                }
                                else
                                {
                                    clearInterval(smsInterval);
                                    btn.text(BX.message('BTN_SEND_CODE'));
                                    btn.removeClass("timeout");
                                }
                            }, 1000);

                            //сразу отображаем
                            btn.text( BX.message('BTN_SEND_CODE_TIMEOUT').replace(/#TIMEOUT#/, timeout ) ).addClass('timeout');
                        }
                    }
                    else if (!!r.error) {

                        self.showMsg(r.error.MSG, true);

                        btn.removeClass("preloader");

                        if(!!r.error.MORE && !!r.error.MORE.TIME)
                        {
                            var smsInterval = setInterval(function(){
                                if(--timeout > 0)
                                {
                                    btn.text( BX.message('BTN_SEND_CODE_TIMEOUT').replace(/#TIMEOUT#/, timeout ) );
                                }
                                else
                                {
                                    clearInterval(smsInterval);
                                    btn.text(BX.message('BTN_SEND_CODE'));
                                    btn.removeClass("timeout");
                                }
                            }, 1000);
                            btn.text( BX.message('BTN_SEND_CODE_TIMEOUT').replace(/#TIMEOUT#/, timeout )).removeClass("preloader").addClass('timeout');
                        }



                    }
                    else
                    {
                        btn.removeClass("preloader");
                    }
                }
            })
        });

        // btn send emil
        box.on("click", '.cbaup_btn_send_email', function () {
            var btn = $(this);

            if (btn.hasClass('preloader')) return false;
            btn.addClass('preloader');

            var data = {
                component: 'bxmaker.authuserphone.login',
                sessid: BX.bitrix_sessid(),
                method: 'sendEmail',
                phone: box.find('input[name="phone"]').val()
            };

            if(box.find('input[name="captcha_sid"]').length)
            {
                data['captcha_sid'] = box.find('input[name="captcha_sid"]').val();
                data['captcha_word'] = box.find('input[name="captcha_word"]').val();
            }

            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: data,
                error: function (r) {
                    self.showMsg('Error connect to server!', true);
                    btn.removeClass("preloader");
                },
                success: function (r) {

                    if (!!r.response) {
                        self.showMsg(r.response.MSG);
                        btn.removeClass("preloader").hide();
                    }
                    else if (!!r.error) {

                        self.showMsg(r.error.MSG, true);

                        //captcha
                        if(!!r.error.MORE.CAPTCHA_SID)
                        {
                            self.showCaptcha(r.error.MORE);
                        }

                        btn.removeClass("preloader");
                    }
                    else
                    {
                        btn.removeClass("preloader");
                    }
                }
            })
        });

        // обновление капчи
        box.on("click", '.cbaup_row.captcha img, .cbaup_row.captcha span', function(){
            var b = box.find('.cbaup_row.captcha');

            if (b.hasClass("preloader")) return false;
            b.addClass("preloader");

            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: {
                    component: 'bxmaker.authuserphone.login',
                    sessid: BX.bitrix_sessid(),
                    method: 'getCaptcha'
                },
                error: function (r) {
                    self.showMsg('Error connect to server!', true);
                    b.removeClass("preloader");
                },
                success: function (r) {
                    if (!!r.response) {
                        self.showCaptcha(r.response);
                    }
                    else if (!!r.error) {

                    }
                    b.removeClass("preloader");
                }
            });
        });



        // отправка при клике по кнопке enter
        box.find('input').on("keyup", function(e){
            if(e.keyCode == 13)
            {
                box.find(".cbaup_btn").click();
            }
        });

        box.find('.btn_logout').attr('href', location.pathname + (location.search.length > 0 ? location.search + '&' : '?') + 'logout=Y');

    }

})();
console.log('go');
