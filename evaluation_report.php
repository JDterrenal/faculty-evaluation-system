<?php
include './assets/php/functions.php';
preventBack();
$evaluation_id = $_GET["evaluation_id"];
?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluation Report | Faculty Evaluation</title>
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
                    <h1><i class="fas fa-table" id="view-info"> Evaluation Report</i></h1>
                    <hr>
                    <div class="main-content">
                        <div class="main-search-add">
                            <div class="main-search-add-top">
                                <p class="main-search-add-title"><i class="fas fa-search"></i> Questions!</p>
                                <hr>
                            </div>
                        </div>
                        <div class="question-container">
                            <table class="question-table">
                                <thead>
                                    <tr>
                                        <th>Question</th>
                                        <th>Answer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php showQuestions_ER($evaluation_id); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="main-content">
                        <div class="main-search-add">
                            <div class="main-search-add-top">
                                <p class="main-search-add-title"><i class="fas fa-search"></i> Sentiment Analysis!</p>
                                <hr>
                            </div>
                        </div>
                        <div class="question-container">
                            
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