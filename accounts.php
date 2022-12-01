<?php
include './assets/php/functions.php';
preventBack();
?>

<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Accounts | Faculty Evaluation</title>
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
	<div class="main-container">
		<main>
			<div class="container-main">
				<div class="page-container">
					<h1><i class="fas fa-book-open"> Accounts</i></h1>
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
								<p class="main-search-add-title"><i class="fas fa-search"></i> Search here!</p>
								<hr>
							</div>
						</div>
						<div class="main-search1">
							<a><i class="fas fa-search"></i></a>
							<input type="text" placeholder="Search" class="main-search">
						</div>
						<div class="main-table-container">
							<table class="main-table">
								<thead>
									<tr>
										<th>ID</th>
										<th>Student ID</th>
										<th>Faculty ID</th>
										<th>Password</th>
										<th>Usertype</th>
										<th colspan="3">Operation</th>
									</tr>
								</thead>
								<tbody>
									<?php showAccounts() ?>
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

	<!--------popup edit account ------------>
	<form action=accounts.php method=post>
		<div class="popup-background-edit" id="edit-popup-background">
			<div class="popup-add">
				<div class="popup-add-top">
					<p class="popup-add-title"><i class="fas fa-edit"></i> EDIT ACCOUNTS</p>
					<i class="fas fa-times ex" id="ex-edit"></i>
				</div>
				<div class="popup-add-middle">
					<p class="label1">Password</p>
					<input type="password" placeholder="Password" class="popup-tbx">
					<a class="editbtn"><i class="fas fa-edit"></i> Confirm Password</a>
				</div>
			</div>
		</div>
	</form>
	
	<script src="./assets/js/script.js"></script>
</body>

</html>