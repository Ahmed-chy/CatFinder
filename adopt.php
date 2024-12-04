<?php
  include 'db.php'; // Include database connection

  // Get the selected age filter from the form (if any)
  $age_filter = isset($_GET['age_filter']) ? $_GET['age_filter'] : '';

  // Build the query based on the filter
  $sql = "SELECT * FROM cats";
  if ($age_filter) {
    $sql .= " WHERE age = '$age_filter' AND is_adopted = 0";
  } else {
    $sql .= " WHERE is_adopted = 0";
  }

  // Query the database
  $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Adopt a Cat - CatFinder</title>
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

  <!-- Filter form for age -->
  <form method="GET" action="adopt.php" class="filter-form">
    <label for="age_filter">Select Age:</label>
    <select name="age_filter" id="age_filter">
      <option value="">All Ages</option>
      <option value="Kitten" <?php if($age_filter == 'Kitten') echo 'selected'; ?>>Kitten</option>
      <option value="Adult" <?php if($age_filter == 'Adult') echo 'selected'; ?>>Adult</option>
      <option value="Senior" <?php if($age_filter == 'Senior') echo 'selected'; ?>>Senior</option>
    </select>
    <button type="submit" class="filter-button">Filter</button>
  </form>

  <!-- Display cats -->
  <div class="cats-list">
    <?php
      if ($result->num_rows > 0) {
        while ($cat = $result->fetch_assoc()) {
          echo '<div class="cat-card">';
          echo '<img src="' . $cat['image_url'] . '" alt="' . $cat['name'] . '" class="cat-image">';
          echo '<h3>' . $cat['name'] . '</h3>';
          echo '<p>Breed: ' . $cat['breed'] . '</p>';
          echo '<p>Age: ' . $cat['age'] . '</p>';
          echo '<a href="adopt_action.php?id=' . $cat['id'] . '" class="adopt-button">Adopt</a>';
          echo '</div>';
        }
      } else {
        echo '<p>No cats available for adoption at the moment.</p>';
      }
    ?>
  </div>

  <footer>
    <p>&copy; 2024 CatFinder. All rights reserved.</p>
  </footer>
</body>
</html>
