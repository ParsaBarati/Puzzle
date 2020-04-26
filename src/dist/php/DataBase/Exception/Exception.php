<?php
class DBException extends Exception {
    public function detail() {

    }
    public function __debugInfo() {
        return array($this->message);
    }
}
