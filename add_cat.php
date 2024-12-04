<?php
session_start();
include('db.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $breed = $_POST['breed'];
    $age = $_POST['age'];
    $description = $_POST['description'];
    $image_url = $_POST['image_url'];

    $insertQuery = "INSERT INTO cats (name, breed, age, description, image_url, is_adopted, user_id) 
                    VALUES ('$name', '$breed', '$age', '$description', '$image_url', 0, '{$_SESSION['user_id']}')";
    if ($conn->query($insertQuery)) {
        $message = 'Cat added successfully!';
    } else {
        $message = 'An error occurred while adding the cat. Please try again later.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CatFinder - Add Cat</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <h1>CatFinder</h1>
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
    <h2>Add Cat for Adoption</h2>
    <?php if ($message): ?><p class="message"><?php echo $message; ?></p><?php endif; ?>
    <form method="POST">
        <label for="name">Name</label>
        <input type="text" name="name" required placeholder="Enter cat's name">

        <label for="breed">Breed</label>
        <input type="text" name="breed" required placeholder="Enter cat's breed">

        <label for="age">Age</label>
        <input type="text" name="age" required placeholder="Enter cat's age">

        <label for="description">Description</label>
        <textarea name="description" required placeholder="Enter a brief description"></textarea>

        <label for="image_url">Image URL</label>
        <input type="url" name="image_url" required placeholder="Enter image URL">

        <button type="submit">Add Cat</button>
    </form>
</div>

<footer>
    <p>&copy; 2024 CatFinder. All rights reserved.</p>
</footer>
</body>
</html>
