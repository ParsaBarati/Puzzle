<?php
include_once '../../../autoload.php';
$View = new View($_REQUEST, 'شمارنده');
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
                $View->Label('متن').
                $View->Input('text').
                $View->FormGroupEnd().
                $View->FormGroupStart(8).
                $View->Label('عدد و علامت')
                ?>
                <div class="input-group">
                    <input value="<?=$View->getData()->sign?>" name="sign" class="form-control w-25">
                    <input value="<?=$View->getData()->number?>" name="number" type="number" class="form-control w-75">
                </div>
                <?=
                $View->FormGroupEnd()
                ?>
                <?
                $View->CardFooter()
                ?>
            </div>
        </div>
    </div>
</section>
