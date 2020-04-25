<?php
include_once '../../../autoload.php';
$View = new View($_REQUEST, 'تیتر');
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
                    echo '<br>'.$View->getData()->for.'<br>';
                    $View->refreshAndBack();
                    ?>
                </div>
                <?=
                $View->FormStart() .
                $View->Html()->FormGroupStart(6).
                $View->Html()->Label('تیتر').
                $View->Html()->Input('title').
                $View->Html()->FormGroupEnd() .
                $View->Html()->FormGroupStart(12).
                $View->Html()->Label('متن').
                $View->Html()->TextArea('text','text').
                $View->Html()->FormGroupEnd()
                ?>
                <?
                $View->CardFooter()
                ?>
            </div>
        </div>
    </div>
</section>
<script>
    $.checkText();
</script>
