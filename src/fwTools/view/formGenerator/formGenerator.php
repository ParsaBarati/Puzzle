<?php
include '../../../autoload.php';
include 'Models.php';

use fwTools\all\Models; ?>
<style>
    .slider {
        -webkit-appearance: none;
        width: 100%;
        height: 25px;
        background: #d3d3d3;
        outline: none;
        opacity: 0.7;
        -webkit-transition: .2s;
        transition: opacity .2s;
    }

    .slider:hover {
        opacity: 1;
    }

    .slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 25px;
        height: 25px;
        background: #4CAF50;
        cursor: pointer;
    }

    .slider::-moz-range-thumb {
        width: 25px;
        height: 25px;
        background: #4CAF50;
        cursor: pointer;
    }
</style>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Table GENERATOR</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="../../index.php">خانه</a></li>
                    <li class="breadcrumb-item active">Table GENERATOR</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="row">

        <div class="col-md-12">
            <div class="card card-success card-outline">
                <div class="card-header">
                    <h3 class="card-title">Table GENERATOR</h3>
                    <div class="card-tools">

                        <a rel="formGenerator/formGenerator.fwTools.php"
                           class="btn btn-outline-success pull-left ajax"><i
                                    class="fa fa-refresh"></i> تازه
                            سازی</a>
                    </div>
                </div>
                <form>
                    <?= hiddenInput('make') ?>
                    <div class="card-body d-flex flex-wrap table-responsive">
                        <div class="form-group col-md-2">
                            <label for="tblName">
                                نام جدول
                            </label>
                            <div class="input-group">
                                <input dir="ltr" class="form-control" name="tblName" id="tblName">
                                <div class="input-group-append">
                                    <div class="input-group-text">tbl</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-5 card card-success card-outline">
                                <div class="card-header">
                                    <div class="card-title">
                                        فرم
                                    </div>
                                    <div class="card-tools">
                                        <button class="btn btn-tool" data-widget="collapse">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                        <button id="add_item" class="btn btn-tool">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                        <div class="btn-group">
                                            <button type="button"
                                                    class="btn btn-tool dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="true">
                                                <i class="fa fa-wrench"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-left"
                                                 role="menu" x-placement="bottom-start"
                                                 style="position: absolute; transform: translate3d(0px, 31px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a id="addSelect" href="#"
                                                   class="dropdown-item">ورودی انتخابی (select)</a>
                                                <a id="addImage" href="#"
                                                   class="dropdown-item">ورودی تصویر (image)</a>
                                                <a id="addEditor" href="#"
                                                   class="dropdown-item">ورودی متنی (پیشرفته)</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <div id="formData" class="col-md-12 d-flex flex-wrap greatParent">
                                            <div class="form-group col-md-4 parentDiv">
                                                <div id="card_0" class="card card-danger card-outline bg-transparent">
                                                    <div class="card-header">
                                                        <div class="card-title">
                                                            <h5>ورودی نوشتاری (معمولی)</h5>
                                                            <h6>لیبل</h6>
                                                            <div class="input-group w-100">
                                                                <input required name="label[0]"
                                                                       placeholder="مثال: نام استان"
                                                                       class="form-control w-50">
                                                                <select required name="type[0]"
                                                                        class="form-control w-50">
                                                                    <option value="varchar">کاراکتر کم</option>
                                                                    <option value="text">کاراکتر زیاد</option>
                                                                    <option value="int">عددی</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="card-tools">
                                                            <button type="button" class="btn btn-tool removeMe"><i
                                                                        class="fa fa-times"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-tool showAndHide"><i
                                                                        class="fa fa-eye"></i>
                                                            </button>
                                                            <input type="hidden" class="togShow" name="show[0]"
                                                                   value="true">

                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    نام:
                                                                </div>
                                                            </div>
                                                            <input required name="name[0]"
                                                                   placeholder="state_name"
                                                                   class="form-control"
                                                                   dir="ltr" type="text">
                                                            <input type="hidden" name="col_type[0]" value="input">
                                                            <input type="hidden" name="class[0]" value="*">
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="validations">
                                                            <div class="form-group">
                                                                <label>اعتبار سنجی</label>
                                                                <select name="validations[0]"
                                                                        class="form-control w-100">
                                                                    <option value="Input">فاقد اعتبار سنجی</option>
                                                                    <option value="Price">قیمت</option>
                                                                    <option value="Mobile">شماره موبایل</option>
                                                                    <option value="Tel">شماره تلفن</option>
                                                                    <option value="Number">فقط عدد</option>
                                                                    <option value="English">فقط انگلیسی</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <input required name="slider[0]" value="4"
                                                               class="slider w-100"
                                                               min="1"
                                                               max="12"
                                                               type="range">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>


                    <div class="card-footer">
                        <button type="submit" name="submit" class="btn btn-success pull-left"><i class="fa fa-plus"></i>
                            !Generate
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script>
    $("#addImage").on('click', (e) => {
        e.preventDefault();
        let lastDiv = $(".greatParent").find('div.card[id^=card_]');
        lastDiv = $($(lastDiv)[$(lastDiv).length - 1]);
        let parent = $(lastDiv).parents('.parentDiv');
        let id = $(lastDiv).attr("id");
        id = id.split('_')[1];
        id++;
        id = '' + id;
        let addable = '<div class="form-group col-md-4 parentDiv">\n' +
            '                                                <div id="card_' + id + '" class="card card-danger card-outline bg-transparent">\n' +
            '                                                    <div class="card-header">\n' +
            '                                                        <div class="card-title">\n' +
            '                                                            <h5>ورودی تصویر (image)</h5>\n' +
            '                                                            <h6>عکس</h6>\n' +
            '                                                            <div class="input-group w-100">\n' +
            '                                                                <input required name="label[' + id + ']"\n' +
            '                                                                       placeholder="مثال: تصویر استان"\n' +
            '                                                                       class="form-control w-50">\n' +
            '                                                                <select required name="imageData[' + id + '][type]"\n' +
            '                                                                        class="form-control w-50">\n' +
            '                                                                    <option value="image/jpeg">فرمت jpg</option>\n' +
            '                                                                    <option value="image/png">فرمت png</option>\n' +
            '                                                                </select>\n' +
            '<input type="hidden" value="varchar" name="type[' + id + ']">' +
            '                                                            </div>\n' +
            '                                                        </div>\n' +
            '                                                        <div class="card-tools">\n' +
            '                                                            <button type="button"  class="btn btn-tool removeMe"><i\n' +
            '                                                                        class="fa fa-times"></i>\n' +
            '                                                            </button>\n' +
            '                                                            <button type="button"  class="btn btn-tool showAndHide"><i\n' +
            '                                                                        class="fa fa-eye"></i>\n' +
            '                                                            </button>\n' +
            '                                                            <input type="hidden" class="togShow" name="show[' + id + ']"\n' +
            '                                                                   value="true">\n' +
            '\n' +
            '                                                        </div>\n' +
            '                                                    </div>\n' +
            '                                                    <div class="card-body">\n' +
            '                                                        <div class="input-group">\n' +
            '                                                            <div class="input-group-prepend">\n' +
            '                                                                <div class="input-group-text">\n' +
            '                                                                    نام:\n' +
            '                                                                </div>\n' +
            '                                                            </div>\n' +
            '                                                            <input required name="name[' + id + ']" placeholder="state_image"\n' +
            '                                                                   class="form-control"\n' +
            '                                                                   dir="ltr" type="text">\n' +
            '                                                            <input type="hidden" name="col_type[' + id + ']" value="image">\n' +
            '                                                            <input type="hidden" name="class[' + id + ']" value="*">\n' +
            '                                                        </div>\n' +
            '                                                    </div>\n' +
            '                                                    <div class="card-footer">\n' +
            '                                                        <div class="validations">\n' +
            '                                                            <div class="form-group">\n' +
            '                                                                <label>اعتبار سنجی</label>\n' +
            '                                                                 <div class="input-group w-100">' +
            '<div class="input-group-prepend">' +
            '<div class="input-group-text"> عرض </div>' +
            '<input class="form-control" value="150" name="imageData[' + id + '][width]">' +
            // '</div>' +
            //     '<div class="input-group-prepend">' +
            '<div class="input-group-text"> طول </div>' +
            '<input class="form-control" value="150" name="imageData[' + id + '][height]">' +
            '</div>' +
            '</div>                             \n' +
            '                                                            </div>\n' +
            '                                                        </div>\n' +
            '                                                        <input required name="slider[' + id + ']" value="4" class="slider w-100"\n' +
            '                                                               min="1"\n' +
            '                                                               max="12"\n' +
            '                                                               type="range">\n' +
            '                                                    </div>\n' +
            '                                                </div>\n' +
            '                                            </div>';

        $(parent).after(addable);
        doSort();
    });
