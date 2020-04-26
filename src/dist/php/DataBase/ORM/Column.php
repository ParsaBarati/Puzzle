<?php
namespace FwDBInteraction\Primitives\Orm;
use FwDBInteraction\Primitive\Methods\Methods;
use FwDBInteraction\Primitives\Database;
use Str;

class Column {
    public $column_name;
    private $table;
    public function __construct(string $column_name, string $table_name) {
        $this->setTable($table_name);
        $this->setColumn($column_name);
    }
    public function __toString() {
        return $this->column_name;
    }

    public function rows() {
        global $conn;
        $table = $this->table;
        $column_name = $this->column_name;
        $res = $conn->query("select $column_name from $table");
        $output = array();
        while ($row = $res->fetchObject()){
            foreach ($row as $item){
                if (is_string($item)){
                    $row->$item = new Str($item);
                }
            }
            $output[] = new \FwDBInteraction\Primitives\Orm\DBResult($row,$table);
        }
        return $output;
    }
    /**
     * @return mixed
     */
    private function getTable() {
        return $this->table;
    }
    public function __debugInfo() {
        return array("rows" => $this->rows(), "name" => $this->column_name,"table" => $this->table);
    }

    /**
     * @param mixed $table
     */
    private function setTable($table) {
        $this->table = $table;
    }

    /**
     * @return mixed
     */
    private function getColumn() {
        return $this->column_name;
    }

    /**
     * @param mixed $column
     */
    private function setColumn($column) {
        $this->column_name = $column;
    }
}
