<?php
include './assets/php/functions.php';
preventBack();
enableDelete_faculty();
?>

<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Faculty | Faculty Evaluation</title>
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
				<div class="page-container"><h1><i class="fas fa-chalkboard-teacher"> Faculty</i></h1>
					<hr>
					<div class="user-info">
						<div class="user-content">
							<div class="user-info-title">
									<p class="user-title"><i class="fas fa-user"></i> User Information!</p>
									<hr>
							</div>
						</div>
						<div class="user-nfo-content">
							<table class="user-table">
								<tbody>
									<tr>
										<th data-label="Name">Name</th>
										<td data-label="Name">Tite</td>
									</tr>
									<tr>
										<th data-label="usertyp">User Type</th>
										<td data-label="User Type">Tite</td>
									</tr>
									<tr>
										<th data-label="Course">Course</th>
										<td data-label="Course">Tite</td>
									</tr>
									<tr>
										<th data-label="Student ID">Student ID</th>
										<td data-label="Student ID">Tite</td>
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
							<a class="add-main" id="add-button">Add Faculty</a>
						</div>
						<div class="student-table-container">
							<table class="student-table">
								<thead>
									<tr>
										<th>ID</th>
										<th>FIRST NAME</th>
                                        <th>LAST NAME</th>
                                        <th>EMAIL</th>
                                        <th>GENDER</th>
                                        <th>CONTACT NUMBER</th>
                                        <th>ADDRESS</th>
                                        <th>PHOTO</th>
                                        <th>OPERATION</th>
									</tr>
								</thead>
								<tbody>
									<?php showFaculty() ?>
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

	<!--------popup add ------------>

	<form action=add_course.php method=post>
		<div class="popup-background" id="popup-background">
			<div class="popup-users">
				<div class="popup-add-top">
					<p class="popup-add-title"><i class="fas fa-plus"></i> ADD FACULTY</p>
					<i class="fas fa-times ex" id="ex-add"></i>
				</div>
              	<div class="popup-users-middle">
					<div class="boxx">
						<p class="P">Student Picture</p>
						<div class="userscon">
							<img src="./images/uploads/<?php echo $_SESSION['photo'] ?>" alt="" class="profile-side-pop">
						</div>
						<div class="userscon">
							<input type="file" id="photo" name="photo">
						</div>
					</div>
					<div class="boxx">
						<p class="P">Faculty Name</p>
						<div class="userscon">
							<input type="text" id="firstname" name="firstname" placeholder="First name" >
							<input type="text" id="lastname" name="lastname" placeholder="Last name">
						</div>
					</div>
					<div class="boxx">
						<p class="P">Address</p>
						<div class="userscon">
							<input type="text" id="address" name="address" placeholder="Address">
						</div>
					</div>
					<div class="boxx">
						<p class="P">Contact Number</p>
						<div class="userscon">
							<input type="number" id="contact_no" name="contact_no" placeholder="Contact Number">
						</div>
					</div>
					<div class="boxx">
						<p class="P">Gender</p>
						<div class="userscon1">
							<input type="radio" id="male" name="gender" value="Male"><label for="male">Male</label>
							<input type="radio" id="female" name="gender" value="Female"><label for="female">Female</label>
						</div>
					</div>
					<div class="boxx">
						<p class="P">Email</p>
						<div class="userscon">
							<input type="text" id="email" name="email" placeholder="Email">
						</div>
					</div>
					<div class="userscon">
					<a class="addbtn"><i class="fas fa-plus"></i> Add Faculty</a>
				</div>
				</div>
			</div>
		</div>
	</form>

	<!--------popup edit ------------>

	<form action=add_course.php method=post>
		<div class="popup-background-edit" id="edit-popup-background">
			<div class="popup-users">
				<div class="popup-add-top">
					<p class="popup-add-title"><i class="fas fa-edit"></i> EDIT FACULTY</p>
					<i class="fas fa-times ex" id="ex-edit"></i>
				</div>
				<div class="popup-users-middle">
					<div class="boxx">
						<p class="P">Faculty Name</p>
						<div class="userscon">
							<input type="text" id="firstname" name="firstname" placeholder="First name" >
							<input type="text" id="lastname" name="lastname" placeholder="Last name">
						</div>
					</div>
					<div class="boxx">
						<p class="P">Address</p>
						<div class="userscon">
							<input type="text" id="address" name="address" placeholder="Address">
						</div>
					</div>
					<div class="boxx">
						<p class="P">Contact Number</p>
						<div class="userscon">
							<input type="number" id="contact_no" name="contact_no" placeholder="Contact Number">
						</div>
					</div>
					<div class="boxx">
						<p class="P">Gender</p>
						<div class="userscon1">
							<input type="radio" id="male" name="gender" value="Male"><label for="male">Male</label>
							<input type="radio" id="female" name="gender" value="Female"><label for="female">Female</label>
						</div>
					</div>
					<div class="boxx">
						<p class="P">Email</p>
						<div class="userscon">
							<input type="text" id="email" name="email" placeholder="Email">
						</div>
					</div>
					<div class="userscon">
					<a class="addbtn"><i class="fas fa-edit"></i> Edit Faculty</a>
				</div>
				</div>
			</div>
		</div>
	</form>
	
	<script src="./assets/js/script.js"></script>
	<script src="./assets/js/deleteConfirmation.js"></script>
</body>
</html>