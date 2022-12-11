<?php
include './functions.php';
if ($_SESSION['usertype'] == "Student") {
    header('Location: /student_profile.php');
} else if ($_SESSION['usertype'] == "Faculty") {
    header('Location: /faculty_profile.php');
} else {
    header('Location: /dashboard.php');
}
?>