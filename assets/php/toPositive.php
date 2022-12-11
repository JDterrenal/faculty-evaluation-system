<?php
include 'connection.php';
$term_id = $_GET["term_id"];
$sql = "UPDATE tb_terms SET value=1, term_type='positive' WHERE term_id='$term_id'";
if (mysqli_query($conn, $sql)) {
    header('location: /sentiment_terms.php');
} else {
    ?><script src="/assets/js/errorAlert.js"></script><?php
}
?>