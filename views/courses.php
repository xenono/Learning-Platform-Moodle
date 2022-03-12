<?php
include("../includes/header.php");
$currentCourse = null;
$currentWeek = "1";
if (isset($_GET["course"]) && isset($_GET["week"])) {
    $currentCourse = $_GET["course"];
    $currentWeek = $_GET["week"];
}
?>
<div class="courses-content-wrapper">

    <?php if (!$currentCourse) { ?>
        <h1> Database error!!!</h1>
        <?php
        return;
    } ?>
    <div class="week-dropdown">
        <h1>All lectures</h1>
        <ul class="week-dropdown-list">
            <?php for ($i = 1; $i < 28; $i += 1) { ?>
                <li class="week-dropdown-list-item">
                    <a
                            class="<?php echo($currentWeek == $i ? "current" : "") ?>"
                            href=<?php echo "courses.php?course=" . $currentCourse . "&week=" . $i ?>>
                        <?php echo "Lecture " . $i ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
    <div class="course-content">
        <div class="course-content-container">
            <h1><?php echo $currentCourse . " Lecture" . " " . $currentWeek ?></h1>
            <p>Lecture description</p>
            <div class="file-wrapper">
                <img src="../public/assets/pptx.png" alt="" class="file-icon">
                <p class="file-name">3--CSS-part.pptx</p>
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
        <div class="course-content-container">
            <h1><?php echo $currentCourse . " Lecture" . " " . $currentWeek ?></h1>
            <p class="course-content-description">Introduction
                In weeks 3 and 4 will will look at the highest layer in the communications stack - the Application Layer. Many of the networking protocols you will be most familiar with (email, HTTP etc.) are defined at this level and will provide an accessible introduction to the notion of a protocol and how protocols are used in networks and the internet.

                This Week
                Application Architectures.
                Application service requirements.
                Internet transport service model.
                Specific protocols; The Web and HTTP

            </p>
            <div class="file-wrapper">
                <img src="../public/assets/pptx.png" alt="" class="file-icon">
                <p class="file-name">3--CSS-part.pptx</p>
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

