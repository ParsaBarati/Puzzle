<?php
include '../../../autoload.php';
$Controller = new Controller(new \model\TopBanners(),$_REQUEST,'بنر');
$Controller->Uploads(array('image' => '../../../images/banners/'),$_FILES);
$Controller->do();
$Controller->castOutput();
