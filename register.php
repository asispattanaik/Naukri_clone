<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Registration</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="icon" href="https://static.naukimg.com/s/7/103/i/naukriIcon.74e6a29a.png">

<script src="https://kit.fontawesome.com/24c494a6b6.js" crossorigin="anonymous"></script>

<style>
body{background:#fafbfe;font-family:'Poppins',sans-serif;}
#rightBox{background:#fff;padding:35px;border-radius:20px;box-shadow:0 4px 12px rgba(0,0,0,.1);}
#register{background:#4b87ff;color:white;border:none;border-radius:15px;font-size:18px;padding:10px 40px;}
</style>
</head>

<body>

<a href="index.php">
<img src="https://static.naukimg.com/s/4/100/i/naukri_Logo.png" alt="Naukri Logo">
</a>

<div class="container mt-5">
  <div id="rightBox">

<form method="POST" action="back.php" enctype="multipart/form-data">

<h2 class="mb-4">Find a job & grow your career</h2> 
<!-- FULL NAME -->
<div class="mb-3">
<label class="form-label">Full Name</label>
<input type="text" class="form-control" name="full_name" required>
</div>

<!-- EMAIL -->
<div class="mb-3">
<label class="form-label">Email ID</label>
<input type="email" class="form-control" name="email" required>
</div>

<!-- PASSWORD -->
<div class="mb-3">
<label class="form-label">Password</label>
<input type="password" class="form-control" name="password" required>
</div>

<!-- MOBILE -->
<div class="mb-3">
<label class="form-label">Mobile Number</label>
<input type="number" class="form-control" name="mobile" required>
</div>

<!-- WORK STATUS -->
<div class="mb-3">
<label class="form-label">Work Status</label><br>
<input type="radio" name="work_status" value="Experienced" required> Experienced &nbsp;&nbsp;
<input type="radio" name="work_status" value="Fresher"> Fresher
</div>

<!-- PROFILE TITLE -->
<div class="mb-3">
  <label class="form-label">Profile Title</label>
  <input type="text" class="form-control" name="profile_title"
   placeholder="Ex: Frontend Developer | Data Analyst | Human Resource">
</div>

<!-- PROFILE SUMMARY -->
<div class="mb-3">
  <label class="form-label">Profile Summary</label>
  <textarea class="form-control" name="profile_summary" rows="3"></textarea>
</div>

<!-- EDUCATION -->
<div class="mb-3">
  <label class="form-label">Education</label>
  <input type="text" class="form-control" name="education"
   placeholder="B.Tech in Computer Science – 2021–2025">
</div>

<!-- SKILLS -->
<div class="mb-3">
  <label class="form-label">Skills (comma separated)</label>
  <input type="text" class="form-control" name="skills"
   placeholder="HTML, CSS, JavaScript, React">
</div>

<!-- LANGUAGES -->
<div class="mb-3">
  <label class="form-label">Languages</label>
  <input type="text" class="form-control" name="languages"
   placeholder="English, Hindi">
</div>

<!-- PROJECTS -->
<div class="mb-3">
  <label class="form-label">Projects</label>
  <textarea class="form-control" name="projects" rows="2"></textarea>
</div>


<!-- RESUME -->
<div class="mb-3">
<label class="form-label">Upload Resume</label>
<input type="file" class="form-control" name="resume" accept=".pdf,.doc,.docx" required>
<small class="text-muted">DOC, DOCX, PDF | Max 2MB</small>
</div>

<!-- Profile Picture -->
<div class="mb-3">
<label class="form-label">Upload Profile Picture</label>
<input type="file" class="form-control" name="resume" accept="'jpg','jpeg','png','webp'" required>
<small class="text-muted">JPG, JPEG , PNG , WEBP | Max 2MB</small>
</div>


<!-- TERMS -->
<p style="font-size:12px;color:#6b7994">
By clicking Register, you agree to the Terms and Conditions & Privacy Policy
</p>

<!-- SUBMIT -->
<button type="submit" id="register">Register Now</button>

</form>

</div>
</div>

<footer class="text-center mt-5" style="font-size:12px;color:#6b7994">
All rights reserved © Asis Pattanaik
</footer>

</body>
</html>
