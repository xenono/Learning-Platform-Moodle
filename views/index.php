<?php
// Absolute path to the project folder
include "../includes/header.php";
include("../config/Connection.php");
include("../models/User.php");


$conn = new Connection();
$res = User::getAllUsers($conn->getConnection());
foreach($res as $user){
    echo $user["name"];
    echo "<br><br>";
}
//while($row = $res->fetch_array()){
//    print_r($row["id"]);
//    echo "<br>";
//}
// 301 Moved Permanently
//header("Location: ./views/dashboard.php", true, 301);
//exit();
?>

