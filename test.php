<?php



// Function to connect to the database (replace with your actual database connection code)
function connectToDatabase() {
    $host = 'your_database_host';
    $username = 'your_database_username';
    $password = 'your_database_password';
    $database = 'your_database_name';

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

// Dummy user authentication using database (replace with your actual authentication logic)
function authenticateUser($conn, $username, $password) {
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    return $result->num_rows > 0;
}

// Function to add a product to the cart
function addToCart($conn, $username, $productId, $quantity) {
    // Check if the user is authenticated
    if (authenticateUser($conn, $username, $_SESSION['password'])) {
        // Check if a cart already exists for the user
        $sql = "SELECT * FROM carts WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
            // If not, create a new cart
            $sql = "INSERT INTO carts (username) VALUES ('$username')";
            $conn->query($sql);
        }

        // Check if the product is already in the cart
        $sql = "SELECT * FROM carts_items WHERE cart_username = '$username' AND product_id = $productId";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // If it is, update the quantity
            $sql = "UPDATE carts_items SET quantity = quantity + $quantity WHERE cart_username = '$username' AND product_id = $productId";
        } else {
            // If not, add the product to the cart
            $sql = "INSERT INTO carts_items (cart_username, product_id, quantity) VALUES ('$username', $productId, $quantity)";
        }

        $conn->query($sql);
    } else {
        // User not authenticated, handle accordingly (redirect to login, etc.)
        echo "User not authenticated. Please log in.";
    }
}

// Example usage
$username = 'exampleUser';
$password = 'examplePassword';

$conn = connectToDatabase();

// Dummy authentication using database (replace with your actual authentication logic)
if (authenticateUser($conn, $username, $password)) {
    addToCart($conn, $username, 1, 2);
} else {
    echo "Authentication failed.";
}

$conn->close();
?>
