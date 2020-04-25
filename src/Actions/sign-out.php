<?php
session_start();
$_SESSION['auth'] = array();
session_destroy();
header('location: ../login.php');