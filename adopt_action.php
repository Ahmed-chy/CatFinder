<?php
session_start();
include 'db.php'; // Include database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $cat_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Check if the cat is already adopted
    $checkQuery = "SELECT is_adopted FROM cats WHERE id = '$cat_id'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        $cat = $checkResult->fetch_assoc();
        if ($cat['is_adopted'] == 1) {
            // If the cat is already adopted, redirect with a message
            header("Location: adopt.php?message=This cat has already been adopted.");
            exit();
        }

        // Insert adoption record into the adoptions table
        $insertQuery = "INSERT INTO adoptions (cat_id, user_id) VALUES ('$cat_id', '$user_id')";

        // Update the cat's adoption status in the cats table
        $updateQuery = "UPDATE cats SET is_adopted = 1 WHERE id = '$cat_id'";

        if ($conn->query($insertQuery) === TRUE && $conn->query($updateQuery) === TRUE) {
            // Redirect to the adopt page with a success message
            header("Location: adopt.php?message=Adopted successfully!");
            exit();
        } else {
            echo "Error adopting cat: " . $conn->error;
        }
    } else {
        echo "Cat not found.";
    }
}
?>
