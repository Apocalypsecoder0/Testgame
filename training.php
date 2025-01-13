<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Logic to train troops
    

class Troop {
    public $name;
    public $experience;

    public function __construct($name) {
        $this->name = $name;
        $this->experience = 0; // Initial experience
    }

    public function train($hours) {
        $this->experience += $hours * 10; // Gain experience based on training hours
        echo "{$this->name} trained for {$hours} hours and gained " . ($hours * 10) . " experience points.\n";
    }
}

class TrainingCamp {
    private $troops = [];

    public function addTroop($troop) {
        $this->troops[] = $troop;
    }

    public function conductTraining($hours) {
        foreach ($this->troops as $troop) {
            $troop->train($hours);
        }
    }

    public function showTroopExperience() {
        foreach ($this->troops as $troop) {
            echo "{$troop->name} has {$troop->experience} experience points.\n";
        }
    }
}

// Example usage
$camp = new TrainingCamp();
$camp->addTroop(new Troop("Alpha"));
$camp->addTroop(new Troop("Bravo"));

$camp->conductTraining(5); // Train for 5 hours
$camp->showTroopExperience();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch troop types
$stmt = $pdo->prepare("SELECT * FROM troop_types");
$stmt->execute();
$troop_types = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch player's resources
$stmt = $pdo->prepare("SELECT resources FROM player_resources WHERE user_id = ?");
$stmt->execute([$user_id]);
$player_resources = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch training queue
$stmt = $pdo->prepare("SELECT * FROM training_queue WHERE user_id = ?");
$stmt->execute([$user_id]);
$training_queue = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle troop training
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['train'])) {
    $troop_type_id = $_POST['troop_type_id'];
    $quantity = $_POST['quantity'];

    // Fetch troop type details
    $stmt = $pdo->prepare("SELECT * FROM troop_types WHERE id = ?");
    $stmt->execute([$troop_type_id]);
    $troop_type = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the player has enough resources
    $total_cost = $troop_type['cost'] * $quantity;
    if ($player_resources['resources'] >= $total_cost) {
        // Deduct resources
        $new_resources = $player_resources['resources'] - $total_cost;
        $stmt = $pdo->prepare("UPDATE player_resources SET resources = ? WHERE user_id = ?");
        $stmt->execute([$new_resources, $user_id]);

        // Start training
        $stmt = $pdo->prepare("INSERT INTO training_queue (user_id, troop_type_id, quantity, start_time) VALUES (?, ?, ?, NOW())");
        $stmt->execute([$user_id, $troop_type_id, $quantity]);

        echo "Training of " . htmlspecialchars($quantity) . " " . htmlspecialchars($troop_type['name']) . "(s) started!";
        // Refresh the page to update the list
        header("Refresh:0");
        exit();
    } else {
        echo "Not enough resources to train this troop.";
    }
}

// Check for completed training
foreach ($training_queue as $training) {
    $stmt = $pdo->prepare("SELECT * FROM troop_types WHERE id = ?");
    $stmt->execute([$training['troop_type_id']]);
    $troop_type = $stmt->fetch(PDO::FETCH_ASSOC);

    $elapsed_time = (new DateTime())->getTimestamp() - (new DateTime($training['start_time']))->getTimestamp();
    if ($elapsed_time >= $troop_type['training_time']) {
        // Mark training as completed
        $stmt = $pdo->prepare("UPDATE training_queue SET status = 'completed' WHERE id = ?");
        $stmt->execute([$training['id']]);
        echo "Training of " . htmlspecialchars($training['quantity']) . " " . htmlspecialchars($troop_type['name']) . "(s) completed!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Train Troops</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Train Troops</h1>

    <h2>Your Resources: <?= htmlspecialchars($player_resources['resources']) ?></h2>

    <h2>Available Troop Types</h2>
    <ul>
        <?php foreach ($troop_types as $troop_type): ?>
            <li>
                <strong><?= htmlspecialchars($troop_type['name']) ?></strong><br>
                Cost: <?= htmlspecialchars($troop_type['cost']) ?> resources<br>
                Training Time: <?= htmlspecialchars($troop_type['training_time']) ?> seconds<br>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="troop_type_id" value="<?= htmlspecialchars($troop_type['id']) ?>">
                    <label for="quantity">Quantity:</label>
                    <input type="number" name="quantity" min="1" required>
                    <button type="submit" name="train">Train</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

    <h2>Your Training Queue</h2>
    <ul>
        <?php if (count($training_queue) > 0): ?>
            <?php foreach ($training_queue as $training): ?>
                <?php
                $stmt = $pdo->prepare("SELECT * FROM troop_types WHERE id = ?");
                $stmt->execute([$training['troop_type_id']]);
                $troop_type = $stmt->fetch(PDO::FETCH_ASSOC);
                ?>
                <li>
                    <?= htmlspecialchars($training['quantity']) ?> <?= htmlspecialchars($troop_type['name']) ?> - 
                    Status: <?= htmlspecialchars($training['status']) ?>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>No troops in training.</li>
        <?php endif; ?>
    </ul>

    <a href="index.php">Back to Dashboard</a>
</body>
</html>
?>

<h1>Training</h1>
<p>Train your troops here.</p>
