<?php
session_start();
include 'db.php';

/* SEARCH FILTERS */
$keyword    = $_GET['keyword'] ?? '';
$location   = $_GET['location'] ?? '';
$experience = $_GET['experience'] ?? '';

$sql = "SELECT * FROM jobs WHERE 1";

if (!empty($keyword)) {
    $sql .= " AND (job_title LIKE '%$keyword%' 
              OR company_name LIKE '%$keyword%'
              OR description LIKE '%$keyword%')";
}

if (!empty($location)) {
    $sql .= " AND location LIKE '%$location%'";
}

if (!empty($experience)) {
    $sql .= " AND experience LIKE '%$experience%'";
}

$sql .= " ORDER BY created_at DESC";

$jobs = $conn->query($sql);
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Jobs</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<style>
body{
    background:#f5f7fb;
    font-family:'Poppins', sans-serif;
}

/* NAVBAR */
.navbar{
    background:#fff;
    box-shadow:0 2px 10px rgba(0,0,0,0.08);
}
.navbar-brand img{
    height:40px;
}

/* SEARCH BAR */
.search-wrapper{
    background:#fff;
    padding:15px;
    border-radius:50px;
    display:flex;
    gap:10px;
    align-items:center;
    box-shadow:0 6px 15px rgba(0,0,0,0.08);
}
.search-wrapper input,
.search-wrapper select{
    border:none;
    outline:none;
    padding:10px 15px;
    width:100%;
}
.search-btn{
    background:#4f7cff;
    color:#fff;
    border:none;
    padding:10px 25px;
    border-radius:30px;
}

/* JOB CARD */
.job-card{
    background:#fff;
    padding:20px;
    border-radius:12px;
    margin-bottom:20px;
    box-shadow:0 4px 10px rgba(0,0,0,0.08);
    transition:.2s;
}
.job-card:hover{
    transform:translateY(-3px);
}
</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar px-4">
    <a class="navbar-brand" href="index.php">
        <img src="https://static.naukimg.com/s/4/100/i/naukri_Logo.png">
    </a>

    <div class="ms-auto">
        <?php if(isset($_SESSION['user_id'])): ?>
            <a href="candidate_dashboard.php" class="btn btn-outline-primary">Dashboard</a>
        <?php else: ?>
            <a href="index.php" class="btn btn-outline-primary">Login</a>
        <?php endif; ?>
    </div>
</nav>

<!-- SEARCH BAR -->
<div class="container mt-4">
<form method="GET">
<div class="search-wrapper">

    <i class="fa fa-search text-muted"></i>

    <input type="text" name="keyword"
           placeholder="Enter skills / designation / companies"
           value="<?= htmlspecialchars($keyword) ?>">

    <input type="text" name="location"
           placeholder="Enter location"
           value="<?= htmlspecialchars($location) ?>">

    <select name="experience">
        <option value="">Select experience</option>
        <option value="0-1">0-1 Years</option>
        <option value="1-3">1-3 Years</option>
        <option value="3-5">3-5 Years</option>
        <option value="5+">5+ Years</option>
    </select>

    <button class="search-btn">Search</button>
</div>
</form>
</div>

<!-- JOB LIST -->
<div class="container mt-5">
<h4 class="mb-4">Latest Jobs</h4>

<!-- STATUS MESSAGE -->
<?php if(isset($_SESSION['msg'])): ?>
<div class="alert alert-info">
    <?= $_SESSION['msg']; unset($_SESSION['msg']); ?>
</div>
<?php endif; ?>

<?php if($jobs->num_rows > 0): ?>
<?php while($job = $jobs->fetch_assoc()): ?>

<div class="job-card">
    <h5><?= htmlspecialchars($job['job_title']) ?></h5>
    <p class="text-muted"><?= htmlspecialchars($job['company_name']) ?></p>

    <p>
        <i class="fa fa-briefcase"></i> <?= htmlspecialchars($job['experience']) ?>
        &nbsp; | &nbsp;
        ₹ <?= htmlspecialchars($job['salary']) ?>
        &nbsp; | &nbsp;
        <i class="fa fa-location-dot"></i> <?= htmlspecialchars($job['location']) ?>
    </p>

    <p><?= htmlspecialchars($job['description']) ?></p>

    <div class="d-flex justify-content-between align-items-center mt-3">
        <span class="badge bg-primary"><?= htmlspecialchars($job['job_type']) ?></span>

        <form method="POST" action="apply_job.php">
            <input type="hidden" name="job_id" value="<?= $job['id'] ?>">
            <button class="btn btn-success btn-sm">
                <i class="fa fa-paper-plane"></i> Apply
            </button>
        </form>
    </div>
</div>

<?php endwhile; ?>
<?php else: ?>
<p class="text-muted">No jobs found</p>
<?php endif; ?>

</div>

</body>
</html>
