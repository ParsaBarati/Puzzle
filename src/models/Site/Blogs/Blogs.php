<?php
namespace model;
use DATABASE\Model;
class Blogs extends Model {
     const table = 'tblBlogs';
     const key = 'id';
     public function getByUri($uri){
         return $this->select(self::table,'uri',$uri);
     }
}
