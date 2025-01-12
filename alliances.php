<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Logic to manage alliances
?>

<h1>Alliances</h1>
<p>Manage your alliances here.</p>
