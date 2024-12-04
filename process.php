<?php
session_start();
include('db.php');

$action = $_GET['action'] ?? '';

if ($action === 'register') {
    // Registration logic
} elseif ($action === 'login') {
    // Login logic
} elseif ($action === 'logout') {
    session_destroy();
    header('Location: index.php?message=Logged out successfully');
    exit;
}
?>
