<?php
include './assets/php/functions.php';
preventBack();
$usertype = $_SESSION['usertype'];
?>

<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dashboard | Faculty Evaluation</title>
	<link rel="icon" type="image/png" href="/images/systems-plus-computer-college-logo.png">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="icon" href="images/logo.png" type="image/x-icon" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
	<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
	<link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
	<!------ navigation and side bar ------->
	<?php include './assets/php/navigation.php' ?>

	<!-------- main content ---------->
	<div class="main-container">
		<main>
			<div class="container-main">
				<div class="dashboard-container">
					<h1><i class="fas fa-desktop i"> Dashboard</i></h1>
					<hr>
					<div class="columns">
						<div class="col1">
							<p>Welcome <?php echo $_SESSION['username'] ?>!</p>
							<?php showActiveEvaluation($usertype) ?>
						</div>
					</div>
					<div class="columns">
						<div class="col2">
							<div class="stat-cont">
								<div class="col-left">
									<h1><?php echo accountsCount() ?></h1>
									<p class="stat">Total Users</p>
								</div>
								<div class="col-right"><i class="fas fa-users"></i></div>
							</div>
						</div>
						<div class="col3">
							<div class="stat-cont">
								<div class="col-left">
									<h1><?php echo courseCount() ?></h1>
									<p class="stat">Total Course</p>
								</div>
								<div class="col-right"><i class="fas fa-book"></i></div>
							</div>
						</div>
					</div>
					<div class="columns">
						<div class="col2">
							<div class="stat-cont">
								<div class="col-left">
									<h1><?php echo subjectCount() ?></h1>
									<p class="stat">Total Subjects</p>
								</div>
								<div class="col-right"><i class="fas fa-book-open"></i></div>
							</div>
						</div>
						<div class="col3">
							<div class="stat-cont">
								<div class="col-left">
									<h1><?php echo sectionCount() ?></h1>
									<p class="stat">Total Sections</p>
								</div>
								<div class="col-right"><i class="fas fa-table"></i></div>
							</div>
						</div>
					</div>
					<div class="columns">
						<div class="col2">
							<div class="stat-cont">
								<div class="col-left">
									<h1><?php echo studentCount() ?></h1>
									<p class="stat">Total Students</p>
								</div>
								<div class="col-right"><i class="fas fa-user"></i></div>
							</div>
						</div>
						<div class="col3">
							<div class="stat-cont">
								<div class="col-left">
									<h1><?php echo facultyCount() ?></h1>
									<p class="stat">Total Faculty</p>
								</div>
								<div class="col-right"><i class="fas fa-chalkboard-teacher"></i></div>
							</div>
						</div>
					</div>
					<?php adminDashboard() ?>
				</div>
			</div>
		</main>

		<!-------- footer ---------->
		<?php include './assets/php/footer.php' ?>
	</div>

	<!--================= popups ===================-->
	<!-------- popup logout ---------->
	<?php include './assets/php/popupLogout.php' ?>

	<script src="./assets/js/script.js"></script>
</body>

</html>