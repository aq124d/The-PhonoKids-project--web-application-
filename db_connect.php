<?php
// Database credentials
$servername = "localhost"; // Replace with your database host
$username = "root"; // Replace with your database username
$password = "Alisha_2004"; // Replace with your database password
$database = "game_web"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optionally, you can set character set to ensure proper encoding
mysqli_set_charset($conn, "utf8");

// Optionally, you can start session here if needed
// session_start();

?>
