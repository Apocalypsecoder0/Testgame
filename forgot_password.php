<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Check if the email exists in the database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Generate a unique token
        $token = bin2hex(random_bytes(50));
        $expires = date("Y-m-d H:i:s", strtotime('+1 hour'));

        // Store the token and expiration in the database
        $stmt = $pdo->prepare("UPDATE users SET reset_token = ?, token_expires = ? WHERE email = ?");
        $stmt->execute([$token, $expires, $email]);
// In forgot_password.php
if ($user) {
    // Log successful attempt
    $stmt = $pdo->prepare("INSERT INTO password_reset_logs (email, status) VALUES (?, 'success')");
    $stmt->execute([$email]);
    // ... (rest of the code)
} else {
    // Log failed attempt
    $stmt = $pdo->prepare("INSERT INTO password_reset_logs (email, status) VALUES (?, 'failure')");
    $stmt->execute([$email]);
    echo "No user found with that email address.";
}
        // Send email with reset link
        $resetLink = "http://yourdomain.com/reset_password.php?token=" . $token;
        $subject = "Password Reset Request";
        $message = "Click the link to reset your password: " . $resetLink;
        mail($email, $subject, $message);

        echo "A password reset link has been sent to your email.";
    } else {
        echo "No user found with that email address.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
</head>
<body>
    <h1>Forgot Password</h1>
    <form method="POST">
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <button type="submit">Send Reset Link</button>
    </form>
</body>
</html>
