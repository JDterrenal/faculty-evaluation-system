<?php
include './assets/php/functions.php';
preventBack();
?>

<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard | Faculty Evaluation</title>
  <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="icon" href="images/logo.png" type="image/x-icon" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>

	<!-------- navbar top ---------->

	<header>
		<div class="container-nav">
			<div class="left">
				<i class='fas fa-bars toggleHeader'></i>
			</div>
			<div class="right">
				<a class="usernamee" ><img src="./images/uploads/<?php echo $_SESSION['photo'] ?>" alt="" class="profile" id="popup-btn" onclick="LogOutFunction()"></a>
				<a class="username1" id="popup-btn" onclick="LogOutFunction()"><?php echo $_SESSION['username'] ?></a>
			</div>
		</div>
	</header>

	<!-------- sidebar ---------->

		<div class="sidebar-nav close">
			<nav>
				<div class="sidebar">
					<div class="sidebar-logo">
						<a href="./dashboard.php"><img src="./images/systems-plus-computer-college-logo.png" alt="" class="logo"></a>
					</div>
					<div class="sidebar-name">
						<span class="sidebar-name1">Systems Plus</span>
						<span class="sidebar-name1">College Caloocan</span>
					</div>
				</div>
				<i class='fas fa-bars toggle'></i>
			</nav>
			<div class="menu-bar">
				<div class="menu">
						<nav>
							<p><a href="./assets/php/directProfile.php" class="username"><img src="./images/uploads/<?php echo $_SESSION['photo'] ?>" alt="" class="profile-side"><span><?php echo $_SESSION['username'] ?></span></a></p>
							<ul>
								<?php sidebarIdentify() ?>
							</ul>
						</nav>
				</div>
			</div>
		</div>

	<!-------- main content ---------->
	
	<div class= "main-container">
		<main>
			<div class="container-main">
				<div class="dashboard-container"><h1><i class="fas fa-desktop i"> Dashboard</i></h1>
					<hr>
					<div class="columns">
						<div class="col1">
							<p>Welcome <?php echo $_SESSION['username'] ?>!</p>
							<div class="anouncement">
								<p class="acad-year">Academic Year: 2021-2022</p>
								<p class="eval-status">Evaluation Status: On-going</p>
							</div>
						</div>
					</div>
					<div class="columns">
						<div class="col2">
							<div class="stat-cont">
								<div class="col-left">
									<h1><?php echo accountsCount() ?></h1>
									<p class="stat">Total Users</p>
								</div>
								<div class="col-right"><i class="fas fa-user"></i></div>
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
					<div class="columns">
						<div class="col2">
							<div class="stat-cont">
							<div class="col-left">
								<h1><?php echo accountsCount() ?></h1>
								<p class="stat">Total Accounts</p>
							</div>
							<div class="col-right"><i class="fas fa-users"></i></div>
						</div>
						</div>
						<div class="col3">
							<div class="stat-cont">
								<div class="col-left">
									<h1><?php echo evaluationCount() ?></h1>
									<p class="stat">Total Evaluations</p>
								</div>
								<div class="col-right"><i class="fas fa-calendar-check"></i></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>

	<!-------- footer ---------->

		<footer>
			<div class="container-footer">
				<p class="footer-text"><span>Copyright © 2022 System Plus College Caloocan</span> All rights reserved.</p>
				<p class="footer-text2"><span>Version</span> 1.0</p>
			</div>
		</footer>
	</div>
	
	<!--================= popups ===================-->

	<!-------- popup logout ---------->
	
	<div class="popup-logout pop" id="popup">
		<div class="popup-logout-first">
			<img src="./images/uploads/<?php echo $_SESSION['photo'] ?>" alt="" class="popup-profile">
			<p class="popup-name"><?php echo $_SESSION['username'] ?></p>
			<p class="popup-student-number"><?php echo $_SESSION['login_id'] ?></p>
		</div>
		<div class="popup-logout-middle">
			<a href="#" class="popup-middle1">qwe</a>
			<a href="#" class="popup-middle2">qwe</a>
			<a href="#" class="popup-middle3">qwe</a>
		</div>
		<div class="popup-logout-last">
			<a href="./assets/php/directProfile.php" class="popup-profile-button">Profile</a>
			<a href="?logout=true" class="popup-profile-logout">Sign out</a>
		</div>
	</div>
	
	
	<script src="./assets/js/script.js"></script>
</body>
</html>

