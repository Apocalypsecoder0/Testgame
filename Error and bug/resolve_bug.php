<?php
session_start();
include 'db.php';

// Check if the user is an admin
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    die("Access denied.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Update the bug report status to resolved
    $stmt = $pdo->prepare("UPDATE bug_reports SET status = 'resolved' WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: admin_bugs.php");
    exit();
}
?>
