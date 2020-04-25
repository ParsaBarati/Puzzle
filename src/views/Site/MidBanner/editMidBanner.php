<?php
include_once '../../../autoload.php';
$View = new View($_REQUEST, 'بنر','بنر بخش وسط');
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
                $View->FormGroupStart(4).
                $View->Label('تیتر اصلی').
                $View->Input('title').
                $View->FormGroupEnd().
                $View->FormGroupStart(8).
                $View->Label('متن زیر تیتر').
                $View->Input('text').
                $View->FormGroupEnd().
                $View->FormGroupStart(4).
                $View->Label('متن دکمه').
                $View->Input('btn_text').
                $View->FormGroupEnd() .
                $View->FormGroupStart(8).
                $View->Label('تصویر').
                $View->ImageInput('image','image/png',423,565).
                $View->FormGroupEnd()
                ?>
                <?
                $View->CardFooter()
                ?>
            </div>
        </div>
    </div>
</section>
