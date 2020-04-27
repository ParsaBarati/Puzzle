<?php

use model\Cities;

include '../../../autoload.php';
$Controller = new Controller(new Cities(),$_REQUEST,'شهر');


function cityByState($state_id) {
    $Cities = new \model\Cities();
    $result = '';
    foreach ($Cities->CitiesInState($state_id) as $city) {
        $city = (object)$city;
        $result .= "<option value='$city->city_id'>$city->city_name</option>";
    }
    return $result;
}
$Controller->addMethod('getCitiesInState','cityByState',array($_REQUEST['state_id']));
$Controller->do();
$Controller->castOutput();
