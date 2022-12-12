<?php
include './assets/php/functions.php';
preventBack();
$usertype = $_SESSION['usertype'];
?>

<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>About | Faculty Evaluation</title>
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
				<div class="page-container">
					<h1><i class="fab fa-adn i"> About</i></h1>
					<hr>
					<div class="about-container">
                        <div class="about-panel">
							<div class="credit1">
                                <p class="credit-name">Erick Uriel Bartolome</p>
                                <p class="credit-role">Assistant Developer</p>
                            </div>
                            <div class="credit1">
                                <p class="credit-name">Clifford Randall Chan</p>
                                <p class="credit-role">Assistant Personel</p>
                            </div>
                            <div class="credit1">
                                <p class="credit-name">Alexander Macenas</p>
                                <p class="credit-role">Database Architect</p>
                            </div>
                            <div class="credit1">
                                <p class="credit-name">Jan Reynald Pangilinan</p>
                                <p class="credit-role">Back-end Developer</p>
                            </div>
                            <div class="credit1">
                                <p class="credit-name">John Derick Terrenal</p>
                                <p class="credit-role">Front-end Developer</p>
                            </div>
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