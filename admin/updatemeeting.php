<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'db_connection.php';

$username = $_SESSION['username'];

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve meeting ID
    $meeting = $_POST['id'];

    // Get form data
    $meeting_date = $_POST['meeting_date'];
    $title = $_POST['titlee'];
    $content = $_POST['content'];
    $location = $_POST['location'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $active = isset($_POST['active1']) ? 1 : 0; // If checkbox is checked, set $active to 1; otherwise, set it to 0
    $image = $_FILES['image_path1']['name']; // Get the file name of the uploaded image

    // Move the uploaded image to the uploads folder
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image_path1"]["name"]);
    move_uploaded_file($_FILES["image_path1"]["tmp_name"], $target_file);

    // Prepare SQL statement to update data in the 'meetings' table
    $sql = "UPDATE meetings SET meeting_date=?, title=?, content=?, location=?, price=?, active=?, image_path=?, category=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssi", $meeting_date, $title, $content, $location, $price, $active, $image, $category, $meeting);

    // Execute SQL statement
    if ($stmt->execute()) {
        header("Location: meetings.php?success=update_successful");
        exit();
    } else {
        header("Location: meetings.php?error=update_failed");
        exit();
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>

