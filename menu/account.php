<?php
// account.php
echo "<h1>Account Settings</h1>";
// Add account settings content here
// account.php
echo "<h1>Account Settings</h1>";
echo "<form method='post' action='update_account.php'>";
echo "<label for='username'>Username:</label>";
echo "<input type='text' id='username' name='username' required><br>";
echo "<label for='email'>Email:</label>";
echo "<input type='email' id='email' name='email' required><br>";
echo "<label for='password'>Password:</label>";
echo "<input type='password' id='password' name='password' required><br>";
echo "<input type='submit' value='Update Account'>";
echo "</form>";
?>
