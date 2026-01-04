<?php 
session_start();
include 'db.php';

/* AUTH CHECK */
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

/* FETCH USER NAME */
$user_stmt = $conn->prepare("SELECT full_name FROM users WHERE id=?");
$user_stmt->bind_param("i", $user_id);
$user_stmt->execute();
$user = $user_stmt->get_result()->fetch_assoc();

/* FETCH APPLIED JOBS + REVIEW */
$sql = "
    SELECT 
        j.job_title,
        j.company_name,
        j.location,
        ja.applied_at,
        ja.status,
        r.score,
        r.comments
    FROM job_applications ja
    JOIN jobs j ON ja.job_id = j.id
    LEFT JOIN reviews r ON ja.id = r.application_id
    WHERE ja.user_id = ?
    ORDER BY ja.applied_at DESC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$applied_jobs = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Applied Jobs</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
body{
    background:#f5f7fb;
    font-family:'Poppins',sans-serif;
}
.navbar{
    background:#fff;
    padding:12px 30px;
    box-shadow:0 2px 10px rgba(0,0,0,.08);
}
.card-box{
    background:#fff;
    border-radius:15px;
    padding:25px;
    box-shadow:0 4px 10px rgba(0,0,0,.05);
}
</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar d-flex justify-content-between">
  <div>
    <a href="candidate_dashboard.php">
      <img src="https://static.naukimg.com/s/4/100/i/naukri_Logo.png" height="35">
    </a>
  </div>

  <div class="d-flex align-items-center gap-3">
    <span><?= htmlspecialchars($user['full_name']) ?></span>
    <a href="candidate_dashboard.php" class="btn btn-outline-primary btn-sm">
      Back to Dashboard
    </a>
  </div>
</nav>

<!-- CONTENT -->
<div class="container mt-4">
  <div class="card-box">
    <h4 class="mb-4">Applied Jobs</h4>

    <?php if($applied_jobs->num_rows > 0): ?>
      <?php while($job = $applied_jobs->fetch_assoc()): ?>
        <div class="border rounded p-3 mb-3">

          <div class="d-flex justify-content-between">
            <div>
              <h6><?= htmlspecialchars($job['job_title']) ?></h6>
              <p class="text-muted mb-1">
                <?= htmlspecialchars($job['company_name']) ?> |
                <?= htmlspecialchars($job['location']) ?>
              </p>
              <small class="text-muted">
                <i class="bi bi-clock"></i>
                Applied on <?= date("d M Y", strtotime($job['applied_at'])) ?>
              </small>
            </div>

            <!-- STATUS BADGE -->
            <span class="badge align-self-start
              <?= $job['status']=='Shortlisted' ? 'bg-success' :
                 ($job['status']=='Rejected' ? 'bg-danger' : 'bg-primary'); ?>">
              <?= htmlspecialchars($job['status']); ?>
            </span>
          </div>

          <!-- REVIEW SECTION -->
          <div class="mt-3">
            <?php if(!empty($job['score'])): ?>
              <div class="alert alert-info mb-0">
                <strong>Reviewer Score:</strong> <?= $job['score'] ?>/10 <br>
                <strong>Feedback:</strong>
                <?= htmlspecialchars($job['comments']) ?>
              </div>
            <?php else: ?>
              <span class="badge bg-secondary">Review Pending</span>
            <?php endif; ?>
          </div>

        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p class="text-muted">You haven’t applied to any jobs yet.</p>
    <?php endif; ?>

  </div>
</div>

</body>
</html>
