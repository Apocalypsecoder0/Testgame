<?php
session_start();
include 'db.php';

// Check if the user is an admin
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    die("Access denied.");
}

// Fetch bug reports
$stmt = $pdo->query("SELECT * FROM bug_reports ORDER BY created_at DESC");
$bugReports = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Bug Reports</title>
</head>
<body>
    <h1>Bug Reports</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Error Message</th>
            <th>Error File</th>
            <th>Error Line</th>
            <th>Created At</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php foreach ($bugReports as $report): ?>
        <tr>
            <td><?php echo $report['id']; ?></td>
            <td><?php echo $report['user_id']; ?></td>
            <td><?php echo htmlspecialchars($report['error_message']); ?></td>
            <td><?php echo htmlspecialchars($report['error_file']); ?></td>
            <td><?php echo $report['error_line']; ?></td>
            <td><?php echo $report['created_at']; ?></td>
            <td><?php echo $report['status']; ?></td>
            <td>
                <form method="POST" action="resolve_bug.php">
                    <input type="hidden" name="id" value="<?php echo $report['id']; ?>">
                    <button type="submit">Resolve</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
