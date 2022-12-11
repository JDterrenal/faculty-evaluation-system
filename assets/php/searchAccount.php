<?php
if(isset($_POST['input'])) {
    include 'connection.php';
    $input = $_POST['input'];
    $sql =
        "SELECT login_id, student_id, faculty_id, password, usertype
    FROM tb_login
    WHERE login_id LIKE '{$input}%'
    OR student_id LIKE '{$input}%'
    OR faculty_id LIKE '{$input}%'
    OR password LIKE '{$input}%'
    OR usertype LIKE '{$input}%'
    ORDER BY usertype";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $primary_id = $row["login_id"];
        $student_id = $row["student_id"];
        $faculty_id = $row["faculty_id"];
        $password = $row["password"];
        $usertype = $row["usertype"];
        if ($usertype == "Student") {
            $sql2 = "SELECT firstname, lastname FROM tb_students WHERE student_id = $student_id";
            $result2 = mysqli_query($conn, $sql2);
            while ($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
                $firstname = $row["firstname"];
                $lastname = $row["lastname"];
            }
            echo "
            <tr>
            <td data-label='Login ID'>$primary_id</td>
            <td data-label='User ID'>$student_id</td>
            <td data-label='Full Name'>$firstname $lastname</td>
            <td data-label='Password'>$password</td>
            <td data-label='User Type'>$usertype</td>
            <td data-label='Operation'>
            <a href='#view-info' class='view' onclick='viewAccount($(this));'><i class='fas fa-eye'></i> <span>View</span></a>
            <a class='edit' onclick='editAccount($(this));'><i class='fas fa-edit'></i> <span>Edit</span></a>
            </td>
            </tr>
            ";
        } else if ($usertype == "Faculty") {
            $sql2 = "SELECT firstname, lastname FROM tb_faculty WHERE faculty_id = $faculty_id";
            $result2 = mysqli_query($conn, $sql2);
            while ($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
                $firstname = $row["firstname"];
                $lastname = $row["lastname"];
            }
            echo "
            <tr>
            <td data-label='Login ID'>$primary_id</td>
            <td data-label='User ID'>$faculty_id</td>
            <td data-label='Full Name'>$firstname $lastname</td>
            <td data-label='Password'>$password</td>
            <td data-label='User Type'>$usertype</td>
            <td data-label='Operation'>
            <a href='#view-info' class='view' onclick='viewAccount($(this));'><i class='fas fa-eye'></i> <span>View</span></a>
            <a class='edit' onclick='editAccount($(this));'><i class='fas fa-edit'></i> <span>Edit</span></a>
            </td>
            </tr>
            ";
        }
    }
    if (($count) == 0) {
        echo "
        <tr>
        <td colspan='6'>There are no records.</td>
        </tr>
        ";
    }
}
?>