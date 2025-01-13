<?php
// general.php
echo "<h1>General Settings</h1>";
// Add general settings content here

// general.php
echo "<h1>General Settings</h1>";
echo "<form method='post' action='save_general.php'>";
echo "<label for='site_name'>Site Name:</label>";
echo "<input type='text' id='site_name' name='site_name' required><br>";
echo "<label for='site_description'>Site Description:</label>";
echo "<textarea id='site_description' name='site_description' required></textarea><br>";
echo "<input type='submit' value='Save Settings'>";
echo "</form>";

?>
