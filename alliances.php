<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Logic to manage alliances
    <?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch all alliances
$stmt = $pdo->prepare("SELECT * FROM alliances");
$stmt->execute();
$alliances = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch user's alliances
$stmt = $pdo->prepare("SELECT a.* FROM alliances a JOIN alliance_members am ON a.id = am.alliance_id WHERE am.user_id = ?");
$stmt->execute([$user_id]);
$user_alliances = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle creating a new alliance
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_alliance'])) {
    $alliance_name = $_POST['alliance_name'];
    $description = $_POST['description'];

    // Insert new alliance into the alliances table
    $stmt = $pdo->prepare("INSERT INTO alliances (name, description) VALUES (?, ?)");
    if ($stmt->execute([$alliance_name, $description])) {
        $alliance_id = $pdo->lastInsertId();
        // Automatically add the creator as a member
        $stmt = $pdo->prepare("INSERT INTO alliance_members (alliance_id, user_id) VALUES (?, ?)");
        $stmt->execute([$alliance_id, $user_id]);
        echo "Alliance created successfully!";
    } else {
        echo "Failed to create alliance.";
    }
}

// Handle joining an alliance
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['join_alliance'])) {
    $alliance_id = $_POST['alliance_id'];

    // Insert new member into the alliance_members table
    $stmt = $pdo->prepare("INSERT INTO alliance_members (alliance_id, user_id) VALUES (?, ?)");
    if ($stmt->execute([$alliance_id, $user_id])) {
        echo "Successfully joined the alliance!";
    } else {
        echo "Failed to join the alliance or already a member.";
    }
}

// Handle leaving an alliance
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['leave_alliance'])) {
    $alliance_id = $_POST['alliance_id'];

    // Remove member from the alliance_members table
    $stmt = $pdo->prepare("DELETE FROM alliance_members WHERE alliance_id = ? AND user_id = ?");
    if ($stmt->execute([$alliance_id, $user_id])) {
        echo "Successfully left the alliance!";
    } else {
        echo "Failed to leave the alliance.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alliances</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Alliances</h1>

    <h2>Create New Alliance</h2>
    <form method="POST">
        <input type="text" name="alliance_name" placeholder="Alliance Name" required>
        <textarea name="description" placeholder="Alliance Description"></textarea>
        <button type="submit" name="create_alliance">Create Alliance</button>
    </form>

    <h2>Available Alliances</h2>
    <table>
        <thead>
            <tr>
                <th>Alliance Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($alliances) > 0): ?>
                <?php foreach ($alliances as $alliance): ?>
                    <tr>
                        <td><?= htmlspecialchars($alliance['name']) ?></td>
                        <td><?= htmlspecialchars($alliance['description']) ?></td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="alliance_id" value="<?= $alliance['id'] ?>">
                                <button type="submit" name="join_alliance">Join</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No alliances available.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <h2>Your Alliances</h2>
    <table>
        <thead>
            <tr>
                <th>Alliance Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($user_alliances) > 0): ?>
                <?php foreach ($user_alliances as $alliance): ?>
                    <tr>
                        <td><?= htmlspecialchars($alliance['name']) ?></td>
                        <td><?= htmlspecialchars($alliance['description']) ?></td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="alliance_id" value="<?= $alliance['id'] ?>">
                                <button type="submit" name="leave_alliance">Leave</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">You are not a member of any alliances.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="index.php">Back to Dashboard</a>
</body>
</html>
?>

<h1>Alliances</h1>
<p>Manage your alliances here.</p>
