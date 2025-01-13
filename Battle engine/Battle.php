
<?php
// Database connection
$host = 'localhost';
$db = 'ogame';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to calculate damage
function calculateDamage($attackerFleet, $defenderFleet) {
    $totalAttack = 0;
    foreach ($attackerFleet as $ship) {
        $totalAttack += $ship['attack_power'] * $ship['quantity'];
    }

    $totalDefense = 0;
    foreach ($defenderFleet as $ship) {
        $totalDefense += $ship['defense_points'] * $ship['quantity'];
    }

    $damage = $totalAttack - $totalDefense;
    return max($damage, 0); // Damage can't be negative
}

// Fetch fleets from the database
$attackerId = 1; // Example attacker ID
$defenderId = 2; // Example defender ID

$attackerFleet = $conn->query("SELECT * FROM fleets WHERE player_id = $attackerId")->fetch_all(MYSQLI_ASSOC);
$defenderFleet = $conn->query("SELECT * FROM fleets WHERE player_id = $defenderId")->fetch_all(MYSQLI_ASSOC);

// Calculate damage
$damageDealt = calculateDamage($attackerFleet, $defenderFleet);
echo "Damage dealt by attacker: " . $damageDealt;

// Close connection
$conn->close();
?>
