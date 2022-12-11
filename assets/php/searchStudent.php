<?php
if(isset($_POST['input'])) {
    include 'connection.php';
    $input = $_POST['input'];
    $sql =
        "SELECT student_id, firstname, lastname, email, gender, yearlevel, contact_no, address, status, photo, course_id, section_id
    FROM tb_students
    WHERE student_id LIKE '{$input}%'
    OR firstname LIKE '{$input}%'
    OR lastname LIKE '{$input}%'
    OR email LIKE '{$input}%'
    OR gender LIKE '{$input}%'
    OR yearlevel LIKE '{$input}%'
    OR contact_no LIKE '{$input}%'
    OR address LIKE '{$input}%'
    OR status LIKE '{$input}%'
    OR course_id LIKE '{$input}%'
    OR section_id LIKE '{$input}%'
    ORDER BY student_id";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $primary_id = $row["student_id"];
        $firstname = $row["firstname"];
        $lastname = $row["lastname"];
        $email = $row["email"];
        $gender = $row["gender"];
        $yearlevel = $row["yearlevel"];
        $contact_no = $row["contact_no"];
        $address = $row["address"];
        $status = $row["status"];
        $photo = $row["photo"];
        $course_id = $row["course_id"];
        $section_id = $row["section_id"];
        echo "
        <tr>
        <td data-label='ID'>$primary_id</td>
        <td data-label='FIRST NAME'>$firstname</td>
        <td data-label='LAST NAME'>$lastname</td>
        <td data-label='EMAIL'>$email</td>
        <td data-label='GENDER'>$gender</td>
        <td data-label='YEAR LEVEL'>$yearlevel</td>
        <td data-label='CONTACT NO.'>$contact_no</td>
        <td data-label='ADDRESS'>$address</td>
        <td data-label='STATUS'>$status</td>
        <td data-label='PHOTO'><img src='/images/uploads/$photo' alt='' width=50px height=50px><span style='display: none;'>$photo</span></td>
        <td data-label='COURSE ID'>$course_id</td>
        <td data-label='SECTION ID'>$section_id</td>
        <td data-label='Operation'>
        <a href='#view-info' class='view' onclick='viewStudent($(this));'><i class='fas fa-eye'></i> <span>View</span></a>
        <a class='edit' onclick='editStudent($(this));'><i class='fas fa-edit'></i> <span>Edit</span></a>
        <a href='?delete_id=$primary_id' class='delete' onclick='javascript:confirmationDelete($(this));return false;'><i class='fas fa-trash'></i> <span>Delete</span></a>
        </td>
        </tr>
        ";
    }
    if (($count) == 0) {
        echo "
        <tr>
        <td colspan='13'>There are no records.</td>
        </tr>
        ";
    }
}
?>