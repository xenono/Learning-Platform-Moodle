<?php
include("../includes/header.php");
include $_SERVER["DOCUMENT_ROOT"] . "/includes/auth.php";
include("../config/Connection.php");
global $conn;

?>
<DOCTYPE html>
    <head>
        <title>Admin Page</title>
        <style>
            table {
                border-collapse: collapse;
                border: 2px solid #ee6631;
                width: 20px;
            }
            td {
                width: 100%;
                height: 5px;
                border: 1px solid #ccc;
                row-span: 1;
            }</style>
    </head>
<body>

  <div class = "">
      <h2>Admin Page</h2>
      <div class = "">
          <h2>Student applications</h2>
          <div class="">
              <?php
              $sql = "SELECT * FROM user WHERE userType = 'student' AND userAuthorised = 0";
              $result = mysqli_query($conn, $sql);
              authoriseStudent($conn);
              rejectStudentEnrollment($conn);
              while($row = $result->fetch_object()){
                  ;?>
                  <form method ='post' action = 'admin.php'>
                      <table>
                          <tr><td><?php echo $row->id ?> </td>
                              <td><?php echo $row->name ?></td>
                              <td><?php echo $row -> surname?></td>
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
      </div>
      <div class="">
          <h2><u> Enrolling Students to courses</u></h2>
          <div>
          <?php
          $sql = "SELECT * FROM studentcourse where course_approved = 0";
          $result = mysqli_query($conn,$sql);
          authoriseEnrollmentCourse($conn);
          rejectEnrollmentCourse($conn);
           while($row = $result->fetch_object()){
              ?>
              <form method ='post' action = 'admin.php'>
              <table>
              <tr><td><?php echo $row->student_id ?> </td>
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
      </div>

  </div>
</body>
</DOCTYPE>
