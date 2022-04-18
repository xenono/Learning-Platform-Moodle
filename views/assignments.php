<?php
include ("../includes/header.php");
include $_SERVER["DOCUMENT_ROOT"] . "/learning-platform-moodle/includes/auth.php";
include("../config/Connection.php");

global $conn;
// Find the courseIds of the courses that the user is taking and the course enrolment has been approved
$userId = $_SESSION["userId"];

/*

					-- ASSIGNMENTS --

*/

// Grabs the IDs of the courses that the logged in user is taken and that have been approved by the admin
$courseIdResults = mysqli_query($conn, "SELECT studentcourse.courseId FROM studentcourse INNER JOIN course ON studentcourse.courseId=course.courseId WHERE studentId='$userId' AND courseApproved = '1'");
$courseIds = mysqli_fetch_all($courseIdResults);


// Array variables that will hold the names, details and dates of each assignment that is assigned to the logged in user
$courseNamesResults = array();
$courseDetailsResults = array();
$courseDatesResults = array();
$courseFileNames = array();

// Grab the names, details and dates of each assignment of the courses that are being taken by the logged in user
if (sizeof($courseIds) > 0) {
	for ($i = 0; $i < sizeof($courseIds); $i++) {
		$courseId = $courseIds[$i][0];
		$courseNames = mysqli_query($conn, "SELECT courseName FROM assignment INNER JOIN course ON assignment.courseId=course.courseId WHERE assignment.courseId=$courseId");
		$courseDetails = mysqli_query($conn, "SELECT assignmentDetails FROM assignment INNER JOIN course ON assignment.courseId=course.courseId WHERE assignment.courseId=$courseId");
		$courseDates = mysqli_query($conn, "SELECT dueDate FROM assignment INNER JOIN course ON assignment.courseId=course.courseId WHERE assignment.courseId=$courseId");

		// Grab the assignment ids of the assignments for the courses that the user is taking
		$files = mysqli_query($conn, "SELECT assignmentId FROM assignment INNER JOIN course ON assignment.courseId=course.courseId WHERE assignment.courseId=$courseId");

		while($row = mysqli_fetch_array($files)) {
			$courseFileIds = mysqli_query($conn, "SELECT fileId FROM assignmentresource WHERE assignmentId = $row[assignmentId]");
		}

		while($row = mysqli_fetch_array($courseFileIds)) {
			$fileNames = mysqli_query($conn, "SELECT fileName FROM file INNER JOIN assignmentresource ON file.fileId=assignmentresource.fileId WHERE file.fileId=$row[fileId]");
			array_push($courseFileNames, mysqli_fetch_array($fileNames));
		}

		array_push($courseNamesResults, mysqli_fetch_array($courseNames));
		array_push($courseDetailsResults, mysqli_fetch_array($courseDetails));
		array_push($courseDatesResults, mysqli_fetch_array($courseDates));
	}

	// Gather the course names, assignment titles and due dates for each assignment

	$assignmentCourses = array();
	$assignmentDetails = array();
	$assignmentDueDates = array();
	$assignmentFileNames = array();

	// Push each name, detail and date for each assignment to the array variables that will be used within the html to present them to the user
	if (sizeof($courseNamesResults) > 0) {
		for ($i = 0; $i < sizeof($courseDatesResults); $i++) {
			$name = $courseNamesResults[$i];
			$details = $courseDetailsResults[$i];
			$date = $courseDatesResults[$i];
			$fileName = $courseFileNames[$i];
			array_push($assignmentCourses, $name);
			array_push($assignmentDetails, $details);
			array_push($assignmentDueDates, $date);
			array_push($assignmentFileNames, $fileName);
		}
	}
}

/*
					-- QUIZZES --
*/

$quizzes = array('SE Quiz 1','SE Quiz 2', 'OOSD Quiz 1','OOSD Quiz 2');

?>

<!-- Assignments -->

<div class = "assignments-grid">
	<div>
		<h1>Course Assignments</h1>
		<div class = "assignments">
			<ul class = "assignments-courses-list">
				<h2>Course</h2>
				<?php foreach($assignmentCourses as $course){?>
					<li class="assignments-course-item">
						<p>
						<?php
							echo $course[0];
						?>
						</p>
					</li>
				<?php } ?>
			</ul>
			<ul class = "assignments-assignment-titles">
				<h2>Assignment Title</h2>
				<?php foreach($assignmentDetails as $detail){?>

							<div class = "assignments-assignment-titles-item">
								<p>
									<?php
										echo $detail[0];
									?>
								</p>
							</div>
				<?php } ?>
			</ul>

			<ul class = "assignments-assignment-dates">
				<h2>Due date</h2>
				<?php foreach($assignmentDueDates as $date){?>

							<div class = "assignments-assignment-dates-item">
								<p>
									<?php
										echo $date[0];
									?>
								</p>
							</div>
				<?php } ?>
			</ul>

			<!-- File handling  (download & upload buttons) -->

			<ul class = "assignments-assignment-resources">
				<h2>Assignment Resource</h2>
				<?php foreach($assignmentFileNames as $file){?>

							<div class = "assignments-assignment-resources-item">
								<p>
									<?php
										echo "<a href='/learning-platform-moodle/uploads/" . $file[0] . "'/>Download file</a>";
									?>
								</p>
							</div>
				<?php } ?>
			</ul>

			<ul class ="assignments-assignment-file-upload">
				<h2>Upload File</h2>
			</ul>


		</div>
	</div>
	
	<div>
		<h1>Quizzes</h1>
		<div class = "quizzes">
			<ul class = "quizzes-list">
				<?php foreach($quizzes as $quiz){?>
					<div class = "quizzes-item">
								<a>
									<?php
										echo "$quiz"
									?>
								</a>
							</div>
				<?php } ?>
		</div>
	</div>
</div>

<?php
include ("../includes/footer.php");
?>

