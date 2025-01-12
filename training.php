<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Logic to train troops
?>

<h1>Training</h1>
<p>Train your troops here.</p>
