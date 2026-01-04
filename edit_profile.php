<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
<title>Edit Profile</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
<div class="card p-4 shadow">

<h4>Edit Profile</h4>
<form method="POST" action="update_profile.php">

<div class="mb-3">
<label>Full Name</label>
<input type="text" name="full_name" class="form-control" value="<?= htmlspecialchars($user['full_name']) ?>" required>
</div>




<div class="mb-3">
<label>Profile Title</label>
<input type="text" name="profile_title" class="form-control" value="<?= htmlspecialchars($user['profile_title']) ?>">
</div>

<div class="mb-3">
<label>Profile Summary</label>
<textarea name="profile_summary" class="form-control" rows="4"><?= htmlspecialchars($user['profile_summary']) ?></textarea>
</div>

<div class="mb-3">
<label>Education</label>
<input type="text" name="education" class="form-control" value="<?= htmlspecialchars($user['education']) ?>">
</div>

<div class="mb-3">
<label>Skills (comma separated)</label>
<input type="text" name="skills" class="form-control" value="<?= htmlspecialchars($user['skills']) ?>">
</div>

<div class="mb-3">
<label>Languages (comma separated)</label>
<input type="text" name="languages" class="form-control" value="<?= htmlspecialchars($user['languages']) ?>">
</div>

<div class="mb-3">
<label>Projects (use | to separate)</label>
<textarea name="projects" class="form-control"><?= htmlspecialchars($user['projects']) ?></textarea>
</div>

<button class="btn btn-success">Update</button>
<a href="candidate_dashboard.php" class="btn btn-secondary">Cancel</a>

</form>
</div>
</div>

</body>
</html>
