<?php
$currentPage = explode("/", $_SERVER['SCRIPT_NAME']);
$currentPage = end($currentPage);
session_start();
include $_SERVER["DOCUMENT_ROOT"] . "/scripts/courses.php";
include $_SERVER["DOCUMENT_ROOT"] . "/config/Connection.php";
global $conn;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ace training</title>
    <!-- Import fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,500;1,700&display=swap"
          rel="stylesheet">
    <!-- End of fonts imports -->
    <!-- Import CSS -->
    <link href="../public/css/styles.css" type="text/css" rel="stylesheet"/>
    <!-- End of CSS imports -->
    <!-- AJAX   -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<?php
if (session_status() == PHP_SESSION_ACTIVE && isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"] == true) {
    $courses = getUserCourses($conn, $_SESSION["userId"]);
}

if (strcmp($currentPage, "login.php") && strcmp($currentPage, "signup.php")) {
    ?>
    <header>

        <nav class="nav">
<<<<<<< Updated upstream
                <a class="nav-item <?php if($currentPage == "dashboard.php") {echo "nav-item-active";}?>" href="../views/dashboard.php">dashboard</a>
                <a class="nav-item <?php if($currentPage == "admin.php") {echo "nav-item-active";}?>" href="../views/admin.php">Admin</a>
=======
            <?php if(!isset($_SESSION["isLoggedIn"]) || $_SESSION["isLoggedIn"] === false) {?>
            <a class="nav-item <?php if ($currentPage == "index.php") {
                echo "nav-item-active";
            } ?>" href="../views/index.php">Home Page </a>
            <?php } ?>
            <?php if (isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"] == true) { ?>
                <a class="nav-item <?php if ($currentPage == "dashboard.php") {
                    echo "nav-item-active";
                } ?>" href="../views/dashboard.php">Dashboard</a>
                <a class="nav-item <?php if ($currentPage == "admin.php") {
                    echo "nav-item-active";
                } ?>" href="../views/admin.php">Admin</a>
>>>>>>> Stashed changes
                <div class="nav-item-dropdown">
                    <span class="nav-item  <?php if ($currentPage == "courses.php") {
                        echo "nav-item-active";
                    } ?>" id="course-dropdown-parent" href="../views/courses.php">courses</span>
                    <div class="nav-item-course-dropdown" id="course-dropdown-list">
                        <?php
                        if (isset($courses)) {
                            foreach (array_keys($courses) as $courseId) { ?>
                                <a class="nav-item" href="../views/courses.php?courseId=<?php echo $courseId?>&lecture=1"><?php echo $courses[$courseId] ?></a>
                            <?php }
                        } ?>
                    </div>

                </div>
                <a class="nav-item <?php if ($currentPage == "assignments.php") {
                    echo "nav-item-active";
                } ?>" href="../views/assignments.php">assignments</a>
                <a class="nav-item <?php if ($currentPage == "grades.php") {
                    echo "nav-item-active";
                } ?>" href="../views/grades.php">grades</a>
            <?php } ?>
        </nav>
    </header>
<?php } ?>
