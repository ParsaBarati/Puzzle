<?php

use model\NewsLetter;

include '../../../autoload.php';
$Controller = new Controller(new NewsLetter(), $_REQUEST, 'عضویت خبر نامه');


function addFromSite($__REQUEST) {
    unset($__REQUEST['controller_type']);
    global $Controller;
    $all = $Controller->model()->getAllFiltered('email', $__REQUEST['email']);
    $i = 0;
    foreach ($all as $item) {
        $i++;
    }
    if ($i === 0) {
        if ($Controller->model()->add($__REQUEST)) {
            return 1;
        } else {
            return 2;
        }
    } else {
        return 3;
    }
}

$Controller->addMethod('addFromSite', 'addFromSite', array($_REQUEST));
$Controller->do();
$Controller->castOutput();
