<?php
include '../../../autoload.php';
$Controller = new Controller(new \model\Services(),$_REQUEST,'خدمت');
$Controller->Uploads(array('icon' => '../../../images/services/','image' => '../../../images/services/'),$_FILES);
$Controller->do();
$Controller->castOutput();
