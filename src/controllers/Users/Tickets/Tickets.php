<?php

use model\Tickets;

include '../../../autoload.php';
$Controller = new Controller(new Tickets(), $_REQUEST, 'تیکت');

function addFromSite($__REQUEST) {
    unset($__REQUEST['controller_type']);
    global $Controller;

    if ($Controller->model()->add($__REQUEST)) {
        return 1;
    } else {
        return 2;
    }
}

$Controller->addMethod('addFromSite', 'addFromSite', array($_REQUEST));
$Controller->do();
$Controller->castOutput();
