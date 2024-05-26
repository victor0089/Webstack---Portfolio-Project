$sql_create_db = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql_create_db) === TRUE) {
    echo "Database created successfully or already exists";
} else {
    die("Error creating database: " . $conn->error);
}

// Select database
$conn->select_db($dbname);

// Create table
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    active BOOLEAN NOT NULL DEFAULT TRUE
)";
CREATE TABLE meetings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    meeting_date DATE NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    location VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    active TINYINT(1) DEFAULT 0,
    image_path VARCHAR(255) NOT NULL, -- Store the path to the image file
    category VARCHAR(50) NOT NULL
);

// Create database if it doesn't exist
$sql_create_db = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql_create_db) === TRUE) {
    echo "Database created successfully or already exists";
} else {
    die("Error creating database: " . $conn->error);
}

// Select the database
$conn->select_db($dbname);

// SQL query to create meetings table if it doesn't exist
$sql_create_table = "CREATE TABLE IF NOT EXISTS meetings (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    meeting_date DATE NOT NULL,
    title VARCHAR(255) NOT NULL,
    active ENUM('Yes', 'No') NOT NULL
)";


