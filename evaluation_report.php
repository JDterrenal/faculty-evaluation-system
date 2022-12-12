<?php
include './assets/php/functions.php';
include './assets/php/validationEvaluation.php';
include './assets/php/connection.php';
preventBack();
$evaluation_id = $_GET["evaluation_id"];
$sql_comment = "SELECT comment FROM tb_evaluations WHERE evaluation_id = $evaluation_id";
$result_comment = mysqli_query($conn, $sql_comment);
while ($row = mysqli_fetch_array($result_comment, MYSQLI_ASSOC)) {
    $comment = $row["comment"];
}
mysqli_close($conn);
getSentiment($comment, $evaluation_id);
?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluation Report | Faculty Evaluation</title>
    <link rel="icon" type="image/png" href="/images/systems-plus-computer-college-logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
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
                        <div class="question-stats-container">
                            <div class="question-container">
                                <p class="main-search-add-title"><i class="fas fa-search"></i> Questions!</p>
                                <table class="question-table">
                                    <thead>
                                        <tr>
                                            <th>Question</th>
                                            <th>Answer</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php showQuestions_ER($evaluation_id) ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="stats-container">
                                <p class="main-search-add-title"><i class="fas fa-search"></i> Status!</p>
                                <table class='sentiment-table'>
                                    <tbody>
                                        <?php showStatus($evaluation_id) ?>
                                    <tbody>
                                </table>
                                <canvas id="questionChart" width="100%" height="40rem"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="main-content">
                        <div class="main-search-add">
                            <div class="main-search-add-top">
                                <p class="main-search-add-title"> Sentiment Analysis!</p>
                                <hr>
                            </div>
                        </div>
                        <?php printSentiment($evaluation_id) ?>
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
        // Use ajax to retrieve the data from the PHP script
        const url = new URL(document.URL);
        const eval_id = url.searchParams.get("evaluation_id");
        $.ajax({
            url: './assets/php/questionData.php?evaluation_id=' + eval_id + '',
            dataType: 'json',
            success: function(response) {
                const chart = new Chart(document.getElementById('questionChart'), {
                    type: 'bar',
                    data: {
                        labels: response.data.labels,
                        datasets: [{
                            label: 'Answers',
                            data: response.data.answers
                        }]
                    }
                });
            }
        });
    </script>
    <script src="./assets/js/script.js"></script>
</body>

</html>