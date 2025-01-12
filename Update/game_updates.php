<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Logic to display game updates
?>

<h1>Game Updates</h1>
<p>View recent updates here.</p>
