<?php
$currentPage= explode("/", $_SERVER['SCRIPT_NAME']);
$currentPage =  end($currentPage);
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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,500;1,700&display=swap" rel="stylesheet">
    <!-- End of fonts imports -->
    <!-- Import CSS -->
    <link href="../public/css/styles.css" type="text/css" rel="stylesheet" />
    <!-- End of CSS imports -->
</head>
<body>

<?php if(strcmp($currentPage, "login.php") && strcmp($currentPage,"signup.php")){
    ?>
    <header>

        <nav class="nav">
                <a class="nav-item <?php if($currentPage == "dashboard.php") {echo "nav-item-active";}?>" href="../views/dashboard.php">dashboard</a>
                <div class="nav-item-dropdown">
                    <span class="nav-item  <?php if($currentPage == "courses.php") {echo "nav-item-active";}?>" id="course-dropdown-parent" href="../views/courses.php">courses</span>
                    <div class="nav-item-course-dropdown" id="course-dropdown-list">
                        <a class="nav-item" href="../views/courses.php?course=CSCORE1&week=1">CORE 1</a>
                        <a class="nav-item" href="../views/courses.php?course=CSCORE2&week=1">CORE 2</a>
                    </div>

                </div>
                <a class="nav-item <?php if($currentPage == "assignments.php") {echo "nav-item-active";}?>" href="../views/assignments.php">assignments</a>
                <a class="nav-item <?php if($currentPage == "grades.php") {echo "nav-item-active";}?>" href="../views/grades.php">grades</a>
        </nav>
    </header>
<?php }?>
