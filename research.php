<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Logic to handle research
?>

<h1>Research</h1>
<p>Research new technologies here.</p>
