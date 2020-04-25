let fw_referrer = 'undefined.php';
$.Ajax = function () {
    $('.ajax').click(function (e) {
        $('.modal').modal("hide");
        $.loader();
        e.preventDefault();
        let myUrl, controller, view;
        myUrl = $(this).attr('rel');
        let currentFile = $("#fw_lastAjaxCallView").val();
        let isRefresh = currentFile == myUrl;
        let isUndefined = myUrl == 'undefined.php';
        let isBackBtn = $(this).attr("id") == 'fw_back_btn';
        if (!isBackBtn && !isRefresh && !isUndefined){
            fw_referrer = currentFile;
        }
        let date = new Date();
        if (!myUrl.includes('.fwTools')) {
            if (myUrl.includes('edit')) {
                controller = "controllers/" + myUrl.replace('edit', '') + "&controller_type=get"
            } else if (myUrl.toLowerCase().includes('view')) {
                controller = "controllers/" + myUrl.replace('view', '') + "&controller_type=get"
            } else if (myUrl.includes('delete')) {
                controller = "controllers/" + myUrl.replace('delete', '') + "&controller_type=get"
            } else if (myUrl.includes('add')) {
                controller = "controllers/" + myUrl.replace('add', '')
            } else {
                controller = "controllers/" + myUrl
            }
            view = "views/" + myUrl
        } else {
            myUrl = myUrl.replace('.fwTools', '');
            controller = "fwTools/controller/" + myUrl;
            view = "fwTools/view/" + myUrl
        }
        $.ajax({
            url: 'Actions/CheckSession.php', success: r => {
                if (parseInt(r) === 1) {
                    $.ajax({
                        url: controller, success: rt => {
                            $.ajax({
                                url: view,
                                data: {
                                    data: rt,
                                    fw_referrer: fw_referrer,
                                    timeStampForAjaxRequest: date.getTime()
                                },
                                type: "POST",
                                success: page => {
                                    $('#fw-content').empty();
                                    $('#fw-content').html(page);
                                    $(".tooltip").hide();
                                    $.loader();
                                },
                                error: error => {
                                    if (error.status == 403 || error.status == 404) {
                                        $.loader();
                                        Swal.fire({
                                            icon: 'info',
                                            title: 'صفحه ی مورد نظر در حال طراحی است!',
                                            confirmButtonText: 'تایید'
                                        })
                                    } else {
                                        let timerInterval;
                                        $.loader();
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'خطای ناشناخته!',
                                            html: 'شما در <b></b> میلی ثانیه به صفحه ی اصلی منتقل میشوید',
                                            timer: 3000,
                                            timerProgressBar: !0,
                                            onBeforeOpen: () => {
                                                Swal.showLoading();
                                                timerInterval = setInterval(() => {
                                                    Swal.getContent().querySelector('b').textContent = Swal.getTimerLeft()
                                                }, 100)
                                            },
                                            onClose: () => {
                                                clearInterval(timerInterval)
                                            }
                                        }).then((result) => {
                                            if (result.dismiss === Swal.DismissReason.timer)
                                                location.reload()
                                        })
                                    }
                                }
                            })
                        }, error: error => {
                            if (error.status == 403) {
                                $.loader();
                                Swal.fire({
                                    icon: 'info',
                                    title: 'صفحه ی مورد نظر در حال طراحی است!',
                                    confirmButtonText: 'تایید'
                                })
                            } else if (error.status == 404) {
                                $.ajax({
                                    url: view,
                                    data: {fw_referrer: fw_referrer},
                                    type: "POST",
                                    success: page => {
                                        $('#fw-content').empty();
                                        $('#fw-content').html(page);
                                        $(".tooltip").hide();
                                        $.loader();
                                    },
                                    error: error => {
                                        if (error.status == 403 || error.status == 404) {
                                            $.loader();
                                            Swal.fire({
                                                icon: 'info',
                                                title: 'صفحه ی مورد نظر در حال طراحی است!',
                                                confirmButtonText: 'تایید'
                                            })
                                        } else {
                                            let timerInterval;
                                            $.loader();
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'خطای ناشناخته!',
                                                html: 'شما در <b></b> میلی ثانیه به صفحه ی اصلی منتقل میشوید',
                                                timer: 3000,
                                                timerProgressBar: !0,
                                                onBeforeOpen: () => {
                                                    Swal.showLoading();
                                                    timerInterval = setInterval(() => {
                                                        Swal.getContent().querySelector('b').textContent = Swal.getTimerLeft()
                                                    }, 100)
                                                },
                                                onClose: () => {
                                                    clearInterval(timerInterval)
                                                }
                                            }).then((result) => {
                                                if (result.dismiss === Swal.DismissReason.timer) {
                                                    location.reload()
                                                }
                                            })
                                        }
                                    }
                                })
                            } else {
                                let timerInterval;
                                $.loader();
                                Swal.fire({
                                    icon: 'error',
                                    title: 'خطای ناشناخته!',
                                    html: 'شما در <b></b> میلی ثانیه به صفحه ی اصلی منتقل میشوید',
                                    timer: 2000,
                                    timerProgressBar: !0,
                                    onBeforeOpen: () => {
                                        Swal.showLoading();
                                        timerInterval = setInterval(() => {
                                            Swal.getContent().querySelector('b').textContent = Swal.getTimerLeft()
                                        }, 100)
                                    },
                                    onClose: () => {
                                        clearInterval(timerInterval)
                                    }
                                }).then((result) => {
                                    if (result.dismiss === Swal.DismissReason.timer) {
                                        location.reload()
                                    }
                                })
                            }
                        }, cache: !1, async: !0
                    });
                    return !1
                } else {
                    let username = $('#index_username').val();
                    let avatar = $('#index_avatar').val();
                    let name = $('#index_name').val();
                    window.location = 'lockScreen.php?username=' + username + '&avatar=' + avatar + "&name=" + name;
                    return !1
                }
            }
        });
        e.stopImmediatePropagation();
        return !1
    })
};
$.Ajax();

