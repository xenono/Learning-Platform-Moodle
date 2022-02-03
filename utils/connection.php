<?php
require_once "parseENV.php";
$DB_LOGIN = $_ENV["DB_LOGIN"];
$DB_PASSWORD = $_ENV["DB_PASSWORD"];
$DB_HOST = $_ENV["DB_HOST"];
$conn = mysqli_connect($DB_HOST,$DB_LOGIN,$DB_PASSWORD,"moodle");

?>