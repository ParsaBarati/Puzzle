<?php
include '../../../autoload.php';
?>
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
                <h1>MODEL GENERATOR</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="../../index.php">خانه</a></li>
                    <li class="breadcrumb-item active">MODEL GENERATOR</li>
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
                    <h3 class="card-title">MODEL GENERATOR</h3>
                    <div class="card-tools">

                        <a rel="modelGenerator/modelGenerator.fwTools.php"
                           class="btn btn-outline-success pull-left ajax"><i
                                    class="fa fa-refresh"></i> تازه
                            سازی</a>
                    </div>
                </div>
                <form>
                    <?= hiddenInput('make') ?>
                    <div class="card-body d-flex flex-wrap table-responsive">

                        <div class="form-group col-md-4">
                            <label for="name">نام مدل</label>
                            <input  id="name" class="form-control" dir="ltr" type="text" name="name">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="controller_name">نام کنترلر</label>
                            <input  id="controller_name" class="form-control" dir="ltr" type="text"
                                   name="controller_name">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="tblName">نام جدول</label>
                            <input  id="tblName" autocomplete="off" class="form-control" dir="ltr" type="text"
                                   name="tblName">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="tblKey">کلید</label>
                            <input  id="tblKey" class="form-control" dir="ltr" type="text" name="tblKey">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="address">آدرس قراردهی فایل</label>
                            <div class="input-group">
                                <input  id="address" class="form-control" dir="ltr" type="text" name="address">
                                <span class="input-group-addon mt-2 mr-2"><?= __SOURCE__ . 'models/' ?></span>
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
    $(function () {
        $(".dropdown-item").on('click', function () {
            let cardParent = $(this).parents('.bg-transparent');
            let num = $(cardParent).attr("id").replace('card_','');
            if (!$(this).hasClass('active')) {
                if ($(this).attr("data-value") === 'checkbox') {
                    $(cardParent).children('.card-header').children('.card-tools').children('.btn-group').after('<button type="button" id="add_check_box_'+num+'" class="btn btn-tool"><i class="fa fa-plus"></i></button>');
                    $(cardParent).children('.card-body').children('.input-group').children('.input-group-prepend').before('<input placeholder="لیبل" name="checkboxLabel['+num+']" id="check_box_label_'+num+'" class="form-control" dir="rtl" type="text" >');
                    $("#add_check_box_0").on('click',function () {
                        let last = $("#input_group_"+num);
                        let newItem = $(last).after('<div class="input-group m-1" id="input_group_'+num+'">\n' +
                            '                                                            <input placeholder="لیبل" name="checkboxLabel['+num+']" id="check_box_label_'+num+'" class="form-control" dir="rtl" type="text"><div class="input-group-append">\n' +
                                '<button data-remove="input_group_'+num+'" type="button" class="btn btn-danger removeThis"><i class="fa fa-remove"></i></button>' +
                            '                                                            </div>\n' +
                            '                                                        </div>');
                    });
                    $(document).on('click', '.removeThis', function(){
                        let id = $(this).attr("data-remove");
                        $("#"+id).remove()
                    });
                } else {
                    $("#check_box_label_"+num).remove();
                    $("#add_check_box_"+num).remove();

                }
                $(".dropdown-item").removeClass('active');
                $(this).addClass('active');
            }
        });
    });
    $(".slider").on('change', function () {
        let val = $(this).val(), that = $(this), parent = $(this).parents('.parentDiv');
        let classList = $(parent).attr('class').split(/\s+/);

        $.each(classList, function (index, item) {
            if (/col-md-\d{1,2}/.test(item)) {
                classList[index] = 'col-md-' + val;
            }
        });
        $(parent).attr('class', classList.join(' '))
    });
    $("#tblName").fw_autocomplete('fwTools/controller/modelGenerator/modelGenerator.php');
    $.submit('fwTools/controller/modelGenerator/modelGenerator.php');
    $.Ajax();
</script>
