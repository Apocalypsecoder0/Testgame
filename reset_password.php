<?php
session_start();
include 'db.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Check if the token is valid and not expired
    $stmt = $pdo->prepare("SELECT * FROM users WHERE reset_token = ? AND token_expires > NOW()");
    $stmt->execute([$token]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "Invalid or expired token.";
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // Update the user's password and clear the reset token
        $stmt = $pdo->prepare("UPDATE users SET password = ?, reset_token = NULL, token_expires = NULL WHERE id = ?");
        $stmt->execute([$newPassword, $user['id']]);

        echo "Your password has been reset successfully.";
        // Optionally redirect to login page
        header("Location: login.php");
        exit();
    }
} else {
    echo "No token provided.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
</head>
<body>
    <h1>Reset Password</h1>
    <form method="POST">
        <label for="password">New Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Reset Password</button>
    </form>
</body>
</html>
