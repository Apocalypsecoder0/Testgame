<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM attack_log WHERE user_id = ?");
$stmt->execute([$user_id]);
$attacks = $stmt->fetchAll();
?>

<h1>Attack Log</h1>
<ul>
    <?php foreach ($attacks as $attack): ?>
        <li><?= $attack['description'] ?> at <?= $attack['timestamp'] ?></li>
    <?php endforeach; ?>
</ul>
