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
                    echo '<br>'.$View->getData()->item_for.'<br>';
                    $View->refreshAndBack();
                    ?>
                </div>
                <?=
                $View->FormStart() .
                $View->Html()->FormGroupStart(6).
                $View->Html()->Label('متن تیتر').
                $View->Html()->Input('title').
                $View->Html()->FormGroupEnd() .
                $View->Html()->FormGroupStart(6).
                $View->Html()->Label('متن بخش زیر تیتر').
                $View->Html()->Input('text','text','',false).
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
    $(function () {
        Swal.fire({
            icon: 'info',
            title: 'لطفا توجه کنید',
            text: '"متن بخش زیر تیتر" اجباری نبوده و فقط در بخش هایی از سایت نمایش داده خواهد شد که این مورد را دارا باشند',
            showConfirmButton: false,
            showCloseButton: true
        });
    });
</script>
