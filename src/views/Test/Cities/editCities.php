<?php
include '../../../autoload.php';
$View = new View($_REQUEST,'شهر');
$View->breadcrumbs();
$View->submit();
$View->doFill();
use model\States; ?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <?
                    $View->CardTitle();
                    $View->refreshAndBack();
                    ?>
                </div>
                <?=
                $View->FormStart() .
                $View->Html()->FormGroupStart(6).
                $View->Html()->Label('نلم شهر').
                $View->Html()->Input('city_name') .
                $View->Html()->FormGroupEnd() .
                $View->Html()->FormGroupStart(6).
                $View->Html()->Label('انتخاب استان').
                $View->Html()->Select('state_id','state_id',selectByClass(new States(),'state_name')) .
                $View->Html()->FormGroupEnd()
                ?>
                <?
                $View->CardFooter();
                ?>
            </div>
        </div>
    </div>
</section>
