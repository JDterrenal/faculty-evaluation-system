<?php
if ($_SESSION['usertype'] == "Student") {
    header('Location: /dashboard.php');
}
?>