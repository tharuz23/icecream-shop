<?php
$servername = "localhost";
$username = "root";     // Use root for XAMPP
$password = "";         // No password in XAMPP by default
$dbname = "scoopnest";

// Create DB connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
