<?php
include $_SERVER["DOCUMENT_ROOT"] . "/includes/header.php";
include $_SERVER["DOCUMENT_ROOT"] . "/includes/auth.php";
include $_SERVER["DOCUMENT_ROOT"] . "/config/Connection.php";
global $conn;
//print_r($_SESSION);

if (isset($_SESSION["userType"]) && $_SESSION["userType"] === "student") {
    echo "<div class = 'error-box'>
         <p> Unauthorised Access!</p>
         </div>;";
    die();
}

$sql = "SELECT * from course";
$courses = $conn->query($sql);
if ($courses->num_rows > 0) {
    $courses = mysqli_fetch_all($courses);
}
?>

<div class="admin">
    <h1> Admin Page </h1>

    <div class="page-content">
        <h2><i class="fa fa-id-badge" aria-hidden="true"> Student Applications</i></h2>
        <?php
        $sql = "SELECT * FROM user WHERE userType = 'student' AND userAuthorised = 0";
        $result = mysqli_query($conn, $sql);
        authoriseStudent($conn);
        rejectStudent($conn);
        while ($row = $result->fetch_object()) {
            ; ?>
            <form method='post' action='admin.php'>
                <table>
                    <tr>
                        <td><?php echo $row->id ?> </td>
                        <td><?php echo $row->name ?></td>
                        <td><?php echo $row->surname ?></td>
                        <td><input type='submit' name='authorise' value='Authorise'</td>
                        <td><input type='submit' name='reject' value='Reject'</td>
                    </tr>
                </table>
                <input type='hidden' name='userAuthorised' value='<?php echo $row->userAuthorised ?>'/>
                <input type='hidden' name='id' value='<?php echo $row->id ?>'/>

            </form>

            <?php
        }
        ?>
    </div>
    <div class="page-content">
        <h2><i class="fa fa-book" aria-hidden="true"> Enrollment of students onto applied courses </i></h2>
        <?php
        $sql = "SELECT studentcourse.studentId ,studentcourse.courseId , studentcourse.courseApproved ,user.name,user.surname   FROM studentcourse  INNER JOIN user ON studentcourse.studentId = user.id where courseApproved = 0";
        $result = mysqli_query($conn, $sql);
        authoriseEnrollmentCourse($conn);
        rejectEnrollmentCourse($conn);
        while ($row = $result->fetch_object()) {
            ?>
            <form method='post' action='admin.php'>
                <table>
                    <tr>
                        <td><?php echo $row->studentId ?> </td>
                        <td><?php echo $row->name ?></td>
                        <td><?php echo $row->surname ?></td>
                        <td><?php echo $row->courseId ?></td>

                        <td><input type='submit' name='authorise' value='Authorise'</td>
                        <td><input type='submit' name='reject' value='Reject'</td>
                    </tr>
                </table>
                <input type='hidden' name='courseApproved' value='<?php echo $row->courseApproved ?>'/>
                <input type='hidden' name='course' value='<?php echo $row->courseId ?>'/>
                <input type='hidden' name='student' value='<?php echo $row->studentId ?>'/>
            </form>

            <?php
        }
        ?>

    </div>
      <div class="page-content">
          <h2><i class="fa fa-university"> Tutors Application </i> </h2>
              <?php
              $sql = "SELECT * FROM user WHERE userType = 'tutor' AND userAuthorised = 0";
              $result = mysqli_query($conn, $sql);
              authoriseTutor($conn);
              rejectTutor($conn);
              if($result->num_rows > 0) {
              while($row = $result->fetch_object()){?>
                  <form method ='post' action = 'admin.php'>
                      <table>
                          <tr><td><?php echo $row->id ?> </td>
                              <td><?php echo $row->name ?></td>
                              <td><?php echo $row -> surname?></td>
                              <td><?php echo $row -> phoneNumber?></td>
                              <td><?php echo $row -> email?></td>
                              <td><?php echo $row -> address?></td>
                              <td><?php echo $row -> dateOfBirth?></td>
                              <td><input type='submit' name = 'authorise' value = 'Authorise'</td>
                              <td><input type='submit' name = 'reject' value = 'Reject'</td>
                          </tr></table>
                      <input type = 'hidden' name = 'userAuthorised' value = '<?php echo $row->userAuthorised ?>'/>
                      <input type = 'hidden' name = 'id' value = '<?php echo $row->id ?>'/>
                  </form>

                  <?php
              } } else {
                  echo "<h3 style='color:black;'>No tutors to authorise</h3>";
              }
              ?>
          </div>

    <div class="page-content">
        <table>
            <h2><i class="fa fa-info-circle"> Information </i> </h2>
            <tr>
                <th>Course name</th>
                <th>Course Tutor</th>
                <th>Edit course</th>
            </tr>
            <?php foreach ($courses as $course) {?>
                    <tr>
                        <td><?php echo $course[1] ?></td>
                        <td><?php echo $course[2] ?></td>
                        <td style="padding: 10px;">
                            <form action="adminEditCourse.php" method="POST" class="flex-column">
                                <input type="text" hidden value="<?php echo $course[0] ?>" name="courseId">
                                <button type="submit" style="margin: 0 auto;">Edit</button>
                            </form>
                        </td>
                    </tr>

            <?php } ?>
        </table>
    </div>
     <div class="page-content">
         <h2><i class="fa fa-file"> Add Course </i></h2>
        <?php
        if(isset($_POST["addCourseForm"])){
            $courseLeader = mysqli_escape_string($conn,$_POST["courseLeader"]);
            $courseName = mysqli_escape_string($conn,$_POST["courseName"]);
            $courseProgramme = mysqli_escape_string($conn,$_POST["courseProgramme"]);

            $sql = "INSERT INTO course (courseName,courseLeader,courseProgramme) VALUES ('$courseName','$courseLeader','$courseProgramme')";
            if(!$conn->query($sql)){
                echo mysqli_error($conn);
            }
        }
        ?>
        <form action="admin.php" method="POST" class="flex-form">
            <label for="courseName">Course Name</label>
            <input type="text" name="courseName" id="courseName">
            <label for="courseProgramme">Course Programme</label>
            <input type="text" name="courseProgramme" id="courseProgramme">
            <label for="courseLeader">Course Leader</label>
            <input type="text" name="courseLeader" id="courseLeader">
            <button type="submit" value="true" name="addCourseForm">Add</button>
        </form>
     </div>
    <div class = "page-content">
    <h1>Add files to lecture</h1>
    <!--    <h2><i class = "fa fa-upload"> Upload File</i></h2>-->
    <?php
    if (isset($_POST["addResourceForm"]) && $_FILES["file"]) {
        $courseId = mysqli_escape_string($conn, $_POST["courseId"]);
        $lectureDescription = mysqli_escape_string($conn, $_POST["lectureDescription"]);
        $fileData = $_FILES["file"];

        $tmpName = $fileData["tmp_name"];
        $filename = $fileData["name"];
        if (move_uploaded_file($tmpName, $_SERVER["DOCUMENT_ROOT"] . "/uploads/$filename")) {
            $sql = "INSERT INTO lecture(courseId,lectureDescription) VALUES ('$courseId','$lectureDescription');";
            if (!$conn->query($sql)) {
                echo mysqli_error($conn);
            }
            $lectureId = $conn->insert_id;
            $authorId = $_SESSION["userId"];
            $sql = "INSERT INTO file(fileName,authorId) VALUES ('$tmpName','$authorId');";
            if (!$conn->query($sql)) {
                echo mysqli_error($conn);
            }
            $fileId = $conn->insert_id;
            $sql = "INSERT INTO lectureresource (lectureId,fileId) VALUES ('$lectureId','$fileId')";
            if (!$conn->query($sql)) {
                echo mysqli_error($conn);
            }
        } else {
            echo "File uploading has failed.";
        }
    } ?>
    <form action="admin.php" method="POST" class="flex-form" enctype="multipart/form-data" style="margin-bottom: 50px;">
        <label for="courseId">Choose course</label>
        <select name="courseId" id="courseId" required>
            <?php
            foreach ($courses as $course) { ?>
                <option value="<?php echo $course[0] ?>"><?php echo $course[1] ?></option>
            <?php }
            ?>
        </select>
        <label for="lectureNumber">Lecture Number</label>
        <input id="lectureNumber" name="lectureNumber" required type="number">
        <label for="file">Lecture Resource</label>
        <input type="file" name="file" id="file">
        <button type="submit" value="true" name="addResourceForm">Add</button>
    </form>

    <!-- Assignment file handling -->
    <h1>Assignments</h1>
    <h2><i class = "fa fa-upload"> Upload Assignment Files</i></h2>
    <form action="admin.php" method="POST" class="flex-form"  enctype="multipart/form-data">
        <label for="courseId">Choose course</label>
        <select name="courseId" id="courseId" required>
            <?php
            foreach ($courses as $course) { ?>
                <option value="<?php echo $course[0] ?>"><?php echo $course[1] ?></option>
            <?php } ?>
        </select>
        <label for="assignmentDetails">Assignment Details</label>
        <textarea id="assignmentDetails" name="assignmentDetails" required></textarea>
        <label for="assignmentDate">Assignment Due Date</label>
        <input type="date" id="assignmentDate" name="assignmentDate" required></input>
        <label for="file">Assignment Resource</label>
        <input type="file" name="file" id="file">
        <button type="submit" value="true" name="addAssignmentResource">Add</button>
    </form>

    <?php
    if(isset($_POST["addAssignmentResource"]) && $_FILES["file"]){
        $courseId = mysqli_escape_string($conn,$_POST["courseId"]);
        $assignmentDetails = mysqli_escape_string($conn,$_POST["assignmentDetails"]);
        $assignmentDate = date('Y-m-d', strtotime($_POST['assignmentDate']));
        $fileData = $_FILES["file"];

        $tmpName =$fileData["tmp_name"];
        $filename = $fileData["name"];

        $noOfForbiddenChars = 0;

        // Count no. of forbidden chars in file name

        for ($i = 0; $i < strlen($filename); $i++) {
            if (($filename[$i] == "<") || ($filename[$i] == ">") || ($filename[$i] == "#") || ($filename[$i] == "%")) {
                $noOfForbiddenChars++;
            }
        }

        if((move_uploaded_file($tmpName,$_SERVER["DOCUMENT_ROOT"] . "/learning-platform-moodle/uploads/$filename")) && ($noOfForbiddenChars == 0)){
            $sql = "INSERT INTO assignment(courseId,assignmentDetails,dueDate) VALUES ('$courseId','$assignmentDetails', '$assignmentDate');";
            if(!$conn->query($sql)){
                echo mysqli_error($conn);
            }
            $assignmentId = $conn->insert_id;
            $authorId = $_SESSION["userId"];
            $sql = "INSERT INTO file(fileName,authorId) VALUES ('$filename','$authorId');";
            if(!$conn->query($sql)){
                echo mysqli_error($conn);
            }
            $fileId = $conn->insert_id;
            $sql = "INSERT INTO assignmentresource (assignmentId,fileId) VALUES ('$assignmentId','$fileId')";
            if(!$conn->query($sql)){
                echo mysqli_error($conn);
            }
        } else {
            echo "File uploading has failed. Check if the name of the file contains a '<', '>', '%' or a '#'.";
        }
    } ?>

