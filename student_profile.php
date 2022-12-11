<?php
include './assets/php/functions.php';
preventBack();
?>

<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile | Faculty Evaluation</title>
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
	<div class= "main-container">
		<main>
			<div class="container-main">
				<div class="page-container"><h1><i class="fas fa-table"> Students Profile</i></h1>
					<hr>
					<div class="user-info">
						<div class="user-content">
							<div class="user-info-title">
									<p class="user-title"><i class="fas fa-user"></i> Student Information!</p>
									<hr>
							</div>
						</div>
						<div class="user-nfo-content">
							<table class="user-table">
								<tbody>
									<tr>
                                        <td rowspan="4" scope="row" style="text-align: center; padding-left: 5px;"><img src="./images/uploads/<?php echo $_SESSION['photo'] ?>" class="student-picture"></td>
										<th>Name</th>
										<td data-label="First Name">John Derick ramos Terrenal</td>
									</tr>
									<tr>
										<th>Last Name</th>
										<td data-label="Last Name">john Derick ramos Terrenal</td>
									</tr>
									<tr>
										<th>Gender</th>
										<td data-label="Gender">MMMALE</td>
									</tr>
									<tr>
										<th>Student No.</th>
										<td data-label="Student No.">20201125646</td>
									</tr>
								<tbody>
							</table>
						</div>
					</div>

                    <div class="user-info">
						<div class="user-content">
							<div class="user-info-title">
									<p class="user-title"><i class="fas fa-user"></i> Accademic Information!</p>
									<hr>
							</div>
						</div>
						<div class="user-nfo-content">
							<table class="user-table">
								<tbody>
									<tr>
										<th>Status</th>
										<td data-label="Status">Tite</td>
									</tr>
									<tr>
										<th>Year Level</th>
										<td data-label="Year Level">Tite</td>
									</tr>
									<tr>
										<th>Course</th>
										<td data-label="Course">Tite</td>
									</tr>
									<tr>
										<th>Section</th>
										<td data-label="Section">Tite</td>
									</tr>
								<tbody>
							</table>
						</div>
					</div>

                    <div class="user-info">
						<div class="user-content">
							<div class="user-info-title">
									<p class="user-title"><i class="fas fa-user"></i> Contact Information!</p>
									<hr>
							</div>
						</div>
						<div class="user-nfo-content">
							<table class="user-table">
								<tbody>
									<tr>
										<th>Email</th>
										<td data-label="Email">Tite</td>
									</tr>
									<tr>
										<th>Contact No.</th>
										<td data-label="Contact No.">Tite</td>
									</tr>
									<tr>
										<th>Address</th>
										<td data-label="Address">Tite</td>
									</tr>
								<tbody>
							</table>
						</div>
					</div>

                    <div class="user-info">
						<div class="user-content">
							<div class="user-info-title">
									<p class="user-title"><i class="fas fa-user"></i> Contact Information!</p>
									<hr>
							</div>
						</div>
						<div class="user-nfo-content">
							<table class="user-table">
								<tbody>
									<tr>
										<th>Email</th>
										<td data-label="Email">Tite</td>
									</tr>
									<tr>
										<th>Contact No.</th>
										<td data-label="Contact No.">Tite</td>
									</tr>
									<tr>
										<th>Address</th>
										<td data-label="Address">Tite</td>
									</tr>
								<tbody>
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

	<script src="./assets/js/script.js"></script>
</body>
</html>