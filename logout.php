<?php
// Start session
session_start();

// Check if user is already logged in
if(isset($_SESSION["email"])) {
    // If logged in, redirect to home page
    header("Location: home.html");
    exit();
}

// Logout logic
if(isset($_POST["logout"])) {
    // Destroy session data
    session_destroy();
    // Redirect to login page after logout
    header("Location: login.php");
    exit();
}
?>