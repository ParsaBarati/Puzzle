<?php
include '../../../autoload.php';
$View = new View($_REQUEST, 'روند کار','روند های کاری');
$View->doFill();
$View->submit();
$View->breadcrumbs(); ?>
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
                $View->FormStart().
                $View->Html()->FormGroupStart(4).
                $View->Html()->Label('تیتر').
                $View->Html()->Input('title').
                $View->Html()->FormGroupEnd().
                $View->Html()->FormGroupStart(8).
                $View->Html()->Label('متن').
                $View->Html()->Input('text').
                $View->Html()->FormGroupEnd().
                $View->Html()->FormGroupStart(12).
                $View->Html()->Label('تصویر').
                $View->Html()->ImageInput('image','image/png',234,264).
                $View->Html()->FormGroupEnd()
                ?>
                <?
                $View->CardFooter();
                ?>
            </div>
        </div>
    </div>
</section>
