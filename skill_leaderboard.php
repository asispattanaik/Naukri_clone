<?php
session_start();
include 'db.php';
include 'github_score.php';

$job_id = $_GET['job_id'] ?? '';
/* Optional filter */
$filterSkill = $_GET['skill'] ?? '';

/* Fetch candidates with GitHub */
$sql = "
SELECT id, full_name, email, github_username
FROM users
WHERE github_username IS NOT NULL
AND github_username != ''
";

$result = $conn->query($sql);

$candidates = [];

while ($row = $result->fetch_assoc()) {

    $githubData = calculateGithubScore($row['github_username']);

    if ($githubData) {

        // Skill filter logic
        if ($filterSkill && !in_array($filterSkill, $githubData['languages'])) {
            continue;
        }

        $row['score'] = $githubData['score'];
        $row['repos'] = $githubData['repos'];
        $row['languages'] = $githubData['languages'];

        $candidates[] = $row;
    }
}

/* Sort by score DESC */
usort($candidates, function ($a, $b) {
    return $b['score'] <=> $a['score'];
});
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Skill Leaderboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{background:#f5f7fb}
.card-box{
    background:#fff;
    padding:25px;
    border-radius:14px;
    box-shadow:0 6px 15px rgba(0,0,0,.08);
}
</style>
</head>

<body>


<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container-fluid px-4">

    <!-- LEFT: Naukri Logo -->
    <a class="navbar-brand d-flex align-items-center" href="recruiter_dashboard.php">
      <img src="https://static.naukimg.com/s/4/100/i/naukri_Logo.png"
           alt="Naukri"
           height="34"
           class="me-2">
      <span class="fw-semibold text-dark">Recruiter Panel</span>
    </a>

    <!-- RIGHT: BUTTONS -->
   

  </div>
</nav>


<!-- FILTER -->
<form method="GET" class="mb-4">
    <div class="row g-2">
        <div class="col-md-4">
            <input type="text"
                   name="skill"
                   value="<?= htmlspecialchars($filterSkill) ?>"
                   class="form-control"
                   placeholder="Filter by skill (Python, Java...)">
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100">Filter</button>
        </div>
        <div class="col-md-2">
            <a href="skill_leaderboard.php" class="btn btn-secondary w-100">
                Reset
            </a>
        </div>
    </div>
</form>

<!-- LEADERBOARD TABLE -->
<table class="table table-hover align-middle">
<thead class="table-light">
<tr>
    <th>#</th>
    <th>Candidate</th>
    <th>Email</th>
    <th>Score</th>
    <th>Repos</th>
    <th>Skills</th>
</tr>
</thead>

<tbody>
<?php if (!empty($candidates)): ?>
    <?php foreach ($candidates as $index => $c): ?>
    <tr>
        <td><?= $index + 1 ?></td>
        <td><?= htmlspecialchars($c['full_name']) ?></td>
        <td><?= htmlspecialchars($c['email']) ?></td>
        <td>
            <span class="badge bg-success">
                <?= $c['score'] ?>/100
            </span>
        </td>
        <td><?= $c['repos'] ?></td>
        <td>
            <?= implode(', ', $c['languages']) ?>
        </td>
    </tr>
    <?php endforeach; ?>
<?php else: ?>
<tr>
    <td colspan="6" class="text-center text-muted">
        No candidates found
    </td>
</tr>
<?php endif; ?>
</tbody>
</table>

</div>
</div>

</body>
</html>
