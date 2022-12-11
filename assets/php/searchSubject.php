<?php
if(isset($_POST['input'])) {
    include 'connection.php';
    $input = $_POST['input'];
    $sql =
        "SELECT subject_id, subject_code, subject_name, units
    FROM tb_subjects
    WHERE subject_id LIKE '{$input}%'
    OR subject_code LIKE '{$input}%'
    OR subject_name LIKE '{$input}%'
    OR units LIKE '{$input}%'
    ORDER BY subject_id";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $primary_id = $row["subject_id"];
        $subject_code = $row["subject_code"];
        $subject_name = $row["subject_name"];
        $units = $row["units"];
        echo "
        <tr>
        <td data-label='ID'>$primary_id</td>
        <td data-label='Subject Code'>$subject_code</td>
        <td data-label='Subject'>$subject_name</td>
        <td data-label='Units'>$units</td>
        <td data-label='Operation'>
        <a href='#view-info' class='view' onclick='viewSubject($(this));'><i class='fas fa-eye'></i> <span>View</span></a>
        <a class='edit' onclick='editSubject($(this));'><i class='fas fa-edit'></i> <span>Edit</span></a>
        <a href='?delete_id=$primary_id' class='delete' onclick='javascript:confirmationDelete($(this));return false;'><i class='fas fa-trash'></i> <span>Delete</span></a>
        </td>
        </tr>
        ";
    }
    if (($count) == 0) {
        echo "
        <tr>
        <td colspan='5'>There are no records.</td>
        </tr>
        ";
    }
}
?>