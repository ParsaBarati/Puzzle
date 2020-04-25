<?php
include '../../../autoload.php';
$Controller = new Controller(new \model\States(),$_REQUEST,'استان');
$Controller->do();
$Controller->castOutput();