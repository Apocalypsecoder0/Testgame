<?php
// security.php
echo "<h1>Security Settings</h1>";
// Add security settings content here

// security.php
echo "<h1>Security Settings</h1>";
echo "<form method='post' action='update_security.php'>";
echo "<label for='two_factor'>Enable Two-Factor Authentication:</label>";
echo "<input type='checkbox' id='two_factor' name='two_factor'><br>";
echo "<label for='security_question'>Security Question:</label>";
echo "<select id='security_question' name='security_question'>";
echo "<option value='pet_name'>What is your pet's name?</option>";
echo "<option value='mother_maiden'>What is your mother's maiden name?</option>";
echo "<option value='birth_city'>In what city were you born?</option>";
echo "</select><br>";
echo "<label for='security_answer'>Answer:</label>";
echo "<input type='text' id='security_answer' name='security_answer' required><br>";
echo "<input type='submit' value='Update Security Settings'>";
echo "</form>";
?>
