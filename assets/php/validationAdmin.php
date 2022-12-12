<?php
if ($_SESSION['usertype'] == "Student") {
    header('Location: /dashboard.php');
} else if ($_SESSION['usertype'] == "Faculty") {
    header('Location: /dashboard.php');
}
?>