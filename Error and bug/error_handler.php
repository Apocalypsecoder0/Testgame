<?php
include 'db.php'; // Include your database connection

// Custom error handler
function customError($errno, $errstr, $errfile, $errline) {
    global $pdo;

    // Prepare the SQL statement
    $stmt = $pdo->prepare("INSERT INTO bug_reports (error_message, error_file, error_line) VALUES (?, ?, ?)");
    $stmt->execute([$errstr, $errfile, $errline]);

    // Optionally, you can display a user-friendly message
    echo "An error occurred. Please try again later.";
}

// Set the custom error handler
set_error_handler("customError");
?>
