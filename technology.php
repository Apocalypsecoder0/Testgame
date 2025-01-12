<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Logic to display technologies
?>

<h1>Technologies</h1>
<p>View available technologies here.</p>
