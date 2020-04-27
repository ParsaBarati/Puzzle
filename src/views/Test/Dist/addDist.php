<?php
include_once '../../../autoload.php';
$View = new View($_REQUEST,'دیست');
$View->breadcrumbs();
$View->submit();
?>
<section class='content'>
    <div class='row'>
        <div class='col-md-12'>
             <div class='card card-primary card-outline'>
                <div class='card-header'>
                  <?
                  $View->CardTitle();
                $View->refreshAndBack();
                    ?>
                </div>
                <?=
                $View->FormStart().
                $View->Html()->FormGroupStart(6) .
                            $View->Html()->Label('تیتر') .
                            $View->Html()->Input('title') .
                            $View->Html()->FormGroupEnd() .
                            
                            $View->Html()->FormGroupStart(6) .
                            $View->Html()->Label('تصویر') .
                            $View->Html()->ImageInput('state_image','image/jpeg',150,150).
                            $View->Html()->FormGroupEnd() .
                            
                            $View->Html()->FormGroupStart(12) .
                            $View->Html()->Label('متن دیست') .
                            $View->Html()->Input('detail') .
                            $View->Html()->FormGroupEnd() 
                ?>
                <?
                $View->CardFooter();
                ?>
        </div>
    </div>
</section>
                    