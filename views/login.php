<?php
include("../config/Connection.php");
include("../includes/header.php");
$isError = false;
global $conn;
if (isset($_POST["studentId"]) && isset($_POST["password"])) {
    $userId = $_POST["studentId"];
    $password = $_POST["password"];
    if ($userId && $password) {
        $sqlQuery = "SELECT * FROM user";
        $res = mysqli_query($conn, $sqlQuery);
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_array($res)) {
                if ($row["id"] == $userId && $row["userAuthorised"] == 1) {
                    if (password_verify($password, $row["password"])) {
                        $_SESSION["isLoggedIn"] = true;
                        $_SESSION["userId"] = $userId;
                        $_SESSION["name"] = $row["name"];
                        $_SESSION["surname"] = $row["surname"];
                        $_SESSION["userType"] = $row["userType"];
                        header('Location: ./dashboard.php');
                        break;
                    }
                }
            }
            $isError = true;
        }
    } else {
        $isError = true;
    }
}
?>

<div class="flex-column wrapper-center ">
    <form action="login.php" method="POST" class="flex-form" id="login-form">
        <h2>Login</h2>
        <label for="studentId">Identity Number</label>
        <input type="text" name="studentId" id="studentId"/>
        <label for="password">Password</label>
        <input type="password" name="password" id="password"/>
        <div class="error <?php if(!$isError) echo 'hidden' ?>" id="error-box">
            <span id="error-msg">
                        <?php
                        if ($isError) {
                            ?>
                            <p>Credenitals not found!</p>
                        <?php } ?>
            </span>
        </div>
        <button type="submit" style="margin-bottom: 10px;">Login</button>

        <p style="margin-bottom: 10px;">Don't have an account?</p>
        <a href="signup.php" class="button">Sign up</a>

    </form>

</div>
<?php
    include "../includes/footer.php";
?>