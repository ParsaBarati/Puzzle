<?php

namespace model;

use DATABASE\Model;
use FwDBInteraction\Primitives\Database;

class States extends Model {
    use Database;
    const table = 'tblStates';
    const key = 'state_id';
}
