<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch the user's command center
$stmt = $pdo->prepare("SELECT * FROM command_centers WHERE user_id = ?");
$stmt->execute([$user_id]);
$command_center = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch the upgrade details for the next level
$stmt = $pdo->prepare("SELECT * FROM upgrades WHERE level = ?");
$stmt->execute([$command_center['level'] + 1]);
$next_upgrade = $stmt->fetch(PDO::FETCH_ASSOC);

// Handle upgrade action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upgrade'])) {
    if ($next_upgrade && $command_center['resources'] >= $next_upgrade['cost']) {
        // Deduct the cost and upgrade the command center
        $new_resources = $command_center['resources'] - $next_upgrade['cost'];
        $new_level = $command_center['level'] + 1;

        // Update command center in the database
        $stmt = $pdo->prepare("UPDATE command_centers SET level = ?, resources = ? WHERE user_id = ?");
        $stmt->execute([$new_level, $new_resources, $user_id]);

        // Optionally, increase resource production
        // (This can be implemented based on your game's logic)

        echo "Command Center upgraded to level " . $new_level . "!";
    } else {
        echo "Not enough resources to upgrade or no further upgrades available.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upgrade Command Center</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Upgrade Command Center</h1>

    <h2>Your Command Center</h2>
    <p>Level: <?= htmlspecialchars($command_center['level']) ?></p>
    <p>Resources: <?= htmlspecialchars($command_center['resources']) ?></p>

    <?php if ($next_upgrade): ?>
        <h2>Next Upgrade</h2>
        <p>Upgrade Level: <?= htmlspecialchars($next_upgrade['level']) ?></p>
        <p>Cost: <?= htmlspecialchars($next_upgrade['cost']) ?> resources</p>
        <p>Resource Increase: <?= htmlspecialchars($next_upgrade['resource_increase']) ?> resources per hour</p>

        <form method="POST">
            <button type="submit" name="upgrade">Upgrade Command Center</button>
        </form>
    <?php else: ?>
        <p>No further upgrades available for your Command Center.</p>
    <?php endif; ?>

    <a href="index.php">Back to Dashboard</a>
</body>
</html>
