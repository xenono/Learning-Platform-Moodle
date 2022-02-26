<?php
require_once "ParseENV.php";

class Connection {

    public $connection;
    public function __construct(){
        $user = $_ENV["DB_LOGIN"];;
        $host = $_ENV["DB_HOST"];;
        $password = $_ENV["DB_PASSWORD"];;
        $dbName = $_ENV["DB_DB"];
        $this->connection = new mysqli($host,$user,$password,$dbName);
    }
    public function getConnection(): mysqli{
        return $this->connection;
    }
}