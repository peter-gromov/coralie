;
(function () {

    if (window.frameCacheVars !== undefined) {
        BX.addCustomEvent("onFrameDataReceived", function (json) {
            Working();
        });
    } else {
        BX.ready(function () {
            Working();
        });
    }


    function Working() {

        if (!!window.jQuery == false) {
            console.log('bxmaker.authserphone.edit - need jQuery');
            return true;
        }



        $('.c-bxmaker-authuserphone_edit-default-box').each(function () {
             new BxmakerAuthUserphoneEdit(jQuery(this), jQuery);
        });


    }

    function BxmakerAuthUserphoneEdit(b, $) {
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
        self.showCaptcha = function (param) {
            var cb = box.find('.cbaup_row.captcha');

            param.CAPTCHA_SID = param.CAPTCHA_SID || '';
            param.CAPTCHA_SRC = param.CAPTCHA_SRC || '';

            if (!cb.find('input[name="captcha_sid"]').length) {
                var html = '<input type="hidden" name="captcha_sid" value="' + param.CAPTCHA_SID + '"/>' +
                    '<img src="' + param.CAPTCHA_SRC + '" title="' + BX.message('UPDATE_CAPTCHA_IMAGE') + '" alt=""/>' +
                    '<span class="btn_captcha_reload" title="' + BX.message('UPDATE_CAPTCHA_IMAGE') + '"></span>' +
                    '<input type="text" name="captcha_word" class="captcha_word" placeholder="' + BX.message('INPUT_CAPTHCA') + '"/>';

                cb.append(html).fadeIn(300);
            }
            else {
                cb.find('input[name="captcha_sid"]').val(param.CAPTCHA_SID);
                cb.find('img').attr('src', param.CAPTCHA_SRC);
            }
        };


        // btn enter
        box.find(".cbaup_btn").on("click", function () {
            var btn = $(this);

            if (btn.hasClass("preloader")) return false;
            btn.addClass("preloader");

            var data = {
                component: 'bxmaker.authuserphone.edit',
                sessid: BX.bitrix_sessid(),
                method: 'setPhone',
                phone: box.find('input[name="phone"]').val(),
                code: box.find('input[name="code"]').val()
            };

            if (box.find('input[name="captcha_sid"]').length) {
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

                        if (!!r.response.PHONE) {
                            box.find('.cur_phone_info').html(BX.message('PHONE_INFO_TEMPLATE').replace(/PHONE/, r.response.PHONE));
                        }
                    }
                    else if (!!r.error) {
                        self.showMsg(r.error.MSG, true);

                        //captcha
                        if (!!r.error.MORE.CAPTCHA_SID) {
                            self.showCaptcha(r.error.MORE);
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

            var data = {
                component: 'bxmaker.authuserphone.edit',
                sessid: BX.bitrix_sessid(),
                method: 'sendCode',
                phone: box.find('input[name="phone"]').val()
            };

            if (box.find('input[name="captcha_sid"]').length) {
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

                        var timeout = (!!r.response.TIME ? r.response.TIME : 59);

                        // индикатор
                        var smsInterval = setInterval(function () {
                            if (--timeout > 0) {
                                btn.text(BX.message('BTN_SEND_CODE_TIMEOUT').replace(/#TIMEOUT#/, timeout));
                            }
                            else {
                                clearInterval(smsInterval);
                                btn.text(BX.message('BTN_SEND_CODE'));
                                btn.removeClass("timeout");
                            }
                        }, 1000);

                        //сразу отображаем
                        btn.text(BX.message('BTN_SEND_CODE_TIMEOUT').replace(/#TIMEOUT#/, timeout)).removeClass("preloader").addClass('timeout');
                    }
                    else if (!!r.error) {

                        self.showMsg(r.error.MSG, true);


                        if (!!r.error.MORE && !!r.error.MORE.TIME) {
                            var smsInterval = setInterval(function () {
                                if (--timeout > 0) {
                                    btn.text(BX.message('BTN_SEND_CODE_TIMEOUT').replace(/#TIMEOUT#/, timeout));
                                }
                                else {
                                    clearInterval(smsInterval);
                                    btn.text(BX.message('BTN_SEND_CODE'));
                                    btn.removeClass("timeout");
                                }
                            }, 1000);
                            btn.text(BX.message('BTN_SEND_CODE_TIMEOUT').replace(/#TIMEOUT#/, timeout)).removeClass("preloader").addClass('timeout');
                        }

                        //captcha
                        if (!!r.error.MORE.CAPTCHA_SID) {
                            self.showCaptcha(r.error.MORE);
                        }


                        btn.removeClass("preloader");
                    }
                    else {
                        btn.removeClass("preloader");
                    }
                }
            })
        });


        // обновление капчи
        box.on("click", '.cbaup_row.captcha img, .cbaup_row.captcha span', function () {
            var b = box.find('.cbaup_row.captcha');

            if (b.hasClass("preloader")) return false;
            b.addClass("preloader");

            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: {
                    component: 'bxmaker.authuserphone.edit',
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
        box.find('input').on("keyup", function (e) {
            if (e.keyCode == 13) {
                box.find(".cbaup_btn").click();
            }
        });

    }

})();

