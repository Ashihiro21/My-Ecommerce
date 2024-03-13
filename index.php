<?php
require('connectiion.php'); // Ensure correct connection file is included
session_start();

if (isset($_POST['login'])) {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $query = "SELECT * FROM `registration_user` WHERE `email`='$email'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $user = mysqli_fetch_assoc($result);
            if ($user && password_verify($password, $user['password'])) {
                // Successful login
                $_SESSION["email"] = $email;
                    header('Location: categories.php');
                    
            } else {
                // Incorrect username or password
                echo "Invalid email or password. Please try again.";
            }
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        $conn->close();
    }
} else {
    // Display login form
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="login.css" />
    <title>Login Form</title>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center mb-4">Login Here!!</h1>
                    <form name="login" action="" method="post">
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Email" required />
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password" required />
                        </div>
                        <div class="form-group">
                            <input type="submit" name="login" class="btn btn-primary btn-block" value="Click me to Login" />
                        </div>
                    </form>
                    <p class="text-center">Don't have an account? <a href="registration.php" class="btn btn-link">Register</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>

    <?php
}
?>
