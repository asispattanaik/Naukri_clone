<?php
include 'db.php';

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $company = trim($_POST['company_name']);
    $email   = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if recruiter already exists
    $check = $conn->prepare("SELECT id FROM recruiters WHERE email=?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $error = "Email already registered";
    } else {
        $stmt = $conn->prepare(
            "INSERT INTO recruiters (company_name, email, password) VALUES (?,?,?)"
        );
        $stmt->bind_param("sss", $company, $email, $password);

        if ($stmt->execute()) {
            $success = "Registration successful! Please login.";
        } else {
            $error = "Something went wrong";
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Recruiter Registration</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#f5f7fb;
}
.card{
    border-radius:15px;
    box-shadow:0 4px 12px rgba(0,0,0,.1);
}
</style>
</head>

<body>
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-5">

      <div class="card p-4">
        <h4 class="mb-3 text-center">Recruiter Registration</h4>

        <?php if($error): ?>
          <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <?php if($success): ?>
          <div class="alert alert-success">
            <?= $success ?>
            <br>
            <a href="recruiter_login.php">Click here to login</a>
          </div>
        <?php endif; ?>

        <form method="POST">
          <div class="mb-3">
            <label>Company Name</label>
            <input type="text" name="company_name" class="form-control" required>
          </div>

          <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>

          <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>

          <button class="btn btn-primary w-100">Register</button>
        </form>

        <p class="text-center mt-3">
          Already registered?  
          <a href="recruiter_login.php">Login here</a>
        </p>

      </div>

    </div>
  </div>
</div>
</body>
</html>
