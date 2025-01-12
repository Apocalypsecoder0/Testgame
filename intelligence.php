<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Logic to display intelligence reports

$user_id = $_SESSION['user_id'];

// Fetch intelligence reports for the logged-in user
$stmt = $pdo->prepare("SELECT * FROM intelligence_reports WHERE user_id = ? ORDER BY report_date DESC");
$stmt->execute([$user_id]);
$reports = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intelligence Reports</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Intelligence Reports</h1>

    <?php if (count($reports) > 0): ?>
        <ul>
            <?php foreach ($reports as $report): ?>
                <li>
                    <strong>Date:</strong> <?= htmlspecialchars($report['report_date']) ?><br>
                    <strong>Report:</strong> <?= htmlspecialchars($report['report_content']) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No intelligence reports available.</p>
    <?php endif; ?>

    <a href="index.php">Back to Dashboard</a>
</body>
</html>
?>

<h1>Intelligence</h1>
<p>View intelligence reports here.</p>
