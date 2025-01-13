<?php
$title = "Contact Us";
include('header.php');
?>

<h1>Contact Us</h1>
<form action="send_message.php" method="post">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    
    <label for="message">Message:</label>
    <textarea id="message" name="message" required></textarea>
    
    <button type="submit">Send</button>
</form>

<h2>Our Contact Information</h2>
<p>Email: info@example.com</p>
<p>Phone: none</p>
<p>Address: github</p>

<div class="map">
    <h3>Find Us Here</h3>
    <iframe src="https://www.google.com/maps/embed?..."></iframe>
</div>

<?php include('footer.php'); ?>
