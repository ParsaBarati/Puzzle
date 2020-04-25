<?php
include '../../../autoload.php';

use FwDBInteraction\Primitives\Database;
use model\States;

//$db->setHost($HOST);
//$db->setDbName($connectionConnDataVariableExtractedFromDotConnFileDb_name);
//$db->setDbUser($connectionConnDataVariableExtractedFromDotConnFileDb_nameUser);
//$db->setDbPass($connectionConnDataVariableExtractedFromDotConnFileDb_nameUserPass);
//$db->connect();
$states = new States();
try {
    $state = $states->db_select()->where(['state_id' => 1])->execute();
} catch (DBException $e) {
}
$state->state_name->toUpper();
$state->save();
