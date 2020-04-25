<?php
include_once '../../../../autoload.php';
$View = new View($_REQUEST, 'تنظیمات فوتر','تنظیمات فوتر');
$View->breadcrumbs();
$View->submit();
$View->doFill();
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
                $View->Html()->FormGroupStart(6).
                $View->Html()->Label('شماره تماس').
                $View->Tel('tel','tel').
                $View->Html()->FormGroupEnd().
                $View->Html()->FormGroupStart(6).
                $View->Html()->Label('ایمیل').
                $View->Input('email','email').
                $View->Html()->FormGroupEnd().
                $View->Html()->FormGroupStart(3).
                $View->Html()->Label('اینستاگرام').
                $View->Input('instagram','instagram').
                $View->Html()->FormGroupEnd().
                $View->Html()->FormGroupStart(3).
                $View->Html()->Label('فیسبوک').
                $View->Input('facebook','facebook').
                $View->Html()->FormGroupEnd().
                $View->Html()->FormGroupStart(3).
                $View->Html()->Label('توییتر').
                $View->Input('twitter','twitter').
                $View->Html()->FormGroupEnd().
                $View->Html()->FormGroupStart(3).
                $View->Html()->Label('تلگرام').
                $View->Input('telegram','telegram').
                $View->Html()->FormGroupEnd()
                ?>
            <?
            $View->CardFooter();
            ?>
        </div>
    </div>
</section>

<script>
    $("#email").checkEmail();
</script>
