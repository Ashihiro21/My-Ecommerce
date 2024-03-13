<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have a database connection, adjust this part based on your actual connection code.
    include "connectiion.php";

    // Check if the selected_products array is set and not empty
    if (isset($_POST['selected_products']) && !empty($_POST['selected_products'])) {
        // Escape and sanitize the data
        $selectedProducts = array_map('intval', $_POST['selected_products']);
        $selectedProducts = implode(',', $selectedProducts);

        // Example query, adjust based on your actual database structure
        $sql = "INSERT INTO order (id) VALUES ($selectedProducts)";

        if ($conn->query($sql) === TRUE) {
            echo "Cart processed successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "No products selected";
    }

    $conn->close();
} else {
    echo "Invalid request";
}
?>
