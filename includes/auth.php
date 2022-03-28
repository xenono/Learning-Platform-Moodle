<?php
session_start();
if(!isset($_SESSION["userId"]) || !isset($_SESSION["isLoggedIn"]) || !isset($_SESSION["name"])){
    header('Location: ../views/login.php');
}

// to authorise the enrollment
function authoriseEnrollmentCourse($conn){
    if (isset($_POST['authorise']) && isset($_POST["course"]) && isset($_POST["courseApproved"])){
        extract($_POST);
        $courseId = $_POST["course"];
        $studentId = $_POST["student"];
        $Approved = $_POST["courseApproved"];
        $Approved = 1;

        $sql = "UPDATE studentcourse SET course_approved=$Approved WHERE course_id = $courseId AND student_id = $studentId ";
        if ($conn->query($sql) === TRUE) {
            echo "Record $courseId successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }

    }
}

function rejectEnrollmentCourse($conn){
    // to reject the enrollment.
    if (isset($_POST['reject'])&& isset($_POST["course"])){
        $courseId = $_POST["course"];
        $studentId = $_POST["student"];
        $Approved = $_POST["courseApproved"];
        $sql = "DELETE FROM studentcourse WHERE course_id = $courseId AND student_id = $studentId ";
        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}

function authoriseStudent($conn){
    if (isset($_POST['authorise']) && $_POST['id']){

        $id = $_POST['id'];
        $userAuthorised = $_POST['userAuthorised'];
        $userAuthorised = 1;
        $sql = "UPDATE user SET userAuthorised = $userAuthorised WHERE id = $id  ";
        if ($conn->query($sql) === TRUE) {
            echo "Record created successfully";

        } else {
            echo "Error updating record: " . $conn->error;
        }

    }

}
function rejectStudentEnrollment($conn){
    if(isset($_POST['reject']) && $_POST['id']){
        $id = $_POST['id'];
        $sql = "DELETE FROM user where id = $id";
        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}

