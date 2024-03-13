<?php
// Start a session (for authentication)
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['username'];
    $shippingAddress = $_POST['shipping_address'];
    $billingAddress = $_POST['billing_address'];
    $phoneNumber = $_POST['phone_number'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $paymentInformation = $_POST['payment_information'];
    $preferences = $_POST['preferences'];
    $securityQuestion = $_POST['security_question'];
    $securityAnswer = $_POST['security_answer'];

    // Validate and sanitize the data (you should add more validation)
    $fullname = htmlspecialchars($fullname);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    // Example: Hash the password (use password_hash in production)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Store user data in a database (this is a simple example using MySQL)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "osfcp";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert user data into the database (use prepared statements in production)
    $sql = "INSERT INTO users (fullname, email, password, username, shipping_address, billing_address, 
            phone_number, dob, gender, payment_information, preferences, security_question, security_answer)
            VALUES ('$fullname', '$email', '$hashed_password', '$username', '$shippingAddress', '$billingAddress', 
            '$phoneNumber', '$dob', '$gender', '$paymentInformation', '$preferences', '$securityQuestion', '$securityAnswer')";

    if ($conn->query($sql) === TRUE) {
        // Assume registration is successful, and redirect to a success page
        $_SESSION['user'] = $email;
        header('Location: index.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} 
?>
