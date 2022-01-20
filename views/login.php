<?php
include "../components/header.php";
if(isset($_POST["student-id"]) && isset($_POST["password"])){
    $studentId = $_POST["student-id"];
    $password = $_POST["password"];
    if($studentId && $password){
        echo "credentials are here";

    } else {
        echo "DUPA";
    }
}
?>
<div class="wrapper-center">
    <form action="login.php" method="POST" class="flex-form">
        <label for="student-id">Student Number</label>
        <input type="text" name="student-id" id="student-id"/>
        <label for="password">Password</label>
        <input type="text" name="password" id="password"/>
        <button type="submit">Login</button>
    </form>
</div>