<?php
include_once '../../../../autoload.php';
$View = new View($_REQUEST, 'تنظیمات فوتر,','تنظیمات فوتر');
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
                <div class="card-body table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                        <tr>
                            <th class="no-sort" width="50">ردیف</th>
                            <th>شماره تلفن</th>
                            <th>ایمیل</th>
                            <th class="no-sort" width="150">عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?= $View->show(['MobileFormat' => 'tel', 'email'], -1, true, true, false) ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

