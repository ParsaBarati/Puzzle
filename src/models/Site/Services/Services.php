<?php
namespace model;
use DATABASE\Model;
use FwDBInteraction\Primitives\Database;

class Services extends Model {
    use Database;
     const table = 'tblServices';
     const key = 'service_id';
}
