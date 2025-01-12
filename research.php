<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Logic to handle research

$user_id = $_SESSION['user_id'];

// Fetch available research projects
$stmt = $pdo->prepare("SELECT * FROM research_projects");
$stmt->execute();
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch player's ongoing research
$stmt = $pdo->prepare("SELECT * FROM player_research WHERE user_id = ? AND status = 'in_progress'");
$stmt->execute([$user_id]);
$ongoing_research = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle research action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['research'])) {
    $project_id = $_POST['project_id'];

    // Fetch project details
    $stmt = $pdo->prepare("SELECT * FROM research_projects WHERE id = ?");
    $stmt->execute([$project_id]);
    $project = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the player has enough resources
    // Assuming you have a resources table or similar to check player resources
    $stmt = $pdo->prepare("SELECT resources FROM player_resources WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $player_resources = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($player_resources['resources'] >= $project['cost']) {
        // Deduct the cost from player's resources
        $new_resources = $player_resources['resources'] - $project['cost'];
        $stmt = $pdo->prepare("UPDATE player_resources SET resources = ? WHERE user_id = ?");
        $stmt->execute([$new_resources, $user_id]);

        // Start the research
        $stmt = $pdo->prepare("INSERT INTO player_research (user_id, project_id, start_time) VALUES (?, ?, NOW())");
        $stmt->execute([$user_id, $project_id]);

        echo "Research on " . htmlspecialchars($project['name']) . " started!";
    } else {
        echo "Not enough resources to start this research.";
    }
}

// Check for completed research
foreach ($ongoing_research as $research) {
    $stmt = $pdo->prepare("SELECT * FROM research_projects WHERE id = ?");
    $stmt->execute([$research['project_id']]);
    $project = $stmt->fetch(PDO::FETCH_ASSOC);

    $elapsed_time = (new DateTime())->getTimestamp() - (new DateTime($research['start_time']))->getTimestamp();
    if ($elapsed_time >= $project['duration']) {
        // Mark research as completed
        $stmt = $pdo->prepare("UPDATE player_research SET status = 'completed' WHERE id = ?");
        $stmt->execute([$research['id']]);
        echo "Research on " . htmlspecialchars($project['name']) . " completed!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Research Projects</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Research Projects</h1>

    <h2>Available Research Projects</h2>
    <ul>
        <?php foreach ($projects as $project): ?>
            <li>
                <strong><?= htmlspecialchars($project['name']) ?></strong> - Cost: <?= htmlspecialchars($project['cost']) ?> resources<br>
                <em><?= htmlspecialchars($project['description']) ?></em>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="project_id" value="<?= htmlspecialchars($project['id']) ?>">
                    <button type="submit" name="research">Start Research</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

    <h2>Your Ongoing Research</h2>
    <ul>
        <?php if (count($ongoing_research) > 0): ?>
            <?php foreach ($ongoing_research as $research): ?>
                <li>
                    <?php
                    $stmt = $pdo->prepare("SELECT * FROM research_projects WHERE id = ?");
                    $stmt->execute([$research['project_id']]);
                    $project = $stmt->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <strong><?= htmlspecialchars($project['name']) ?></strong> - In Progress
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>No ongoing research.</li>
        <?php endif; ?>
    </ul>

    <a href="index.php">Back to Dashboard</a>
</body>
</html>
?>

<h1>Research</h1>
<p>Research new technologies here.</p>
