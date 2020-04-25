<?php
include '../../../autoload.php';
$View = new View($_REQUEST, 'روند کار','روند های کاری');
$View->breadcrumbs(); ?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <?
                    $View->CardTitle();
                    $View->refresh();
                    ?>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                        <tr>
                            <th width="50">مرحلله</th>
                            <th>تیتر</th>
                            <th width="150">عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?= $View->show(['title'], -1, true, true, false) ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
