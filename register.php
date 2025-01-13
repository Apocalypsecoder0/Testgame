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
}// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $race = $_POST['race'];

    // Insert user into the database
    $stmt = $pdo->prepare("INSERT INTO users (username, password, race) VALUES (:username, :password, :race)");
    $stmt->execute(['username' => $username, 'password' => $password, 'race' => $race]);

    echo "Registration successful! Welcome, " . htmlspecialchars($username) . "!";
}
?>
<?>
!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="race">Select Race:</label>
        <select id="race" name="race" required>
            <option value="Human">Human</option>
            <option value="Alien">Alien</option>
            <option value="Robot">Robot</option>
            <option value="Wraith">Wraith</option>
        </select><br><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>
<form method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="email" name="email" placeholder="Email" required>
    <button type="submit">Register</button>
</form>
