<?php
// Start the session
session_start();

// Check if the user is already logged in
if (isset($_SESSION['username'])) {
    // Redirect the user to the success page
    header("Location: success.html");
    exit();
}

// Check if the login form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted username and password
    $submittedUsername = $_POST['username'];
    $submittedPassword = $_POST['password'];

    // Perform the validation against your database
    // Replace the following code with your own database validation logic

    $servername = "localhost";
    $username = "admin";
    $password = "admin";
    $dbname = "myappdb";

    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  } else {
      echo "Connected successfully!";
  }
  

    // Check if the username and password match in the database
    $checkUserQuery = "SELECT * FROM users WHERE username = '$submittedUsername' AND password = '$submittedPassword'";
    $checkUserResult = mysqli_query($conn, $checkUserQuery);

    if (mysqli_num_rows($checkUserResult) === 1) {
        // Username and password are correct
        // Set the session variable and redirect to the success page
        $_SESSION['username'] = $submittedUsername;
        header("Location: success.html");
        exit();
    } else {
        // Username or password is incorrect
        $errorMessage = "Invalid username or password.";
    }

    mysqli_close($conn);
}

// Check if the signup form was submitted
if (isset($_POST['signup'])) {
    // Get the submitted username and password
    $submittedUsername = $_POST['username'];
    $submittedPassword = $_POST['password'];

    // Perform the validation against your database
    // Replace the following code with your own database validation logic

    $servername = "localhost";
    $username = "admin";
    $password = "admin";
    $dbname = "myappdb";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if the username already exists in the database
    $checkUsernameQuery = "SELECT * FROM users WHERE username = '$submittedUsername'";
    $checkUsernameResult = mysqli_query($conn, $checkUsernameQuery);

    if (mysqli_num_rows($checkUsernameResult) > 0) {
        // Username already exists
        $errorMessage = "Username already taken. Please choose a different username.";
    } else {
        // Username is available, insert new user into the database
        $insertUserQuery = "INSERT INTO users (username, password) VALUES ('$submittedUsername', '$submittedPassword')";
        if (mysqli_query($conn, $insertUserQuery)) {
            // User successfully registered
            $_SESSION['username'] = $submittedUsername;
            header("Location: success.html");
            exit();
        } else {
            // Error occurred while inserting user
            $errorMessage = "Error: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="../stylesheet/main.css">
</head>
<body>
  <header>
    <div class="logo"></div>
    <nav>
      <a class="nav-item" href="main.html">Home</a>
      <a class="nav-item" href="about.html">About</a>
      <a class="nav-item" href="order.html">Order</a>
      <a class="nav-item" href="contact.html">Contact</a>
      <a class="nav-item" href="faq.html">FAQ</a>
      <a class="nav-item" id="loginBtn" href="#">Login</a>
    </nav>
  </header>

  <main>
    <div class="login-container">
      <h2>Login</h2>
      <?php if (isset($errorMessage)) : ?>
        <p class="error-message"><?php echo $errorMessage; ?></p>
      <?php endif; ?>
      <form method="POST" action="login.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Login</button>
      </form>
    </div>
    <div class="signup-container">
      <h2>Sign Up</h2>
      <?php if (isset($signupErrorMessage)) : ?>
        <p class="error-message"><?php echo $signupErrorMessage; ?></p>
      <?php endif; ?>
      <form method="POST" action="login.php">
        <label for="signup-username">Username:</label>
        <input type="text" id="signup-username" name="username" required>
        <label for="signup-password">Password:</label>
        <input type="password" id="signup-password" name="password" required>
        <button type="submit" name="signup">Sign Up</button>
      </form>
    </div>
  </main>

  <footer>
    <p>&copy; 2023 Your Company. All rights reserved.</p>
  </footer>

  <!-- Include the main.js script -->
  <script src="../template/order.js"></script>
</body>
</html>
