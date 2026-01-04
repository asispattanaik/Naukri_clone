<?php
session_start();
include 'db.php';

/* Recruiter auth check */
if (!isset($_SESSION['recruiter_id'])) {
    header("Location: recruiter_login.php");
    exit();
}

/* Fetch jobs posted by recruiter */
$sql = "SELECT * FROM jobs ORDER BY created_at DESC";
$jobs = $conn->query($sql);
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>My Posted Jobs</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
body{
    background:#f5f7fb;
    font-family:'Poppins',sans-serif;
}
.card-box{
    background:#fff;
    padding:25px;
    border-radius:15px;
    box-shadow:0 4px 10px rgba(0,0,0,.08);
}
.job-item{
    border-bottom:1px solid #eee;
    padding:15px 0;
}
.job-item:last-child{
    border-bottom:none;
}
</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg px-4 bg-white shadow-sm">
    <a class="navbar-brand" href="recruiter_dashboard.php">
        <img src="https://static.naukimg.com/s/4/100/i/naukri_Logo.png" height="40">
    </a>

    <div class="ms-auto">
        <a href="recruiter_dashboard.php" class="btn btn-outline-secondary btn-sm">
            Back to Dashboard
        </a>
    </div>
</nav>

<!-- CONTENT -->
<div class="container mt-5">
    <div class="card-box">
        <h4 class="mb-4">My Posted Jobs</h4>

        <?php if($jobs->num_rows > 0): ?>
            <?php while($job = $jobs->fetch_assoc()): ?>
                <div class="job-item">
                    <h6><?= htmlspecialchars($job['job_title']) ?></h6>
                    <p class="text-muted mb-1">
                        <?= htmlspecialchars($job['company_name']) ?> |
                        <?= htmlspecialchars($job['location']) ?>
                    </p>

                    <a href="view_applicants.php?job_id=<?= $job['id'] ?>"
                       class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-people"></i> View Applicants
                    </a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-muted">No jobs posted yet.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
