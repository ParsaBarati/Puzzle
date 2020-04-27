<?php
include '../../../autoload.php';

use FwDBInteraction\Primitives\Database;
use model\States;

/*
    توجه کنید که در تعریف ستون ها در جداول دیتابیس به هیچ عنوان از حرف بزرگ استفاده نکنید
    به عنوان مثال برای شروط مشخص روی ستون column_name مشخص از دستور {Is/IsNot}where[Column_name] استفاده کنید
 */
$States = new States();
try {
    echo $States->db_select()->whereState_idIs('1')->showQuery();
} catch (DBException $e) {
    echo $e->getMessage();
}

