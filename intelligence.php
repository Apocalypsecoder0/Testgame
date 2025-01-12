<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Logic to display intelligence reports
?>

<h1>Intelligence</h1>
<p>View intelligence reports here.</p>
