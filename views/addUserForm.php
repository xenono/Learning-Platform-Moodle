<?php
require_once "../config/Connection.php";
global $conn;
if(isset($_POST["dateOfBirth"]) && isset($_POST["surname"]) && isset($_POST["phoneNumber"]) && isset($_POST["email"]) && isset($_POST["address"])){
    $name = $_POST["firstName"];
    $surname = $_POST["surname"];
    $phoneNumber = $_POST["phoneNumber"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $dateOfBirth = $_POST["dateOfBirth"];
    $password = "";
    $sql = "INSERT INTO user (name,surname,phoneNumber,email,password,address,dateOfBirth,userType) 
        VALUES ('$name','$surname','$phoneNumber','$email','$password','$address','$dateOfBirth','student')";
    $res = $conn->query($sql);
    if($res){
        $sql = "INSERT INTO student (id,personalTutor,fees) VALUES ('$conn->insert_id','',0)";
        $conn->query($sql);
        echo mysqli_error($conn);

    } else {
        echo mysqli_error($conn);
    }




}
$sql = "SELECT * FROM user JOIN student ON user.id=student.id";
$res = $conn->query($sql);
print_r(mysqli_fetch_assoc($res)["id"]);
print_r(mysqli_fetch_assoc($res)["id"]);
?>

<form action="addUserForm.php" class="flex-form" method="POST">
    <label for="firstName">First Name</label>
    <input type="text" name="firstName" id="firstName"/>
    <label for="surname">Lastname</label>
    <input type="text" name="surname" id="surname"/>
    <label for="phoneNumber">Phone Number</label>
    <input type="text" name="phoneNumber" id="phoneNumber">
    <label for="email">Email</label>
    <input type="email" name="email" id="email">
    <label for="address">Home Address</label>
    <input type="text" name="address" id="address">
    <label for="dateOfBirth">Date of birth</label>
    <input type="date" name="dateOfBirth" id="dateOfBirth">
    <button type="submit">Add</button>
</form>