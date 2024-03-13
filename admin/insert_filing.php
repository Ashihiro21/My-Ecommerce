<?php
// Replace these values with your actual database credentials
include "../connectiion.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $id = $_POST["id"];
    $filename = $_POST["filename"];
    $category_id = $_POST["category_id"];

    // SQL query to insert data into the table
    $sql = "INSERT INTO files (id, filename, category_id) VALUES ('$id', '$filename', '$category_id')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('New files added successfully!');";
        echo "window.location.href = 'dashboard.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>