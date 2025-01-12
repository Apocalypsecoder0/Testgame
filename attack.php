<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $target_user_id = $_POST['target_user_id'];
    // Logic to perform attack
    echo "Attacking user ID: $target_user_id";
}

?>

<h1>Attack</h1>
<form method="POST">
    <input type="text" name="target_user_id" placeholder="Target User ID" required>
    <button type="submit">Attack</button>
</form>
