# Naukri
Designed and developed a full stack recruitment management system inspired by Naukri, enabling seamless interaction between candidates and recruiters. The platform supports job posting, job applications, candidate tracking, and recruiter driven evaluation with an integrated technical skill assessment mechanism.

Candidates can create and update their profiles, upload resumes, apply for jobs, and link their GitHub profiles. The system automatically calculates a GitHub based Technical Skill Score by analyzing repositories, programming languages used, and activity metrics using the GitHub REST API. This score is displayed on the candidate dashboard and made visible to recruiters for informed shortlisting decisions.

Key Features: -Candidate & Recruiter authentication -Job posting and job application workflow -Resume upload and secure viewing -GitHub Technical Skill Score integration -Recruiter review & rating system -Application status tracking -Skill Leaderboard with filtering -Dynamic dashboards for candidates and recruiters

Technologies Used: -Frontend: HTML, CSS, Bootstrap, JavaScript -Backend: PHP -Database: MySQL -APIs: GitHub REST API -Tools: XAMPP, phpMyAdmin

naukri/
│
├── assets/
│   ├── css/
│   │   ├── style.css
│   │   ├── dashboard.css
│   │   └── navbar.css
│   │
│   ├── js/
│   │   ├── featured_companies.js
│   │   ├── leaderboard.js
│   │   └── dashboard.js
│   │
│   └── images/
│       ├── logo/
│       │   └── naukri_logo.png
│       ├── companies/
│       │   ├── airtel.png
│       │   ├── fitjee.png
│       │   ├── jpmorgan.png
│       │   └── xoriant.png
│       └── default_avatar.png
│
├── uploads/
│   ├── profile/
│   │   └── user_1.jpeg
│   └── resumes/
│       └── 1766074360_Asis_Resume.pdf
│
├── includes/
│   ├── auth.php
│   ├── header.php
│   ├── footer.php
│   └── navbar.php
│
├── candidate/
│   ├── candidate_dashboard.php
│   ├── edit_profile.php
│   ├── applied_jobs.php
│   └── candidate_profile_modal.php
│
├── recruiter/
│   ├── recruiter_dashboard.php
│   ├── view_applicants.php
│   ├── skill_leaderboard.php
│   └── recruiter_login.php
│
├── jobs/
│   ├── jobs.php
│   ├── job_details.php
│   └── apply_job.php
│
├── api/
│   └── github_score.php
│
├── auth/
│   ├── login.php
│   ├── register.php
│   └── logout.php
│
├── db.php
├── index.php
├── .htaccess
└── README.md


CopyRight by-Asis Pattanaik 2025
