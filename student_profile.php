<?php
include './assets/php/functions.php';
preventBack();
$student_id = $_SESSION["login_id"];
?>

<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile | Faculty Evaluation</title>
  <link rel="icon" type="image/png" href="/images/systems-plus-computer-college-logo.png">
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
								<?php showStudentProfile($student_id) ?>
							</table>
						</div>
					</div>
				</div>
			</div>

			<div class="main-content">
				<div class="main-search-add">
					<div class="main-search-add-top">
						<p class="main-search-add-title"><i class="fas fa-search"></i> Subjects!</p>
						<hr>
					</div>
				</div>
				<div class="main-table-container">
					<table class="main-table">
						<thead>
							<tr>
								<th>ID</th>
								<th>Subject Code</th>
								<th>Subject</th>
								<th>Faculty</th>
							</tr>
						</thead>
						<tbody>
							<?php studentSubjects($student_id) ?>
						</tbody>
					</table>
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