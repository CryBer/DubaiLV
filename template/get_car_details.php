<?php
// Connect to the database
$conn = mysqli_connect("localhost", "username", "password", "car_orders");

// Check the connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get the car ID from the URL parameter
$carId = $_GET['id'];

// Retrieve car details from the database
$sql = "SELECT * FROM cars WHERE id = $carId";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  // Build the car details HTML
  $html = '<img src="' . $row['image'] . '" alt="' . $row['make'] . ' ' . $row['model'] . '">';
  $html .= '<h2>' . $row['make'] . ' ' . $row['model'] . '</h2>';
  $html .= '<p>' . $row['description'] . '</p>';
  $html .= '<p>Price: $' . $row['price'] . '</p>';

  echo $html;
} else {
  echo 'Car details not found.';
}

// Close the database connection
mysqli_close($conn);
?>
