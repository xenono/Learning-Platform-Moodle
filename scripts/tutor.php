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

function enrollTutor($conn){
    if (isset($_POST['enrollTutor']) && $_POST['courseEnroll']) {
        $courseId = mysqli_escape_string($conn, $_POST['courseEnroll']);
        $tutorId = mysqli_escape_string($conn, $_POST['tutorId']);
        $contractType = $_POST['contract'];
        print_r($contractType);

        // enrolling each tutor to courses by the admin; many-to-many relationship
        $check = "SELECT * FROM tutorcourse where tutorId  = $tutorId && courseId = $courseId";
        $res = $conn ->query($check);
        $sql = mysqli_fetch_array($res , MYSQLI_NUM);
        if($sql > 1){
            echo "You have assigned this person, for this course!";
        }
        else {
            $sql = "INSERT INTO tutorcourse (tutorId,courseId) VALUES ('$tutorId','$courseId')";
            $res = $conn->query($sql);
            if($res)
            {
                  echo "ADDED Successfully";
                  $courseSalary = array();
                  $totalSalary = 0;

                  $sqlsalary = "SELECT course.courseSalary from tutorcourse INNER JOIN course on tutorcourse.courseId = course.courseId where tutorId = $tutorId ";
                  $resultSal = $conn->query($sqlsalary);

                  if ($resultSal->num_rows > 0){
                        $courseSalary = mysqli_fetch_all($resultSal);
                    }
                    if (count($courseSalary) > 0){
                        foreach($courseSalary as $salary){
                            $totalSalary = $totalSalary + $salary[0];
                        }
                        print_r($totalSalary);
                        $sql = "UPDATE tutor set salary =$totalSalary where tutorId = $tutorId ";
                        $result = mysqli_query($conn,$sql);
                    }

                else {
                    echo "Error updating record: " . $conn->error;
                }
            }
          else {
                echo "There was an error while enrolling on to a course";
                echo mysqli_error($conn);
            }
        }
    }
}