<!-- Grade student assignment work -->


<h2><i class = "fa fa-university"> Grade Assignments</i></h2>

<table>
    <tr>
        <th>Assignment</th>
        <th>Submitted Work</th>
        <th>Student</th>
        <th>Grade</th>
    </tr>
    <?php 
    $sql = mysqli_query($conn, "SELECT * FROM assignmentgrade;");
    $fileNames = mysqli_query($conn, "SELECT fileName FROM file INNER JOIN assignmentgrade ON assignmentgrade.fileId=file.fileId WHERE file.fileId=assignmentgrade.fileId");
    while($row = mysqli_fetch_array($sql)) { ?>
        <form method = 'POST' action = '<?php echo "admin.php?fileid=" . $row['fileId']; ?>' method='POST' enctype='multipart/form-data'>
            <tr>
                <td> <?php echo $row['assignmentId']; ?> </td>
                <td><?php echo "<a href='/learning-platform-moodle/uploads/" . mysqli_fetch_array($fileNames)[0] . "'/>Download file</a>";?></td>
                <td> <?php echo $row['userId']; ?> </td>
                <td><input type = 'text' name = 'Grade' id = 'Grade' required></td>
                <td><input type="submit" value="Submit" name="uploadGrade"></td>
            </tr>
        </form>
    <?php } 

    if (isset($_POST["uploadGrade"])) {
        $fileId = $_GET['fileid'];
        $userId = $_SESSION['userId'];
        $grade = mysqli_escape_string($conn,$_POST["Grade"]);

        $sql = "UPDATE assignmentgrade SET grade = '$grade' WHERE fileId='$fileId'";
        if(!$conn->query($sql)) {
            echo mysqli_error($conn);
        }
    } ?>
