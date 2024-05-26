<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Perform the delete query
    $sql = "DELETE FROM users WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        // Deletion successful, redirect to users page with success message
        header("Location: users.php?success=delete_successful");
        exit();
    } else {
        // Deletion failed, redirect to an error page or display an error message
        header("Location: users.php?error=delete_failed");
        exit();
    }
} else {
    // Redirect to an error page or display an error message if the user ID is not provided in the URL
    header("Location: users.php?error=id_not_provided");
    exit();
}

mysqli_close($conn);
?>