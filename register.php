<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
// In your registration script
$verificationToken = bin2hex(random_bytes(50));
$verificationLink = "http://yourdomain.com/verify_email.php?token=" . $verificationToken;

// Store the token in the database
$stmt = $pdo->prepare("INSERT INTO users (email, password, verification_token) VALUES (?, ?, ?)");
$stmt->execute([$email, $hashedPassword, $verificationToken]);

// Send verification email
$subject = "Email Verification";
$message = "Click the link to verify your email: " . $verificationLink;
mail($email, $subject, $message);
    $stmt = $pdo->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
    if ($stmt->execute([$username, $password, $email])) {
        echo "Registration successful!";
    } else {
        echo "Registration failed!";
    }
}
?>

<form method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="email" name="email" placeholder="Email" required>
    <button type="submit">Register</button>
</form>
