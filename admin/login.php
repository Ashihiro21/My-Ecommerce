<?php
session_start();
require "../connectiion.php";

if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM admin WHERE username = '$username' and password = '$password'"; 

    $result = $conn->query($sql);
    
    if (mysqli_num_rows($result) > 0) {
      $_SESSION['login_user'] = $username;
      header("location: dashboard.php"); 
    } else {
      $error = "Your Login Name or Password is invalid";
    }
} 

$conn->close();
?>