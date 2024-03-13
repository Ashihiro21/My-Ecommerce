<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION['login_user'])) {
    header('Location: index.php');
    exit();
}
require("../connectiion.php");

// Assuming session_start() has been called before this point to start the session

// Prepared statement to prevent SQL injection
$query = $conn->prepare("SELECT username, user_images FROM `admin` WHERE username = ?");
$query->bind_param('s', $username); // 's' specifies the variable type => 'string'

$query->execute();

$result = $query->get_result();

if ($result->num_rows > 0) { // Check for at least one row
    $row = $result->fetch_assoc();
    $_SESSION['login_user'] = $row['username'];
    $_SESSION['user_images'] = $row['user_images'];
} else {
    echo "";
}

$query->close(); // Close the prepared statement


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <title>Document</title>
</head>

<style>
    
#dropdownMenuButton:active{
    border-color: none;
}

.dropdown-toggle:active {
    border-color: none;
    
}
</style>
    <!-- Bootstrap Navigation Bar -->
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">


    <a class="navbar-brand" href="dashboard.php">
    <img src="../img/download10.png" alt="Your Logo" width="150" height="40" class="">
        </a>

        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Logo -->
        

        <!-- Search Bar -->
        <form class="form-inline ml-3">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        </form>

        

        <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav m-auto">
        <li class="nav-item nav-item1 active">
            <a class="nav-link" href="dashboard.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
  <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4z"/>
</svg> <!-- Home Icon -->
            </a>
        </li>
        <li class="nav-item nav-item1 active">
            <a class="nav-link" href="cart.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
  <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z"/>
  <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
</svg>

<?php
include "../connectiion.php";
$stmt = $conn->prepare("SELECT `id`, `i_id`, `tracking_number`, `name`, `price`, `quantity`, `total`, `images`, `username` FROM `add_to_cart` WHERE username = ?");
$stmt->bind_param("s", $_SESSION['login_user']);
$stmt->execute();
$result = $stmt->get_result();
if ($result) {
    
    $rowCount = mysqli_num_rows($result);

    echo "<span style='font-weight:bold;'>$rowCount</span>";

    // Free result set
    mysqli_free_result($result);
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();

?>
   

            </a>
        </li>
        <li class="nav-item nav-item1 active">
            <a class="nav-link" href="order.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
  <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022zm2.004.45a7 7 0 0 0-.985-.299l.219-.976q.576.129 1.126.342zm1.37.71a7 7 0 0 0-.439-.27l.493-.87a8 8 0 0 1 .979.654l-.615.789a7 7 0 0 0-.418-.302zm1.834 1.79a7 7 0 0 0-.653-.796l.724-.69q.406.429.747.91zm.744 1.352a7 7 0 0 0-.214-.468l.893-.45a8 8 0 0 1 .45 1.088l-.95.313a7 7 0 0 0-.179-.483m.53 2.507a7 7 0 0 0-.1-1.025l.985-.17q.1.58.116 1.17zm-.131 1.538q.05-.254.081-.51l.993.123a8 8 0 0 1-.23 1.155l-.964-.267q.069-.247.12-.501m-.952 2.379q.276-.436.486-.908l.914.405q-.24.54-.555 1.038zm-.964 1.205q.183-.183.35-.378l.758.653a8 8 0 0 1-.401.432z"/>
  <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0z"/>
  <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5"/>
</svg><?php
include "../connectiion.php";
$stmt = $conn->prepare("SELECT `id`, `i_id`, `tracking_number`, `name`, `price`, `quantity`, `total`, `images`, `username` FROM `order` WHERE username = ?");
$stmt->bind_param("s", $_SESSION['login_user']);
$stmt->execute();
$result = $stmt->get_result();
if ($result) {

    $rowCount = mysqli_num_rows($result);

    echo "<span style='font-weight:bold;'>$rowCount</span>";

    // Free result set
    mysqli_free_result($result);
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();

?>
   
            </a>
        </li>
</ul>


         <!-- Right-side navigation items -->
   
        <!-- Message -->
        <ul class="navbar-nav ml-auto">
        <li class="nav-item2 active">
            <a class="nav-link mt-3" href="messages.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-send-exclamation" viewBox="0 0 16 16">
  <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855a.75.75 0 0 0-.124 1.329l4.995 3.178 1.531 2.406a.5.5 0 0 0 .844-.536L6.637 10.07l7.494-7.494-1.895 4.738a.5.5 0 1 0 .928.372zm-2.54 1.183L5.93 9.363 1.591 6.602z"/>
  <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1.5a.5.5 0 0 1-1 0V11a.5.5 0 0 1 1 0m0 3a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0"/>
</svg>
            </a>
        </li>
        <!-- Profile -->
        <li class="nav-item">
    <div class="dropdown mt-2">
    <div class="dropdown">
    <button style="border-radius: 50%; overflow: hidden; background-color:transparent; border:none;" class="dropdown-toggle mt-2" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php
// Get the user image URL from the session
            $userImageUrl = isset($_SESSION['user_images']) ? $_SESSION['user_images'] : '';

            // Check if $userImageUrl is set
            if(isset($userImageUrl) && !empty($userImageUrl)) {
                // Create a circular image by applying a mask using CSS
                echo '<div style="width: 50px; border-radius: 50%; overflow: hidden; background-color:white;">';
                echo '<img src="' . $userImageUrl . '" class="rounded-3" width="100%" height="100%" alt="">';
                echo '</div>';
            } else {
                // Use a default image if $userImageUrl is not set
                echo '<div style="width: 50px; border-radius: 50%; overflow: hidden; background-color:white;">';
                echo '<img src="../img/dp.png" class="rounded-3" width="100%" height="100%" alt="Default Image">';
                echo '</div>';
            }

            ?>
    </button>
    <style>
        /* Remove the default arrow styling */
        .dropdown-toggle::after {
            display: none;
            color: #343a40;
        }
    </style>
<div class="dropdown-menu dropdown-menu-right p-4" aria-labelledby="dropdownMenuButton">
    <h5 class="text-center"><?php echo $_SESSION['login_user']; ?></h5>
    <a class="btn btn-primary mt-1 w-100" href="edit_profile.php">Edit Profile </a><br>
    <a class="btn btn-danger mt-1 w-100" href="logout.php">Logout</a>
</div>
</div>

</li>



    </ul>
</div>

</nav>

    </div>

    
 