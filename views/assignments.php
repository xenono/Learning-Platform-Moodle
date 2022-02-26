<?php
include ("../includes/header.php");

$core1_assignments = array(
	$se_assignment1 = array('Software Engineering', 'Portfolio 1', '12th November 2022'),
	$oosd_assignment1 = array('OOSD', 'Essay 1', '25th May 2023')
);

$core2_assignments = array(
	$webdev_assignment1 = array('Website Development', 'Portfolio 1', '12th November 2022'),
	$networks_assignment1 = array('Networks', 'Essay 1', '25th May 2023')
);

$core1_quizzes = array('SE Quiz 1','SE Quiz 2', 'OOSD Quiz 1','OOSD Quiz 2');

$core2_quizzes = array('Web Dev Quiz 1', 'Web Dev Quiz 2', 'Networks Quiz 1','Networks Quiz 2');

?>

<!-- Assignments -->

<div class = "assignments-grid">
	<div>
		<h1>Core 1</h1>
		<div class = "core1-assignments">
			<ul class = "core1-modules-list">
				<h2>Module</h2>
				<?php foreach($core1_assignments as $course){?>
					<li class="core1-module-item">
						<p>
						<?php
							echo "$course[0]";
						?>
						</p>
					</li>
				<?php } ?>
			</ul>

			<ul class = "core1-assignment-titles">
				<h2>Assignment Title</h2>
				<?php foreach($core1_assignments as $assignment){?>

							<div class = "core1-assignment-titles-item">
								<p>
									<?php
										echo "$assignment[1]"
									?>
								</p>
							</div>
				<?php } ?>
			</ul>

			<ul class = "core1-assignment-dates">
				<h2>Due date</h2>
				<?php foreach($core1_assignments as $date){?>

							<div class = "core1-assignment-dates-item">
								<p>
									<?php
										echo "$date[2]"
									?>
								</p>
							</div>
				<?php } ?>
			</ul>

		</div>
	</div>
	
	<div>
		<h1>Core 2</h1>
		<div class = "core2-assignments">
			<ul class = "core2-modules-list">
				<h2>Module</h2>
				<?php foreach($core2_assignments as $course){?>
					<li class="core1-module-item">
						<p>
						<?php
							echo "$course[0]";
						?>
						</p>
					</li>
				<?php } ?>
			</ul>

			<ul class = "core2-assignment-titles">
				<h2>Assignment Title</h2>
				<?php foreach($core2_assignments as $assignment){?>

							<div class = "core2-assignment-titles-item">
								<p>
									<?php
										echo "$assignment[1]"
									?>
								</p>
							</div>
				<?php } ?>
			</ul>

			<ul class = "core2-assignment-dates">
				<h2>Due date</h2>
				<?php foreach($core2_assignments as $date){?>

							<div class = "core2-assignment-dates-item">
								<p>
									<?php
										echo "$date[2]"
									?>
								</p>
							</div>
				<?php } ?>
			</ul>
		</div>
	</div>
</div>

<!-- Quizzes -->

<div class = "quizzes-elements-grid">
	<h1>Links to quizzes</h1>
	<div class = "quizzes-grid">
		<div class = "core1-quizzes">
			<ul class = "core1-quizzes-list">
				<h1>Core 1</h1>
				<?php foreach($core1_quizzes as $quiz){?>
					<div class = "core1-quizzes-item">
								<a>
									<?php
										echo "$quiz"
									?>
								</a>
							</div>
				<?php } ?>
			</ul>
		</div>

		<div class = "core2-quizzes">
			<ul class = "core2-quizzes-list">
				<h1>Core 2</h1>
				<?php foreach($core2_quizzes as $quiz){?>
					<div class = "core2-quizzes-item">
								<a>
									<?php
										echo "$quiz"
									?>
								</a>
							</div>
				<?php } ?>
			</ul>
		</div>
	</div>
</div>
<?php
include ("../includes/footer.php");
?>

