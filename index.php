<?php
session_start();

// Redirect to login if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cat Finder</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header>
    <h1>Welcome to CatFinder</h1>
    <nav>
      <a href="index.php">Home</a>
      <a href="add_cat.php">Add Cat</a>
      <a href="adopt.php">Adopt a Cat</a>
      <a href="my_adoptions.php">Show Adopted</a>
      <a href="contact.php">Contact</a>
      <a href="logout.php">Logout</a>
    </nav>
    
  </header>

  <div class="welcome-section">
    <h2>"Adopting a pet is one of the most rewarding things you can do."</h2>
    <p>Browse through our list of cats available for adoption!</p>
    <a href="adopt.php" class="adopt-button">View Cats for Adoption</a>
  </div>

  <footer>
    <p>&copy; 2024 CatFinder. All rights reserved.</p>
  </footer>
</body>
</html>
