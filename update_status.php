<?php
session_start();
include 'db.php';

if (!isset($_SESSION['recruiter_id'])) {
    header("Location: recruiter_login.php");
    exit();
}

$id = $_GET['id'];
$status = $_GET['status'];

$sql = "UPDATE job_applications SET status=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $status, $id);
$stmt->execute();

header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
