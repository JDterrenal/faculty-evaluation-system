<?php
if(isset($_POST['input'])) {
    include 'connection.php';
    $input = $_POST['input'];
    $sql =
        "SELECT course_id, course_name
    FROM tb_courses
    WHERE course_id LIKE '{$input}%'
    OR course_name LIKE '{$input}%'
    ORDER BY course_id";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $primary_id = $row["course_id"];
        $course_name = $row["course_name"];
        $sql2 = "SELECT student_id FROM tb_students WHERE course_id = $primary_id";
        $result2 = mysqli_query($conn, $sql2);
        $students = mysqli_num_rows($result2);
        echo "
        <tr>
        <td data-label='ID'>$primary_id</td>
        <td data-label='Course'>$course_name</td>
        <td data-label='Students'>$students</td>
        <td data-label='Operation'>
        <a href='#view-info' class='view' onclick='viewCourse($(this));'><i class='fas fa-eye'></i> <span>View</span></a>
        <a class='edit' onclick='editCourse($(this));'><i class='fas fa-edit'></i> <span>Edit</span></a>
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