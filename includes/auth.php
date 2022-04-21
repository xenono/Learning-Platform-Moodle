<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION["userId"]) || !isset($_SESSION["isLoggedIn"]) || !isset($_SESSION["name"])){
    header('Location: ../views/login.php');
}

// to authorise the enrollment
function authoriseEnrollmentCourse($conn){
    if (isset($_POST['authorise']) && isset($_POST["course"]) && isset($_POST["courseApproved"])){
        $courseId = mysqli_escape_string($conn, $_POST["course"]);
        $studentId = mysqli_escape_string($conn, $_POST["student"]);
        $Approved = mysqli_escape_string($conn, $_POST["courseApproved"]);
        $Approved = 1;
        $sql = "UPDATE studentcourse SET courseApproved=$Approved WHERE courseId = $courseId AND studentId = $studentId ";
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }

    }
}

function rejectEnrollmentCourse($conn){
    // to reject the enrollment.
    if (isset($_POST['reject'])&& isset($_POST["course"])){
        $courseId = mysqli_escape_string($conn,$_POST["course"]);
        $studentId = mysqli_escape_string($conn,$_POST["student"]);
        $Approved = mysqli_escape_string($conn,$_POST["courseApproved"]);
        $sql = "DELETE FROM studentcourse WHERE courseId = $courseId AND studentId = $studentId ";
        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}

function authoriseStudent($conn){
    if (isset($_POST['authorise']) && $_POST['id']){
        $id = mysqli_escape_string($conn,$_POST['id']);
        $userAuthorised = mysqli_escape_string($conn,$_POST['userAuthorised']);
        $userAuthorised = 1;
        $sql = "UPDATE user SET userAuthorised = $userAuthorised WHERE id = $id  ";
        if ($conn->query($sql) === TRUE) {
// adding the approved students to 'student' table
            $sqladd = "INSERT INTO student (studentId) VALUES ($id)";
            if ($conn->query($sqladd) === TRUE){
                echo "Student added to the student table successfully";
            }
        }
        else {
            echo "Error updating record: " . $conn->error;
        }

    }

}
function rejectStudent($conn){
    if(isset($_POST['reject']) && $_POST['id']){
        $id = mysqli_escape_string($conn,$_POST['id']);
        $sql = "DELETE FROM user where id = $id";
        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}

function authoriseTutor($conn){
    if (isset($_POST['authorise']) && $_POST['id']){
        $id = mysqli_escape_string($conn,$_POST['id']);
        $userAuthorised = mysqli_escape_string($conn,$_POST['userAuthorised']);
        $userAuthorised = 1;
        $sql = "UPDATE user SET userAuthorised = $userAuthorised WHERE id = $id";
        if(($conn)->query($sql) == True){
            // adding authorised tutor to the tutor table
            $sqladd = "INSERT INTO tutor (tutorId) VALUES ($id)";
            if ($conn->query($sqladd) === TRUE) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
    }
}
function rejectTutor($conn){
    if(isset($_POST['reject']) && $_POST['id']){
        $id = mysqli_escape_string($conn,$_POST['id']);
        $sql = "DELETE FROM user where id = $id";
        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}

