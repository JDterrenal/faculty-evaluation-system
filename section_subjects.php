<?php
include './assets/php/functions.php';
include './assets/php/validationAdmin.php';
preventBack();
enableDelete_secrel();
$section_id = $_GET["section_id"];
?>

<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Manage Subjects | Faculty Evaluation</title>
	<link rel="icon" type="image/png" href="/images/systems-plus-computer-college-logo.png">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
				<div class="page-container">
					<h1><i class="fas fa-book-open" id="view-info"> Manage Subjects</i></h1>
					<hr>
					<div class="user-info">
						<div class="user-content">
							<div class="user-info-title">
								<p class="user-title"><i class="fas fa-user"></i> Information!</p>
								<hr>
							</div>
						</div>
						<div class="user-nfo-content">
							<?php loadSectionsRelation($section_id) ?>
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
										<th>Subject Code</th>
										<th>Subject</th>
										<th>Faculty</th>
										<th>Faculty ID</th>
										<th>Operation</th>
									</tr>
								</thead>
								<tbody>
									<?php showSectionsRelation($section_id) ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</main>

		<!-------- footer ---------->
		<?php include './assets/php/footer.php' ?>
	</div>

	<!--================= popups ===================-->
	<!-------- popup logout ---------->
	<?php include './assets/php/popupLogout.php' ?>

	<!--------popup add subject ------------>
	<form method="post">
		<div class="popup-background" id="popup-background">
			<div class="popup-add">
				<div class="popup-add-top">
					<p class="popup-add-title"><i class="fas fa-plus"></i> ADD SUBJECT</p>
					<i class="fas fa-times ex" id="ex-add"></i>
				</div>
				<div class="popup-add-middle">
					<p class="P">Subject</p>
					<div class="userscon">
						<select name="subject_code" required>
							<?php cbSubject() ?>
						</select>
					</div>
					<p class="P">Faculty</p>
					<div class="userscon">
						<select name="faculty_id" required>
							<?php cbFaculty() ?>
						</select>
					</div>
					<?php addSecrel() ?>
					<button type="submit" name="addsecrel" class="addbtn"><i class="fas fa-plus"></i> Add Subject</button>
				</div>
			</div>
		</div>
	</form>

	<!--------popup edit subject ------------>
	<form method="post">
		<div class="popup-background-edit" id="edit-popup-background">
			<div class="popup-add">
				<div class="popup-add-top">
					<p class="popup-add-title"><i class="fas fa-edit"></i> EDIT SUBJECT</p>
					<i class="fas fa-times ex" id="ex-edit"></i>
				</div>
				<div class="popup-add-middle">
					<input type="hidden" name="edit_id" id="edit_id">
					<p class="P">Subject</p>
					<div class="userscon">
						<select id="edit_subject_code" name="edit_subject_code" required>
							<?php cbSubject() ?>
						</select>
					</div>
					<p class="P">Faculty</p>
					<div class="userscon">
						<select id="edit_faculty_id" name="edit_faculty_id" required>
							<?php cbFaculty() ?>
						</select>
					</div>
					<?php editSecrel() ?>
					<button type="submit" name="editsecrel" class="editbtn"><i class="fas fa-edit"></i> Edit Subject</button>
				</div>
			</div>
		</div>
	</form>

	<script src="./assets/js/script.js"></script>
	<script src="./assets/js/deleteConfirmation.js"></script>
</body>

</html>