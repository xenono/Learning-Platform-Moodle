<?php
include $_SERVER["DOCUMENT_ROOT"] . "/learning-platform-moodle/includes/header.php";

require_once "../config/Connection.php";

//START TRANSACTION;
//INSERT INTO user (name,surname,phoneNumber,address,email,password,dateOfBirth,userType)
//VALUES			 ("name","surname","phoneNUmber","address","email@email.com","password","dateOfBirth","student");
//SET @userId := LAST_INSERT_ID();
//INSERT INTO student (student_id,fees,personal_tutor_id) VALUES (@userId,1000,0);
//COMMIT;
global $conn;
if (isset($_POST["dateOfBirth"]) && isset($_POST["surname"]) && isset($_POST["name"]) && isset($_POST["phoneNumber"]) && isset($_POST["email"]) && isset($_POST["userType"])&&isset($_POST["address"])) {
    $name = mysqli_escape_string($conn,$_POST["name"]);
    $surname = mysqli_escape_string($conn,$_POST["surname"]);
    $phoneNumber = mysqli_escape_string($conn,$_POST["phoneNumber"]);
    $email = mysqli_escape_string($conn,$_POST["email"]);
    $address = mysqli_escape_string($conn,$_POST["address"]);
    $dateOfBirth = mysqli_escape_string($conn,$_POST["dateOfBirth"]);
    $userType = mysqli_escape_string($conn,$_POST["userType"]);
    $password = mysqli_escape_string($conn,$_POST["password"]);
    $conn->query("INSERT INTO user (name,surname,phoneNumber,email,password,address,dateOfBirth,userType)
    VALUES ('$name','$surname','$phoneNumber','$email','$password','$address','$dateOfBirth','$userType');");

    /*$conn->begin_transaction();
    $conn->query("INSERT INTO user (name,surname,phoneNumber,email,password,address,dateOfBirth)
    VALUES ('$name','$surname','$phoneNumber','$email','$password','$address','$dateOfBirth');");
    $conn->query("SET @userId := LAST_INSERT_ID();");
    $conn->query("INSERT INTO student (student_id) VALUES (@userId)");
    $res = $conn->commit();
    if($res) {
        Header("Location: login.php");
    } else {
        echo "Fail" . "<br>";
        echo mysqli_error($conn) . "<br>";
        echo mysqli_errno($conn) . "<br>";
        echo mysqli_sqlstate($conn) . "<br>";
    }*/
}
?>

<div class="wrapper-center" style="position: relative">
    <a href="login.php" class="button" style="position: absolute; left: 10%; top: 12%;">Back</a>
    <form action="signup.php" method="POST" class="flex-form">
        <h2>Signup form</h2>
        <label for="name">Name</label>
        <input type="text" name="name" id="name"/>
        <label for="surname">Surname</label>
        <input type="text" name="surname" id="surname"/>
        <label for="email">Email</label>
        <input type="email" name="email" id="email"/>
        <label for="phoneNumber">Phone Number</label>
        <input type="number" name="phoneNumber" id="phoneNumber"/>
        <label for="address">Your address</label>
        <input type="text" name="address" id="address"/>
        <label for="dateOfBirth">Date of birth</label>
        <input type="date" name="dateOfBirth" id="dateOfBirth"/>
        <label for="userType">Are you a student or a tutor?</label>
        <input type="text" name="userType" id="userType"/>
        <label for="password">Password</label>
        <input type="password" name="password" id="password"/>
        <label for="retypePassword">Confirm Password</label>
        <input type="password" name="retypePassword" id="retypePassword"/>
        <button type="submit">Create account</button>
    </form>
</div>


<?php include "../includes/footer.php"?>

