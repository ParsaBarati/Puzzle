<?php
define('__SOURCE__', substr(__DIR__, 0, strpos(__DIR__, 'src') + 3) . DIRECTORY_SEPARATOR);
$allFiles = [];
$views = [];
$controllers = [];
foreach (new RegexIterator(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__SOURCE__ . 'views/')), '/\.php$/') as $phpFile) {
    $fileName = $phpFile->getFileName();
    $views[] = (true ? str_replace('.php', '', str_replace(__SOURCE__, '', $phpFile->getRealPath())) : str_replace(__SOURCE__, '', $phpFile->getRealPath()));
    $allFiles[] = (true ? str_replace('.php', '', $fileName) : $fileName);
}
foreach (new RegexIterator(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__SOURCE__ . 'controllers/')), '/\.php$/') as $phpFile) {
    $controllers[] = (true ? str_replace('.php', '', str_replace(__SOURCE__, '', $phpFile->getRealPath())) : str_replace(__SOURCE__, '', $phpFile->getRealPath()));
}
?>
<script>
    let fw_referrer = 'undefined';
    $.Ajax = function (json_pages = <?=json_encode($allFiles)?>, allViews = <?=json_encode($views)?>, allControllers = <?=json_encode($controllers)?>) {
        $('.ajax').click(function (e) {
            $('.modal').modal("hide");
            $.loader();
            e.preventDefault();
            for (let i = 1; i < 99999; i ++) {
                window.clearInterval(i);
            }
            let myUrl, controller, view;
            myUrl = $(this).attr('rel');
            if (myUrl == 'undefined' || !myUrl) {
                $.loader();
                Swal.fire({
                    icon: 'info',
                    title: 'صفحه ی مورد نظر در حال طراحی است!',
                    confirmButtonText: 'تایید'
                });
                return false;
            }
            myUrl = myUrl.replace('.php', '');
            let currentFile = $("#fw_lastAjaxCallView").val();
            let isRefresh = currentFile == myUrl;
            let isUndefined = myUrl == 'undefined';
            let isBackBtn = $(this).attr("id") == 'fw_back_btn';
            if (!isBackBtn && !isRefresh && !isUndefined) {
                fw_referrer = currentFile;
            }
            let date = new Date();
            let array = json_pages;
            let controller_type = '';
            let fileExists = false, isViewValid = false, isControllerValid = true;
            if (!myUrl.includes('.fwTools')) {
                array = array.filter(file => myUrl.includes(file));
                array.forEach(function (val, index) {
                    let url_end = myUrl.includes('/') ? (myUrl.split('/')) : myUrl;
                    url_end = myUrl.includes('/') ? url_end[url_end.length - 1] : url_end;
                    url_end = (url_end.includes('?') ? url_end.split('?')[0] : url_end);
                    if (url_end == val) {
                        fileExists = true;
                        if (myUrl.includes('edit')) {
                            controller = "controllers/" + myUrl.replace('edit', '');
                            controller_type = 'get';
                        } else if (myUrl.toLowerCase().includes('view')) {
                            controller = "controllers/" + myUrl.replace('view', '');
                            controller_type = 'get';
                        } else if (myUrl.includes('delete')) {
                            controller = "controllers/" + myUrl.replace('delete', '');
                            controller_type = 'get';
                        } else if (myUrl.includes('add')) {
                            controller = "controllers/" + myUrl.replace('add', '')
                        } else {
                            let newArray = myUrl.split('/');
                            let fileName = newArray[newArray.length - 1].includes('?') ? newArray[newArray.length - 1].split('?')[0] : newArray[newArray.length - 1];
                            controller_type = fileName.replace(val, '');
                            // let things = controller_type[1].split('&');
                            // things.forEach(function (val, index) {
                            //     let array = val.split('=');
                            //     $("form[fw-id=target-form-target-fw]").append('<input type="hidden" value="' + array[1] + '" name="' + array[0] + '">');
                            // });
                            controller = "controllers/" + myUrl.replace(controller_type, '');
                        }
                    }

                });
                view = "views/" + myUrl;
                if (controller) {
                    let tmpController = (controller.includes('?') ? (controller.split('?')[0]) : controller);
                    isControllerValid = (allControllers.includes(tmpController));
                } else {
                    fileExists = false;
                }
                if (view) {
                    let tmpView = (view.includes('?') ? (view.split('?')[0]) : view);
                    isViewValid = (allViews.includes(tmpView));
                } else {
                    fileExists = false;
                }
            } else {
                isControllerValid = true;
                isViewValid = true;
                fileExists = true;
                myUrl = myUrl.replace('.fwTools', '');
                controller = "fwTools/controller/" + myUrl;
                view = "fwTools/view/" + myUrl
            }
            if (!fileExists) {
                $.loader();
                Swal.fire({
                    icon: 'info',
                    title: 'صفحه ی مورد نظر در حال طراحی است!',
                    confirmButtonText: 'تایید'
                });
                return false;
            }
            if (!isControllerValid) {
                $.loader();
                Swal.fire({
                    icon: 'info',
                    title: 'صفحه ی مورد نظر در حال طراحی است!',
                    <? if ($DEVELOPMENT and $DEBUG) {?>
                    text: 'آدرس کنترلر اشتباه است',
                    <? } ?>
                    confirmButtonText: 'تایید'
                });
                return false;
            }
            if (!isViewValid) {
                $.loader();
                Swal.fire({
                    icon: 'info',
                    title: 'صفحه ی مورد نظر در حال طراحی است!',
                    <? if ($DEVELOPMENT and $DEBUG) {?>
                    text: 'آدرس ویو اشتباه است',
                    <? } ?>
                    confirmButtonText: 'تایید'
                });
                return false;
            }

            $.ajax({
                url: 'Actions/CheckSession.php', success: r => {
                    if (parseInt(r) === 1) {
                        $.ajax({
                            data: {
                                ajax_type: 'internal',
                                controller_type: controller_type,
                            },
                            type: "POST",
                            url: controller, success: rt => {
                                let key = rt.split('||||||')[0];
                                $.ajax({
                                    url: view,
                                    data: {
                                        data: rt.split('||||||')[1],
                                        fw_referrer: fw_referrer,
                                        controller_key: key,
                                        controller: controller,
                                        timeStampForAjaxRequest: date.getTime()
                                    },
                                    type: "POST",
                                    success: page => {
                                        view = view.split('/');
                                        view = view[view.length - 1];
                                        view = (view.includes('?') ? view.split('?')[0] : view);
                                        window.history.pushState('page2', 'Title', view);
                                        let title = document.title;
                                        title = (title.includes('/') ? title.split('/')[0] : title);
                                        $('#fw-content').empty();
                                        $('#fw-content').html(page);
                                        document.title = ($("#fw_current_page_title").val() ? title + ' / ' + $("#fw_current_page_title").val() : title);
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
                            },
                            cache: !1, async: !0
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
        });
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
            url: 'Actions/CheckSession', success: function (r) {
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
                    window.location = 'lockScreen?username=' + un + '&avatar=' + av + "&name=" + nm;
                    return !1
                }
            }
        })
    }
</script>
