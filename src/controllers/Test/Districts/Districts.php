<?php
include '../../../autoload.php';
$Controller = new Controller(new \model\Districts(),$_REQUEST,'منطقه');


$Controller->do();
$Controller->castOutput();
