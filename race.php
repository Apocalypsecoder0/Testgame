<?php
include 'db.php'; // Include database connection

// Fetch available races (you can also hardcode them as shown in register.php)
$races = ['Human', 'Alien', 'Robot', 'Wraith'];

// Display the available races
echo "<h2>Available Races</h2>";
echo "<ul>";
foreach ($races as $race) {
    echo "<li>" . htmlspecialchars($race) . "</li>";
}
echo "</ul>";

echo "<h2>Register for a Race</h2>";
echo "<form method='POST' action='register.php'>";
echo "<label for='username'>Username:</label>";
echo "<input type='text' id='username' name='username' required><br><br>";

echo "<label for='password'>Password:</label>";
echo "<input type='password' id='password' name='password' required><br><br>";

echo "<label for='race'>Select Race:</label>";
echo "<select id='race' name='race' required>";
foreach ($races as $race) {
    echo "<option value='" . htmlspecialchars($race) . "'>" . htmlspecialchars($race) . "</option>";
}
echo "</select><br><br>";

echo "<input type='submit' value='Register'>";
echo "</form>";
?>
