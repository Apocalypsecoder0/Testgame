<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = $_POST['to'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $headers = "From: your-email@example.com";

    if (mail($to, $subject, $message, $headers)) {
        echo "Message sent successfully!";
    } else {
        echo "Failed to send message.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Send Message</title>
</head>
<body>
    <form method="post" action="send_message.php">
        To: <input type="email" name="to" required><br>
        Subject: <input type="text" name="subject" required><br>
        Message:<br>
        <textarea name="message" required></textarea><br>
        <input type="submit" value="Send Message">
    </form>
</body>
</html>
