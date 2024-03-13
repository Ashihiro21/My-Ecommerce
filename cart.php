<?php   ?>

<?php

include "nav.php";

include "connectiion.php";

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}


if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM `add_to_cart` WHERE id = $remove_id");

}

if (isset($_GET['delete_all'])) {
    mysqli_query($conn, "DELETE FROM `add_to_cart`");
    header("Location:cart.php");
}


?>




<style>
    body{
        padding-top: 5rem;
        margin: 0px;
    }
</style>

<div class="container-fluid mt-5">

<?php
include "connectiion.php";

if (isset($_POST['update_product_quantity'])) {
    $update_value = $_POST['update_quantity'];
    $update_id = $_POST['update_quantity_id'];

    $price_query = mysqli_query($conn, "SELECT `price` FROM `add_to_cart` WHERE id = $update_id");
    $price = mysqli_fetch_assoc($price_query)['price'];
    
    $sub_total = $price * $update_value;

    $update_quantity_query = mysqli_query($conn, "UPDATE `add_to_cart` SET quantity = $update_value, total = $sub_total WHERE id = $update_id");
    if ($update_quantity_query) {
    }
}



$num = 1;
$grand_total = 0;

?>




    
    <?php include "connectiion.php" ?>



        <h2 class="text-center">Cart</h2>

        <table class="table text-center"  style="margin-bottom:40rem;">
            <?php


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["order_btn"])) {

    // Check if each required field is set in the POST array
    if(!isset($_POST["images"]) || !isset($_POST["total"]) || !isset($_POST["tracking_number"]) || !isset($_POST["price"])|| !isset($_POST["name"]) || !isset($_POST["quantity"]) || !isset($_POST["i_id"])) {
        echo 'Error: All fields are required.';
    } else {
        $image_url = $_POST["images"];
        $tracking_number = $_POST["tracking_number"];
        $name = $_POST["name"];
        $price = $_POST["price"];
        $quantity = $_POST["quantity"];
        $i_id = $_POST["i_id"];
        $total = $_POST["total"];

        $sql = "INSERT INTO `order` (username, i_id, name, price, quantity, total, images, tracking_number) VALUES ('".$_SESSION['username']."', '$i_id', '$name', '$price', '$quantity', '$total', '$image_url','$tracking_number')";
        $stmt = $conn->prepare($sql);

        $image_url = htmlspecialchars(trim($image_url));
        $tracking_number = htmlspecialchars(trim($tracking_number));
        $name = htmlspecialchars(trim($name));
        $price = htmlspecialchars(trim($price));
        $quantity = htmlspecialchars(trim($quantity));
        $i_id = htmlspecialchars(trim($i_id));
        $total = htmlspecialchars(trim($total));

        // $stmt->bind_param("sssssss", $i_id, $name, $total, $quantity, $image_url, $tracking_number, $price, );

        if (!$stmt->execute()) {
            echo "Error: ". $stmt->error;
        } else {
            echo "Order placed successfully";
        }

        $stmt->close();
    }
}

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}


$username = $_SESSION['username'];

$num = 1;
$grand_total = 0;
$stmt = $conn->prepare("SELECT `id`, `i_id`, `tracking_number`, `name`, `price`, `quantity`, `total`, `images`, `username` FROM `add_to_cart` WHERE username = ?");
$stmt->bind_param("s", $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
                echo "
                <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Images</th>
                    <th>Action</th>
                </thead>
                <tbody>";

                while ($rows = $result->fetch_assoc()) {
                    ?>

            <tr>
                <td><?php echo $num ?></td>
                <td><?php echo $rows['name'] ?></td>
                <td>₱<?php echo $rows['price'] ?></td>
                <td>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <input type="hidden" value="<?php echo $rows["id"] ?>" name="update_quantity_id">
                        <input type="hidden" value="<?php echo $rows["id"] ?>" name="product_quantity_id">
                        <div>
                            <input type="number" min="1" value="<?php echo $rows['quantity'] ?>" name="update_quantity">
                            <input type="submit" class="btn btn-success" value="Update"
                                name="update_product_quantity">
                        </div>
                    </td>
                    <td>₱<?php echo $subtotal = number_format($rows['price'] * $rows['quantity']) ?>/-</td>
                    <td><img src="<?php echo $rows['images'] ?>" alt="Product Image" style="max-width: 100px;"></td>
                    
                    <td>
   <div class="dropdown" role="presentation">
      <button style="overflow: hidden;" class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         Options
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" role="menu">
         <a tabindex="0" class="dropdown-item" href="cart.php?remove=<?php echo $rows['id'] ?>" onclick="return confirm('Are you sure you want to delete this product?')" role="menuitem">Remove</a>
         <form class="dropdown-item" role="menuitem">
             <input role="textbox" aria-label="Tracking Number" type="hidden" name="tracking_number" value="<?php echo $rows['tracking_number']; ?>">
             <input role="textbox" aria-label="Name" type="hidden" name="name" value="<?php echo $rows['name']; ?>">
             <input role="textbox" aria-label="Price" type="hidden" name="price" value="<?php echo $rows['price']; ?>">
             <input role="textbox" aria-label="Quantity" type="hidden" name="quantity" value="<?php echo $rows['quantity']; ?>">
             <input role="textbox" aria-label="Images" type="hidden" name="images" value="<?php echo $rows['images']; ?>">
             <input role="textbox" aria-label="Images" type="hidden" name="i_id" value="<?php echo $rows['i_id']; ?>">
             <input role="textbox" aria-label="total" type="hidden" name="total" value="<?php echo $rows['total']; ?>">
             <input role="textbox" aria-label="username" type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
             <button type="submit" name="order_btn" class="dropdown-item" role="button">Order</button>
          </form>
      </div>
   </div>
</td>
                    
        
                </form>
                </tr>
            <?php
            $grand_total = $grand_total + ($rows['price'] * $rows['quantity']);
            $num++;
        }
    } else {
        echo "<p class='text-center mt-5'>Your shopping cart is empty.</p>";
        echo "<div class='text-center mt-3'><a href='categories.php' class='btn btn-dark'>Go Shopping Now</a></div>";
    }

    ?>

    </tbody>
    </table>
    <?php

    if ($grand_total > 0) {
        echo "<div class='table_bottom'>
    <a href='categories.php' class='btn btn-primary'>Continue Shopping</a>
    <h3 class='btn btn-primary mt-2'>Grand Total <span>" . $grand_total . "</span></h3>
    <a href='checkout.php' class='btn btn-primary'>Proceed to Checkout</a>
</div>";

        ?>
    <a href="cart.php?delete_all"
        onclick="return confirm('Are you sure you want to delete all products?')"
        class="btn btn-danger">DELETE ALL</a>

    <?php
} else {
    echo "";
}

?>

</div>

<?php include "footer.php" ?>

<?php include "side_messages.php"; ?>
    






