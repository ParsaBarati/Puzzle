<?php
include_once '../../../autoload.php';
$View = new View($_REQUEST,'منطقه');
$View->breadcrumbs();
$View->submit();
$View->doFill();
use model\Cities;
use model\States; ?>
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
                $View->Html()->FormGroupStart(4) .
                $View->Html()->Label('نام منطقه') .
                $View->Html()->Input('district_name') .
                $View->Html()->FormGroupEnd() .

                $View->Html()->FormGroupStart(4) .
                $View->Html()->Label('انتخاب استان') .
                $View->Html()->Select('state_id', 'state_id', selectByClass(new States(),'state_name')) .
                $View->Html()->FormGroupEnd() .

                $View->Html()->FormGroupStart(4) .
                $View->Html()->Label('انتخاب شهر') .
                $View->Html()->Select('city_id', 'city_id',selectByClass(new Cities(),'city_name',$View->getData()->city_id,false,false,' state_id = '.$View->getData()->state_id),true,false) .
                $View->Html()->FormGroupEnd()
                ?>
                <?
                $View->CardFooter();
                ?>
            </div>
        </div>
</section>
<script>
    $("#state_id").on('change',() => {
        let state_id = $("#state_id").val();
        $.ajax({
            url: 'controllers/Test/Cities/Cities',
            type: 'POST',
            data: {
                controller_type: 'getCitiesInState',
                state_id: state_id
            },
            success: res => {
                $("#city_id").html(res);
                $("#city_id").attr("disabled",false)
            }
        });
    });
</script>
