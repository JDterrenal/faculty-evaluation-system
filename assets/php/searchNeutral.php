<?php
if(isset($_POST['input'])) {
    include 'connection.php';
    $input = $_POST['input'];
    $sql =
        "SELECT term_id, term
    FROM tb_terms
    WHERE term_type = 'neutral'
    AND term LIKE '{$input}%'
    ORDER BY term";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $primary_id = $row["term_id"];
        $term = $row["term"];
        echo "
        <tr>
        <td>$primary_id</td>
        <td>$term</td>
        <td>
        <a href='/assets/php/toPositive.php?term_id=$primary_id' class='positive'><i class='fas fa-plus'></i><span> Positive</span></a>
        <a href='/assets/php/toNegative.php?term_id=$primary_id' class='negative'><i class='fas fa-minus'></i><span> Negative</span></a>
        </td>
        </tr>
        ";
    }
    if (($count) == 0) {
        echo "
        <tr>
        <td></td>
        <td colspan='2'>There are no records.</td>
        </tr>
        ";
    }
}
?>