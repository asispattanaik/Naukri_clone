<?php
include 'db.php';

$full_name = $_POST['full_name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$mobile = $_POST['mobile'];
$work_status = $_POST['work_status'];

$profile_title = $_POST['profile_title'];
$profile_summary = $_POST['profile_summary'];
$education = $_POST['education'];
$skills = $_POST['skills'];
$languages = $_POST['languages'];
$projects = $_POST['projects'];

/* Resume upload */
$resume_name = $_FILES['resume']['name'];
$tmp = $_FILES['resume']['tmp_name'];
move_uploaded_file($tmp, "resumes/".$resume_name);

$sql = "INSERT INTO users
(full_name,email,password,mobile,work_status,
 profile_title,profile_summary,education,skills,languages,projects,resume)
VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssssss",
$full_name,$email,$password,$mobile,$work_status,
$profile_title,$profile_summary,$education,$skills,$languages,$projects,$resume_name);

$stmt->execute();

header("Location: Login.php");
exit();
?>
