<?php
// Database connection details
$servername = "localhost";  // Host (usually "localhost" for most servers)
$username = "a30081050_Kunal";  // Your database username
$password = "Singla@64500";  // Your database password
$dbname = "a30081050_db";  // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); // If connection fails, display the error
}
?>
