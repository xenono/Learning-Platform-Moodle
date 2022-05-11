<?php
include("../includes/header.php");
include $_SERVER["DOCUMENT_ROOT"] . "/includes/auth.php";
include("../config/Connection.php");
global $conn;

if(!isset($_SESSION["userId"])){
    Header("Location: login.php");
}
$userId = $_SESSION["userId"];
$userType = $_SESSION["userType"];

$sql = "SELECT * from course";
$courses = $conn->query($sql);
if ($courses->num_rows > 0) {
    $courses = mysqli_fetch_all($courses);
}
?>
<body>

    <div class="unifac">
        <img src = "../public/assets/logo.png">
        <h1>Faculty</h1>
        <div class = "desc">
        <p>The ACE Training System is a premier online school that has attracted international notice for the high quality of education it provides. It is completely equipped with professionally educated tutors and a well-organized administrative staff. We'd like to introduce you to our tutors.</p>
        </div>
        <div class="uni">

        <?php
        $sql = "SELECT user.id AS Id , user.name AS name, user.surname AS surname, user.email AS email, user.phoneNumber AS number FROM tutor LEFT JOIN user ON 
    tutor.tutorId = user.id ";
        $result = mysqli_query($conn,$sql);
        if($result){
            while($row = $result->fetch_object()){?>
            <table>
            <td>
                <?php echo "Name: <b>".$row->name." ".$row->surname."</b><br>"; ?>
                <?php echo "Contact details: <b>".$row->email."</b> 
                            <br><b>(+44)".$row->number."</b><br>"; ?>
                <?php echo "Availability: <b> Monday to Friday, 9:00am - 9:00pm </b><br>";?>
                <?php
                echo "Courses :";
                $sqlin = "SELECT course.courseName AS courseName FROM tutorcourse LEFT JOIN course ON tutorcourse.courseId = course.courseId WHERE tutorcourse.tutorId = $row->Id ";
                $resultsqlin = mysqli_query($conn, $sqlin);
                if($resultsqlin) {
                    while ($dis = $resultsqlin->fetch_object()) {
                        echo "<b>".$dis->courseName."</b><br>";
                    }
                }
                ?>

            </td>
            </table>
            <?php
            }
        }else{
            echo $conn->error;
        }
        ?>

        </div>
</div>
</body>
