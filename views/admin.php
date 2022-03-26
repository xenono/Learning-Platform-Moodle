<?php
include("../includes/header.php");
include $_SERVER["DOCUMENT_ROOT"] . "/includes/auth.php";
include("../config/Connection.php");
global $conn;
$sql = "SELECT * FROM studentcourse where course_approved = 0";
$result = mysqli_query($conn , $sql);
/*if ($result-> num_rows >0){
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
}*/

if (isset($_POST['authorise'])){
   $courseId = $_POST["course"];
   $studentId = $_POST["student"];
   $Approved = $_POST["courseApproved"];
   $Approved = 1;

    $sql = "UPDATE studentcourse SET course_approved=$Approved WHERE course_id = $courseId AND student_id = $studentId ";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        Header("Location: admin.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }

}
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
            }</style>
    </head>
<body>
  <div class = "">
      <h2>Admin Page</h2>
      <div class="">
          <h2><u>Student enrollment</u></h2>
          <div>
          <?php

           while($row = $result->fetch_object()){ ?>
              <form method ='post' action = 'admin.php'>
              <table>
              <tr><td><?php echo $row->student_id ?> </td>
                  <td><?php echo $row->course_id ?></td>
                  <td><input type='submit' name = 'authorise' value = 'Authorise'</td>
                  <td><input type='submit' name = 'reject' value = 'Reject'</td>
              </tr></table>
              <input type = 'hidden' name = 'courseApproved' value = '<?php echo $row->course_approved ?>'/>
                  <input type = 'hidden' name = 'student' value ='<?php echo $row->student_id ?>' />
                  <input type = 'hidden' name = 'course' value ='<?php echo $row->course_id ?>' />
                  


               </form>

      <?php
          }
          ?>
          </div>
      </div>

  </div>
</body>
</DOCTYPE>
