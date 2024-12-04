<?php
session_start();
include('db.php');  // Include database connection
include('partials.php');  // Include header and footer functions

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$cat_id = $_GET['id'];

// Fetch cat details
$query = "SELECT * FROM cats WHERE id = $cat_id";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $cat = $result->fetch_assoc();
} else {
    die('Cat not found.');
}

// Handle adoption
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Add to adoptions table and mark the cat as adopted
    $insertQuery = "INSERT INTO adoptions (cat_id, user_id) VALUES ($cat_id, $user_id)";
    $updateCatQuery = "UPDATE cats SET is_adopted = 1 WHERE id = $cat_id";

    if ($conn->query($insertQuery) && $conn->query($updateCatQuery)) {
        $message = "Congratulations! You have successfully adopted " . htmlspecialchars($cat['name']) . ".";
    } else {
        $message = "There was an issue processing your adoption. Please try again.";
    }
}
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
<?php renderHeader('adopt'); ?>

<div class="container">
    <h2>Adopt <?php echo htmlspecialchars($cat['name']); ?></h2>

    <?php if ($message): ?>
        <p class="message"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <div class="cat-details">
        <img src="<?php echo htmlspecialchars($cat['image_url']); ?>" alt="<?php echo htmlspecialchars($cat['name']); ?>" class="cat-image">
        <h3>Name: <?php echo htmlspecialchars($cat['name']); ?></h3>
        <p>Breed: <?php echo htmlspecialchars($cat['breed']); ?></p>
        <p>Age: <?php echo htmlspecialchars($cat['age']); ?></p>
    </div>

    <?php if (!$cat['is_adopted']): ?>
        <form method="POST">
            <button type="submit" class="adopt-btn">Adopt Now</button>
        </form>
    <?php else: ?>
        <p class="already-adopted">This cat has already been adopted.</p>
    <?php endif; ?>
</div>

<?php renderFooter(); ?>
<script src="scripts.js"></script>
</body>
</html>
