function number_format(number, decimals, dec_point, thousands_sep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    let n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            let k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}


const _0x3b95 = ['true', 'checkMobile', 'direction:\x20ltr', 'Tab', 'charAt', 'is-invalid', 'val', 'is-valid', 'stopImmediatePropagation', 'Backspace', 'test', 'fw-required', 'slice', 'key', 'keydown', 'addClass', 'length', 'removeClass'];
(function (_0xea4734, _0x2015c7) {
    const _0x760e1e = function (_0x2128aa) {
        while (--_0x2128aa) {
            _0xea4734['push'](_0xea4734['shift']());
        }
    };
    _0x760e1e(++_0x2015c7);
}(_0x3b95, 0x1e5));
const _0x627d = function (_0xea4734, _0x2015c7) {
    _0xea4734 = _0xea4734 - 0x0;
    let _0x760e1e = _0x3b95[_0xea4734];
    return _0x760e1e;
};
$['fn'][_0x627d('0x2')] = function () {
    $(this)['on'](_0x627d('0xf'), function (_0xc0c6cb) {
        let _0x147a4b = $(this)[_0x627d('0x7')](), _0xfb30e6 = _0xc0c6cb[_0x627d('0xe')],
            _0x59706b = $(this)[_0x627d('0x7')]()[_0x627d('0x11')] - 0x1,
            _0x247ae9 = $(this)['attr'](_0x627d('0xc')) == _0x627d('0x1') ? !![] : ![];
        if (_0xfb30e6 == _0x627d('0x4')) return !![];
        $(this)['attr']('style', _0x627d('0x3'));
        _0xc0c6cb['preventDefault']();
        _0xc0c6cb[_0x627d('0x9')]();
        if (_0xfb30e6 == _0x627d('0xa')) {
            if (_0x147a4b[_0x627d('0x5')](_0x147a4b['length'] - 0x2) == '\x20') {
                if (_0x147a4b[_0x627d('0x5')](_0x147a4b[_0x627d('0x11')] - 0x3) == ')') {
                    _0x59706b = _0x147a4b[_0x627d('0x11')] - 0x3;
                } else {
                    _0x59706b = _0x147a4b[_0x627d('0x11')] - 0x2;
                }
            } else {
                if (_0x147a4b['charAt'](_0x147a4b[_0x627d('0x11')] - 0x3) == '(') {
                    _0x59706b = _0x147a4b['length'] - 0x3;
                } else {
                    _0x59706b = _0x147a4b[_0x627d('0x11')] - 0x1;
                }
            }
            _0x147a4b = _0x147a4b[_0x627d('0xd')](0x0, _0x59706b);
        } else {
            switch ($(this)[_0x627d('0x7')]()[_0x627d('0x11')]) {
                case 0x0:
                    _0x147a4b = _0x147a4b + '(' + '09';
                    break;
                case 0x3:
                case 0x4:
                    if (/^[0-9]+$/[_0x627d('0xb')](_0xfb30e6)) {
                        _0x147a4b = _0x147a4b + _0xfb30e6;
                    }
                    break;
                case 0x5:
                    if (/^[0-9]+$/[_0x627d('0xb')](_0xfb30e6)) {
                        _0x147a4b = _0x147a4b + ')\x20' + _0xfb30e6;
                    }
                    break;
                case 0x8:
                    if (/^[0-9]+$/['test'](_0xfb30e6)) {
                        _0x147a4b = _0x147a4b + _0xfb30e6;
                    }
                    break;
                case 0x9:
                    if (/^[0-9]+$/[_0x627d('0xb')](_0xfb30e6)) {
                        _0x147a4b = _0x147a4b + _0xfb30e6 + '\x20';
                    }
                    break;
                case 0xb:
                    if (/^[0-9]+$/[_0x627d('0xb')](_0xfb30e6)) {
                        _0x147a4b = _0x147a4b + _0xfb30e6;
                    }
                    break;
                case 0xc:
                    if (/^[0-9]+$/['test'](_0xfb30e6)) {
                        _0x147a4b = _0x147a4b + _0xfb30e6 + '\x20';
                    }
                    break;
                case 0xd:
                case 0xe:
                case 0xf:
                    if (/^[0-9]+$/[_0x627d('0xb')](_0xfb30e6)) {
                        _0x147a4b = _0x147a4b + _0xfb30e6;
                    }
                    break;
            }
        }
        $(this)['val'](_0x147a4b);
        if (_0x247ae9) {
            if (/\(09[0-9]{2}\) [0-9]{3} [0-9]{2} [0-9]{2}/['test'](_0x147a4b)) {
                $(this)[_0x627d('0x0')](_0x627d('0x6'));
                $(this)[_0x627d('0x10')](_0x627d('0x8'));
            } else {
                $(this)[_0x627d('0x0')](_0x627d('0x8'));
                $(this)[_0x627d('0x10')](_0x627d('0x6'));
            }
        } else {
            if (_0x147a4b != '') {
                if (/\(09[0-9]{2}\) [0-9]{3} [0-9]{2} [0-9]{2}/[_0x627d('0xb')](_0x147a4b)) {
                    $(this)[_0x627d('0x0')](_0x627d('0x6'));
                    $(this)[_0x627d('0x10')](_0x627d('0x8'));
                } else {
                    $(this)[_0x627d('0x0')](_0x627d('0x8'));
                    $(this)[_0x627d('0x10')](_0x627d('0x6'));
                }
            } else {
                $(this)[_0x627d('0x0')](_0x627d('0x8'));
                $(this)['removeClass'](_0x627d('0x6'));
            }
        }
    });
};
const _0x7436 = ["\x63\x68\x65\x63\x6B\x54\x65\x6C\x6C", "\x66\x6E", "\x6B\x65\x79\x64\x6F\x77\x6E", "\x76\x61\x6C", "\x6B\x65\x79", "\x6C\x65\x6E\x67\x74\x68", "\x66\x77\x2D\x72\x65\x71\x75\x69\x72\x65\x64", "\x61\x74\x74\x72", "\x74\x72\x75\x65", "\x54\x61\x62", "\x73\x74\x79\x6C\x65", "\x64\x69\x72\x65\x63\x74\x69\x6F\x6E\x3A\x20\x6C\x74\x72", "\x70\x72\x65\x76\x65\x6E\x74\x44\x65\x66\x61\x75\x6C\x74", "\x73\x74\x6F\x70\x49\x6D\x6D\x65\x64\x69\x61\x74\x65\x50\x72\x6F\x70\x61\x67\x61\x74\x69\x6F\x6E", "\x42\x61\x63\x6B\x73\x70\x61\x63\x65", "\x63\x68\x61\x72\x41\x74", "\x20", "\x29", "\x28", "\x73\x6C\x69\x63\x65", "\x30", "\x74\x65\x73\x74", "\x29\x20", "\x69\x73\x2D\x69\x6E\x76\x61\x6C\x69\x64", "\x72\x65\x6D\x6F\x76\x65\x43\x6C\x61\x73\x73", "\x69\x73\x2D\x76\x61\x6C\x69\x64", "\x61\x64\x64\x43\x6C\x61\x73\x73", "", "\x6F\x6E"];
$[_0x7436[1]][_0x7436[0]] = function () {
    $(this)[_0x7436[28]](_0x7436[2], function (_0x5530x1) {
        let _0x5530x2 = $(this)[_0x7436[3]](), _0x5530x3 = _0x5530x1[_0x7436[4]],
            _0x5530x4 = $(this)[_0x7436[3]]()[_0x7436[5]] - 1,
            _0x5530x5 = $(this)[_0x7436[7]](_0x7436[6]) == _0x7436[8] ? true : false;
        if (_0x5530x3 == _0x7436[9]) {
            return true
        }
        $(this)[_0x7436[7]](_0x7436[10], _0x7436[11]);
        _0x5530x1[_0x7436[12]]();
        _0x5530x1[_0x7436[13]]();
        if (_0x5530x3 == _0x7436[14]) {
            if (_0x5530x2[_0x7436[15]](_0x5530x2[_0x7436[5]] - 2) == _0x7436[16]) {
                if (_0x5530x2[_0x7436[15]](_0x5530x2[_0x7436[5]] - 3) == _0x7436[17]) {
                    _0x5530x4 = _0x5530x2[_0x7436[5]] - 3
                } else {
                    _0x5530x4 = _0x5530x2[_0x7436[5]] - 2
                }
            } else {
                if (_0x5530x2[_0x7436[15]](_0x5530x2[_0x7436[5]] - 2) == _0x7436[18]) {
                    _0x5530x4 = _0x5530x2[_0x7436[5]] - 2
                } else {
                    _0x5530x4 = _0x5530x2[_0x7436[5]] - 1
                }
            }
            _0x5530x2 = _0x5530x2[_0x7436[19]](0, _0x5530x4)
        } else {
            switch ($(this)[_0x7436[3]]()[_0x7436[5]]) {
                case 0:
                    _0x5530x2 = _0x5530x2 + _0x7436[18] + _0x7436[20];
                    break;
                case 2:

                case 3:
                    if (/^[0-9]+$/[_0x7436[21]](_0x5530x3)) {
                        _0x5530x2 = _0x5530x2 + _0x5530x3
                    }

                    break;
                case 4:
                    if (/^[0-9]+$/[_0x7436[21]](_0x5530x3)) {
                        _0x5530x2 = _0x5530x2 + _0x7436[22] + _0x5530x3
                    }

                    break;
                case 5:
                    if (/^[0-9]+$/[_0x7436[21]](_0x5530x3)) {
                        _0x5530x2 = _0x5530x2 + _0x5530x3 + _0x7436[16]
                    }

                    break;
                case 7:
                    if (/^[0-9]+$/[_0x7436[21]](_0x5530x3)) {
                        _0x5530x2 = _0x5530x2 + _0x5530x3 + _0x7436[16]
                    }

                    break;
                case 9:
                    if (/^[0-9]+$/[_0x7436[21]](_0x5530x3)) {
                        _0x5530x2 = _0x5530x2 + _0x5530x3
                    }

                    break;
                case 10:
                    if (/^[0-9]+$/[_0x7436[21]](_0x5530x3)) {
                        _0x5530x2 = _0x5530x2 + _0x5530x3 + _0x7436[16]
                    }

                    break;
                case 12:
                    if (/^[0-9]+$/[_0x7436[21]](_0x5530x3)) {
                        _0x5530x2 = _0x5530x2 + _0x5530x3
                    }

                    break;
                case 13:
                    if (/^[0-9]+$/[_0x7436[21]](_0x5530x3)) {
                        _0x5530x2 = _0x5530x2 + _0x5530x3 + _0x7436[16]
                    }

                    break;
                case 14:

                case 15:

                case 16:
                    if (/^[0-9]+$/[_0x7436[21]](_0x5530x3)) {
                        _0x5530x2 = _0x5530x2 + _0x5530x3
                    }

                    break
            }
        }
        $(this)[_0x7436[3]](_0x5530x2);
        if (_0x5530x5) {
            if (/\(0[1-9][0-9]\) [0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}/[_0x7436[21]](_0x5530x2)) {
                $(this)[_0x7436[24]](_0x7436[23]);
                $(this)[_0x7436[26]](_0x7436[25])
            } else {
                $(this)[_0x7436[24]](_0x7436[25]);
                $(this)[_0x7436[26]](_0x7436[23])
            }
        } else {
            if (_0x5530x2 != _0x7436[27]) {
                if (/\(0[1-9][0-9]\) [0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}/[_0x7436[21]](_0x5530x2)) {
                    $(this)[_0x7436[24]](_0x7436[23]);
                    $(this)[_0x7436[26]](_0x7436[25])
                } else {
                    $(this)[_0x7436[24]](_0x7436[25]);
                    $(this)[_0x7436[26]](_0x7436[23])
                }
            } else {
                $(this)[_0x7436[24]](_0x7436[25]);
                $(this)[_0x7436[24]](_0x7436[23])
            }
        }
    })
};
$.fn.checkNationalCode = function () {
    $(this).addClass('ltr');
    $(this).on('input', function () {
        let number = $(this).val();
        if (!/^[0-9]{10}$/.test(number)) {
            $(this).parents("form").find("button").attr("disabled", true);
            $(this).removeClass('is-valid');
            $(this).addClass('is-invalid');
        } else {
            $(this).parents("form").find("button").attr("disabled", false);
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');
        }
    })
};
$.fn.checkWebSite = function (options) {
    let subDomain;
    if (options) {
        subDomain = options.subDomain;
    }
    $(this).on('input', function () {
        let site = $(this).val();
        site = site.replace("https://", '');
        site = site.replace("https:/", '');
        if (!/^[0-9]+[a-zA-Z._-]+$/.test(site)) {
            if (subDomain == true) {
                if (char_count(site, '.') == 2 || char_count(site, '.') == 1) {
                    let siteArray = site.slice(site.lastIndexOf('.'), site.length);
                    siteArray = siteArray.replace('.', '');
                    if (/^[a-zA-Z]{2,}$/.test(siteArray)) {
                        $(this).parents("form").find("button").attr("disabled", false);
                        $(this).removeClass('is-invalid');
                        $(this).addClass('is-valid');
                    } else {
                        $(this).parents("form").find("button").attr("disabled", true);
                        $(this).removeClass('is-valid');
                        $(this).addClass('is-invalid');
                    }
                } else {
                    $(this).parents("form").find("button").attr("disabled", true);
                    $(this).removeClass('is-valid');
                    $(this).addClass('is-invalid');
                }
            } else {
                if (char_count(site, '.') == 1) {
                    let siteArray = site.split('.');
                    if (/^[a-zA-Z]{2,}$/.test(siteArray[1])) {
                        $(this).parents("form").find("button").attr("disabled", false);
                        $(this).removeClass('is-invalid');
                        $(this).addClass('is-valid');
                    } else {
                        $(this).parents("form").find("button").attr("disabled", true);
                        $(this).removeClass('is-valid');
                        $(this).addClass('is-invalid');
                    }
                } else {
                    $(this).parents("form").find("button").attr("disabled", true);
                    $(this).removeClass('is-valid');
                    $(this).addClass('is-invalid');
                }
            }

        } else {
            site = site.slice(0, -1);
        }

        function char_count(str, letter) {
            var letter_Count = 0;
            for (var position = 0; position < str.length; position++) {
                if (str.charAt(position) == letter) {
                    letter_Count += 1;
                }
            }
            return letter_Count;
        }

        $(this).val("https://" + site);
    });
};
$.fn.checkNumber = function (options) {
    $(this).on('keypress', function (e) {
        if (/^[0-9]+$/.test(e.key)) {
            if (options) {
                if (options.max <= $(this).val().length) {
                    return false;
                }
            }
        } else {
            return false;
        }
    })
};
$.fn.checkPrice = function () {
    $(this).on('input', function (e) {
        e.preventDefault();
        let value = $(this).val(), max = $(this).attr("check-max");
        if (max) {
            if (parseInt(max) >= parseInt(value.replace(',', ''))) {
                $(this).val(number_format(value))
            }
        } else {
            $(this).val(number_format(value))
        }

    });
};
$.fn.checkEnglish = function () {
    $(this).on('keypress', function (e) {
        if (!/^[a-zA-Z]+$/.test(e.key)) {
            return false;
        }
    })
};
$.fn.checkPersian = function (options = {max: 10000}) {
    let max = options.max;
    $(this).on('keypress', function (e) {
        if ($(this).val().length + 1 <= max) {
            return /^[ آا-ی]+$/.test(e.key);
        } else {
            return  false;
        }
    })
};
$.fn.checkEmail = function () {
    $(this).attr('style', 'direction: ltr');
    $(this).on('keypress keydown keyup input', function (e) {
        let email = $(this).val();
        if (/[a-zA-Z]{3}/g.test(email.substring(0, 3))) {
            if (email.includes('@') && email.includes('.')) {
                let emailArray = email.split('.');
                let emailSecArray = email.split('@');
                let betweenAdAndDot = email.substring(
                    email.lastIndexOf("@") + 1,
                    email.lastIndexOf(".")
                );
                if (emailSecArray[1].length >= 3 && emailArray[1].length >= 2 && /^[a-zA-Z]+$/.test(emailArray[1]) && /^[0-9a-zA-Z_]+$/.test(betweenAdAndDot)) {
                    $(this).parents("form").find("button").attr("disabled", false);
                    $(this).removeClass('is-invalid');
                    $(this).addClass('is-valid');
                } else {
                    $(this).parents("form").find("button").attr("disabled", true);
                    $(this).removeClass('is-valid');
                    $(this).addClass('is-invalid');
                }
            } else {
                $(this).parents("form").find("button").attr("disabled", true);
                $(this).removeClass('is-valid');
                $(this).addClass('is-invalid');
            }

        } else {
            $(this).parents("form").find("button").attr("disabled", true);
            $(this).removeClass('is-valid');
            $(this).addClass('is-invalid');
        }
    })
};
$.fn.checkPostCode = function () {
    $(this).on('input', function (a) {

            let number = $(this).val();
            if ($(this).val().length > 11) {
                $(this).val(number.slice(0, -1));
                number = number.slice(0, -1);
            }
            var numberPattern = /[0-9]+/g;
            number = number.match(numberPattern);
            number = number.join('');
            if ($(this).val().length === 5) {
                $(this).val([$(this).val().slice(0, 5), "-", $(this).val().slice(5)].join(''));
            }
            if (number.length === 10 && number.match(numberPattern) != null) {
                $(this).parents("form").find("button").attr("disabled", false);
                $(this).removeClass('is-invalid');
                $(this).addClass('is-valid');
                return true;
            } else {
                $(this).parents("form").find("button").attr("disabled", true);
                $(this).removeClass('is-valid');
                $(this).addClass('is-invalid');
            }
        }
    )
};
$.fn.checkMaxLen = function (options) {
    let maxLen = options.max;
    $(this).on('keydown', function (key) {
        let len = $(this).val();
        if (key.key == "Backspace" || key.key == "Tab") {
            return true;
        }
        if (len.length + 1 > maxLen) {
            return false;
        }
    })
};
$.fn.checkPassword = function () {
    $(this).on('keyup', function (aaa) {
        if (/^[ آا-ی]+$/.test(aaa.key)) {
            return false;
        }
        let password = $(this).val();
        var matchedCase = [];
        matchedCase.push("[$@$!%*#?&]"); // Special Charector
        matchedCase.push("[A-Z]");      // Uppercase Alpabates
        matchedCase.push("[0-9]");      // Numbers
        matchedCase.push("[a-z]");     // Lowercase Alphabates
        var ctr = 0;
        for (var i = 0; i < matchedCase.length; i++) {
            if (new RegExp(matchedCase[i]).test(password)) {
                ctr++;
            }
        }
        if (password.length > 7) {
            ctr++;
        }
        var color = "";
        var strength = "";
        switch (ctr) {
            case 0:
            case 1:
            case 2:
                strength = "Very Weak";
                color = "red";
                break;
            case 3:
                strength = "Medium";
                color = "orange";
                break;
            case 4:
                strength = "good";
                color = "blue";
                break;
            case 5:
                strength = "Strong";
                color = "green";
                break;
        }
        $(this).attr("style", "border-bottom: inset; border-bottom-color: " + color);
    })
};

