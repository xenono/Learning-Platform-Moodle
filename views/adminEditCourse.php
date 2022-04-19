<?php
include $_SERVER["DOCUMENT_ROOT"] . "/includes/header.php";
include $_SERVER["DOCUMENT_ROOT"] . "/includes/auth.php";
include $_SERVER["DOCUMENT_ROOT"] . "/config/Connection.php";
global $conn;

if (isset($_SESSION["userType"]) && $_SESSION["userType"] === "student") {
    echo "<div class = 'error-box'>
         <p> Unauthorised Access!</p>
         </div>;";
    die();
}
if (isset($_POST["addLectureForm"])) {
    $courseId = mysqli_escape_string($conn, $_POST["courseId"]);
    $lectureDescription = mysqli_escape_string($conn, $_POST["lectureDescription"]);
    $sql = "INSERT INTO lecture(courseId,lectureDescription) VALUES ('$courseId','$lectureDescription');";
    if (!$conn->query($sql)) {
        echo mysqli_error($conn);
    }
}
if(isset($_POST["courseId"])){
    $courseId = $_POST["courseId"];
    $lectures = getAllLectures($conn, $courseId);
    $courseInfo = getCourseInfo($conn, $courseId);
} else {
    Header("Location: admin.php");
}
?>

<div class="admin">
    <div class="page-content">
        <h1>Course: <?php echo $courseInfo->courseName ?></h1>
    </div>
    <div class="page-content">
        <h1>Lectures</h1>
        <table>
            <tr>
                <th>Lecture Number</th>
                <th>Lecture ID</th>
                <th>Lecture Description</th>
                <th>Edit course</th>
            </tr>
            <?php
            $lectureCounter = 0;
            foreach ($lectures as $lecture) {
                $lectureCounter++;
                ?>
                <tr>
                    <td><?php echo $lectureCounter ?></td>
                    <td><?php echo $lecture->lectureId ?></td>
                    <td><?php echo $lecture->lectureDescription ?></td>
                    <td style="padding: 10px;">
                        <form action="adminEditCourse.php" method="POST" class="flex-column">
                            <input type="text" hidden value="<?php echo $lecture->lectureId ?>" name="lectureId">
                            <button type="submit" style="margin: 0 auto;">Edit</button>
                        </form>
                    </td>
                </tr>

            <?php } ?>
        </table>
    </div>
    <div class="page-content">

        <h1>Add lecture</h1>
        <form action="adminEditCourse.php" method="POST" class="flex-form" style="margin-bottom: 50px;">
            <input type="text" hidden name="courseId" value="<?php echo $courseId?>">
            <label for="lectureDescription">Lecture Description</label>
            <textarea id="lectureDescription" name="lectureDescription" required></textarea>
            <button type="submit" value="true" name="addLectureForm">Add</button>
        </form>
    </div>
</div>

