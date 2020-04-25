<?php
include '../../../autoload.php';
$Controller = new Controller(new \model\Dist(),$_REQUEST,'دیست');
$Controller->Uploads(array("state_image" => "../../../images/Dist/"),$_FILES);
$Controller->do();
$Controller->castOutput();
