<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Logic to display technologies

$user_id = $_SESSION['user_id'];

// Fetch all technologies
$stmt = $pdo->prepare("SELECT * FROM technologies");
$stmt->execute();
$technologies = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch player's unlocked technologies
$stmt = $pdo->prepare("SELECT technology_id FROM player_technologies WHERE user_id = ?");
$stmt->execute([$user_id]);
$unlocked_technologies = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Function to check if a technology can be unlocked
function canUnlock($technology, $unlocked_technologies) {
    if (empty($technology['prerequisites'])) {
        return true; // No prerequisites
    }
    $prerequisites = explode(',', $technology['prerequisites']);
    foreach ($prerequisites as $prerequisite) {
        if (!in_array(trim($prerequisite), $unlocked_technologies)) {
            return false; // At least one prerequisite is not unlocked
        }
    }
    return true; // All prerequisites are unlocked
}

// Handle unlocking technology
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['unlock'])) {
    $technology_id = $_POST['technology_id'];

    // Check if the technology can be unlocked
    $stmt = $pdo->prepare("SELECT * FROM technologies WHERE id = ?");
    $stmt->execute([$technology_id]);
    $technology = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($technology && canUnlock($technology, $unlocked_technologies)) {
        // Unlock the technology
        $stmt = $pdo->prepare("INSERT INTO player_technologies (user_id, technology_id) VALUES (?, ?)");
        $stmt->execute([$user_id, $technology_id]);

        echo "Technology " . htmlspecialchars($technology['name']) . " unlocked!";
        // Refresh the page to update the list
        header("Refresh:0");
        exit();
    } else {
        echo "Cannot unlock this technology. Check prerequisites.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technologies</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Available Technologies</h1>

    <ul>
        <?php foreach ($technologies as $technology): ?>
            <li>
                <strong><?= htmlspecialchars($technology['name']) ?></strong><br>
                <em><?= htmlspecialchars($technology['description']) ?></em><br>
                <?php if (in_array($technology['id'], $unlocked_technologies)): ?>
                    <span style="color: green;">Unlocked</span>
                <?php else: ?>
                    <span style="color: red;">Locked</span><br>
                    <em>Prerequisites: <?= htmlspecialchars($technology['prerequisites']) ?: 'None' ?></em><br>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="technology_id" value="<?= htmlspecialchars($technology['id']) ?>">
                        <button type="submit" name="unlock">Unlock</button>
                    </form>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <a href="index.php">Back to Dashboard</a>
</body>
</html>
?>

<h1>Technologies</h1>
<p>View available technologies here.</p>
