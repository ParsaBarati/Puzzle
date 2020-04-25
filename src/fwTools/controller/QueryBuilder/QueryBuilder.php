<?php
include '../../../autoload.php';
if (isset($_REQUEST['json'])) {
    if ($array = is_json($_REQUEST['json'], true, true)) {
        $fields = "";
        $values = "";
        $i = 0;
        foreach ($array as $index => $item) {
            if (is_object($item) or is_array($item)) {
                $j = 0;
                foreach ($item as $key => $val) {
                    if ($i == 0) {
                        $fields .= "$key, ";
                    }
                    if ($j == 0) {
                        $values .= "('$val'";
                    } else if ($j == sizeof($item) - 1) {
                        $values .= ",'$val'),";
                    } else {
                        $values .= ",'$val'";
                    }
                    $j++;
                }
            } else {
                $fields .= "$index, ";
                if ($i == 0) {
                    $values .= "('$item'";
                } else if ($i == sizeof($array) - 1) {
                    $values .= ",'$item'),";
                } else {
                    $values .= ",'$item'";
                }
            }
            $i++;
        }
        $fields = substr($fields, 0, strlen($fields) - 2);
        $values = substr($values, 0, strlen($values) - 1);

        echo("INSERT INTO `TABLE_NAME_HERE` (" . $fields . ") VALUES $values ");
    } else {
        trigger_error('Invalid Json Data', E_USER_WARNING);
    }
}