<?php

namespace FwDBInteraction\Primitives\Orm;

use DBException;
use FwDBInteraction\Primitive\Methods\Methods;
use FwDBInteraction\Primitives\DirectInterAction;
use Error;
use PDO;
use PDOStatement;
use Str;
if (!class_exists('DBResult')) {
    class DBResult {
        use Methods;
        private $__associated_table;
        protected $connection;

        public function __construct($inner_data, $__associated_table) {
            include __SOURCE__ . 'conf/connection.php';
            $this->connection = $conn;
            $this->__associated_table = $__associated_table;
            foreach ($inner_data as $index => $value) {
                $this->{$index} = $value;
            }
        }

        public function save() {
            $vars = get_object_vars($this);
            $arr = array();
            foreach ($vars as $key => $var) {
                if ($key != 'connection') {
                    if ($key === '__associated_table') {
                        $table = $var;
                    } else {
                        if ($var instanceof Str) {
                            $var = $var->__toString();
                        }
                        $arr[$key] = $var;
                    }
                }
            }
            $fields = $this->GenUpdate($arr);
            $res = $this->connection->query("DESCRIBE $table");
            $result = $res->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $column) {
                if ($column['Key'] === 'PRI') {
                    $key = $column['Field'];
                }
            }
            return $this->connection->query("UPDATE $table set $fields WHERE $key = " . $this->{$key});
        }

        public function delete() {
            $table = $this->__associated_table;
            $res = $this->connection->query("DESCRIBE $table");
            $result = $res->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $column) {
                if ($column['Key'] === 'PRI') {
                    $key = $column['Field'];
                }
            }
            return $this->connection->query("DELETE FROM $table WHERE $key = " . $this->{$key});
        }

        public function __invoke() {
            var_dump('jere');
        }

        public function __call($name, $arguments) {
            throw new DBException("function $name does not exist!");
        }

        public function __debugInfo() {
            var_dump(get_object_vars($this));
        }
    }
}
