<?php
session_start();
include 'db.php';
include 'github_score.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];



/* Save GitHub username */
if (isset($_POST['save_github'])) {
    $github = trim($_POST['github_username']);
    if ($github !== '') {
        $stmt = $conn->prepare("UPDATE users SET github_username=? WHERE id=?");
        $stmt->bind_param("si", $github, $user_id);
        $stmt->execute();
    }
}

/*Profile picture */
if (isset($_POST['upload_image']) && isset($_FILES['profile_image'])) {

    $file = $_FILES['profile_image'];

    if ($file['error'] === 0) {

        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $allowed = ['jpg','jpeg','png','webp'];

        if (in_array(strtolower($ext), $allowed)) {

            $newName = 'user_' . $_SESSION['user_id'] . '.' . $ext;
            $path = "uploads/profile/" . $newName;

            move_uploaded_file($file['tmp_name'], $path);

            $stmt = $conn->prepare(
                "UPDATE users SET profile_image=? WHERE id=?"
            );
            $stmt->bind_param("si", $path, $_SESSION['user_id']);
            $stmt->execute();

            header("Location: candidate_dashboard.php");
            exit;
        }
    }
}



/* Resume upload */
if (isset($_POST['upload_resume']) && !empty($_FILES['resume']['name'])) {
    $file = time() . "_" . basename($_FILES['resume']['name']);
    $path = "uploads/resumes/" . $file;

    if (!is_dir("uploads/resumes")) {
        mkdir("uploads/resumes", 0777, true);
    }

    if (move_uploaded_file($_FILES['resume']['tmp_name'], $path)) {
        $stmt = $conn->prepare("UPDATE users SET resume=? WHERE id=?");
        $stmt->bind_param("si", $path, $user_id);
        $stmt->execute();
    }
}

/* Fetch user */
$stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

$skills   = $user['skills'] ? explode(',', $user['skills']) : [];
$projects = $user['projects'] ? explode('|', $user['projects']) : [];

$github_username = $user['github_username'] ?? '';
$githubData = calculateGithubScore($github_username);
?>


<!DOCTYPE html>
<html>
<head>
<title>Candidate Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
body{background:#eef2f7}
.sidebar{
    width:250px;
    background:#0d6efd;
    min-height:100vh;
    color:#fff;
    position:fixed;
}
.sidebar h4{padding:20px}
.sidebar a{
    display:block;
    color:#fff;
    padding:12px 20px;
    text-decoration:none;
}
.sidebar a:hover{background:rgba(255,255,255,.15)}
.main{
    margin-left:250px;
    padding:30px;
}
.card{
    border-radius:14px;
    box-shadow:0 6px 20px rgba(0,0,0,.05);
}
.skill{
    background:#f1f5ff;
    padding:6px 14px;
    border-radius:20px;
    margin:5px;
    display:inline-block;
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
  <h4><?= htmlspecialchars($user['full_name']) ?></h4>
  <a href="#"><i class="bi bi-person"></i> Profile</a>
  <a href="applied_jobs.php"><i class="bi bi-briefcase"></i> Applied Jobs</a>
  <a href="jobs.php">Opportunity</a>
  <a href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
</div>

<!-- MAIN -->
<div class="main">

<div class="row g-4">

<!-- PROFILE -->


<div class="text-center mb-3">
    <img src="/naukri/<?= htmlspecialchars($user['profile_image']) ?>"
        
        class="rounded-circle shadow"
        width="120"
        height="120"
        style="object-fit:cover;">
</div>

<form method="POST" enctype="multipart/form-data" class="text-center">
    <input type="file"
           name="profile_image"
           class="form-control form-control-sm mb-2"
           accept="image/*"
           required>

    <button name="upload_image" class="btn btn-sm btn-primary">
        Update Profile Picture
    </button>
</form>


    <div class="col-md-6">
  <div class="card p-4 position-relative">

    <a href="edit_profile.php"
       class="btn btn-sm btn-outline-primary position-absolute"
       style="top:15px; right:15px;">
       <i class="bi bi-pencil"></i> Update Profile
    </a>

    <h5>Profile</h5>

    <p class="text-muted"><?= htmlspecialchars($user['profile_title']) ?></p>
    <p><?= nl2br(htmlspecialchars($user['profile_summary'])) ?></p>
  </div>
</div>

<!-- EDUCATION -->
<div class="col-md-6">
  <div class="card p-4">
    <h5>Education</h5>
    <p><?= htmlspecialchars($user['education']) ?></p>
  </div>
</div>

<!-- SKILLS -->
<div class="col-md-6">
  <div class="card p-4">
    <h5>Skills</h5>
    <?php foreach($skills as $s): ?>
      <span class="skill"><?= htmlspecialchars(trim($s)) ?></span>
    <?php endforeach; ?>
  </div>
</div>

<!-- GITHUB SCORE -->
<div class="col-md-6">
  <div class="card p-4">
    <h5>Technical Skill Score (GitHub)</h5>

    <?php if($githubData): ?>
      <p>
        <strong>Overall Score:</strong>
        <span class="badge bg-success">
          <?= $githubData['score'] ?>/100
        </span>
      </p>

      <p><strong>Repositories:</strong> <?= $githubData['repos'] ?></p>

      <p><strong>Languages Used:</strong>
        <?= !empty($githubData['languages'])
              ? implode(', ', $githubData['languages'])
              : 'N/A'; ?>
      </p>
    <?php else: ?>
      <p class="text-muted">
        GitHub profile not linked or API limit reached.
      </p>
    <?php endif; ?>

    <form method="POST" class="mt-3">
      <div class="input-group">
        <span class="input-group-text"><i class="bi bi-github"></i></span>
        <input type="text" name="github_username" class="form-control"
               value="<?= htmlspecialchars($github_username) ?>"
               placeholder="GitHub username">
        <button class="btn btn-primary" name="save_github">Save</button>
      </div>
    </form>
  </div>
</div>


<!-- PROJECTS -->
<div class="col-md-12">
  <div class="card p-4">
    <h5>Projects</h5>
    <ul>
      <?php foreach($projects as $p): ?>
        <li><?= htmlspecialchars(trim($p)) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>

<!-- RESUME -->
<div class="col-md-12">
  <div class="card p-4">
    <h5>Resume</h5>

    <?php if($user['resume']): ?>
      <a href="<?= htmlspecialchars($user['resume']) ?>" target="_blank"
         class="btn btn-outline-primary btn-sm mb-2">View Resume</a>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
      <input type="file" name="resume" class="form-control mb-2" required>
      <button class="btn btn-primary btn-sm" name="upload_resume">Upload</button>
    </form>
  </div>
</div>

</div>
</div>

</body>
</html>
