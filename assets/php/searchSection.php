<?php
if(isset($_POST['input'])) {
    include 'connection.php';
    $input = $_POST['input'];
    $sql =
        "SELECT section_id, section_name
    FROM tb_sections
    WHERE section_id LIKE '{$input}%'
    OR section_name LIKE '{$input}%'
    ORDER BY section_id";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $primary_id = $row["section_id"];
        $section_name = $row["section_name"];
        $sql2 = "SELECT student_id FROM tb_students WHERE section_id = $primary_id";
        $result2 = mysqli_query($conn, $sql2);
        $students = mysqli_num_rows($result2);
        echo "
        <tr>
        <td data-label='ID'>$primary_id</td>
        <td data-label='Section'>$section_name</td>
        <td data-label='Students'>$students</td>
        <td data-label='Operation'>
        <a href='#view-info' class='view' onclick='viewSection($(this));'><i class='fas fa-eye'></i> <span>View</span></a>
        <a class='edit' onclick='editSection($(this));'><i class='fas fa-edit'></i> <span>Edit</span></a>
        <a href='?delete_id=$primary_id' class='delete' onclick='javascript:confirmationDelete($(this));return false;'><i class='fas fa-trash'></i> <span>Delete</span></a>
        </td>
        </tr>
        ";
    }
    if (($count) == 0) {
        echo "
        <tr>
        <td colspan='4'>There are no records.</td>
        </tr>
        ";
    }
}
?>