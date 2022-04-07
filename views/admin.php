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
            <h2><i class = "fa fa-id-badge" aria-hidden="true"> Student Applications</i> </h2>
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
          <h2> <i class = "fa fa-book" aria-hidden="true"> Enrollment of students onto applied courses </i> </h2>
          <?php
          $sql = "SELECT studentcourse.student_id ,studentcourse.course_id , studentcourse.course_approved ,user.name,user.surname   FROM studentcourse  INNER JOIN user ON studentcourse.student_id = user.id where course_approved = 0";
          $result = mysqli_query($conn,$sql);
          authoriseEnrollmentCourse($conn);
          rejectEnrollmentCourse($conn);
           while($row = $result->fetch_object()){
              ?>
              <form method ='post' action = 'admin.php'>
              <table>
              <tr><td><?php echo $row->student_id ?> </td>
                  <td><?php echo $row->name ?></td>
                  <td><?php echo $row->surname ?></td>
                  <td><?php echo $row->course_id ?></td>

                  <td><input type='submit' name = 'authorise' value = 'Authorise'</td>
                  <td><input type='submit' name = 'reject' value = 'Reject'</td>
              </tr></table>
              <input type = 'hidden' name = 'courseApproved' value = '<?php echo $row->course_approved ?>'/>
                  <input type = 'hidden' name = 'course' value = '<?php echo $row->course_id ?>'/>
                  <input type = 'hidden' name = 'student' value = '<?php echo $row->student_id ?>'/>
               </form>

      <?php
          }
          ?>

      </div>
      <div class="page-content">
          <h2><i class="fa fa-university"> Tutors Enrollment </i> </h2>
              <?php
              $sql = "SELECT * FROM user WHERE userType = 'tutor' AND userAuthorised = 0";
              $result = mysqli_query($conn, $sql);
              authoriseTutor($conn);
              //rejectTutor($conn);
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
              }
              ?>
          </div>

     <div class="page-content">
         <h2><i class="fa fa-file"> Add Course </i></h2>
        <?php
        if(isset($_POST["addCourseForm"])){
            extract($_POST);
            /**
             * @var string $courseLeader
             * @var string $courseName
             * @var number $courseProgramme
             */
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
    <?php
    if(isset($_POST["addLectureForm"]) && $_FILES["file"]){
        extract($_POST);
        /**
         * @var string $courseId
         * @var string $lectureDescription
         * */
        $fileData = $_FILES["file"];

        $tmpName =$fileData["tmp_name"];
        $filename = $fileData["name"];
        if(move_uploaded_file($tmpName,$_SERVER["DOCUMENT_ROOT"] . "/uploads/$filename")){
            $sql = "INSERT INTO lecture(courseId,lectureDescription) VALUES ('$courseId','$lectureDescription');";
            if(!$conn->query($sql)){
                echo mysqli_error($conn);
            }
            $lectureId = $conn->insert_id;
            $authorId = $_SESSION["userId"];
            $sql = "INSERT INTO file(fileName,authorId) VALUES ('$tmpName','$authorId');";
            if(!$conn->query($sql)){
                echo mysqli_error($conn);
            }
            $fileId = $conn->insert_id;
            $sql = "INSERT INTO lectureresource (lectureId,fileId) VALUES ('$lectureId','$fileId')";
            if(!$conn->query($sql)){
                echo mysqli_error($conn);
            }
        } else {
            echo "File uploading has failed.";
        }
    } ?>
        <h2><i class = "fa fa-upload"> Upload File</i></h2>
    <form action="admin.php" method="POST" class="flex-form"  enctype="multipart/form-data">
        <label for="courseId">Choose course</label>
        <select name="courseId" id="courseId" required>
            <?php
            foreach ($courses as $course) { ?>
                <option value="<?php echo $course[0] ?>"><?php echo $course[1] ?></option>
            <?php } ?>
        </select>
        <label for="lectureDescription">Lecture Description</label>
        <textarea id="lectureDescription" name="lectureDescription" required></textarea>
        <label for="file">Lecture Resource</label>
        <input type="file" name="file" id="file">
        <button type="submit" value="true" name="addLectureForm">Add</button>
    </form>
  </div>
</div>
