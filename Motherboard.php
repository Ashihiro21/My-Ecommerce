<style>
body{
    padding-top: 5rem;
}
</style>


<?php include "nav.php"; ?>

<?php
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

?>

<div class="container mt-5" style="margin-bottom: 20rem;">

<h1 class="text-center">Ram</h1>



<?php

include "connectiion.php";

$modalScript = '';

$Id = '';

function generateTrackingNumber() {
    // You can implement your own logic here to generate a unique tracking number
    // For example, you can use a combination of date, time, and a random number
    return rand();

}

if (isset($_POST['adding_cart']) && !isset($_POST['form_submitted'])) {
    $Id = $conn->real_escape_string($_POST['i_id']);
    $Name = $conn->real_escape_string($_POST['name']);
    $price = $conn->real_escape_string($_POST['price']);
    $quantity = $conn->real_escape_string($_POST['quantity']);
    $total = $conn->real_escape_string($_POST['total']);
    $images = $conn->real_escape_string($_POST['images']);
    $trackingNumber = generateTrackingNumber();
    // Insert the product details into the 'add_to_cart' table (replace 'add_to_cart' with your actual table name)
    $insertQuery = "INSERT INTO `add_to_cart` (username, i_id, name, price, quantity, total, images, tracking_number) VALUES ('".$_SESSION['username']."', '$Id', '$Name', '$price', '$quantity', '$total', '$images','$trackingNumber')";
    if ($conn->query($insertQuery) === TRUE) {
        $_POST['form_submitted'] = true;
        $modalScript = "
    <script>
        $(document).ready(function(){
            $('#successModal-$Id').modal('show');
            setTimeout(function(){
                $('#successModal-$Id').modal('hide');
                window.history.replaceState({}, document.title, window.location.href); // Replace the current state
            }, 2000);
        });
    </script>
";
    }
} elseif (isset($_POST['buy_now']) && !isset($_POST['form_submitted'])) {
    // Code for "Buy Now" button
    $Id = $conn->real_escape_string($_POST['i_id']);
    $Name = $conn->real_escape_string($_POST['name']);
    $price = $conn->real_escape_string($_POST['price']);
    $quantity = $conn->real_escape_string($_POST['quantity']);
    $total = $conn->real_escape_string($_POST['total']);
    $images = $conn->real_escape_string($_POST['images']);
    $trackingNumber = generateTrackingNumber();
    // Insert the product details into the 'buy_now' table (replace 'buy_now' with your actual table name)
    $insertQuery = "INSERT INTO `order` (username, i_id, name, price, quantity, total, images, tracking_number) VALUES ('".$_SESSION['username']."', '$Id', '$Name', '$price', '$quantity', '$total', '$images','$trackingNumber')";
    
    if ($conn->query($insertQuery) === TRUE) {
        $_POST['form_submitted'] = true;
        $modalScript = "
    <script>
        $(document).ready(function(){
            $('#successModal-$Id').modal('show');
            setTimeout(function(){
                $('#successModal-$Id').modal('hide');
                window.history.replaceState({}, document.title, window.location.href); // Replace the current state
            }, 2000);
        });
    </script>
    ";

    } else {
        echo "Error: " . $insertQuery . "<br>" . $conn->error;
    }

}
// Prepare the SQL query
$sql = "SELECT m.id, m.name, m.price, m.quantity, m.manufacturer, m.i_id, m.memory_support, m.images, f.filename FROM motherboards m INNER JOIN files f ON m.i_id = f.category_id; ";

// Execute the query
$result = $conn->query($sql);

// Check if the query was successful
if ($result) {
    // Fetch and display the results using a while loop
    while ($row = $result->fetch_assoc()) {
        echo "<form method='post' action=''>";  // Add your desired action here
        echo "<div class='card m-5' style='width: 18rem;'>";
        echo "  <img src='" . $row['images'] . "' class='card-img-top' alt='mobo Image'>";
        echo "  <div class='card-body'>";
        echo "    <p class='card-text'>" . $row['name'] . "</p>";
        echo "    <p class='card-text'>"."P " . $row['price'] . "</p>";
        echo "    <p class='card-text'>" . $row['manufacturer'] . "</p>";
        echo "    <p class='card-text'>" . $row['memory_support'] . "</p>";
        echo "    <p class='card-text itotal'>Total: <span class='total-value'>" . $row['price'] . "</span></p>";
        echo "    <input type='hidden' name='i_id' value='" . $row['i_id'] . "'>";
        echo "    <input type='hidden' name='name' value='" . $row['name'] . "'>";
        echo "    <input type='hidden' class='iprice' name='price' value='" . $row['price'] . "'>";
        echo "    <input type='hidden' name='images' value='" . $row['images'] . "'>";
        echo "    <input type='hidden' name='tracking_number' value='" . ($row['tracking_number'] ?? '') . "'>"; // Check if the key exists
        echo "    <input type='hidden' name='total' class='itotal-input' value=''>"; // Hidden input for total
        echo "    <input type='number' onchange='subTotal()' name='quantity' min='1' max='" . $row['quantity'] . "'>";
        echo "    <button type='submit' name='adding_cart' class='btn btn-primary'>Add to Cart</button>";
        echo "    <button type='submit' name='buy_now' class='btn btn-success'>Buy Now</button>";
        echo "  </div>";
        echo "</div>";
        echo "</form>";
        
        // Modal for success message
        echo "
            <div class='modal' id='successModal-$Id' tabindex='-1' role='dialog'>
                <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h5 class='modal-title'>Success!</h5>
                        </div>
                        <div class='modal-body'>
                            Product added successfully!
                        </div>
                    </div>
                </div>
            </div>
        ";
    }
    

    $result->free();
}
// Close the connection
$conn->close();
?>

<script>
    var iprice = document.getElementsByClassName('iprice');
    var iquantity = document.getElementsByName('quantity');
    var itotal = document.getElementsByClassName('total-value');
    var itotalInput = document.getElementsByClassName('itotal-input');

    function subTotal() {
        for (var i = 0; i < iprice.length; i++) {
            var totalValue = (iprice[i].value) * (iquantity[i].value);
            itotal[i].innerText = "Total: " + totalValue;
            itotalInput[i].value = totalValue;
        }
    }

    subTotal();
</script>

<?php echo $modalScript; // Output the modal script ?>
</div>


<?php include "footer.php"   ?>
