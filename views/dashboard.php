<?php
include("../includes/header.php");
// include "../session/auth.php"
include("../config/Connection.php");
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
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
                    <a href="http://localhost:63342/ace_training/views/courses.php?course=CSCORE1&week=1">Core1</a><br>
                    <a href="http://localhost:63342/ace_training/views/courses.php?course=CSCORE2&week=1">Core2</a>
                </span>
            </div>
            <br>
            <a href="http://localhost:63342/ace_training/views/grades.php">Grades</a><br>
            <a href="http://localhost:63342/ace_training/views/assignments.php">Assignment_Information</a><br>
        </div>
        <div class = "navigation-content">
            <b>Announcement</b>
            <marquee behavior="scroll" direction="left">Hey listen....ACE Training is planning to launch a new course.</marquee>

        </div>
    </div>
    <div class="navigation-box">
        <h2>Welcome</h2>
        <div class="box">
            <div class="icon">
                <i class="fa fa-home" aria-hidden="true"></i>
            </div>
            <div class="content">
                <a href="">Back to home page</a>
            </div>
        </div>
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
                <i class="fa fa-bell" aria-hidden="true"></i>
            </div>
            <div class="content">
                <a href="">Notification</a>
            </div>
        </div>
    </div>
    <div class="navigation-box">
        <div class="box">
            <div class="icon">
                <i class="fa fa-university" aria-hidden="true"></i>
            </div>
            <div class="content">
                <a href="">University faculty</a>
            </div>
        </div>
        <div class="box">
            <div class="icon">
                <i class="fa fa-book" aria-hidden="true"></i>
            </div>
            <div class="content">
                <a href="">Library Resources</a>
            </div>
        </div>
    </div>

</div>

</body>
</html>

<?php
include "../includes/footer.php";
?>


