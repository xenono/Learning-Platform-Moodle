<?php
include ("../config/Connection.php");
include ("../includes/header.php");
$userId = $_SESSION["userId"];
if ($userId == true){
    echo "logged in as $userId ";
}

?>
    <style>
        #button1{
            color: blue;
        }
        #course_selection{
            padding-left: 10px;
        }
        #head{
            padding-left: 10px;
        }
    </style>
    <h1 id="title">&nbsp;Grades</h1>
    </form>
    <table id="head">
        <th>assignment ID</th>
        <th>File ID</th>
        <th>User ID</th>
        <th>Grade</th>

        <?php
        global $conn;
        //display grade for student
        $sql = mysqli_query($conn, "SELECT * FROM assignmentgrade WHERE userId = $userId");
        if ($sql->num_rows > 0) {
// output data of each row
            while($row = $sql->fetch_assoc()) {
                echo "<tr><form style= padding-left: 30px  = 'firstForm' method='post' action=''>";
                echo "<td><input type=text name=title value='" . $row["assignmentId"], "'></td>";
                echo "<td><input type=text name=title value='" . $row["fileId"], "'></td>";
                echo "<td><input type=text name=title value='" . $row["userId"], "'></td>";
                echo "<td><input type=text name=title value='" . $row["grade"], "'></td>";
                echo "</form></tr>";
            } }else if (isset($_SESSION["userType"]) === "tutor")
            while($row = $sql->fetch_assoc()){
                echo "<tr><form style= padding-left: 30px  = 'firstForm' method='post' action=''>";
                echo "<td><input type=text name=title value='" . $row["assignmentId"], "'></td>";
                echo "<td><input type=text name=title value='" . $row["fileId"], "'></td>";
                echo "<td><input type=text name=title value='" . $row["userId"], "'></td>";
                echo "<td><input type=text name=title value='" . $row["grade"], "'></td>";
                echo "</form></tr>";
            }else
            echo "Please"?><a id = "button1" href="login.php"> LogIn </a> <?php echo "to view grades";{
        }
        ?>

    </table>
<?php
include "../includes/footer.php";
?>