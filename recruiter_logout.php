<?php
session_start();
session_destroy();
header("Location: recruiter_login.php");
exit();
