<?php
include 'db.php';

// Sample data
$galaxies = [
    'Galaxy 1',
    'Galaxy 2',
    'Galaxy 3'
];

$systems = [
    ['Galaxy 1', 'System 1'],
    ['Galaxy 1', 'System 2'],
    ['Galaxy 2', 'System 1'],
    ['Galaxy 2', 'System 2'],
    ['Galaxy 3', 'System 1']
];

$planets = [
    ['System 1', 'Alpha', 500, 300, 100, 'Unoccupied'],
    ['System 1', 'Beta', 600, 200, 150, 'Occupied'],
    ['System 2', 'Gamma', 400, 400, 200, 'Unoccupied'],
    ['System 2', 'Delta', 700, 100, 50, 'Under Attack'],
    ['System 1', 'Epsilon', 300, 500, 250, 'Unoccupied']
];

// Insert galaxies
foreach ($galaxies as $galaxy) {
    $stmt = $pdo->prepare("INSERT INTO galaxies (name) VALUES (:name)");
    $stmt->execute(['name' => $galaxy]);
}

// Insert systems
foreach ($systems as $system) {
    $galaxyId = $pdo->query("SELECT id FROM galaxies WHERE name = '{$system[0]}'")->fetchColumn();
    $stmt = $pdo->prepare("INSERT INTO systems (galaxy_id, name) VALUES (:galaxy_id, :name)");
    $stmt->execute(['galaxy_id' => $galaxyId, 'name' => $system[1]]);
}

// Insert planets
foreach ($planets as $planet) {
    $systemId = $pdo->query("SELECT id FROM systems WHERE name = '{$planet[0]}'")->fetchColumn();
    $stmt = $pdo->prepare("INSERT INTO planets (system_id, name, metal, crystal, deuterium, status) VALUES (:system_id, :name, :metal, :crystal, :deuterium, :status)");
    $stmt->execute([
        'system_id' => $systemId,
        'name' => $planet[1],
        'metal' => $planet[2],
        'crystal' => $planet[3],
        'deuterium' => $planet[4],
        'status' => $planet[5]
    ]);
}

echo "Sample data inserted successfully.";
?>
