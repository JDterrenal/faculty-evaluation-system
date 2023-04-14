<?php
include './assets/php/functions.php';
include './assets/php/validationAdmin.php';
preventBack();
enableDelete_evaluations();
$usertype = $_SESSION['usertype'];
?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluation Status | Faculty Evaluation</title>
    <link rel="icon" type="image/png" href="/images/systems-plus-computer-college-logo.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
                    <h1><i class="fas fa-calendar-check"> Evaluation Status</i></h1>
                    <hr>
                    <div class="edit-question">
                        <div class="form">
                            <form action="evaluation_status.php" method="post">
                                <div class="form-top">
                                    <p class="form-title">Edit Evaluation Status</p>
                                </div>
                                <div class="form-middle">
                                    <p class="P">Start of School Year</p>
                                    <input type="number" id="yearstart" name="yearstart" placeholder="Year Start" required>
                                    <p class="P">Semester</p>
                                    <select id="semester" name="semester" required>
                                        <option value="1st">1st Semester</option>
                                        <option value="2nd">2nd Semester</option>
                                    </select>
                                    <p class="P">Status</p>
                                    <select id="status" name="status" required>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Finished">Not Started/Finished</option>
                                    </select>
                                </div>
                                <div class="form-bottom">
                                    <?php editEvaluation() ?>
                                    <button type="submit" name="editevaluation" class="save">Save</button>
                                    <a href="./edit_questions.php" class="cancel">Manage Questions</a>
                                </div>
                            </form>
                        </div>
                        <div class="box-container">
                            <div class="form-top">
                                <p class="form-title">Status Preview</p>
                            </div>
                            <div class="form-middle">
                                <?php showActiveEvaluation($usertype) ?>
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