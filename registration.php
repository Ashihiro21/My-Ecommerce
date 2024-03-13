<?php
function generateUniqueId() {
    return bin2hex(random_bytes(16));
}

function generateRandomUsername($length = 8) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $username = '';
    for ($i = 0; $i < $length; $i++) {
        $username .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $username;
}

require('connectiion.php'); // Ensure correct connection file is included

if (isset($_POST['submit'])) {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $username = generateRandomUsername();
        $user_id = generateUniqueId();

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $msg = 'The Email you have entered is invalid, please try again.';
            echo $msg;
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO `registration_user` (`user_id`, `username`, `password`, `email`) VALUES ('$user_id', '$username', '$hashed_password', '$email')";
            $result1 = mysqli_query($conn, $query);

            if ($result1) {
                echo "<div class='form'>
                        <h3>You are registered successfully.</h3>
                        <br/>Click here to start <a href='index.php'>Login</a>
                    </div>";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
        $conn->close();
    }
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="registration.css" />
        <title>Registration Form</title>
    </head>
    <body>

        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="login">
                        <div class="form">
                            <h1 class="text-center">Register Here!!</h1>
                            <form name="registration" action="" method="post">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" placeholder="Email" required />
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" placeholder="Password" required />
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="submit" class="btn btn-primary btn-block" value="Click me to Register" />
                                </div>
                            </form>
                            <p class="text-center">Already have an account? <a href="index.php" class="btn btn-link">Login</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS (optional) -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    </body>
    </html>
    <?php
}
?>
