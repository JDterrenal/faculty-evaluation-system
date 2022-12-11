<?php
$usertype = $_SESSION["usertype"];
if ($usertype == "Admin") {
    header('Location: /dashboard.php');
} else if ($usertype == "Student") {
    header('Location: /student_profile.php');
} else if ($usertype == "Faculty") {
    header('Location: /faculty_profile.php');
}

?>