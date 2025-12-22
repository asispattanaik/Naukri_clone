<?php
session_start();
include 'db.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM recruiters WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows == 1) {
        $row = $res->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            $_SESSION['recruiter_id'] = $row['id'];
            header("Location: recruiter_dashboard.php");
            exit();
        }
    }
    $error = "Invalid login credentials";
}
?>
<!doctype html>
<html lang="en">
<head>
<title>Recruiter Login</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.navbar{
    background:#fff;
    box-shadow:0 2px 10px rgba(0,0,0,0.08);
}
.navbar-brand img{
    height:40px;
}
</style>
</head>

<body class="bg-light">

<!-- NAVBAR WITH LOGO -->
<nav class="navbar px-4">
    <a class="navbar-brand" href="index.php">
        <img src="https://static.naukimg.com/s/4/100/i/naukri_Logo.png" alt="Naukri Logo">
    </a>
</nav>

<!-- LOGIN CARD -->
<div class="container mt-5">
    <div class="card p-4 mx-auto shadow" style="max-width:400px">
        <h4 class="mb-3 text-center">Recruiter Login</h4>

        <?php if(isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST">
            <input class="form-control mb-3" name="email" placeholder="Email" required>
            <input class="form-control mb-3" type="password" name="password" placeholder="Password" required>
            <button class="btn btn-primary w-100" name="login">Login</button>
        </form>
    </div>
</div>

</body>
</html>
