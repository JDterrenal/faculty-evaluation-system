<?php
$server = "localhost";
$dbuser = "ctihjqny_fesDB";
$dbpass = "FESd@t@b@se";
$database = "ctihjqny_fesDB";

//Database Connection
$conn = mysqli_connect($server, $dbuser, $dbpass, $database);
if (!$conn) {
    die("Connection error: " . mysqli_connect_error());
}
?>