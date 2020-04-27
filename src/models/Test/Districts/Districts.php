<?php
namespace model;
use DATABASE\Model;
use DATABASE\relations;

class Districts  extends Model {
    use relations;
     const table = 'tblDistricts';
     const key = 'district_id';

     public function getAll() {
         global $conn;
         $res = $conn->query("select * from tblDistricts");
         $output = array();
         while ($row = $res->fetchObject()){
             $row->state_name = $conn->query("select * from tblStates where state_id = ".$row->state_id)->fetchObject()->state_name;
             $row->city_name = $conn->query("select * from tblCities where city_id = ".$row->city_id)->fetchObject()->city_name;
             array_push($output,$row);
         }
         return $output;
     }
}
