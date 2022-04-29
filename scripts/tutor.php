<?php
function authoriseTutor($conn){
    if (isset($_POST['authoriseTutor']) && $_POST['id']){
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
    if(isset($_POST['rejectTutor']) && $_POST['id']){
        $id = mysqli_escape_string($conn,$_POST['id']);
        $sql = "DELETE FROM user where id = $id";
        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}