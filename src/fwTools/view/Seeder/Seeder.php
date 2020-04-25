<?php
include '../../../autoload.php';
$AllDATA = ValidateRequestForPageLoad($_POST,true);
//echo CheckLoadedDataFromAjaxCall($AllDATA);
?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>DATA SEEDER</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="../../index.php">خانه</a></li>
                    <li class="breadcrumb-item active">DATA SEEDER</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="row">

        <div class="col-md-12">

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">DATA SEEDER</h3>
                </div>
                <div class="card-body d-flex flex-wrap table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="table-dark">
                        <tr>
                            <th class="no-sort">ردیف</th>
                            <th>نام جدول</th>
                            <th>تعداد فیلد ها</th>
                            <th>تعداد رکورد ها</th>
                            <th class="no-sort" width="200">عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i=0;
                        foreach ($AllDATA as $table => $data) {
                            $i++;
                            ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $table ?></td>
                                <td><?= sizeof($data) ?></td>
                                <td><?= $data['row_count'] ?></td>
                                <td>
                                    <a rel="Seeder/SeedStart.php?table=<?=$table?>"
                                       class="btn btn-info ajax" data-toggle="tooltip" title="SEED"><i
                                            class="fa fa-leaf"></i> </a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ajaxStart(function () {
        Pace.restart();
    });
    $("[data-toggle=tooltip]").tooltip();
    $.Ajax();
    $.table();
</script>
