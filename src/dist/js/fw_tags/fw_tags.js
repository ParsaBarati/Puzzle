$.fw_tags = function () {
    $(function () {
        let i = 0;
        $("fw-mobile").each(function () {
            i++;
            let attr = $(this).attr();
            $(this).after('<input fw-id="fw_mobile_' + i + '">');
            $(this).remove();
            let inp = $('input[fw-id=fw_mobile_' + i + ']');
            for (let key in attr) {
                $(inp).attr(key, attr[key]);
            }
        });
        $('input[fw-id^=fw_mobile_]').checkMobile();
    });
    $(function () {
        let i = 0;
        $("fw-email").each(function () {
            i++;
            let attr = $(this).attr();
            $(this).after('<input fw-id="fw_email_' + i + '">');
            $(this).remove();
            let inp = $('input[fw-id=fw_email_' + i + ']');
            for (let key in attr) {
                $(inp).attr(key, attr[key]);
            }
            $('input[fw-id^=fw_email_]').checkEmail();
        })
    });
    $(function () {
        let i = 0;
        $("fw-tell").each(function () {
            i++;
            let attr = $(this).attr();
            $(this).after('<input fw-id="fw_tell_' + i + '">');
            $(this).remove();
            let inp = $('input[fw-id=fw_tell_' + i + ']');
            for (let key in attr) {
                $(inp).attr(key, attr[key]);
            }
            $('input[fw-id^=fw_tell_]').checkTell();
        })
    });
    $(function () {
        let i = 0;
        $("fw-price").each(function () {
            i++;
            let unit = $(this).attr("price-unit");
            let attr = $(this).attr();
            $(this).after("<div class=\"input-group\">\n" +
                "                                <input fw-id='fw_price_"+i+"'>" +
                "                                <div class=\"input-group-append\">\n" +
                "                                    <span class=\"input-group-text\">\n" +
                unit +
                "                                    </span>\n" +
                "                                </div>\n" +
                "                            </div>");
            $(this).remove();
            let inp = $('input[fw-id=fw_price_' + i + ']');
            for (let key in attr) {
                $(inp).attr(key, attr[key]);
            }
            $('input[fw-id^=fw_price_]').checkPrice();
        })
    });
};