$.submit = function (url = 'undefined.php') {
    $("form").attr("novalidate",'novalidate');
    $("form").attr("novalidate",true);
    $("form").submit(function (e) {
        let that = $(this);
        let formData = new FormData(this);
        let validationArray = [];
        setTimeout(() => {
            $(that).find('input[fw-id^=fw_price_]').each(function () {
                $(this).val($(this).val().replace(',',''))
            });
            $(that).find('input:required').each(function () {
                if ($(this).val() === ''){
                    $(this).removeClass("is-valid");
                    $(this).addClass("is-invalid");
                    validationArray.push(false);
                }

                $(this).on('input',function () {
                    if ($(this).val() === ''){
                        $(this).removeClass("is-valid");
                        $(this).addClass("is-invalid");
                    } else {
                        $(this).removeClass("is-invalid");
                        $(this).addClass("is-valid");
                    }
                });
            });

            $(that).find('select:required').each(function () {
                if ($(this).val()) {
                    if (parseInt($(this).val().length) === 0 || $(this).children('option:selected').val().length === 0) {
                        $(this).siblings('span').removeClass("is-valid");
                        $(this).siblings('span').addClass("is-invalid");
                        validationArray.push(false);
                    }
                } else {

                    $(this).siblings('span').removeClass("is-valid");
                    $(this).siblings('span').addClass("is-invalid");
                    validationArray.push(false);
                }
                $(this).on('change',function () {
                    if (parseInt($(this).val().length) === 0 || $(this).children('option:selected').val().length === 0){
                        $(this).siblings('span').removeClass("is-valid");
                        $(this).siblings('span').addClass("is-invalid");
                    } else {
                        $(this).siblings('span').removeClass("is-invalid");
                        $(this).siblings('span').addClass("is-valid");
                    }
                });
            });
            if (!validationArray.includes(false)) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    async: false,
                    success: data => {
                        $(that).html(data);
                    },
                    error: error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'خطایی رخ داد',
                            text: 'ثبت اطلاعات  با خطا مواجه شد!',
                            showConfirmButton: false,
                            showCloseButton: true
                        });
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'اطلاعات کامل نیست!',
                    text: 'لطفا تمام اطلاعات خواسته شده (موارد اجباری با رنگ قرمز مشخص شده است) را وارد نمایید',
                    showConfirmButton: false,
                    showCloseButton: true
                });
            }
        },0);

        e.preventDefault();
    });
};
