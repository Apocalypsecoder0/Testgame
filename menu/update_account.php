<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // Validate and check for duplicates
    $stmt = $db->prepare("SELECT * FROM users WHERE username=? OR email=?");
    $stmt->execute([$username, $email]);
    
    if ($stmt->rowCount() == 0) {
        $stmt = $db->prepare("UPDATE users SET username=?, email=?, password=? WHERE user_id=?");
        $stmt->execute([$username, $email, $password, $_SESSION['user_id']]);
        echo "Account updated successfully.";
    } else {
        echo "Username or email already exists.";
    }
}
?>
