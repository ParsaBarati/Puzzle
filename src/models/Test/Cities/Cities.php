<?php
namespace model;
use DATABASE\Model;
use DATABASE\relations;

class Cities extends Model {
    use relations;

    const table = 'tblCities';
    const key = 'city_id';
    public function getAll() {
        return $this->isChildOf(new States());
    }
    public function CitiesInState($state_id){
        return $this->isChildOf(new States(),'state_id',$state_id);
    }
}
