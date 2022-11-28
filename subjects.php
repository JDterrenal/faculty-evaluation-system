<?php
include './assets/php/functions.php';
preventBack();
enableDelete_subjects();
?>

<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Subjects | Faculty Evaluation</title>
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
						<a href="#"><img src="./images/systems-plus-computer-college-logo.png" alt="" class="logo"></a>
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
				<div class="page-container"><h1><i class="fas fa-book-open" id="view-info"> Subjects</i></h1>
					<hr>
					<div class="user-info">
						<div class="user-content">
							<div class="user-info-title">
									<p class="user-title"><i class="fas fa-user"></i>Information!</p>
									<hr>
							</div>
						</div>
						<div class="user-nfo-content">
						<table class="user-table">
								<tbody>
									<tr>
										<th>ID</th>
										<td data-label="ID Info"></td>
									</tr>
									<tr>
										<th>Subject</th>
										<td data-label="Subject Info"></td>
									</tr>
								<tbody>
							</table>
						</div>
					</div>
					
					<div class="main-content">
						<div class="main-search-add">
							<div class="main-search-add-top">
								<p class="main-search-add-title"><i class="fas fa-search"></i> Search and add here!</p>
								<hr>
							</div>
						</div>
						<div class="main-search1">
							<a><i class="fas fa-search"></i></a>
							<input type="text" placeholder="Search" class="main-search">
						</div>
						<div class="main-add">
							<a class="add-main" id="add-button">Add Subject</a>
						</div>
						<div class="main-table-container">
							<table class="main-table">
								<thead>
									<tr>
										<th>ID</th>
										<th>Subject</th>
										<th>Operation</th>
									</tr>
								</thead>
								<tbody>
									<?php showSubjects() ?>
								</tbody>
							</table>
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

	<!--------popup add subject ------------>

	<form action=subjects.php method=post>
		<div class="popup-backgroundsubject" id="popup-background">
			<div class="popup-add">
				<div class="popup-add-top">
					<p class="popup-add-title"><i class="fas fa-plus"></i> ADD SUBJECT</p>
					<i class="fas fa-times ex" id="ex-add"></i>
				</div>
				<div class="popup-add-middle">
					<p class="label1">Subject Name</p>
					<input type="text" name="subject_name" placeholder="Subject Name" class="course-name-tbx" required>
					<?php addSubject() ?>
					<button type="submit" name="addsubject" class="addbtn"><i class="fas fa-plus"></i> Add Subject</button>
				</div>
			</div>
		</div>
	</form>

	<!--------popup edit subject ------------>

	<form action=subjects.php method=post>
		<div class="popup-background-edit" id="edit-popup-background">
			<div class="popup-add">
				<div class="popup-add-top">
					<p class="popup-add-title"><i class="fas fa-edit"></i> EDIT SUBJECT</p>
					<i class="fas fa-times ex" id="ex-edit"></i>
				</div>
				<div class="popup-add-middle">
					<input type="hidden" name="edit_id" id="edit_id">
					<p class="label1">Subject Name</p>
					<input type="text" name="edit_subject_name" id="edit_subject_name" placeholder="Subject Name" class="editcourse-name-tbx" required>
					<?php editSubject() ?>
					<button type="submit" name="editsubject" class="editbtn"><i class="fas fa-edit"></i> Edit Subject</button>
				</div>
			</div>
		</div>
	</form>
	
	<script src="./assets/js/script.js"></script>
	<script src="./assets/js/deleteConfirmation.js"></script>
</body>
</html>