<?php
include 'db.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verify the token
    $stmt = $pdo->prepare("SELECT * FROM users WHERE verification_token = ?");
    $stmt->execute([$token]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Update user status to verified
        $stmt = $pdo->prepare("UPDATE users SET verified = 1, verification_token = NULL WHERE id = ?");
        $stmt->execute([$user['id']]);
        echo "Email verified successfully!";
    } else {
        echo "Invalid verification token.";
    }
} else {
    echo "No token provided.";
}
?>
