<?php
// Database connection
$mysqli = new mysqli("localhost", "username", "password", "database");

// Email notification function
function sendEmailNotification($bugReport) {
    $to = "admin@example.com";
    $subject = "New Bug Report Submitted";
    $message = "A new bug report has been submitted:\n\n" . print_r($bugReport, true);
    mail($to, $subject, $message);
}

// Bug report submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $mysqli->real_escape_string(trim($_POST['title']));
    $description = $mysqli->real_escape_string(trim($_POST['description']));
    
    // Insert bug report into the database
    $stmt = $mysqli->prepare("INSERT INTO bug_reports (title, description) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $description);
    $stmt->execute();
    
    // Send email notification
    sendEmailNotification(['title' => $title, 'description' => $description]);
}

// Search and filter functionality
$search = isset($_GET['search']) ? $mysqli->real_escape_string(trim($_GET['search'])) : '';
$query = "SELECT * FROM bug_reports WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
$result = $mysqli->query($query);

// User feedback submission
if (isset($_POST['feedback'])) {
    $feedback = $mysqli->real_escape_string(trim($_POST['feedback']));
    // Save feedback logic here
}

// Access control check
session_start();
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    die("Access denied.");
}

// HTML for displaying bug reports
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Bug Reports</title>
</head>
<body>
    <h1>Bug Reports</h1>
    <form method="GET">
        <input type="text" name="search" placeholder="Search bug reports" value="<?php echo htmlspecialchars($search); ?>">
        <input type="submit" value="Search">
    </form>
    <ul>
        <?php while ($row = $result->fetch_assoc()): ?>
            <li><?php echo htmlspecialchars($row['title']); ?> - <?php echo htmlspecialchars($row['description']); ?></li>
        <?php endwhile; ?>
    </ul>
</body>
</html>
