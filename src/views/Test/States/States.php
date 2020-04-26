<?php
include '../../../autoload.php';

use FwDBInteraction\Primitives\Database;
use model\States;

//$db->setHost($HOST);
//$db->setDbName($connectionConnDataVariableExtractedFromDotConnFileDb_name);
//$db->setDbUser($connectionConnDataVariableExtractedFromDotConnFileDb_nameUser);
//$db->setDbPass($connectionConnDataVariableExtractedFromDotConnFileDb_nameUserPass);
//$db->connect();
/*
    توجه کنید که در تعریف ستون ها در جداول دیتابیس به هیچ عنوان از حرف بزرگ استفاده نکنید
    به عنوان مثال برای شروط مشخص روی ستون column_name مشخص از دستور {Is/IsNot}where[Column_name] استفاده کنید
 */
$states = new States();
try {
    echo $states->db_select()->whereState_nameIs(['مشهد','تهران'])->and()->notEqual('state_id', '1')->showQuery();
} catch (DBException $e) {
    echo $e->getMessage();
}
//$state->state_name->toUpper();
//$state->save();
