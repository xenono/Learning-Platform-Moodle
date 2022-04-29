<?php
include("../includes/header.php");
include $_SERVER["DOCUMENT_ROOT"] . "/includes/auth.php";
include("../config/Connection.php");
global $conn;
global $totalFee;
if(!isset($_SESSION["userId"])){
    Header("Location: login.php");
}
$userId = $_SESSION["userId"];
$userType = $_SESSION["userType"];

if ($userType == "student") {
    $totalFee = 0;
    $sql = "SELECT courseName FROM studentcourse INNER JOIN course ON studentcourse.courseId=course.courseId WHERE studentId='$userId' AND courseApproved = 1 ";
    $result = $conn->query($sql);
    echo mysqli_error($conn);
    $courses = array();
    if ($result->num_rows > 0) {
        $courses = mysqli_fetch_all($result);
    }
}

?>
<?php
if (isset($_GET["formSubmission"])) {
    $formSubmitted = $_GET["formSubmission"];
    if($formSubmitted === "true"){?>
        <div class="form-submission-success">
            <p>Your form was successfully submitted</p>
            <p>Please wait for the course tutor to review your application</p>
        </div>
    <?php }
}
?>
<div>
</div>
<div>

    <?php
    // only if a student logged in the courses and courseFee pops up.
    if ($userType == "student"){
    if (count($courses) > 0) {
        echo "<p>Your courses</p>";
        foreach ($courses as $course) {
            echo "<p>" . $course[0] . "</p>";
        }
    } else { ?>
        <p>No courses</p>
    <?php }
    }
    ?>
    <a href="enrollOnCourse.php" class="button">Enroll on a course</a>

</div>
<div class="container">

    <div class="navigation-bar">
        <div class="navigation-content">
            <img src="../public/assets/navigation_logo.jpg" style="float:left;width:20px;height:20px;">
            <b>Navigation</b><br>
            <a href="http://localhost:63342/ace_training/views/dashboard.php">Dashboard</a><br>
            <a href="http://localhost:63342/ace_training/views/events.php">Events</a><br>
            <a href="">Overview</a><br>
            <div class="tooltip">
                <a href="">My_Courses</a>
                <span class="tooltiptext">
                    <a href="http://localhost:63342/ace_training/views/courses.php?course=CSCORE1&week=1">Website development</a><br>
                    <a href="http://localhost:63342/ace_training/views/courses.php?course=CSCORE2&week=1">Networking</a><br>
                    <a href="">C++</a><br>
                    <a href="">Software Engineering</a><br>
                    <a href="">Robotics</a><br>
                    <a href="">AI</a>
                </span>
            </div>
            <br>
            <a href="http://localhost:63342/ace_training/views/grades.php">Grades</a><br>
            <a href="http://localhost:63342/ace_training/views/assignments.php">Assignment_Information</a><br>
        </div>
        <div class="navigation-content">
            <b>Announcement</b>
            <marquee behavior="scroll" direction="left">Hey listen....ACE Training is planning to launch a new course.
            </marquee>

        </div>
    </div>
    <div class="navigation-box">
        <h2>Welcome <?php echo $_SESSION["name"]; ?></h2>

        <div class="box">
            <div class="icon">
                <i class="fa fa-info-circle" aria-hidden="true"></i>
            </div>
            <div class="content">
                <a href="">About Ace training</a>
            </div>
        </div>

        <div class="box">
            <div class="icon">
                <i class="fa fa-university" aria-hidden="true"></i>
            </div>
            <div class="content">
                <a href="">University faculty</a>
            </div>
        </div>
</div>

<?php
include "../includes/footer.php";
?>


