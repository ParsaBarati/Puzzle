<?php
include '../../../autoload.php';
$View = new View($_REQUEST, 'عضویت خبر نامه','اعضای خبرنامه');
$View->breadcrumbs();
?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <?
                    $View->refreshAndAdd();
                    ?>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                        <tr>
                            <th width="50">ردیف</th>
                            <th>ایمیل</th>
                            <th width="150">عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?= $View->show(['email'], -1, false, false, true) ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

