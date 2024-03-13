
<?php
// Establish a connection to the MySQL database (replace with your database credentials)
$mysqli = new mysqli('localhost', 'root', '', 'samples');

// Check connection
if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}

// Check if the message is sent via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the message from the POST request
    $message = isset($_POST['message']) ? $_POST['message'] : '';

    // Insert the message into the database
    $query = "INSERT INTO messages (content) VALUES ('$message')";
    $result = $mysqli->query($query);

    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Message inserted successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error inserting message']);
    }

    // Close the database connection
    $mysqli->close();
} else {
    // Handle invalid requests
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>