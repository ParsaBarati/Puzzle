<?php

use model\Counters;

include '../../../autoload.php';
$Controller = new Controller(new Counters(), $_REQUEST, 'شمارنده');
$Controller->do();
$Controller->castOutput();
