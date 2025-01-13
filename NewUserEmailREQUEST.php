<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming registration logic is here

    $to = "recipient@example.com"; // Change to your email
    $subject = "New Registration Notification";
    $message = "A new user has registered.";
    $headers = "From: no-reply@example.com"; // Change to your sender email

    if (mail($to, $subject, $message, $headers)) {
        echo "Email sent successfully.";
    } else {
        echo "Email sending failed.";
    }
}
?>
