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
}/<?php

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $race = $_POST['race'];
    $email = $_POST['email'];

    // Define race-specific abilities
    $abilities = '';
    switch ($race) {
        case 'Human':
            $abilities = 'Adaptability, Diplomacy';
            break;
        case 'Alien':
            $abilities = 'Telepathy, Advanced Technology';
            break;
        case 'Androids':
            $abilities = 'Strength, Precision';
            break;
        case 'Wraith':
            $abilities = 'Regeneration, Stealth';
            break;
    }

    // Insert user into the database
// In register.php, after inserting the user
$role_id = 3; // Default role_id for 'user'
$stmt = $pdo->prepare("INSERT INTO users (username, password, race, email, abilities, role_id) VALUES (:username, :password, :race, :email, :abilities, :role_id)");
$stmt->execute(['username' => $username, 'password' => $password, 'race' => $race, 'email' => $email, 'abilities' => $abilities, 'role_id' => $role_id]);
    echo "Registration successful! Welcome, " . htmlspecialchars($username) . "!";
}
?>

<!DOCTYPE html>
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

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="race">Select Race:</label>
        <select id="race" name="race" required>
            <option value="Human">Human</option>
            <option value="Alien">Alien</option>
            <option value="Android">Android</option>
            <option value="Wraith">Wraith</option>
        </select><br><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>
</html>
<form method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="email" name="email" placeholder="Email" required>
    <button type="submit">Register</button>
</form>
