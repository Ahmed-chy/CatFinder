<?php
session_start();
include 'db.php'; // Include database connection

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to check user credentials
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Store user details in session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];

        // Redirect to index.php
        header("Location: index.php");
        exit();
    } else {
        $error_message = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - CatFinder</title>
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
    <h2>Login</h2>
    <?php if (isset($error_message)) echo '<p class="error">' . $error_message . '</p>'; ?>
    <form method="POST" action="login.php">
      <input type="email" name="email" required placeholder="Email">
      <input type="password" name="password" required placeholder="Password">
      <input type="submit" name="login" value="Login">
    </form>
  </div>

  <footer>
    <p>&copy; 2024 CatFinder. All rights reserved.</p>
  </footer>
</body>
</html>
