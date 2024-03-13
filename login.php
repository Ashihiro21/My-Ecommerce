<?php
require('connectiion.php'); // Ensure correct connection file is included

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
                echo "<div class='form'>
                        <h3>Login successful. Welcome, {$user['username']}!</h3>
                        <br/>Click here to go to <a href='categories.php'>Dashboard</a>
                    </div>";
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
        <link rel="stylesheet" href="login.css" />
        <title>Login Form</title>
    </head>
    <body>
        <div class="bg-image">
            <img src="cyber2.jpg" class="image" alt="Background Image">
        </div>

        <div class="login">
            <div class="form">
                <h1>Login Here!!</h1>
                <form name="login" action="" method="post">
                    <input type="email" name="email" placeholder="Email" required />
                    <input type="password" name="password" placeholder="Password" required />
                    <input type="submit" name="login" value="Click me to Login" />
                </form>
            </div>
        </div>
    </body>
    </html>
    <?php
}
?>