$.fn.checkImage = function () {
    let imgStr = '<img src="" id="source" alt="">';
    $(this).after(imgStr);
    let imgTag = document.getElementById("source");
    let _URL = window.URL || window.webkitURL;
    $(this).change(function (e) {
        let input = $(this);
        let file, img, width, height, txt, required, size;
        if ((file = this.files[0])) {
            width = $(this).attr("check-width");
            $(imgTag).attr("width", width);
            height = $(this).attr("check-height");
            $(imgTag).attr("height", height);
            required = $(this).attr("check-required");
            size = $(this).attr("check-size");
            txt = "ابعاد تصویر خواسته شده " + width + " در " + height + " می باشد";
            img = new Image();
            img.onload = function (e) {
                if (size != "") {
                    if (file.size > size) {
                        txt = "حجم تصویر خواسته شده " + Math.round(size / 1024) + " کیلوبایت می باشد، تصویر ارسالی شما " + Math.round(file.size / 1024) + " کیلوبایت می باشد!";
                        if (required == "true") {
                            $(input).val('');
                        }
                        Swal.fire({
                            icon: 'warning',
                            title: 'هشدار!',
                            text: txt,
                            confirmButtonText: 'تایید'
                        });
                        return false;
                    }
                }
                if (width != "" && height != "" && this.width != width && this.height != height) {
                    txt += " تصویر ارسالی شما دارای ابعاد " + this.width + " در " + this.height + " است" + "، آیا به سیستم اجازه ی رساندن عکس به ابعاد مورد نظر را میدهید؟";
                    Swal.fire({
                        icon: 'warning',
                        title: 'هشدار!',
                        text: txt,
                        confirmButtonText: 'بله، اجازه میدهم!',
                        confirmButtonColor: '#00e92e',
                        cancelButtonText: 'خیر، اجازه نمیدهم!',
                        cancelButtonColor: '#e9342b',
                        showCancelButton: true,
                        reverseButtons: true,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        preConfirm: () => {
                            file.width = width;
                            file.height = height;
                            let widthInput = '<input value="' + width + '"' + ' name="checkImage[width]" type="hidden">';
                            let heightInput = '<input value="' + height + '" name="checkImage[height]" type="hidden">';
                            input.after(widthInput);
                            input.after(heightInput);
                            if (e.path) {
                                imgTag.src = e.path[0].src;
                            } else {
                                imgTag.src = e.target.src;
                            }
                        }
                    }).then((res) => {
                        if (res.dismiss === Swal.DismissReason.cancel) {
                            if (required == "true") {
                                $(input).val('');
                                imgTag.src = '';
                            }
                        }
                    });
                    return false;
                }
            };
            img.src = _URL.createObjectURL(file);
        }
    });
};
$.checkIcon = function (position = 'left-middle') {
    $('#picker').IconPicker({
        'containerPosition': position,
        'iconSize': 45,
        'onDisplayIconChange': (imgIdx, imgUrl) => {
            $.ajax({
                url: "controllers/BaseTables/IconCenter/IconCenter.php",
                data: {
                    controller_type: "getId",
                    imgUrl: imgUrl
                },
                type: "post",
                success: res => {
                    $("#iconCenterInput").val(res);
                },
                error: error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'خطایی رخ داد',
                        text: 'بارگذاری آیکون با خطا مواجه شد!',
                        showConfirmButton: false,
                        showCloseButton: true
                    });
                }
            })
        }
    })
};
$.fn.checkFloat = function () {
    $(this).on('keydown', function (e) {
        if (e.key == 'Backspace' || e.key == 'Tab') return true;
        return /^[0-9.]+$/.test(e.key)
    })
};
$.checkText = function () {
    $("textarea").trumbowyg();
};
$.checkSelect = function () {
    $("select").each(function () {
        $(this).select2();
        $(this).siblings('span').attr("style","width=100%;")
    });
};
$.count = function (table_id = false) {
    if (table_id == false) {
        let i = 0;
        $("table tbody tr").each(function () {
            i++;
            $(this).find('td:first-child').html(i);
        });
    } else {
        let i = 0;
        $("#" + table_id + " tbody tr").each(function () {
            i++;
            $(this).find('td:first-child').html(i);
        });
    }
};
$.checkCheckBox = function () {
    $('input[type=checkbox]').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '40%'
    });
    $('input[type=radio]').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '40%'
    });
};