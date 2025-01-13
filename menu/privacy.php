<?php
// privacy.php
echo "<h1>Privacy Settings</h1>";
// Add privacy settings content here

// privacy.php
echo "<h1>Privacy Settings</h1>";
echo "<form method='post' action='update_privacy.php'>";
echo "<label for='profile_visibility'>Profile Visibility:</label>";
echo "<select id='profile_visibility' name='profile_visibility'>";
echo "<option value='public'>Public</option>";
echo "<option value='friends'>Friends Only</option>";
echo "<option value='private'>Private</option>";
echo "</select><br>";
echo "<input type='submit' value='Save Privacy Settings'>";
echo "</form>";
?>