function GoToUrl(u) {
    $('.modal').modal("hide");
    $('#fw-preloader').removeClass('loaded');
    let c, v;
    if (u.includes('edit')) {
        c = "controllers/" + u.replace('edit', '') + "&controller_type=get"
    } else if (u.includes('delete')) {
        c = "controllers/" + u.replace('delete', '') + "&controller_type=get"
    } else if (u.includes('view')) {
        c = "controllers/" + u.replace('view', '') + "&controller_type=get"
    } else {
        c = "controllers/" + u
    }
    v = "views/" + u;
    let d = new Date();
    c = c + "&timeStampForAjaxRequest=" + d.getTime();
    $.ajax({
        url: 'Actions/CheckSession.php', success: function (r) {
            if (r == 1) {
                $.ajax({
                    url: c, success: function (result) {
                        $.ajax({
                            url: v, data: {data: result}, type: "POST", success: p => {
                                $('#fw-content').empty();
                                $('#fw-content').html(p);
                                $.loader();
                            }, error: error => {
                                if (error.status == 403 || error.status == 404) {
                                    $.loader();
                                    Swal.fire({
                                        icon: 'info',
                                        title: 'صفحه ی مورد نظر در حال طراحی است!',
                                        confirmButtonText: 'تایید'
                                    })
                                } else {
                                    let timerInterval;
                                    $.loader();
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'خطای ناشناخته!',
                                        html: 'شما در <b></b> میلی ثانیه به صفحه ی اصلی منتقل میشوید',
                                        timer: 3000,
                                        timerProgressBar: !0,
                                        onBeforeOpen: () => {
                                            Swal.showLoading();
                                            timerInterval = setInterval(() => {
                                                Swal.getContent().querySelector('b').textContent = Swal.getTimerLeft()
                                            }, 100)
                                        },
                                        onClose: () => {
                                            clearInterval(timerInterval)
                                        }
                                    }).then((result) => {
                                        if (result.dismiss === Swal.DismissReason.timer) {
                                            location.reload()
                                        }
                                    })
                                }
                            }
                        })
                    }, error: function (error) {
                        if (error.status == 403) {
                            $.loader();
                            Swal.fire({
                                icon: 'info',
                                title: 'صفحه ی مورد نظر در حال طراحی است!',
                                confirmButtonText: 'تایید'
                            })
                        } else if (error.status == 404) {
                            $.ajax({
                                url: v, data: {}, type: "POST", success: page => {
                                    $('#fw-content').empty();
                                    $('#fw-content').html(page);
                                    $.loader();
                                }, error: error => {
                                    if (error.status == 403 || error.status == 404) {
                                        $.loader();
                                        Swal.fire({
                                            icon: 'info',
                                            title: 'صفحه ی مورد نظر در حال طراحی است!',
                                            confirmButtonText: 'تایید'
                                        })
                                    } else {
                                        let timerInterval;
                                        $.loader();
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'خطای ناشناخته!',
                                            html: 'شما در <b></b> میلی ثانیه به صفحه ی اصلی منتقل میشوید',
                                            timer: 3000,
                                            timerProgressBar: !0,
                                            onBeforeOpen: () => {
                                                Swal.showLoading();
                                                timerInterval = setInterval(() => {
                                                    Swal.getContent().querySelector('b').textContent = Swal.getTimerLeft()
                                                }, 100)
                                            },
                                            onClose: () => {
                                                clearInterval(timerInterval)
                                            }
                                        }).then((result) => {
                                            if (result.dismiss === Swal.DismissReason.timer) {
                                                location.reload()
                                            }
                                        })
                                    }
                                }
                            })
                        } else {
                            let timerInterval;
                            $.loader();
                            Swal.fire({
                                icon: 'error',
                                title: 'خطای ناشناخته!',
                                html: 'شما در <b></b> میلی ثانیه به صفحه ی اصلی منتقل میشوید',
                                timer: 2000,
                                timerProgressBar: !0,
                                onBeforeOpen: () => {
                                    Swal.showLoading();
                                    timerInterval = setInterval(() => {
                                        Swal.getContent().querySelector('b').textContent = Swal.getTimerLeft()
                                    }, 100)
                                },
                                onClose: () => {
                                    clearInterval(timerInterval)
                                }
                            }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    location.reload()
                                }
                            })
                        }
                    }, cache: !1, async: !0
                });
                return !1
            } else {
                let un = $('#index_username').val();
                let av = $('#index_avatar').val();
                let nm = $('#index_name').val();
                window.location = 'lockScreen.php?username=' + un + '&avatar=' + av + "&name=" + nm;
                return !1
            }
        }
    })
}