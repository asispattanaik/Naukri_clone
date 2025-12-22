<?php
session_start();
include 'db.php';

/* Recruiter auth check */
if (!isset($_SESSION['recruiter_id'])) {
    header("Location: recruiter_login.php");
    exit();
}

if (isset($_POST['post_job'])) {
    $job_title   = $_POST['job_title'];
    $company     = $_POST['company_name'];
    $location    = $_POST['location'];
    $experience  = $_POST['experience'];
    $salary      = $_POST['salary'];
    $job_type    = $_POST['job_type'];
    $description = $_POST['description'];

    $sql = "INSERT INTO jobs 
            (job_title, company_name, location, experience, salary, job_type, description)
            VALUES (?,?,?,?,?,?,?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssssss",
        $job_title,
        $company,
        $location,
        $experience,
        $salary,
        $job_type,
        $description
    );

    if ($stmt->execute()) {
        $success = "Job posted successfully!";
    } else {
        $error = "Failed to post job";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Recruiter Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
body{
    background:#f5f7fb;
    font-family: 'Poppins', sans-serif;
}
.navbar{
    background:#fff;
    box-shadow:0 2px 10px rgba(0,0,0,0.08);
}
.card-box{
    background:#fff;
    padding:30px;
    border-radius:15px;
    box-shadow:0 4px 10px rgba(0,0,0,0.08);
}
.navbar-brand img{
    height:40px;
}
</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg px-4">

    <a class="navbar-brand" href="recruiter_dashboard.php">
        <img src="https://static.naukimg.com/s/4/100/i/naukri_Logo.png" alt="Naukri Logo">
    </a>


    <div class="ms-auto d-flex align-items-center gap-3">

       
        <a href="recruiter_jobs.php" class="btn btn-outline-primary btn-sm">
            <i class="bi bi-people"></i> View Applicants
        </a>

        
        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown">
                <i class="bi bi-person-circle"></i> Recruiter
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item text-danger" href="recruiter_logout.php">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </li>
            </ul>
        </div>

    </div>
</nav>


<!-- MAIN CONTENT -->
<div class="container mt-5">
  <div class="card-box">
    <h3 class="mb-4">Post a New Job</h3>

    <?php if(isset($success)): ?>
      <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <?php if(isset($error)): ?>
      <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
      <div class="mb-3">
        <label class="form-label">Job Title</label>
        <input type="text" name="job_title" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Company Name</label>
        <input type="text" name="company_name" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Location</label>
        <input type="text" name="location" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Experience</label>
        <input type="text" name="experience" class="form-control" placeholder="0-2 Years" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Salary</label>
        <input type="text" name="salary" class="form-control" placeholder="4 - 6 LPA" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Job Type</label>
        <select name="job_type" class="form-control" required>
          <option>Full Time</option>
          <option>Part Time</option>
          <option>Internship</option>
          <option>Remote</option>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Job Description</label>
        <textarea name="description" class="form-control" rows="4" required></textarea>
      </div>

      <button name="post_job" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Post Job
      </button>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
