<?php
include_once '../../../autoload.php';
$View = new View($_REQUEST, 'تیکت');
$View->breadcrumbs();
?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <?
                    $View->refresh();
                    ?>
                </div>
                <div class="card card-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th width="50">ردیف</th>
                                <th>نام</th>
                                <th>ایمیل</th>
                                <th width="50">عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?=$View->show(['user_name','email'])?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
