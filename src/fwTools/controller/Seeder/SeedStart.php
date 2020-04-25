<?php
require_once '../../helpers/helpers.php';
require_once 'utils/algorithms.php';
$username = "doponder_user";
$pass = "110591356";
$newDb = mysqli_connect('localhost', $username, $pass) or trigger_error(mysqli_error($newDb), E_USER_ERROR);
$newDb->select_db("INFORMATION_SCHEMA");
$newDb->query("SET NAMES 'utf8'");
$newDb->query("SET CHARACTER SET utf8");
$newDb->query("SET SESSION collation_connection = 'utf8_unicode_ci'");
$tblName = $_REQUEST['table'];
$res = array();
$query = $newDb->query("select * from COLUMNS where `TABLE_NAME` = '$tblName'");
while ($row = $query->fetch_object()) {
    $res[] = $row->COLUMN_NAME;
}
$res['table'] = $tblName;
echo json_encode($res);