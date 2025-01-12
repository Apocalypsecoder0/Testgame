<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Logic to display and manage armory items
    $user_id = $_SESSION['user_id'];

// Fetch armory items for the logged-in user
$stmt = $pdo->prepare("SELECT * FROM armory WHERE user_id = ?");
$stmt->execute([$user_id]);
$armory_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle adding a new item
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_item'])) {
    $item_name = $_POST['item_name'];
    $item_type = $_POST['item_type'];
    $quantity = $_POST['quantity'];

    // Insert new item into the armory
    $stmt = $pdo->prepare("INSERT INTO armory (user_id, item_name, item_type, quantity) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$user_id, $item_name, $item_type, $quantity])) {
        echo "Item added successfully!";
    } else {
        echo "Failed to add item.";
    }
}

// Handle removing an item
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_item'])) {
    $item_id = $_POST['item_id'];

    // Delete item from the armory
    $stmt = $pdo->prepare("DELETE FROM armory WHERE id = ? AND user_id = ?");
    if ($stmt->execute([$item_id, $user_id])) {
        echo "Item removed successfully!";
    } else {
        echo "Failed to remove item.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Armory</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Your Armory</h1>

    <h2>Current Items</h2>
    <table>
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Item Type</th>
                <th>Quantity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($armory_items) > 0): ?>
                <?php foreach ($armory_items as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['item_name']) ?></td>
                        <td><?= htmlspecialchars($item['item_type']) ?></td>
                        <td><?= htmlspecialchars($item['quantity']) ?></td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
                                <button type="submit" name="remove_item">Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No items in your armory.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <h2>Add New Item</h2>
    <form method="POST">
        <input type="text" name="item_name" placeholder="Item Name" required>
        <input type="text" name="item_type" placeholder="Item Type" required>
        <input type="number" name="quantity" placeholder="Quantity" required min="1">
        <button type="submit" name="add_item">Add Item</button>
    </form>

    <a href="index.php">Back to Dashboard</a>
</body>
</html>
?>

<h1>Armory</h1>
<p>Manage your weapons and defenses here.</p>
