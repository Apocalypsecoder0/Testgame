<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email_notifications = isset($_POST['email_notifications']) ? 1 : 0;
    $sms_notifications = isset($_POST['sms_notifications']) ? 1 : 0;

    $stmt = $db->prepare("UPDATE users SET email_notifications=?, sms_notifications=? WHERE user_id=?");
    $stmt->execute([$email_notifications, $sms_notifications, $_SESSION['user_id']]);
    echo "Notification settings updated.";
}
?>
