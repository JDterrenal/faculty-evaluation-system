<?php
include './assets/php/functions.php';
include './assets/php/validationAdmin.php';
preventBack();
$usertype = $_SESSION['usertype'];
?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sentiment Terms | Faculty Evaluation</title>
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
                    <h1><i class="fas fa-comment"> Manage Sentiment Terms</i></h1>
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
                    <div class="main-search1">
						<a><i class="fas fa-search"></i></a>
                        <input type="text" id="search_records" placeholder="Search" class="main-search">
                    </div>
                    <div class="sentiment-container">
                        <div class="container-table-words">
                            <table class="table-words">
                                <thead>
                                    <tr>
                                        <th>Positive Words</th>
                                        <th>Operation</th>
                                    </tr>
                                </thead>
                                <tbody id="positive_results">
                                </tbody>
                            </table>
                        </div>
                        <div class="container-table-words">
                            <table class="table-words">
                                <thead>
                                    <tr>
                                        <th>Negative Words</th>
                                        <th>Operation</th>
                                    </tr>
                                </thead>
                                <tbody id="negative_results">
                                </tbody>
                            </table>
                        </div>
                        <div class="container-table-words">
                            <table class="table-words">
                                <thead>
                                    <tr>
                                        <th>Neutral Words</th>
                                        <th>Operation</th>
                                    </tr>
                                </thead>
                                <tbody id="neutral_results">
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

    <script>
        // Loads the data and enables search functionality
        $(document).ready(function() {
            $("#search_records").keyup(function() {
                const input = $(this).val();
                $.ajax({
                    url: "./assets/php/searchPositive.php",
                    method: "POST",
                    data: {
                        input: input
                    },

                    success: function(data) {
                        $("#positive_results").html(data);
                    }
                });
                $.ajax({
                    url: "./assets/php/searchNegative.php",
                    method: "POST",
                    data: {
                        input: input
                    },

                    success: function(data) {
                        $("#negative_results").html(data);
                    }
                });
                $.ajax({
                    url: "./assets/php/searchNeutral.php",
                    method: "POST",
                    data: {
                        input: input
                    },

                    success: function(data) {
                        $("#neutral_results").html(data);
                    }
                });
            });
            const input = $(this).val();
            $.ajax({
                url: "./assets/php/searchPositive.php",
                method: "POST",
                data: {
                    input: input
                },

                success: function(data) {
                    $("#positive_results").html(data);
                }
            });
            $.ajax({
                url: "./assets/php/searchNegative.php",
                method: "POST",
                data: {
                    input: input
                },

                success: function(data) {
                    $("#negative_results").html(data);
                }
            });
            $.ajax({
                url: "./assets/php/searchNeutral.php",
                method: "POST",
                data: {
                    input: input
                },

                success: function(data) {
                    $("#neutral_results").html(data);
                }
            });
        });
    </script>
    <script src="./assets/js/script.js"></script>
</body>

</html>