<?php
// notifications.php
echo "<h1>Notification Settings</h1>";
// Add notification settings content here

// notifications.php
echo "<h1>Notification Settings</h1>";
echo "<form method='post' action='update_notifications.php'>";
echo "<label for='email_notifications'>Email Notifications:</label>";
echo "<input type='checkbox' id='email_notifications' name='email_notifications' checked><br>";
echo "<label for='sms_notifications'>SMS Notifications:</label>";
echo "<input type='checkbox' id='sms_notifications' name='sms_notifications'><br>";
echo "<input type='submit' value='Save Notification Settings'>";
echo "</form>";
?>
