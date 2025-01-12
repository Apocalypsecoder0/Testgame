<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Logic to display and manage armory items
?>

<h1>Armory</h1>
<p>Manage your weapons and defenses here.</p>
