<?php
include './assets/php/functions.php';
preventBack();
?>

<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Subjects | Faculty Evaluation</title>
  <link rel="icon" href="images/logo.png" type="image/x-icon" />
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
	<div class= "main-container">
		<main>
			<div class="container-main">
				<div class="page-container"><h1><i class="fas fa-book-open" id="view-info"> Student Subjects</i></h1>
					<hr>
					
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
							<a class="add-main" id="add-button">Add Student Subject</a>
						</div>
						<div class="main-table-container">
							<table class="main-table">
								<thead>
									<tr>
										<th>Subject Code</th>
										<th>Subject</th>
										<th>Faculty</th>
										<th>Operation</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td data-label='Subject Code'>$subject_code</td>
										<td data-label='Subject'>$subject_name</td>
										<td data-label='Faculty'>$faculty_full</td>
										<td data-label='Operation'>
										<a class='edit edit-subject'><i class='fas fa-edit'></i> Edit</a>
										<a href='?delete_id=$primary_id' class='delete' onclick='javascript:confirmationDelete($(this));return false;'><i class='fas fa-trash'></i> Delete</a>
										</td>
									</tr>
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
	<form action=subjects.php method=post>
		<div class="popup-background" id="popup-background">
			<div class="popup-add">
				<div class="popup-add-top">
					<p class="popup-add-title"><i class="fas fa-plus"></i> ADD STUDENT SUBJECT</p>
					<i class="fas fa-times ex" id="ex-add"></i>
				</div>
				<div class="popup-add-middle">
						<p class="label1">Subject Code</p>
						<input type="text" name="subject_code" placeholder="Subject Code" class="popup-tbx" required>
						<p class="label1">Subject Name</p>
						<input type="text" name="subject_name" placeholder="Subject Name" class="popup-tbx" required>
						<p class="label1">Faculty</p>
						<input type="number" name="faculty" placeholder="Faculty" class="popup-tbx" required>
					<?php addSubject() ?>
					<button type="submit" name="addsubject" class="addbtn"><i class="fas fa-plus"></i> Add Student Subject</button>
				</div>
			</div>
		</div>
	</form>

	<!--------popup edit subject ------------>
	<form action=subjects.php method=post>
		<div class="popup-background-edit" id="edit-popup-background">
			<div class="popup-add">
				<div class="popup-add-top">
					<p class="popup-add-title"><i class="fas fa-edit"></i> EDIT STUDENT SUBJECT</p>
					<i class="fas fa-times ex" id="ex-edit"></i>
				</div>
				<div class="popup-add-middle">
					<input type="hidden" name="edit_id" id="edit_id">
						<p class="label1">Subject Code</p>
						<input type="text" name="edit_subject_code" id="edit_subject_code" placeholder="Subject Name" class="popup-tbx" required>
						
						<p class="label1">Subject Name</p>
						<input type="text" name="edit_subject_name" id="edit_subject_name" placeholder="Subject Name" class="popup-tbx" required>
						
						<p class="label1">Faculty</p>
						<input type="number" name="edit_faculty" id="edit_faculty" placeholder="Student" class="popup-tbx" required>
					<?php editSubject() ?>
					<button type="submit" name="editsubject" class="editbtn"><i class="fas fa-edit"></i> Edit Student Subject</button>
				</div>
			</div>
		</div>
	</form>
	
	<script src="./assets/js/script.js"></script>
	<script src="./assets/js/deleteConfirmation.js"></script>
</body>
</html>