<?php
session_start();
include('partials.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CatFinder - Contact</title>
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
<div class="container">
    <h2>Contact Us</h2>
    <form>
        <label for="name">Name</label>
        <input type="text" id="name" required>

        <label for="email">Email</label>
        <input type="email" id="email" required>

        <label for="message">Message</label>
        <textarea id="message" required></textarea>

        <button type="submit">Send Message</button>
    </form>
</div>
<footer>
    <p>&copy; 2024 CatFinder. All rights reserved.</p>
  </footer>
<script src="scripts.js"></script>
</body>
</html>
