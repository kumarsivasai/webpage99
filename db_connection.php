<?php
$localhost = "localhost"; // Hostname
$port = "3308"; // Port number
$username = "root"; // MySQL username
$password = ""; // MySQL password
$dbname = "vollyballform"; // Database name

// Create connection
$conn = new mysqli($localhost, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connection successful!";
?>


