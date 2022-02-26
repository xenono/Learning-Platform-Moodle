<?php
include ("../includes/header.php");
include "../utils/connection.php";
global $conn;
session_start();
$isError = false;
if(isset($_POST["student-id"]) && isset($_POST["password"])){
    $userId= $_POST["student-id"];
    $password = $_POST["password"];
    if($userId && $password){
        $sqlQuery = "SELECT * FROM user";
        $res = mysqli_query($conn, $sqlQuery);
        if(mysqli_num_rows($res) > 0){
            while($row = mysqli_fetch_array($res)){
                if($row["id"] == $userId && $row["password"] == $password){
                    $_SESSION["isLoggedIn"] = true;
                    $_SESSION["userId"] = $userId;
                    $_SESSION["name"] = $row["name"];
                    header('Location: ./dashboard.php');
                    break;
                }
            }
            $isError = true;
        }
    } else {
        $isError = true;
    }
}
?>
<div class="wrapper-center">
    <form action="login.php" method="POST" class="flex-form">
        <h2>Login</h2>
        <label for="student-id">Student Number</label>
        <input type="text" name="student-id" id="student-id"/>
        <label for="password">Password</label>
        <input type="text" name="password" id="password"/>
        <button type="submit">Login</button>
        <?php
        if($isError){?>
            <p>Credenitals not found!</p>
        <?php }?>
    </form>
</div>
<?php
if(isset($_SESSION["userId"])){
    echo "Session is set";
}


?>