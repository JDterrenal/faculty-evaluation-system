<?php
include './assets/php/functions.php';
preventBack();
?>

<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Faculty Evaluation</title>
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
				<div class="container-404">
					<i class="fas fa-sad-cry fa-10x"></i>
					<h1>404</h1>
					<h2>Page Not Found</h2>
					<h3>The page you are trying to access does not exist.</h3>
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