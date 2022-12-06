<?php
include './assets/php/functions.php';
preventBack();
enableDelete_courses();
?>

<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Question | Faculty Evaluation</title>
  <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
				<div class="page-container"><h1><i class="fas fa-book" id="view-info"> Evaluation</i></h1>
					<hr>
                    <div class="student-evaluation">
                        <div class="form">
                        <div class="form-top">
                                <p class="form-title">Faculty</p>
                            </div>
                                <div class="form-middle-faculty">
                                    <div class="left-side">
                                        <img src="./images/uploads/standard.png" alt="" class="evaluation-faculty-picture">
                                    </div>
                                    <div class="right-side">
                                        <p class="label-question">Faculty Name</p>
                                        <p>Uriel</p>
                                        <p class="label-question">Subject Code</p>
                                        <p>ITCP_01</p>
                                        <p class="label-question">Description</p>
                                        <p>Computer Programming</p>
                                    </div>
                                </div>
                            <div class="form-bottom">
                            </div>
                        </div>

                        <div class="evaluation-question">
                            <div class="evaluation-question-top">
                                <p class="label-question">Evaluation Questionnaire for Academic: 2021-2022 1st</p>
                                <a class='submit-eval'>Submit Evalutaion</a>
                            </div>
                            <hr>
                            <div class="evaluation-question-content">
                                <h1>Rating Legend</h1>
                                <div class="rating-legend-box">
                                    <div class="rating-legend-options">5-STRONGCLY AGREE</div>
                                    <div class="rating-legend-options">4-AGREE</div>
                                    <div class="rating-legend-options">3-UNCERTAIN</div>
                                    <div class="rating-legend-options">2-DISAGREE</div>
                                    <div class="rating-legend-options">1-STRONGLY DISAGREE</div>
                                </div>

                                <div class="question-container">
                                    <table class="question-table">
                                    <thead>
                                        <tr>
                                            <th>Question</th>
                                            <th>5</th>
                                            <th>4</th>
                                            <th>3</th>
                                            <th>2</th>
                                            <th>1</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Maliit ang tite ni uriel</td>
                                            <td data-label='Stongly Disagree'><input type="radio" name="likert" value="strong_disagree"></td>
                                            <td data-label='Disagree'><input type="radio" name="likert" value="disagree"></td>
                                            <td data-label='Uncertain'><input type="radio" name="likert" value="uncertain"></td>
                                            <td data-label='Agree'><input type="radio" name="likert" value="agree"></td>
                                            <td data-label='Strongly Agree'><input type="radio" name="likert" value="strong_agree"></td>
                                        <tr>
                                    </tbody>
                                    </table>
                                </div>
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
	<script src="./assets/js/deleteConfirmation.js"></script>
</body>
</html>