<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $full_name = $_POST['full-name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $active = isset($_POST["active"]) ? 1 : 0;

    // Hash password if provided
    $password = !empty($_POST["password"]) ? password_hash($_POST["password"], PASSWORD_DEFAULT) : '';

    // Validate and handle file upload
    $pimage = '';
    if (isset($_FILES['image_path2']) && $_FILES['image_path2']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image_path2"]["name"]);
        
        // Validate file type and size
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");
        $maxFileSize = 5 * 1024 * 1024; // 5MB
        if (in_array($imageFileType, $allowedExtensions) && $_FILES["image_path2"]["size"] <= $maxFileSize) {
            if (move_uploaded_file($_FILES["image_path2"]["tmp_name"], $target_file)) {
                $pimage = basename($_FILES["image_path2"]["name"]);
            } else {
                // Handle file upload error
            }
        } else {
            // Handle invalid file type or size
        }
    }

    // Update query with prepared statement
    $sql = "UPDATE users SET full_name=?, username=?, email=?, password=?, active=?, image_path2=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssisi", $full_name, $username, $email, $password, $active, $pimage, $id);
    
    if (mysqli_stmt_execute($stmt)) {
        header("Location: users.php?success=update_successful");
        exit();
    } else {
        header("Location: users.php?error=update_failed");
        exit();
    }
}

mysqli_close($conn);
?>