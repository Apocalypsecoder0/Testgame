<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
    header('Pragma:no-cache');

    if ( !file_exists ("config.php")) {
        include ("install.php");
        die ();
    }
    
    include ("home.php");
?>
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM game_data WHERE user_id = ?");
$stmt->execute([$user_id]);
$game_data = $stmt->fetch();
?>

<h1>Welcome to the Game!</h1>
<p>Command Center Level: <?= $game_data['command_center_level'] ?></p>
<a href="logout.php">Logout</a>
<a href="command_center.php">Command Center</a>
<a href="attack.php">Attack</a>
