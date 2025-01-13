<?php
$settings = [
    'General' => 'general.php',
    'Account' => 'account.php',
    'Notifications' => 'notifications.php',
    'Privacy' => 'privacy.php',
    'Security' => 'security.php',
];

function renderMenu($settings) {
    echo '<ul class="settings-menu">';
    foreach ($settings as $name => $link) {
        echo "<li><a href=\"$link\">$name</a></li>";
    }
    echo '</ul>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings Menu</title>
    <style>
        .settings-menu {
            list-style-type: none;
            padding: 0;
        }
        .settings-menu li {
            margin: 5px 0;
        }
        .settings-menu a {
            text-decoration: none;
            color: #007BFF;
        }
        .settings-menu a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Settings</h1>
    <?php renderMenu($settings); ?>
</body>
</html>
