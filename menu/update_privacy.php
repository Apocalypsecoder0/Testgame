<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $profile_visibility = isset($_POST['profile_visibility']) ? 1 : 0;
    $data_sharing = isset($_POST['data_sharing']) ? 1 : 0;

    $stmt = $db->prepare("UPDATE users SET profile_visibility=?, data_sharing=? WHERE user_id=?");
    $stmt->execute([$profile_visibility, $data_sharing, $_SESSION['user_id']]);
    echo "Privacy settings updated.";
}
?>
