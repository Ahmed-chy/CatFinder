<?php
  include 'db.php'; // Include database connection

  if (isset($_POST['register'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['username'];

    // Check if the user already exists
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      echo "Email already registered!";
    } else {
      $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
      if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
        header("Location: login.php");
      } else {
        echo "Error: " . $conn->error;
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - CatFinder</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header>
    <h1>Welcome to CatFinder</h1>
    <nav>
      <a href="login.php">Login</a> | <a href="register.php">Register</a>
    </nav>
  </header>

  <div class="form-container">
    <h2>Register</h2>
    <form method="POST" action="register.php">
      <input type="text" name="username" required placeholder="Name">
      <input type="email" name="email" required placeholder="Email">
      <input type="password" name="password" required placeholder="Password">
      <input type="submit" name="register" value="Register">
    </form>
  </div>

  <footer>
    <p>&copy; 2024 CatFinder. All rights reserved.</p>
  </footer>
</body>
</html>
