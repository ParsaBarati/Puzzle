<?php
namespace model\auth;
class Admins {
    const table = 'admins';
    const key = 'aid';
    public $aid;
    public $name;
    public $username;
    public $admin;
    function Login($username,$password) {
        global $conn;
        $password = sha1(md5($password));
        if ($res = $conn->query("SELECT * from admins where username='$username' and password = '$password'")->fetchObject()) {
            $this->setUid($res->aid);
            $this->setName($res->name);
            $this->setUserName($res->username);
            $this->setAdmin($res);
            return true;
        }
        return false;
    }
    private function setUid($aid){
        $this->aid = $aid;
    }
    private function setAdmin($admin){
        $this->admin = $admin;
    }
    private function setName($name){
        $this->name = $name;
    }
    private function setUserName($username){
        $this->username = $username;
    }

    function findAdminById($aid)
    {
        global $conn;
//        $aid = $aid->toString();
        if ($res = $conn->query("SELECT * from `admins` where `aid` = $aid")->fetchObject()) {
            $this->setUid($res->aid);
            $this->setName($res->name);
            $this->setUserName($res->uname);
            $this->setAdmin($res);
            return true;
        }
        return false;
    }
    function getAid(){
        return $this->aid;
    }
    function getName(){
        return $this->name;
    }
    function getUserName(){
        return $this->username;
    }
    function getAdmin(){
        return $this->admin;
    }
}
