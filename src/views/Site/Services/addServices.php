<?php
include '../../../autoload.php';
                    $View = new View($_REQUEST, 'خدمت');
                    $View->breadcrumbs();
                    $View->submit();
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
                $View->Html()->FormGroupStart(4).
                $View->Html()->Label('نام خدمت').
                $View->Html()->Input('title').
                $View->Html()->FormGroupEnd().
                $View->Html()->FormGroupStart(4).
                $View->Html()->Label('آیکون').
                $View->Html()->ImageInput('icon','image/png',36,36).
                $View->Html()->FormGroupEnd().
                $View->Html()->FormGroupStart(4).
                $View->Html()->Label('تصویر').
                $View->Html()->ImageInput('image','image/png',499,404).
                $View->Html()->FormGroupEnd() .
                $View->Html()->FormGroupStart(12).
                $View->Html()->Label('توضیحات').
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
    $("#text").trumbowyg();
</script>
