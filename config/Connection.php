<?php
require_once "ParseENV.php";

$user = $_ENV["DB_LOGIN"];;
$host = $_ENV["DB_HOST"];;
$password = $_ENV["DB_PASSWORD"];;
$dbName = $_ENV["DB_DB"];
$conn = new mysqli($host,$user,$password,$dbName);

?>
