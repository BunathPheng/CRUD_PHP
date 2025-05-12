<?php
include_once '../config/database.php';
include_once '../classes/User.php';

// Database connection
$database = new Database();
$db = $database->getConnection();

// User object
$user = new User($db);

// Check if ID is set
if(isset($_GET['id'])) {
    $user->id = $_GET['id'];

    $message = "";
    $messageType = "";

    if($user->delete()) {
        $message = "User deleted successfully.";
        $messageType = "success";
    } else {
        $message = "Unable to delete user.";
        $messageType = "danger";
    }

    // Redirect back to index with message
    header("Location: index.php?message=" . urlencode($message) . "&type=" . urlencode($messageType));
    exit();
}