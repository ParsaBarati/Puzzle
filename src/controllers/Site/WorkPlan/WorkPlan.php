<?php
include '../../../autoload.php';
$Controller = new Controller(new \model\WorkPlan(),$_REQUEST,'روند کار');
$Controller->Uploads(array('image' => '../../../images/workPlan/'),$_FILES);
$Controller->do();
$Controller->castOutput();
