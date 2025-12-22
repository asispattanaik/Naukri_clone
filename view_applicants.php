<?php
session_start();
include 'db.php';
include 'github_score.php';

/* Recruiter auth check */
if (!isset($_SESSION['recruiter_id'])) {
    header("Location: recruiter_login.php");
    exit();
}

/* Check job_id */
if (!isset($_GET['job_id'])) {
    die("Job ID missing");
}

$job_id = intval($_GET['job_id']);

/* HANDLE REVIEW SUBMISSION */
if (isset($_POST['submit_review'])) {

    $application_id = intval($_POST['application_id']);
    $score = intval($_POST['score']);
    $comments = trim($_POST['comments']);
    $recruiter_id = $_SESSION['recruiter_id'];

    $stmt = $conn->prepare("
        INSERT INTO reviews (application_id, recruiter_id, score, comments)
        VALUES (?, ?, ?, ?)
    ");
    $stmt->bind_param("iiis", $application_id, $recruiter_id, $score, $comments);
    $stmt->execute();
}

/* HANDLE STATUS UPDATE */
if (isset($_POST['shortlist']) || isset($_POST['reject'])) {

    $application_id = intval($_POST['application_id']);
    $status = isset($_POST['shortlist']) ? 'Shortlisted' : 'Rejected';

    $stmt = $conn->prepare(
        "UPDATE job_applications SET status=? WHERE id=?"
    );
    $stmt->bind_param("si", $status, $application_id);
    $stmt->execute();
}

/* FETCH APPLICANTS */
$sql = "
SELECT 
    ja.id AS application_id,
    ja.status,
    ja.applied_at,
    u.full_name,
    u.email,
    u.resume,
    u.github_username
FROM job_applications ja
JOIN users u ON ja.user_id = u.id
WHERE ja.job_id = ?
ORDER BY ja.applied_at DESC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $job_id);
$stmt->execute();
$applicants = $stmt->get_result();
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Applicants</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">


<style>
body{background:#f5f7fb}
.card-box{
    background:#fff;
    padding:25px;
    border-radius:15px;
    box-shadow:0 4px 10px rgba(0,0,0,.08);
}
</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container-fluid px-4">

    <!-- Left: Naukri Logo -->
    <a class="navbar-brand d-flex align-items-center" href="#">
      <img src="https://static.naukimg.com/s/4/100/i/naukri_Logo.png"
           alt="Naukri"
           height="32"
           class="me-2">
      <span class="fw-semibold">Recruiter Panel</span>
    </a>

    <!-- Right: Actions -->
    <div class="d-flex gap-2">
      <a href="skill_leaderboard.php"
         class="btn btn-outline-primary btn-sm">
        <i class="bi bi-bar-chart-fill"></i>
        Skill Leaderboard
      </a>

      <a href="recruiter_dashboard.php"
         class="btn btn-outline-secondary btn-sm">
        Back
      </a>
    </div>

  </div>
</nav>


<div class="container mt-4">
  <div class="card-box">
    <h4 class="mb-4">Job Applicants</h4>

    <?php if ($applicants->num_rows > 0): ?>
        <?php while ($row = $applicants->fetch_assoc()): ?>
            <?php
$githubScore = null;

if (!empty($row['github_username'])) {
    $githubScore = calculateGithubScore($row['github_username']);
}
?>

        <div class="border rounded p-3 mb-3 d-flex justify-content-between align-items-start">

            <!-- LEFT -->
            <div>
                <h6><?= htmlspecialchars($row['full_name']) ?></h6>
                <p class="mb-1 text-muted"><?= htmlspecialchars($row['email']) ?></p>
            <?php if (!empty($row['github_username'])): ?>
    <div class="mt-2">
        <strong>GitHub:</strong>
        <span class="text-primary">
            <?= htmlspecialchars($row['github_username']) ?>
        </span>

        <?php if ($githubScore): ?>
            <div class="mt-1">
                <span class="badge bg-success">
                    Technical Score: <?= $githubScore['score'] ?>/100
                </span>
                <br>
                <small class="text-muted">
                    Repos: <?= $githubScore['repos'] ?> |
                    Languages: <?= implode(', ', $githubScore['languages']) ?>
                </small>
            </div>
        <?php else: ?>
            <div class="text-muted small">
                Unable to fetch GitHub score
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>

                <?php if (!empty($row['resume']) && file_exists($row['resume'])): ?>
                    <a href="<?= htmlspecialchars($row['resume']) ?>"
                       target="_blank"
                       class="btn btn-sm btn-outline-primary mt-2">
                        View Resume
                    </a>
                <?php else: ?>
                    <p class="text-muted mb-0">No resume uploaded</p>
                <?php endif; ?>

                <br>
                <small class="text-muted">
                    Applied on <?= date("d M Y", strtotime($row['applied_at'])) ?>
                </small>
            </div>

            <!-- RIGHT -->
            <div class="text-end" style="min-width:260px">

                <span class="badge mb-2
                    <?= $row['status']=='Shortlisted'?'bg-success':
                       ($row['status']=='Rejected'?'bg-danger':'bg-primary'); ?>">
                    <?= $row['status'] ?>
                </span>

                <!-- ACTION BUTTONS -->
                <?php if ($row['status'] === 'Applied'): ?>
                    <form method="POST" class="mt-2 d-flex gap-1">
                        <input type="hidden" name="application_id" value="<?= $row['application_id'] ?>">
                        <button name="shortlist" class="btn btn-sm btn-success">Shortlist</button>
                        <button name="reject" class="btn btn-sm btn-danger">Reject</button>
                    </form>
                <?php endif; ?>

                <!-- REVIEW BUTTON -->
                <button class="btn btn-sm btn-outline-primary mt-2"
                        onclick="toggleReview(<?= $row['application_id'] ?>)">
                    Review
                </button>

                <!-- REVIEW FORM -->
                <div id="review-<?= $row['application_id'] ?>" style="display:none;">
                    <form method="POST" class="mt-2">
                        <input type="hidden" name="application_id"
                               value="<?= $row['application_id'] ?>">

                        <input type="number"
                               name="score"
                               class="form-control mb-2"
                               placeholder="Score (1–10)"
                               min="1" max="10"
                               required>

                        <textarea name="comments"
                                  class="form-control mb-2"
                                  placeholder="Reviewer comments"
                                  required></textarea>

                        <button name="submit_review"
                                class="btn btn-sm btn-primary w-100">
                            Submit Review
                        </button>
                    </form>
                </div>

            </div>
        </div>

        <?php endwhile; ?>
    <?php else: ?>
        <p class="text-muted">No applicants found.</p>
    <?php endif; ?>

  </div>
</div>

<!-- ✅ JAVASCRIPT -->
<script>
function toggleReview(id) {
    const el = document.getElementById('review-' + id);
    el.style.display = (el.style.display === 'none' || el.style.display === '')
        ? 'block'
        : 'none';
}
</script>

</body>
</html>
