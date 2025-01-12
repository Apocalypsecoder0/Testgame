<?php
session_start();
include 'db.php';

// Check if the user is an admin (this is a simple check; implement proper authentication in a real app)
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: index.php");
    exit();
}

// Handle new update submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Insert new update into the database
    $stmt = $pdo->prepare("INSERT INTO game_updates (title, content) VALUES (?, ?)");
    $stmt->execute([$title, $content]);

    echo "New update added successfully!";
    // Redirect to updates page
    header("Location: updates.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Game Update</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Add Game Update</h1>
    <form method="POST">
        <label for="title">Title:</label><br>
        <input type="text" name="title" required><br><br>
        
        <label for="content">Content:</label><br>
        <textarea name="content" rows="5" required></textarea><br><br>
        
        <button type="submit" name="submit">Add Update</button>
    </form>

    <a href="updates.php">Back to Updates</a>
</body>
</html>
