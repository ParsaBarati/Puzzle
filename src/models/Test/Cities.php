<?php
namespace model;
use DATABASE\Model;
use FwDBInteraction\Primitives\Database;

class Cities extends Model {
    use Database;
     const table = 'tblCities';
     const key = 'city_id';
}
