<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "miniproject";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user ID from the URL parameter
$expert_ID = $_GET['expert_ID'];

// Update the user's active status to 0
$sql = "UPDATE expert SET active = 0 WHERE expert_ID = $expert_ID";
if ($conn->query($sql) === TRUE) {
    echo "User account deactivated successfully.";
} else {
    echo "Error deactivating user account: " . $conn->error;
}

$conn->close();
?>