</table>

    <h1>Quizzes</h1>
    <h2><i class = "fa fa-file"> Add Quiz</i></h2>

    <form action="admin.php" method="POST" class="flex-form"  enctype="multipart/form-data">
        <label for="courseId">Course</label>
        <select name="courseId" id="courseId" required>
            <?php
            foreach ($courses as $course) { ?>
                <option value="<?php echo $course[0] ?>"><?php echo $course[1] ?></option>
            <?php } ?>
        </select>
        <label for="quizName">Quiz Name</label>
        <input type="text" id="quizName" name="quizName" required></input>
        <button type="submit" value="true" name="addQuiz">Add</button>
    </form>


    <?php

    if (isset($_POST["addQuiz"])) {

        $noOfForbiddenChars = 0;
        $courseId = mysqli_escape_string($conn,$_POST["courseId"]);
        $quizName = mysqli_escape_string($conn,$_POST["quizName"]);

        for ($i = 0; $i < strlen($quizName); $i++) {
            if (($quizName[$i] == "<") || ($quizName[$i] == ">") || ($quizName[$i] == "#") || ($quizName[$i] == "%")) {
                $noOfForbiddenChars++;
            }
        }

        if ($noOfForbiddenChars == 0) {
            $sql = "INSERT INTO quiz(courseId, quizName) VALUES ('$courseId', '$quizName');";
            if(!$conn->query($sql)) {
                echo mysqli_error($conn);
            }
        } else {
            echo "Quiz name invalid. Ensure there are no '<', '>', '#' or '%' symbols";
        }
    }

    ?>

    <h2><i class = "fa fa-upload"> Upload Quiz Questions</i></h2>

    <form action="admin.php" method="POST" class="flex-form"  enctype="multipart/form-data">
        <label for="quizId">Quiz</label>
        <select name="quizId" id="quizId" required>
            <?php
            foreach ($quizzes as $quiz) { ?>
                <option value="<?php echo $quiz[0] ?>"><?php echo $quiz[2] ?></option>
            <?php } ?>
        </select>
        <label for="question">Question</label>
        <textarea id="question" name="question" required></textarea>
        <label for="answer1">Answer 1</label>
        <textarea id="answer1" name="answer1" required></textarea>
        <label for="answer2">Answer 2</label>
        <textarea id="answer2" name="answer2" required></textarea>
        <label for="answer3">Answer 3</label>
        <textarea id="answer3" name="answer3"></textarea>
        <label for="answer4">Answer 4</label>
        <textarea id="answer4" name="answer4"></textarea>
        <label for="correctAnswer">Correct Answer</label>
        <select name="correctAnswer" id="correctAnswer" required>
            <option value="answer1">Answer 1</option>
            <option value="answer2">Answer 2</option>
            <option value="answer3">Answer 3</option>
            <option value="answer4">Answer 4</option>
        </select>
        <button type="submit" value="true" name="addQuestion">Add</button>

    </form>

    <?php

    if (isset($_POST["addQuestion"])) {

        $noOfForbiddenCharsQuestion = 0;
        $noOfForbiddenCharsAnswer1 = 0;
        $noOfForbiddenCharsAnswer2 = 0;
        $noOfForbiddenCharsAnswer3 = 0;
        $noOfForbiddenCharsAnswer4 = 0;
        $quizId = mysqli_escape_string($conn,$_POST["quizId"]);
        $question = mysqli_escape_string($conn,$_POST["question"]);
        $answer1 = mysqli_escape_string($conn,$_POST["answer1"]);
        $answer2 = mysqli_escape_string($conn,$_POST["answer2"]);
        $answer3 = mysqli_escape_string($conn,$_POST["answer3"]);
        $answer4 = mysqli_escape_string($conn,$_POST["answer4"]);
        $correctAnswer = "";

        if ($_POST["correctAnswer"] == "Answer 1") {
            $correctAnswer = $answer1;
        } else if ($_POST["correctAnswer"] == "Answer 2") {
            $correctAnswer = $answer2;
        } else if ($_POST["correctAnswer"] == "Answer 3") {
            $correctAnswer = $answer3;
        } else {
            $correctAnswer = $answer4;
        }
        // Making sure questions and answers dont have forbidden chars

        for ($i = 0; $i < strlen($question); $i++) {
            if (($question[$i] == "<") || ($question[$i] == ">") || ($question[$i] == "#") || ($question[$i] == "%")) {
                $noOfForbiddenCharsQuestion++;
            }
        }

        for ($i = 0; $i < strlen($answer1); $i++) {
            if (($answer1[$i] == "<") || ($answer1[$i] == ">") || ($answer1[$i] == "#") || ($answer1[$i] == "%")) {
                $noOfForbiddenCharsQuestionAnswer1++;
            }
        }

        for ($i = 0; $i < strlen($answer2); $i++) {
            if (($answer2[$i] == "<") || ($answer2[$i] == ">") || ($answer2[$i] == "#") || ($answer2[$i] == "%")) {
                $noOfForbiddenCharsQuestionAnswer2++;
            }
        }

        for ($i = 0; $i < strlen($answer3); $i++) {
            if (($answer3[$i] == "<") || ($answer3[$i] == ">") || ($answer3[$i] == "#") || ($answer3[$i] == "%")) {
                $noOfForbiddenCharsQuestionAnswer3++;
            }
        }

        for ($i = 0; $i < strlen($answer4); $i++) {
            if (($answer4[$i] == "<") || ($answer4[$i] == ">") || ($answer4[$i] == "#") || ($answer4[$i] == "%")) {
                $noOfForbiddenCharsQuestionAnswer4++;
            }
        }

        if (($noOfForbiddenCharsQuestion == 0) && ($noOfForbiddenCharsAnswer1 == 0) && ($noOfForbiddenCharsAnswer2 == 0) && ($noOfForbiddenCharsAnswer3 == 0) && ($noOfForbiddenCharsAnswer4 == 0)) {
            $sql = "INSERT INTO quizquestions (quizId, question, answer1, answer2, answer3, answer4, correctAnswer) VALUES ('$quizId', '$question', '$answer1', '$answer2', '$answer3', '$answer4', '$correctAnswer');";
            if (!$conn->query($sql)) {
                echo mysqli_error($conn);
            }
        } else {
            echo "Ensure the question and answers do not have '<', '>', '#' or '%' in them";
        }

    }

    ?>


  </div>
</div>

<?php
include("../includes/footer.php");
?>

