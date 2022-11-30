<?php
$dir = "./images/uploads/";
$filename = $_FILES['photo']['name'];
$file_tmp_name = $_FILES['photo']['tmp_name'];
$ext = array("jpg", "png", "jpeg", "bmp");
$split = explode('.', $filename);
$image_ext = strtolower(end($split));

if (in_array($image_ext, $ext)) {
    move_uploaded_file($file_tmp_name, "$dir" . $filename);
    $photo = $filename;
} else {
    $photo = 'standard.png';
}
?>