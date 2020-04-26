<?php
include '../../../autoload.php';

$Controller = new Controller(new \model\Services(),$_REQUEST,'خدمت');
$Controller->Uploads(array('icon' => '../../../images/services/','image' => '../../../images/services/'),$_FILES);
function myFunc($param) {
    return $param.' ++';
}
$Servces = new \model\Services();
$Controller->addMethod('test','myFunc',array('hi'));
$Controller->do();
$Controller->castOutput();
