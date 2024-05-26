<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Validate and sanitize the input
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    
    if ($id === false) {
        // Invalid ID provided, redirect with an error message
        header("Location: meetings.php?error=invalid_id");
        exit();
    }

    // Prepare the delete query
    $sql = "DELETE FROM meetings WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    // Execute the query
    if ($stmt->execute()) {
        // Deletion successful, redirect to meetings page with success message
        header("Location: meetings.php?success=delete_successful");
        exit();
    } else {
        // Deletion failed, redirect to an error page or display an error message
        header("Location: meetings.php?error=delete_failed");
        exit();
    }
} else {
    // Redirect to an error page or display an error message if the meeting ID is not provided in the URL
    header("Location: meetings.php?error=id_not_provided");
    exit();
}

// Close statement
$stmt->close();
// Close connection
$conn->close();
?>