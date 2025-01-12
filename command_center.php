<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM game_data WHERE user_id = ?");
$stmt->execute([$user_id]);
$game_data = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Logic to upgrade command center
    $new_level = $game_data['command_center_level'] + 1;
    $stmt = $pdo->prepare("UPDATE game_data SET command_center_level = ? WHERE user_id = ?");
    $stmt->execute([$new_level, $user_id]);
    header("Location: command_center.php");
}

?>

<h1>Command Center</h1>
<p>Current Level: <?= $game_data['command_center_level'] ?></p>
<form method="POST">
    <button type="submit">Upgrade Command Center</button>
</form>
