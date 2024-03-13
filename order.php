
<?php

include "connectiion.php";



if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM `order` WHERE id = $remove_id");
    header("Location:order.php");
}


?>

<?php
include "nav.php";
?>

<style>
    body{
        padding-top: 5rem;
    }
    table{
       padding-bottom: 40rem;
    }
</style>


<div class='container-fluid mt-5'>




<h1 class="text-center">Order History</h1>

 <table class='table text-center'  style='margin-bottom:40rem;'>
<?php
// Assuming you have a MySQLi connection established

include "connectiion.php";
// Your SQL query
$stmt = $conn->prepare("SELECT `id`, `i_id`, `tracking_number`, `name`, `price`, `quantity`, `total`, `images`, `username` FROM `order` WHERE username = ?");
$stmt->bind_param("s", $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();

// Check if there are results
if ($result->num_rows > 0) { 
    // Output data of each row in a Bootstrap table
   

    echo "<thead>
    <tr>
        <th>Tracking Number</th>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th>
        <th>Images</th>
        <th>Action</th>
        </tr>
        </thead>
        <tbody>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["tracking_number"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["price"] . "</td>";
        echo "<td>" . $row["quantity"] . "</td>";
        echo "<td>" . $row["total"] . "</td>";
        echo "<td><img style='width: 100px;'; src='" . $row["images"] . "' class='img-fluid' alt='Image'></td>";
        echo "<td><a class='btn btn-danger' href='order.php?remove=".$row['id']."' onclick='return confirm(\"Are you sure you want to delete this product?\")' role='button'>Remove</a><td>";
        echo "</tr>";
    }

    
} else {
    echo "<p class='text-center mt-5'>Your shopping order is empty.</p>";
    echo "<div class='text-center mt-3'><a href='cart.php' class='btn btn-dark'>Go Shopping Now</a></div>";
}

// Close the connection
$conn->close();
?>
</tbody>
        </table>;

</div>

<?php include "footer.php"; ?>

<?php include "side_messages.php"; ?>
