<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $target_user_id = $_POST['target_user_id'];
    // Logic to perform attack
    <?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch the attacking player
$stmt = $pdo->prepare("SELECT * FROM players WHERE id = ?");
$stmt->execute([$user_id]);
$attacker = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch the target player (for example, the player with ID 2)
$target_id = 2; // This should be dynamically set based on your game's logic
$stmt = $pdo->prepare("SELECT * FROM players WHERE id = ?");
$stmt->execute([$target_id]);
$target = $stmt->fetch(PDO::FETCH_ASSOC);

// Handle attack action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['attack'])) {
    // Calculate damage
    $base_damage = $attacker['attack_power'];
    $damage = max(0, $base_damage - $target['defense']); // Ensure damage is not negative

    // Update target's health
    $new_health = max(0, $target['health'] - $damage);
    $stmt = $pdo->prepare("UPDATE players SET health = ? WHERE id = ?");
    $stmt->execute([$new_health, $target_id]);

    // Check if the target is defeated
    if ($new_health == 0) {
        echo "You have defeated " . htmlspecialchars($target['username']) . "!";
        // Optionally, award experience points
        $stmt = $pdo->prepare("UPDATE players SET experience = experience + 10 WHERE id = ?");
        $stmt->execute([$user_id]);
    } else {
        echo htmlspecialchars($target['username']) . " has " . $new_health . " health remaining.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attack</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Attack</h1>

    <h2>Your Stats</h2>
    <p>Username: <?= htmlspecialchars($attacker['username']) ?></p>
    <p>Health: <?= htmlspecialchars($attacker['health']) ?></p>
    <p>Attack Power: <?= htmlspecialchars($attacker['attack_power']) ?></p>
    <p>Defense: <?= htmlspecialchars($attacker['defense']) ?></p>

    <h2>Target Stats</h2>
    <p>Username: <?= htmlspecialchars($target['username']) ?></p>
    <p>Health: <?= htmlspecialchars($target['health']) ?></p>
    <p>Attack Power: <?= htmlspecialchars($target['attack_power']) ?></p>
    <p>Defense: <?= htmlspecialchars($target['defense']) ?></p>

    <form method="POST">
        <button type="submit" name="attack">Attack</button>
    </form>

    <a href="index.php">Back to Dashboard</a>
</body>
</html>
    echo "Attacking user ID: $target_user_id";
}

?>

<h1>Attack</h1>
<form method="POST">
    <input type="text" name="target_user_id" placeholder="Target User ID" required>
    <button type="submit">Attack</button>
</form>
