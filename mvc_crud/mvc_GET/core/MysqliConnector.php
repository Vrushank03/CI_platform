<?php
class MysqliConnector{
    private $host, $user, $pass, $database;
    public function __construct() {
        $db_cfg = require_once 'config/database.php';
        $this->host=DB_HOST;
        $this->user=DB_USER;
        $this->pass=DB_PASS;
        $this->database=DB_DATABASE;
    }

    public function Connection(){
        $conn = new mysqli($this->host,$this->user,$this->pass,$this->database);
        if($conn->connect_error){
            die("Oops there is some error to connect with DB: ".$conn->connect_error);
        }
        return $conn;
    }
}
