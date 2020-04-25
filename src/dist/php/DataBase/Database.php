<?php

namespace FwDBInteraction\Primitives;

use DBException;
use FwDBInteraction\Primitive\Methods\Methods;
use FwDBInteraction\Primitives\DirectInterAction;
use FwDBInteraction\Primitives\Orm\DBResult;
use Error;
use PDO;
use PDOStatement;
use stdClass;
use Str;
if (!trait_exists('Database')) {
    trait Database {
        use DirectInterAction;
        use Methods;
        private $__host = 'localhost';
        private $__db_name;
        private $__db_user;
        private $__db_pass;
        private $select_cols = array('*');
        private $queryString = '';
        private $_TYPE;

        /**
         * @param string $statement
         * @return false|mixed|PDOStatement
         */
        public function query($statement) {
            return $this->connection->query($statement);
        }

        /**
         * @return string
         */
        private function getQueryString(): string {
            return $this->queryString;
        }

        /**
         * @param string $queryString
         */
        private function setQueryString(string $queryString) {
            $this->queryString = $queryString;
        }

        /**
         * @return mixed
         */
        private function getTYPE() {
            return $this->_TYPE;
        }

        /**
         * @param mixed $TYPE
         */
        private function setTYPE($TYPE) {
            $this->_TYPE = $TYPE;
        }

        /**
         * @return array
         */
        private function getSelectCols(): array {
            return $this->select_cols;
        }

        /**
         * @param array $select_cols
         */
        private function setSelectCols(array $select_cols) {
            $this->select_cols = $select_cols;
        }


        /**
         * @return null
         */
        private function getConnection() {
            return $this->connection;
        }

        /**
         * @param null $connection
         */
        private function setConnection($connection) {
            $this->connection = $connection;
        }

        public function db_select(array $columns = ['*']) {
            $this->setTYPE('select');
            $this->setSelectCols($columns);
            $cols = implode(',', $columns);
            $table = $this::table;
            $this->setQueryString("SELECT $cols FROM $table");
            return $this;
        }

        public function db_update(array $columns) {
            $this->setTYPE('update');
            $cols = $this->GenUpdate($columns);
            $table = $this::table;
            $this->setQueryString("UPDATE $table SET $cols");
            return $this;
        }

        public function db_delete() {
            $this->setTYPE('delete');
            $table = $this::table;
            $this->setQueryString("DELETE FROM $table");
            return $this;
        }

        public function db_insert(array $cols) {
            $this->setTYPE('insert');
            $col = $this->GenInsert($cols);
            $table = $this::table;
            $this->setQueryString("INSERT INTO $table $col");
            return $this;
        }

        public function where(array $columns = []) {

            switch ($this->getTYPE()) {
                case "select":
                    $where = ' WHERE ';
                    if (sizeof($columns) > 0) {
                        foreach ($columns as $col => $value) {
                            $where .= "$col = $value AND";
                        }
                        $where = trim($where);
                        $where = substr($where, 0, strlen($where) - 3);
                    } else {
                        throw new DBException('where() is called but no columns are specified');
                    }
                    $this->setQueryString($this->getQueryString() . " $where ");
                    break;
                case "update":
                case "delete":
                    if (sizeof($columns) > 0) {
                        $where = ' WHERE ';
                        foreach ($columns as $col => $value) {
                            $where .= "$col = $value AND";
                        }
                        $where = trim($where);
                        $where = substr($where, 0, strlen($where) - 3);
                    } else {
                        $where = '';
                    }
                    $this->setQueryString($this->getQueryString() . " $where ");
                    break;
                default:
                    throw new DBException('pleas specify the condition type');
            }
            return $this;
        }

        /*
         return types : [
                array
                object
                generator
                ]
         */

        public function execute(string $return_type = 'object') {
            if ($return_type == 'array') {
                switch ($this->getTYPE()) {
                    case "select":
                        $res = $this->query($this->getQueryString());
                        $output = array();
                        if ($res) {
                            while ($row = $res->fetchAll(PDO::FETCH_ASSOC)) {
                                foreach ($row as $key => $item) {
                                    if (is_string($item)) {
                                        $row[$key] = new Str($item);
                                    }
                                }
                                $row = new DBResult($row, $this::table);
                                $output[] = $row;
                            }
                        }
                        return $output;
                        break;
                    case "update":
                    case "delete":
                    case "insert":
                        $output = array();
                        $output['status'] = 'failed';
                        if ($res = $this->query($this->getQueryString())) {
                            $output['status'] = 'success';
                        }
                        return $output;
                        break;
                }

            } else if ($return_type == 'object') {
                switch ($this->getTYPE()) {
                    case "select":
                        $res = $this->query($this->getQueryString());
                        if ($res->rowCount() > 1) {
                            $output = array();
                            if ($res) {
                                while ($row = $res->fetchObject()) {
                                    foreach ($row as $key => $item) {
                                        if (is_string($item)) {
                                            $row->$key = new Str($item);
                                        }
                                    }
                                    $row = new DBResult($row, $this::table);
                                    $output[] = $row;
                                }
                            }
                            return $output;
                        } else {
                            $row = $res->fetchObject();
                            if ($row) {
                                foreach ($row as $key => $item) {
                                    if (is_string($item)) {
                                        $row->$key = new Str($item);
                                    }
                                }
                                $row = new DBResult($row, $this::table);
                                return $row;
                            }
                            return null;
                        }
                        break;
                    case "update":
                    case "delete":
                    case "insert":
                        $output = new stdClass();
                        $output->status = 'failed';
                        if ($res = $this->query($this->getQueryString())) {
                            $output->status = 'success';
                        }
                        return $output;
                        break;
                }

            } else {
                throw new Error('Invalid Return Type');
            }
        }

        /**
         * @return mixed
         */
        private function getDbPass() {
            return $this->__db_pass;
        }

        /**
         * @param mixed $_db_pass
         */
        public function setDbPass($_db_pass) {
            $this->__db_pass = $_db_pass;
        }

        /**
         * @return mixed
         */
        private function getDbName() {
            return $this->__db_name;
        }

        /**
         * @param mixed $_db_name
         */
        public function setDbName($_db_name) {
            $this->__db_name = $_db_name;
        }

        /**
         * @return mixed
         */
        private function getDbUser() {
            return $this->__db_user;
        }

        /**
         * @param mixed $_db_user
         */
        public function setDbUser($_db_user) {
            $this->__db_user = $_db_user;
        }

        /**
         * @return string
         */
        private function getHost(): string {
            return $this->__host;
        }

        /**
         * @param string $_host
         */
        public function setHost(string $_host) {
            $this->__host = $_host;
        }

        public function connect() {
            $host = $this->getHost();
            $connectionConnDataVariableExtractedFromDotConnFileDb_name = $this->getDbName();
            $connectionConnDataVariableExtractedFromDotConnFileDb_nameUser = $this->getDbUser();
            $connectionConnDataVariableExtractedFromDotConnFileDb_nameUserPass = $this->getDbPass();
            $conn = new PDO("mysql:host=$host;dbname=$connectionConnDataVariableExtractedFromDotConnFileDb_name;charset=utf8", $connectionConnDataVariableExtractedFromDotConnFileDb_nameUser, $connectionConnDataVariableExtractedFromDotConnFileDb_nameUserPass, array(PDO::ATTR_PERSISTENT => true));
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->exec("set names utf8");
            $this->setConnection($conn);
        }
    }
}

