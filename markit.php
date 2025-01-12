<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Logic to handle market trades

    <?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch available items for trade
$stmt = $pdo->prepare("SELECT * FROM items");
$stmt->execute();
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch player's inventory
$stmt = $pdo->prepare("SELECT * FROM player_inventory WHERE user_id = ?");
$stmt->execute([$user_id]);
$inventory = $stmt->fetchAll(PDO::FETCH_ASSOC);
$inventory_map = [];
foreach ($inventory as $item) {
    $inventory_map[$item['item_id']] = $item['quantity'];
}

// Handle trade action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['trade'])) {
    $item_id = $_POST['item_id'];
    $quantity = $_POST['quantity'];

    // Check if the player has enough items to sell
    if (isset($inventory_map[$item_id]) && $inventory_map[$item_id] >= $quantity) {
        // Calculate total price
        $stmt = $pdo->prepare("SELECT price FROM items WHERE id = ?");
        $stmt->execute([$item_id]);
        $item = $stmt->fetch(PDO::FETCH_ASSOC);
        $total_price = $item['price'] * $quantity;

        // Update inventory
        $new_quantity = $inventory_map[$item_id] - $quantity;
        $stmt = $pdo->prepare("UPDATE player_inventory SET quantity = ? WHERE user_id = ? AND item_id = ?");
        $stmt->execute([$new_quantity, $user_id, $item_id]);

        // Record the trade
        $stmt = $pdo->prepare("INSERT INTO trades (buyer_id, seller_id, item_id, quantity) VALUES (?, ?, ?, ?)");
        $stmt->execute([$user_id, 1, $item_id, $quantity]); // Assuming seller_id is 1 for this example

        echo "Trade successful! Sold $quantity of " . htmlspecialchars($item['name']) . " for $total_price.";
    } else {
        echo "Not enough items to sell.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market Trades</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Market Trades</h1>

    <h2>Available Items for Trade</h2>
    <ul>
        <?php foreach ($items as $item): ?>
            <li>
                <strong><?= htmlspecialchars($item['name']) ?></strong> - Price: <?= htmlspecialchars($item['price']) ?> each
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="item_id" value="<?= htmlspecialchars($item['id']) ?>">
                    <input type="number" name="quantity" min="1" max="<?= isset($inventory_map[$item['id']]) ? $inventory_map[$item['id']] : 0 ?>" required>
                    <button type="submit" name="trade">Sell</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

    <h2>Your Inventory</h2>
    <ul>
        <?php foreach ($inventory as $item): ?>
            <li>
                <strong><?= htmlspecialchars($item['item_id']) ?></strong> - Quantity: <?= htmlspecialchars($item['quantity']) ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <a href="index.php">Back to Dashboard</a>
</body>
</html>
?>

<h1>Market</h1>
<p>Trade your resources here.</p>
