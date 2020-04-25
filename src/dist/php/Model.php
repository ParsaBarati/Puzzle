<?php
namespace DATABASE;
use DATABASE\methods;
//use FwDBInteraction\Primitives\Database;
if (!class_exists('Model')) {
    abstract class Model extends methods {
        protected $session;
        protected $conn;

        public function __construct() {
            global $_SESSION;
            global $conn;
            $this->setSession($_SESSION);
            $this->setConn($conn);
        }

        public function add(array $info) {
            $res = parent::insert($this::table, $info);
            global $conn;
            parent::insert('actions', array("admin_id" => $this->session['admin_auth']['aid'], "date" => time(), "tblName" => $this::table, "row_id" => $conn->lastInsertId(), "data_before_edit" => json_encode(array()), "action_type" => "add"));
            return $res;
        }

        public function edit($keyValue, array $info) {
            parent::insert('actions', array("admin_id" => $this->session['admin_auth']['aid'], "date" => time(), "tblName" => $this::table, "row_id" => $keyValue, "data_before_edit" => json_encode(parent::select($this::table, $this::key, $keyValue), JSON_UNESCAPED_UNICODE), "action_type" => "edit"));
            return parent::update($this::table, $this::key, $keyValue, $info);
        }

        public function get($primaryKeyValue) {
            return parent::select($this::table, $this::key, $primaryKeyValue);
        }

        public function delete($primaryKeyValue) {
            parent::insert('actions', array("admin_id" => $this->session['admin_auth']['aid'], "date" => time(), "tblName" => $this::table, "row_id" => $primaryKeyValue, "data_before_edit" => json_encode(parent::select($this::table, $this::key, $primaryKeyValue), JSON_UNESCAPED_UNICODE), "action_type" => "delete"));
            return parent::del($this::table, $this::key, $primaryKeyValue);
        }

        public function getAll() {
            return parent::selectAll($this::table);
        }

        public function getAllConditioned($whereClause) {
            return parent::selectWithWhere($this::table, $whereClause);
        }

        public function getAllFiltered($filterField, $filterValue) {
            return parent::selectFilter($this::table, $filterField, $filterValue);
        }

        /**
         * @return array
         */
        public function getSession(): array {
            return $this->session;
        }

        /**
         * @param array $session
         */
        public function setSession(array $session) {
            $this->session = $session;
        }


        /**
         * @param Database $conn
         */
        public function setConn($conn) {
            $this->conn = $conn;
        }
    }
}
