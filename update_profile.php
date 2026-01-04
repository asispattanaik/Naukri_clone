<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("
    UPDATE users SET
        full_name=?,
        profile_title=?,
        profile_summary=?,
        education=?,
        skills=?,
        languages=?,
        projects=?
    WHERE id=?
");

$stmt->bind_param(
    "sssssssi",
    $_POST['full_name'],
    $_POST['profile_title'],
    $_POST['profile_summary'],
    $_POST['education'],
    $_POST['skills'],
    $_POST['languages'],
    $_POST['projects'],
    $user_id
);

$stmt->execute();

header("Location: candidate_dashboard.php");
exit();
