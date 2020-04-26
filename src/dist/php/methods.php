<?php
namespace DATABASE;
use FwDBInteraction\Primitives\Database;

if (!class_exists('methods')) {
    abstract class methods
    {
        use Database;
        /**
         * @param $table
         * @param $info
         * @return false|\PDOStatement
         */
        protected function insert($table, $info)
        {
            global $conn;
            $fields = "";
            $values = "";
            foreach ($info as $key => $value) {
                $fields .= " $key,";
                $values .= "'$value',";
            }
            $fields = substr($fields, 0, strlen($fields) - 1);
            $values = substr($values, 0, strlen($values) - 1);
            return $conn->query("INSERT INTO `$table` (" . $fields . ") VALUES (" . $values . ")");
        }

        /**
         * @param $table
         * @param $key
         * @param $keyValue
         * @return mixed
         */
        protected static function select($table, $key, $keyValue)
        {
            global $conn;
            return toStr($conn->query("SELECT * FROM `$table` WHERE `$key` = '$keyValue'")->fetchObject());
        }

        /**
         * @param $table
         * @return \Generator
         */
        protected static function selectAll($table)
        {
            global $conn;
            $result = $conn->query("SELECT * FROM `$table`");
            while ($row = $result->fetchObject()) {
//                $row = toStr($row);
                yield $row;
            }
        }

        /**
         * @param $table
         * @param $key
         * @param $keyValue
         * @return \Generator
         */
        protected static function selectFilter($table, $key, $keyValue)
        {
            global $conn;
            $result = $conn->query("SELECT * FROM `$table` where `$key` = '$keyValue'");
            while ($row = $result->fetchObject()) {
                $row = toStr($row);
                yield $row;
            }
        }

        /**
         * @param $table
         * @param $whereClause
         * @return \Generator
         */
        protected static function selectWithWhere($table, $whereClause)
        {
            global $conn;
            $result = $conn->query("SELECT * FROM `$table` where $whereClause");
            while ($row = $result->fetchObject()) {
                $row = toStr($row);
                yield $row;
            }
        }

        /**
         * @param $table
         * @param $key
         * @param $keyValue
         * @param $info
         * @return false|\PDOStatement
         */
        protected static function update($table, $key, $keyValue, $info)
        {

            global $conn;
            $fields = "";
            foreach ($info as $field => $value) {
                $fields .= " `$field` = '$value' ,";
            }
            $fields = substr($fields, 0, strlen($fields) - 1);
            return $conn->query("UPDATE `$table` SET $fields WHERE `$key` = '$keyValue'");
        }

        /**
         * @param $table
         * @param $key
         * @param $keyValue
         * @return false|\PDOStatement
         */
        protected static function del($table, $key, $keyValue)
        {
            global $conn;
            return $conn->query("DELETE FROM `$table` WHERE `$key` = '$keyValue'");
        }
    }
}
