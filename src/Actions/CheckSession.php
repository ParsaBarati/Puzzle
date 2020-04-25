<?php
session_start();
if (isset($_SESSION['admin_auth']['login']) && isset($_SESSION['admin_auth']['aid'])){
    echo 1;
    exit();
}
echo 0;