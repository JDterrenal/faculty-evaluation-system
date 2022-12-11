<?php
if(isset($_POST['input'])) {
    include 'connection.php';
    $input = $_POST['input'];
    $sql =
        "SELECT faculty_id, firstname, lastname, email, gender, contact_no, address, photo
    FROM tb_faculty
    WHERE faculty_id LIKE '{$input}%'
    OR firstname LIKE '{$input}%'
    OR lastname LIKE '{$input}%'
    OR email LIKE '{$input}%'
    OR gender LIKE '{$input}%'
    OR contact_no LIKE '{$input}%'
    OR address LIKE '{$input}%'
    ORDER BY faculty_id";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $primary_id = $row["faculty_id"];
        $firstname = $row["firstname"];
        $lastname = $row["lastname"];
        $email = $row["email"];
        $gender = $row["gender"];
        $contact_no = $row["contact_no"];
        $address = $row["address"];
        $photo = $row["photo"];
        echo "
        <tr>
        <td data-label='ID'>$primary_id</td>
        <td data-label='FIRST NAME'>$firstname</td>
        <td data-label='LAST NAME'>$lastname</td>
        <td data-label='EMAIL'>$email</td>
        <td data-label='GENDER'>$gender</td>
        <td data-label='CONTACT NO.'>$contact_no</td>
        <td data-label='ADDRESS'>$address</td>
        <td data-label='PHOTO'><img src='/images/uploads/$photo' width=50px height=50px><span style='display: none;'>$photo</span></td>
        <td data-label='Operation'>
        <a href='#view-info' class='view' onclick='viewFaculty($(this));'><i class='fas fa-eye'></i> <span>View</span></a>
        <a class='edit' onclick='editFaculty($(this));'><i class='fas fa-edit'></i> <span>Edit</span></a>
        <a href='?delete_id=$primary_id' class='delete' onclick='javascript:confirmationDelete($(this));return false;'><i class='fas fa-trash'></i> <span>Delete</span></a>
        </td>
        </tr>
        ";
    }
    if (($count) == 0) {
        echo "
        <tr>
        <td colspan='9'>There are no records.</td>
        </tr>
        ";
    }
}
?>