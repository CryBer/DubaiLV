<?php
// Connect to the database
$conn = mysqli_connect("localhost", "admin", "admin", "car_orders");

// Check the connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Insert sample data into the cars table
$sql = "INSERT INTO cars (make, model, description, image, price) VALUES
  ('Toyota', 'Corolla', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'images/corolla.jpg', 20000),
  ('Honda', 'Civic', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'images/civic.jpg', 22000),
  ('Ford', 'Mustang', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'images/mustang.jpg', 35000),
  ('BMW', 'X5', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'images/x5.jpg', 45000),
  ('Mercedes-Benz', 'E-Class', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'images/e-class.jpg', 50000)";



if (mysqli_query($conn, $sql)) {
  echo "Sample data inserted successfully";
} else {
  echo "Error inserting sample data: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
