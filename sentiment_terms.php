<?php
include './assets/php/functions.php';
preventBack();
$usertype = $_SESSION['usertype'];
?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Faculty Evaluation</title>
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
                    <h1><i class="fas fa-book"> Manage Sentiment Terms</i></h1>
                    <hr>
                    <div class="form">
                        <form action="sentiment_terms.php" method="post">
                            <div class="form-top">
                                <p class="form-title">Sentiment Terms</p>
                            </div>
                            <div class="form-middle">
                                <p class="label-question">Comment</p>
                                <textarea name="comment" class="question"></textarea>
                            </div>
                            <div class="form-bottom">
                                <?php addSentiment() ?>
                                <button type="submit" name="addsentiment" class="save">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="sentiment-container">
                        <table class="question-table">
                            <thead>
                                <tr>
                                    <th>Positive Words</th>
                                    <th>Operation</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php displayPositive() ?>
                            </tbody>
                        </table>

                        <table class="question-table">
                            <thead>
                                <tr>
                                    <th>Negative Words</th>
                                    <th>Operation</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php displayNegative() ?>
                            </tbody>
                        </table>

                        <table class="question-table">
                            <thead>
                                <tr>
                                    <th>Neutral Words</th>
                                    <th>Operation</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php displayNeutral() ?>
                            </tbody>
                        </table>
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