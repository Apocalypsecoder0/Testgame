<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'] ?? null; // Assuming user is logged in
    $errorMessage = $_POST['error_message'];
    $errorFile = $_POST['error_file'];
    $errorLine = $_POST['error_line'];

    // Prepare the SQL statement
    $stmt = $pdo->prepare("INSERT INTO bug_reports (user_id, error_message, error_file, error_line) VALUES (?, ?, ?, ?)");
    $stmt->execute([$userId, $errorMessage, $errorFile, $errorLine]);

    echo "Bug report submitted successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Report a Bug</title>
</head>
<body>
    <h1>Report a Bug</h1>
    <form method="POST">
        <div>
            <label for="error_message">Error Message:</label>
            <textarea name="error_message" required></textarea>
        </div>
        <div>
            <label for="error_file">Error File:</label>
            <input type="text" name="error_file" required>
        </div>
        <div>
            <label for="error_line">Error Line:</label>
            <input type="number" name="error_line" required>
        </div>
        <button type="submit">Submit Bug Report</button>
    </form>
</body>
</html>
