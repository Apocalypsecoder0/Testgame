<?php
include 'db.php';

// Fetch galaxies
$galaxies = $pdo->query("SELECT * FROM galaxies")->fetchAll(PDO::FETCH_ASSOC);

foreach ($galaxies as $galaxy) {
    echo "Galaxy: " . $galaxy['name'] . "<br>";
    
    // Fetch systems for the galaxy
    $systems = $pdo->prepare("SELECT * FROM systems WHERE galaxy_id = :galaxy_id");
    $systems->execute(['galaxy_id' => $galaxy['id']]);
    $systems = $systems->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($systems as $system) {
        echo "  System: " . $system['name'] . "<br>";
        
        // Fetch planets for the system
        $planets = $pdo->prepare("SELECT * FROM planets WHERE system_id = :system_id");
        $planets->execute(['system_id' => $system['id']]);
        $planets = $planets->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($planets as $planet) {
            echo "    Planet: " . $planet['name'] . " | Resources: Metal: " . $planet['metal'] . ", Crystal: " . $planet['crystal'] . ", Deuterium: " . $planet['deuterium'] . " | Status: " . $planet['status'] . "<br>";
        }
    }
    echo "<br>";
}
?>
