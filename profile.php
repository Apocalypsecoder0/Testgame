<?php
session_start();
include 'db.php'; // Include database connection
// In update_profile.php
if (!hasPermission('update_profile')) {
    echo "Access denied.";
    exit();
}
// In profile.php
if (hasPermission('update_profile')) {
    echo '<a href="update_profile.php">Update Profile</a>';
}
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

// Fetch user details from the database
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>
<body>
    <h2>User Profile</h2>
    <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
    <p><strong>Race:</strong> <?php echo htmlspecialchars($user['race']); ?></p>
    <p><strong>Abilities:</strong> <?php echo htmlspecialchars($user['abilities']); ?></p>
  <p><strong>Role:</strong> <?php echo htmlspecialchars($user['role']); ?></p> <!-- Display user role -->
    <a href="logout.php">Logout</a>
</body>
</html>
