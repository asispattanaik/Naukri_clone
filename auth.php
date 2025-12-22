<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {

        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {

            // Store session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['full_name'];

            header("Location:candidate_dashboard.php");
            exit();

        } else {
            echo "<script>alert('Incorrect password'); window.location.href='login.php';</script>";
        }

    } else {
        echo "<script>alert('Email not registered'); window.location.href='index.php';</script>";
    }
}


?>
