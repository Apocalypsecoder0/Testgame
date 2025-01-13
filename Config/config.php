<?php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');
define('DB_NAME', 'game_db');

// Game Settings
define('GAME_NAME', 'Testgame Galactic Conquest');
define('MAX_PLAYERS', 1000);
define('TURNS_PER_HOUR', 10);
define('STARTING_RESOURCES', [
    'metal' => 500,
    'crystal' => 300,
    'deuterium' => 200,
]);

// Paths
define('BASE_URL', 'http://yourgameurl.com/');
define('ASSETS_PATH', BASE_URL . 'assets/');

// Time Settings
define('TICK_INTERVAL', 3600); // in seconds

// Enable Debugging
define('DEBUG_MODE', true);

// Other Configurations
define('ENABLE_REGISTRATION', true);
define('ENABLE_CHAT', true);
?>
