<?php
include '../../../autoload.php';
?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>QUERY BUILDER</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="../../index.php">خانه</a></li>
                    <li class="breadcrumb-item active">QUERY BUILDER</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="row">

        <div class="col-md-12">
            <div class="card card-warning card-outline">
                <div class="card-header">
                    <h3 class="card-title">QUERY BUILDER</h3>
                    <div class="card-tools">

                        <a rel="QueryBuilder/QueryBuilder.fwTools.php"
                           class="btn btn-outline-warning pull-left ajax"><i
                                class="fa fa-refresh"></i> تازه
                            سازی</a>
                    </div>
                </div>
                <form>
                    <div class="card-body d-flex flex-wrap table-responsive">
                        <div class="form-group col-md-9 mr-auto ml-auto">
                            <label for="array">آرایه ی جیسونی</label>
                            <textarea id="array" rows="5" name="json" class="form-control ltr"></textarea>
                        </div>
                    </div>
                    <div class="form-group col-md-12 mr-auto ml-auto text-center">
                        <label for="array">کوئری:</label>
                        <textarea id="result" rows="12" class="form-control ltr"></textarea>

                    </div>

                    <div class="card-footer">
                        <button type="submit" name="submit" class="btn btn-warning pull-left text-white"><i class="fa fa-plus"></i>
                            !Build
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script>
    $("form").submit(function (e) {
        let formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'fwTools/controller/QueryBuilder/QueryBuilder.php',
            data: formData,
            async: false,
            success: function (data) {
                $("#result").val(data);
            },
            cache: false,
            contentType: false,
            processData: false
        });
        e.preventDefault();
    });
    $.Ajax();
</script>
