<?php
// Connection parameters
$servername = "localhost";
$username = "admin";
$password = "admin"; // Replace 'your_password' with the actual password for the 'admin' user

// Create a new database
$conn = mysqli_connect($servername, $username, $password);
$sql = "CREATE DATABASE car_orders";
if (mysqli_query($conn, $sql)) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
