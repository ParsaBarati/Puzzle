<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
@session_start();
define('__BASE_DIR__', substr(__DIR__, 0, strpos(__DIR__, 'src') - 1) . DIRECTORY_SEPARATOR);
define('__SOURCE__', substr(__DIR__, 0, strpos(__DIR__, 'src') + 3) . DIRECTORY_SEPARATOR);

include __SOURCE__ . 'conf' . DIRECTORY_SEPARATOR . 'connection.php';
include __SOURCE__ . 'conf' . DIRECTORY_SEPARATOR . 'conf.php';
include __SOURCE__ . 'helpers' . DIRECTORY_SEPARATOR . 'helpers.php';
include __SOURCE__ . 'helpers' . DIRECTORY_SEPARATOR . 'numToWord.php';

include __SOURCE__ . 'helpers' . DIRECTORY_SEPARATOR . 'fw.php';
include __SOURCE__ . 'helpers' . DIRECTORY_SEPARATOR . 'security.php';
include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'DataBase/Exception/Exception.php';
include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'DataBase/Utils/DirectInterAction.php';
include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'DataBase/Methods/Methods.php';
include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'DataBase/Database.php';
include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'DataBase/ORM/Column.php';
include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'DataBase/ORM/DBResult.php';
include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'methods.php';
include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Controller.php';
include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Html.php';
include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'View.php';
include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Model.php';
include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' .DIRECTORY_SEPARATOR . 'relations.php';
include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' .DIRECTORY_SEPARATOR . 'DataTypes/String.php';

foreach (new RegexIterator(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__SOURCE__.'models/')), '/\.php$/') as $phpFile) {
    include __SOURCE__ ."models/". explode("/models/", $phpFile->getRealPath())[1];
}
$_REQUEST = toStr($_REQUEST);
//$_SESSION = toStr($_SESSION);
