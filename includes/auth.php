<?php
session_start();
if(!isset($_SESSION["userId"]) || !isset($_SESSION["isLoggedIn"]) || !isset($_SESSION["name"])){
    header('Location: ../views/login.php');
}

