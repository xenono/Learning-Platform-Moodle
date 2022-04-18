<?php
include("../includes/header.php");
include("../config/Connection.php");
global $conn;
$currentCourse = null;
$currentLecture = "1";
$lectures = [];
$resources = [];
$lectureResources = [];
if (isset($_GET["courseId"]) && isset($_GET["lecture"])) {
    $courseId = $_GET["courseId"];
    $currentLecture = $_GET["lecture"];
    $courseInfo = getCourseInfo($conn,$courseId);
    $currentCourse = $courseInfo->courseName;
    $lectures = getAllLectures($conn,$courseId);
    $lectureResources = getLectureResources($conn, $lectures[$currentLecture - 1]->lectureId);
}

//if (!$currentCourse || !$lectures) {
//    Header("Location: dashboard.php");
//}
?>

<div class="courses-content-wrapper">
    <div class="week-dropdown">
        <h1>All lectures</h1>
        <ul class="week-dropdown-list">
            <?php for ($i = 0; $i < sizeof($lectures); $i += 1) { ?>
                <li class="week-dropdown-list-item">
                    <a
                            class="<?php echo($currentLecture == ($i + 1) ? "current" : "") ?>"
                            href=<?php echo "courses.php?courseId=" . $courseId . "&lecture=" . ($i + 1) ?>>
                        <?php echo "Lecture " . ($i + 1) ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
        <div class="course-content-container course-content">
            <h1><?php echo $currentCourse . " Lecture" . " " . $currentLecture ?></h1>
            <p class="course-content-description">
                <?php echo $lectures[$currentLecture - 1]->lectureDescription?>
            </p>
            <?php
            foreach ($lectureResources as $lectureResource) { ?>
            <div class="file-wrapper">
                <img src="../public/assets/pptx.png" alt="" class="file-icon">
                <p class="file-name"><?php echo $lectureResource->fileName ?></p>
            </div>
            <?php } ?>
            <h1> STATIC </h1>
            <div class="file-wrapper">
                <img src="../public/assets/pptx.png" alt="" class="file-icon">
                <p class="file-name">3--Lecture.pptx</p>
            </div>
            <div class="file-wrapper">
                <img src="../public/assets/file.png" alt="" class="file-icon">
                <p class="file-name">3--HTML-exercise.doc/p>
            </div>
            <div class="file-wrapper">
                <img src="../public/assets/file.png" alt="" class="file-icon">
                <p class="file-name">3--CSS-exercise.docx</p>
            </div>

            <div class="file-wrapper">
                <img src="../public/assets/folder.png" alt="" class="file-icon">
                <p class="file-name">Additional Resources</p>
            </div>
        </div>
    </div>
</div>

<?php
include("../includes/footer.php");
?>

