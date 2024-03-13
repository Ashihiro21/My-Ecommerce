<?php
// Start the session
session_start();

// Check if the username session variable is set
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $userId = $_SESSION['user_id'];

    // Display the user information
    echo "Welcome to page 2, $username! Your user ID is $userId.";

    // You can continue to use the session variables in your application logic on this page

} else {
    // Redirect to the login page or display an error message
    echo "Session variables are not set. Please log in.";
    // Alternatively, you can redirect to the login page
    // header("Location: login.php");
    // exit();
}
?>
