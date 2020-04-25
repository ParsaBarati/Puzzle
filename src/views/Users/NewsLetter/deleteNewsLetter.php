<?php
include '../../../autoload.php';
$View = new View($_REQUEST, 'عضویت خبر نامه','اعضای خبرنامه');
$View->breadcrumbs();
$View->submit();
$View->doFill();
$View->doDisableAll();
?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <?
                    $View->refreshAndBack();
                    ?>
                </div>
                <?=
                $View->FormStart().
                $View->Html()->FormGroupStart(12).
                $View->Html()->Label('ایمیل').
                $View->Html()->Input('email','email').
                hiddenInput(time(),'sdate').
                $View->Html()->FormGroupEnd()
                ?>
                <?
                $View->CardFooter();
                ?>
            </div>
        </div>
    </div>
</section>
<script>
    $("#email").checkEmail();
</script>
