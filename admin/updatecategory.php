<?php
include 'db_connection.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $category = $_POST['category-name'];

    // Update query with prepared statement
    $sql = "UPDATE categories SET category_name=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $category, $id);
    
    if (mysqli_stmt_execute($stmt)) {
        header("Location: categories.php?success=update_successful");
        exit();
    } else {
        header("Location: categories.php?error=update_failed");
        exit();
    }
}

mysqli_close($conn);
?>