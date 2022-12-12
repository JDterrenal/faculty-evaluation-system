<?php
include "connection.php";
$evaluation_id = $_GET["evaluation_id"];
$sql = "SELECT answer FROM tb_feedback WHERE evaluation_id = $evaluation_id ORDER BY question_id";
$result = mysqli_query($conn, $sql);
$choice1 = 0;
$choice2 = 0;
$choice3 = 0;
$choice4 = 0;
$choice5 = 0;
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $primary_id = $row["question_id"];
    $question = $row["question"];
    $answer = $row["answer"];
    if ($answer == 1) {
        $choice1++;
    } else if ($answer == 2) {
        $choice2++;
    } else if ($answer == 3) {
        $choice3++;
    } else if ($answer == 4) {
        $choice4++;
    } else if ($answer == 5) {
        $choice5++;
    }
}

$json_data = [
    "result" => "true",
    "message" => "null",
    "data" => [
        "labels" => [
            "Strongly Disagree",
            "Disagree",
            "Uncertain",
            "Agree",
            "Strongly Agree",
        ],
        "answers" => [
            "$choice1",
            "$choice2",
            "$choice3",
            "$choice4",
            "$choice5"
        ]
    ]
];

$json_report = json_encode($json_data);
echo $json_report;

mysqli_close($conn);
?>