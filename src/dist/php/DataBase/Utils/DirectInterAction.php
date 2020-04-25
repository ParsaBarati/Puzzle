<?php
namespace FwDBInteraction\Primitives;
if (!trait_exists('DirectInterAction')){
    trait DirectInterAction {
        protected $connection;
        public function __construct() {
            include __SOURCE__.'conf/connection.php';
            $this->setConnection($conn);
            return $this;
        }

        /**
         * @return mixed
         */
        public function getConnection() {
            return $this->connection;
        }

        /**
         * @param mixed $connection
         */
        public function setConnection($connection) {
            $this->connection = $connection;
        }
    }

}
