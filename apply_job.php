<?php
session_start();
include 'db.php';

/* AUTH CHECK */
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); // login page
    exit();
}

$user_id = $_SESSION['user_id'];
$job_id  = $_POST['job_id'] ?? null;

if (!$job_id) {
    header("Location: jobs.php");
    exit();
}

/* CHECK IF ALREADY APPLIED */
$check = $conn->prepare(
    "SELECT id FROM job_applications WHERE user_id=? AND job_id=?"
);
$check->bind_param("ii", $user_id, $job_id);
$check->execute();
$checkResult = $check->get_result();

if ($checkResult->num_rows > 0) {
    $_SESSION['msg'] = "You have already applied for this job.";
    header("Location: jobs.php");
    exit();
}

/* APPLY JOB */
$stmt = $conn->prepare(
    "INSERT INTO job_applications (user_id, job_id) VALUES (?, ?)"
);
$stmt->bind_param("ii", $user_id, $job_id);

if ($stmt->execute()) {
    $_SESSION['msg'] = "Job applied successfully!";
}

header("Location: jobs.php");
exit();
