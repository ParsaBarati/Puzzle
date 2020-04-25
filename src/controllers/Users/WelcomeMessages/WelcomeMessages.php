<?php
include '../../../autoload.php';
$Controller = new Controller(new \model\WelcomeMessages(),$_REQUEST,'پیام خوش آمد');
$Controller->do();
$Controller->castOutput();
