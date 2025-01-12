<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Logic to handle market trades
?>

<h1>Market</h1>
<p>Trade your resources here.</p>
