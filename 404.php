<?php
include './assets/php/functions.php';
preventBack();
?>

<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Faculty Evaluation</title>
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
				<a class="usernamee" ><img src="images/p.jpg" alt="" class="profile" id="popup-btn" onclick="LogOutFunction()"></a>
				<a class="username1" id="popup-btn" onclick="LogOutFunction()"><?php echo $_SESSION['username'] ?></a>
			</div>
		</div>
	</header>

	<!-------- sidebar ---------->

		<div class="sidebar-nav close">
			<nav>
				<div class="sidebar">
					<div class="sidebar-logo">
						<a href="#"><img src="images/p.jpg" alt="" class="logo"></a>
					</div>
					<div class="sidebar-name">
						<span class="sidebar-name1">System Plus </span>
						<span class="sidebar-name1">College Caloocan</span>
					</div>
				</div>
				<i class='fas fa-bars toggle'></i>
			</nav>
			<div class="menu-bar">
				<div class="menu">
						<nav>
							<p><a href="#" class="username"><img src="images/p.jpg" alt="" class="profile-side"><span><?php echo $_SESSION['username'] ?></span></a></p>
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
                <div class="container-404">
                    <i class="fas fa-sad-cry fa-10x"></i>
                    <h1>404</h1>
                    <h2>Page Not Found</h2>
                    <h3>Uh oh, the page you are trying to access does not exist.</h3>
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
			<img src="images/p.jpg" alt="" class="popup-profile">
			<p class="popup-name">Last, First, MI</p>
			<p class="popup-student-number">146583967</p>
		</div>
		<div class="popup-logout-middle">
			<a href="#" class="popup-middle1">qwe</a>
			<a href="#" class="popup-middle2">qwe</a>
			<a href="#" class="popup-middle3">qwe</a>
		</div>
		<div class="popup-logout-last">
			<a href="#" class="popup-profile-button">Profile</a>
			<a href="?logout=true" class="popup-profile-logout">Sign out</a>
		</div>
		
	</div>
	
	
	<script src="./assets/js/script.js"></script>
</body>
</html>

