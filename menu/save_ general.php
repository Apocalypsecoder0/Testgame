<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $bio = htmlspecialchars($_POST['bio']);
    
    // Validate input
    if (!empty($name) && !empty($bio)) {
        // Assume $db is your database connection
        $stmt = $db->prepare("UPDATE users SET name=?, bio=? WHERE user_id=?");
        $stmt->execute([$name, $bio, $_SESSION['user_id']]);
        echo "Profile updated successfully.";
    } else {
        echo "Please fill in all fields.";
    }
}
?>
