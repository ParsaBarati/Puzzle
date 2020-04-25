<?php
include '../../../../autoload.php';
$Controller = new Controller(new \model\FooterSettings(),$_REQUEST,'تنظیمات فوتر');
$Controller->do();
$Controller->castOutput();
