$.loader = function () {
    $("#fw-preloader").toggleClass('loaded');
};
$.fn.getOptions = function (options = {}) {
    $(this).on('change', () => {
        let url = options.url, target = options.target, controller_type = options.controller_type || 'ajax',id = options.this || $(this).attr('id') || $(this).attr('name') || 'value',
            rest = options.rest || {};
        const object3 = {
            ...{
                controller_type: controller_type,
                [id]: $(this).val()
            }, ...rest
        };
        $.ajax({
            url: url,
            data: object3,
            type: "post",
            success: res => {
                $('#' + target).html(res);
                $('#' + target).attr("disabled",false);
            }
        })
    });
};
