<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$database = "naukri_clone";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
