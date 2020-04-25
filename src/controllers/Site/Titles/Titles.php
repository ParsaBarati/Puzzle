<?php
include '../../../autoload.php';
$Controller = new Controller(new \model\Titles(),$_REQUEST,'تیتر');
$Controller->do();
$Controller->castOutput();
