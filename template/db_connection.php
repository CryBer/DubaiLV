<?php
$servername = "localhost";
$username = "your_username_here";
$password = "your_password_here";
$dbname = "your_database_name_here";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>