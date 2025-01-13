<?php
session_start();

// Sample game state
if (!isset($_SESSION['game_state'])) {
    $_SESSION['game_state'] = [
        'player_name' => '',
        'resources' => 100,
        'units' => 5,
        'turn' => 1,
    ];
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name'])) {
        $_SESSION['game_state']['player_name'] = htmlspecialchars($_POST['name']);
    }
    if (isset($_POST['action'])) {
        // Example action: End turn
        if ($_POST['action'] === 'end_turn') {
            $_SESSION['game_state']['turn']++;
            $_SESSION['game_state']['resources'] += 10; // Gain resources each turn
        }
    }
}

// Game state variables
$playerName = $_SESSION['game_state']['player_name'];
$resources = $_SESSION['game_state']['resources'];
$units = $_SESSION['game_state']['units'];
$turn = $_SESSION['game_state']['turn'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Text-Based RTS MMORPG</title>
</head>
<body>
    <h1>Welcome to the Text-Based RTS MMORPG</h1>
    
    <?php if (empty($playerName)): ?>
        <form method="POST">
            <label for="name">Enter your name:</label>
            <input type="text" id="name" name="name" required>
            <button type="submit">Start Game</button>
        </form>
    <?php else: ?>
        <h2>Hello, <?php echo $playerName; ?>!</h2>
        <p>Turn: <?php echo $turn; ?></p>
        <p>Resources: <?php echo $resources; ?></p>
        <p>Units: <?php echo $units; ?></p>

        <form method="POST">
            <button type="submit" name="action" value="end_turn">End Turn</button>
        </form>
    <?php endif; ?>
</body>
</html>
