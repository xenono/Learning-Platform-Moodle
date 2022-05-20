<?php
 include('session.php');
 include "header.php";
 include "footer.php";
 $connect = mysqli_connect("localhost", "username", "", "moodle");
$query = "SELECT count(*) as present_absent_count, attendance,
     case
         when attendance = 1 then 'Complete'
         when attendance = -1 then 'Uncomplete'
       end as attendance FROM employee GROUP BY attendance ;";
$result = mysqli_query($connect, $query);
$i=0;
while ($row = mysqli_fetch_array($result)) {
    $label[$i] = $row["attendance"];
    $count[$i] = $row["present_absent_count"];
    $i++;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta content='text/html; charset=UTF-8' http-equiv='Content-Type'/>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<title>Ace Training</title>
</head>
<body>
<div id="center">
<h1 align='center'>Welcome <?php echo $loggedin_session; ?>,</h1>
You are now logged in. you can logout by clicking on signout link given below.
<div id="contentbox">
<?php
$sql="SELECT * FROM member where mem_id=$loggedin_id";
$result=mysqli_query($con,$sql);
?>
<?php
while($rows=mysqli_fetch_array($result)){
?>
<div id="signup">
<div id="signup-st">
<form action="" method="POST" id="signin" id="reg">
<div id="reg-head" class="headrg">Your Profile</div>
<table border="0" align="center" cellpadding="2" cellspacing="0">

<tr id="lg-1">
<td class="tl-1"><div align="left" id="tb-name">ID:</div></td>
<td class="tl-4"><?php echo $rows['username']; ?></td>

</tr>
<tr id="lg-1">
<td class="tl-1"><div align="left" id="tb-name">Name:</div></td>
<td class="tl-4"><?php echo $rows['fname']; ?> <?php echo $rows['lname']; ?></td>

</tr>
<tr id="lg-1">
<td class="tl-1"><div align="left" id="tb-name">Address:</div></td>
<td class="tl-4"><?php echo $rows['address']; ?></td>

</tr>
<tr id="lg-1">
<td class="tl-1"><div align="left" id="tb-name">Email:</div></td>
<td class="tl-4"><?php echo $rows['email']; ?></td>

</tr>
</table>
<div id="reg-bottom" class="btmrg">Copyright © Ace Training</div>
</form>
</div>
</div>
<div id="login">
<div id="login-sg">
<div id="st"><a href="logout.php" id="st-btn1">Sign Out</a></div>
<div id="st"><a href="python.sql" id="st-btn1">Python Beginnner</a></div>
<div id="st"><a href="html.sql" id="st-btn1">HTML and CSS</a></div>
<div id="st"><a href="C.sql" id="st-btn1">C# Beginner</a></div>
<div id="st"><a href="resetpiechart.sql" id="st-btn1">Reset</a></div>
</div>
</div>
<?php 
// close while loop 
}
?>

<script type="text/javascript"
    src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">  
google.charts.load('current', {'packages':['corechart']});  
google.charts.setOnLoadCallback(drawPieChart);  

function drawPieChart()  
{  
    var pie = google.visualization.arrayToDataTable([  
              ['attendancede', 'Numbder'],
              ['<?php echo $label[0]; ?>', <?php echo $count[0]; ?>],
              ['<?php echo $label[1]; ?>', <?php echo $count[1]; ?>],
                    
         ]);  
    var header = {  
          title: 'Course Completion',
          slices: {0: {color: '#666666'}, 1:{color: '#f98012'}}
         };  
    var piechart = new google.visualization.PieChart(document.getElementById('piechart'));  
    piechart.draw(pie, header);  
} 
</script>

</div>
</div>
</div>
</br>
<div id="footer"><p> Copyright © Ace Training </p></div>
<div id="piechart"></div>
</body>
</html>