<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection details
    include "../connectiion.php";

    // Retrieve category data from the form
    $categoryId = $_POST['id'];
    $categoryName = $_POST['categoryName'];

    // File upload handling
    $target_dir = "img/"; // specify your upload directory
    $target_file = $target_dir . basename($_FILES["categoryImage"]["name"]);

    // Check if the file has been uploaded successfully

        // Prepare and bind the SQL query with placeholders
        $sql = "INSERT INTO categories (id, category_name, categories_image) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $categoryId, $categoryName, $target_file); // Use $target_file for the image column

        // Execute the statement
        if ($stmt->execute()) {
            echo "<script>alert('New category added successfully!');";
            echo "window.location.href = 'dashboard.php';</script>";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error uploading file.";
    }

    // Close the database connection
    $conn->close();
?>
