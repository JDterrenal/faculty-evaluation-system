<?php
$dir = "./images/uploads/";
$filename = $_FILES['edit_photo']['name'];
$file_tmp_name = $_FILES['edit_photo']['tmp_name'];
$ext = array("jpg", "png", "jpeg", "bmp");
$split = explode('.', $filename);
$image_ext = strtolower(end($split));

if (in_array($image_ext, $ext)) {
    move_uploaded_file($file_tmp_name, "$dir" . $filename);
    $edit_photo = $filename;
} else {
    $sql = "SELECT photo FROM tb_faculty WHERE faculty_id=$edit_id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $edit_photo = $row["photo"];
    }
}
?>