</script>
<script>
    $(document).on('change', 'input.slider', function () {
            let val = $(this).val(), that = $(this), parent = $(this).parents('.parentDiv');
            let classList = $(parent).attr('class').split(/\s+/);

            $.each(classList, function (index, item) {
                if (/col-md-\d{1,2}/.test(item)) {
                    classList[index] = 'col-md-' + val;
                }
            });
            $(parent).attr('class', classList.join(' '));
        }
    );
    $.submit('fwTools/controller/formGenerator/formGenerator.php');
    $.Ajax();
    $("#add_item").on('click', function (e) {
        e.preventDefault();
        let lastDiv = $(".greatParent").find('div.card[id^=card_]');
        lastDiv = $($(lastDiv)[$(lastDiv).length - 1]);
        let parent = $(lastDiv).parents('.parentDiv');
        let id = $(lastDiv).attr("id");
        if (id) {
            id = id.split('_')[1];
        } else {
            id = -1;
        }
        id++;
        let addable = ' <div class="form-group col-md-4 parentDiv">\n' +
            '                                                <div id="card_' + id + '" class="card card-danger card-outline bg-transparent">\n' +
            '<div class="card-header">\n' +
            '                                                        <div class="card-title">\n' +
            '                                                            <h5>ورودی نوشتاری (معمولی)</h5>\n' +
            '                                                            <h6>لیبل</h6>\n' +
            '                                                            <div class="input-group w-100">\n' +
            '                                                                <input required name="label[' + id + ']"\n' +
            '                                                                       placeholder="مثال: نام استان"\n' +
            '                                                                       class="form-control w-50">\n' +
            '                                                                <select required name="type[' + id + ']"\n' +
            '                                                                        class="form-control w-50">\n' +
            '                                                                    <option value="varchar">کاراکتر کم</option>\n' +
            '                                                                    <option value="text">کاراکتر زیاد</option>\n' +
            '                                                                    <option value="int">عددی</option>\n' +
            '                                                                </select>\n' +
            '                                                            </div>\n' +
            '                                                        </div>\n' +
            '                                                        <div class="card-tools">\n' +
            '                                                            <button type="button"  class="btn btn-tool removeMe"><i\n' +
            '                                                                        class="fa fa-times"></i>\n' +
            '                                                            </button>\n' +
            '                                                            <button type="button"  class="btn btn-tool showAndHide"><i\n' +
            '                                                                        class="fa fa-eye"></i>\n' +
            '                                                            </button>\n' +
            '                                                            <input type="hidden" class="togShow" name="show[' + id + ']"\n' +
            '                                                                   value="true">\n' +
            '\n' +
            '                                                        </div>\n' +
            '                                                    </div>\n' +
            '                                                    <div class="card-body">\n' +
            '                                                        <div class="input-group">\n' +
            '                                                            <div class="input-group-prepend">\n' +
            '                                                                <div class="input-group-text">\n' +
            '                                                                    نام:\n' +
            '                                                                </div>\n' +
            '                                                            </div>\n' +
            '                                                            <input required name="name[' + id + ']" placeholder="state_name"\n' +
            '                                                                   class="form-control"\n' +
            '                                                                   dir="ltr" type="text">\n' +
            '                                                            <input type="hidden" name="col_type[' + id + ']" value="input">\n' +
            '                                                            <input type="hidden" name="class[' + id + ']" value="*">\n' +
            '                                                        </div>\n' +
            '                                                    </div>\n' +
            '                                                    <div class="card-footer">\n' +
            '                                                        <div class="validations">\n' +
            '                                                            <div class="form-group">\n' +
            '                                                                <label>اعتبار سنجی</label>\n' +
            '                                                                <select name="validations[' + id + ']" class="form-control w-100">\n' +
            '                                                                    <option value="Input">فاقد اعتبار سنجی</option>\n' +
            '                                                                    <option value="Price">قیمت</option>\n' +
            '                                                                    <option value="Mobile">شماره موبایل</option>\n' +
            '                                                                    <option value="Tel">شماره تلفن</option>\n' +
            '                                                                    <option value="Number">فقط عدد</option>\n' +
            '                                                                    <option value="English">فقط انگلیسی</option>\n' +
            '                                                                </select>\n' +
            '                                                            </div>\n' +
            '                                                        </div>\n' +
            '                                                        <input required name="slider[' + id + ']" value="4" class="slider w-100"\n' +
            '                                                               min="1"\n' +
            '                                                               max="12"\n' +
            '                                                               type="range">\n' +
            '                                                    </div>' +
            '                                                </div>\n' +
            '                                            </div>';
        $(parent).after(addable);
        doSort();
    });
    $("#addEditor").on('click', function (e) {
        e.preventDefault();
        let lastDiv = $(".greatParent").find('div.card[id^=card_]');
        lastDiv = $($(lastDiv)[$(lastDiv).length - 1]);
        let parent = $(lastDiv).parents('.parentDiv');
        let id = $(lastDiv).attr("id");
        if (id) {
            id = id.split('_')[1];
        } else {
            id = -1;
        }
        id++;
        let addable = ' <div class="form-group col-md-12 parentDiv">\n' +
            '                                                <div id="card_' + id + '" class="card card-danger card-outline bg-transparent">\n' +
            '<div class="card-header">\n' +
            '                                                        <div class="card-title">\n' +
            '                                                            <h5>ورودی متنی (پیشرفته)</h5>\n' +
            '                                                            <h6>لیبل</h6>\n' +
            '                                                            <div class="input-group w-100">\n' +
            '                                                                <input required name="label[' + id + ']"\n' +
            '                                                                       placeholder="مثال: توضیحات استان"\n' +
            '                                                                       class="form-control w-50">\n' +
            '<input type="hidden" name="type[' + id + ']" value="text">' +
            '                                                            </div>\n' +
            '                                                        </div>\n' +
            '                                                        <div class="card-tools">\n' +
            '                                                            <button type="button"  class="btn btn-tool removeMe"><i\n' +
            '                                                                        class="fa fa-times"></i>\n' +
            '                                                            </button>\n' +
            '                                                            <button type="button"  class="btn btn-tool showAndHide"><i\n' +
            '                                                                        class="fa fa-eye"></i>\n' +
            '                                                            </button>\n' +
            '                                                            <input type="hidden" class="togShow" name="show[' + id + ']"\n' +
            '                                                                   value="true">\n' +
            '\n' +
            '                                                        </div>\n' +
            '                                                    </div>\n' +
            '                                                    <div class="card-body">\n' +
            '                                                        <div class="input-group">\n' +
            '                                                            <div class="input-group-prepend">\n' +
            '                                                                <div class="input-group-text">\n' +
            '                                                                    نام:\n' +
            '                                                                </div>\n' +
            '                                                            </div>\n' +
            '                                                            <input required name="name[' + id + ']" placeholder="state_details"\n' +
            '                                                                   class="form-control"\n' +
            '                                                                   dir="ltr" type="text">\n' +
            '                                                            <input type="hidden" name="col_type[' + id + ']" value="input">\n' +
            '                                                            <input type="hidden" name="class[' + id + ']" value="*">\n' +
            '                                                        </div>\n' +
            '                                                    </div>\n' +
            '                                                    <div class="card-footer">\n' +
            '                                                        <input required name="slider[' + id + ']" value="12" class="slider w-100"\n' +
            '                                                               min="1"\n' +
            '                                                               max="12"\n' +
            '                                                               type="range">\n' +
            '                                                    </div>' +
            '                                                </div>\n' +
            '                                            </div>';
        $(parent).after(addable);
        doSort();

    });
    $("#tblName").checkEnglish();
    $("#addSelect").on('click', function (e) {
        e.preventDefault();
        let lastDiv = $(".greatParent").find('div.card[id^=card_]');
        lastDiv = $($(lastDiv)[$(lastDiv).length - 1]);
        let parent = $(lastDiv).parents('.parentDiv');
        let id = $(lastDiv).attr("id");
        id = id.split('_')[1];
        id++;
        let addable = ' <div class="form-group col-md-4 parentDiv">\n' +
            '                                                <div id="card_' + id + '" class="card card-danger card-outline bg-transparent">\n' +
            '                                                    <div class="card-header">\n' +
            '                                                        <div class="card-title">\n' +
            '                                                            <h5>ورودی انتخابی (select)</h5>\n' +
            '<h6>لیبل</h6>' +
            '                                                            <div class="input-group w-100">\n' +
            '                                                                <input required name="label[' + id + ']" placeholder="مثال: انتخاب استان"\n' +
            '                                                                       class="form-control w-50">\n' +
            '                                                                <select required name="class[' + id + ']"\n' +
            '                                                                        class="form-control w-50">\n' +
            '<option value="0">خالی</option>' +
            '<?=selectByClass(new Models(), "name")?>' +
            '<input type="hidden" value="int" name="type[' + id + ']">' +
            '<input type="hidden" value="Select" name="validations[' + id + ']">' +

            '                                                                </select>\n' +
            '                                                            </div>\n' +
            '                                                        </div>\n' +
            '                                                        <div class="card-tools">\n' +
            '                                                            <button type="button" class="btn btn-tool removeMe"><i\n' +
            '                                                                        class="fa fa-times"></i>\n' +
            '                                                            </button>\n' +

            '<button type="button" class="btn btn-tool showAndHide"><i\n' +
            '                                                                        class="fa fa-eye"></i>\n' +
            '                                                            </button>\n' +
            '                                                            <input type="hidden" class="togShow" name="show[' + id + ']"\n' +
            '                                                                   value="true">' +
            '\n' +
            '                                                        </div>\n' +
            '                                                    </div>\n' +
            '                                                    <div class="card-body">\n' +
            '                                                        <div class="input-group">\n' +
            '                                                            <div class="input-group-prepend">\n' +
            '                                                                <div class="input-group-text">\n' +
            '                                                                    نام:\n' +
            '                                                                </div>\n' +
            '                                                            </div>\n' +
            '                                                            <input required name="name[' + id + ']" placeholder="state_id"\n' +
            '                                                                   class="form-control"\n' +
            '                                                                   dir="ltr" type="text">\n' +
            '<input type="hidden" name="col_type[' + id + ']" value="select">' +
            '                                                        </div>\n' +
            '                                                    </div>\n' +
            '                                                    <div class="card-footer">\n' +
            '                                                        <input required name="slider[' + id + ']" value="4" class="slider w-100" min="1" max="12"\n' +
            '                                                               type="range">\n' +
            '                                                    </div>\n' +
            '                                                </div>\n' +
            '                                            </div>';
        $(parent).after(addable);
        doSort();

    });
    $(document).on('click', '.removeMe', function (e) {
        e.preventDefault();
        $(this).parents('.parentDiv').remove();
    });

    function doSort() {
        // $(".parentDiv").each(function () {
        //     if ($(this).hasClass('ui-sortable')) {
        //         $(this).sortable("destroy");
        //     }
        //     $(this).sortable({ opacity: 0.6, cursor: 'move', update: function() {
        //             alert('hi')
        //         }
        //     });
        // });
        if ($(this).hasClass('ui-sortable')) {
            $(this).sortable("destroy");
        }
        $("#formData").sortable({
            opacity: 0.6, cursor: 'move',
            update: function () {
                let $list = $("#formData").children();
                $("#formData").children().each(function (index) {
                    let item = $list[index];
                    let $item = $(item).find('div.card[id^=card_]');
                    let id = 'card_' + index;
                    $($item).attr('id', id);
                    $($item).find('input').each(function () {
                        let name = $(this).attr("name");
                        let first = name.indexOf('[');
                        let second = name.indexOf(']');
                        $(this).attr("name", (name.substring(0, first + 1) + index + name.substring(first + 2, second + 1)));
                    });
                    $($item).find('select').each(function () {
                        let name = $(this).attr("name");
                        let first = name.indexOf('[');
                        let second = name.indexOf(']');
                        $(this).attr("name", (name.substring(0, first + 1) + index + name.substring(first + 2, second + 1)));
                    });
                });

            }
        });
    }


    $(document).on('click', '.showAndHide', function (e) {
        e.preventDefault();
        let $i = $(this).find('i.fa');
        if ($($i).hasClass('fa-eye')) {
            $($i).removeClass('fa-eye');
            $($i).addClass('fa-eye-slash');
            $(this).parents('.card-tools').find('.togShow').val('false');
        } else {
            $($i).removeClass('fa-eye-slash');
            $(this).parents('.card-tools').find('.togShow').val('true');
            $($i).addClass('fa-eye');
        }
    });
</script>
