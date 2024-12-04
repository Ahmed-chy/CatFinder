<?php
session_start();
include('db.php');
include('partials.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch user's adopted cats
$query = "
    SELECT cats.name, cats.breed, cats.age, cats.image_url, adoptions.adoption_date 
    FROM adoptions
    INNER JOIN cats ON adoptions.cat_id = cats.id
    WHERE adoptions.user_id = $user_id";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Adoptions - CatFinder</title>
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
    <h2>My Adopted Cats</h2>
    <?php if ($result->num_rows > 0): ?>
        <div class="cats-list">
            <?php while ($cat = $result->fetch_assoc()): ?>
                <div class="cat-card">
                
                    <img src="<?php echo htmlspecialchars($cat['image_url']); ?>" alt="<?php echo htmlspecialchars($cat['name']); ?>" class="cat-image">
                    <h3><?php echo htmlspecialchars($cat['name']); ?></h3>
                    <p>Breed: <?php echo htmlspecialchars($cat['breed']); ?></p>
                    <p>Age: <?php echo htmlspecialchars($cat['age']); ?></p>
                    <p>Adoption Date: <?php echo htmlspecialchars($cat['adoption_date']); ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>You have not adopted any cats yet.</p>
    <?php endif; ?>
</div>

<?php renderFooter(); ?>
</body>
</html>
