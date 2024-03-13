

<style>
body{
    padding-top: 5rem;
}
</style>


<?php include "nav.php"; ?>


<div class="container mt-5" style="margin-bottom: 20rem;">

<h1 class="text-center">Ram</h1>

<?php
// Assuming you have a database connection established
include "../connectiion.php";

$conn = new mysqli($servername, $username, $password, $dbname);


// SELECT query with a while loop
$sql = "SELECT * FROM ram";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table class='table table-bordered'>";
    echo "<thead class='thead-dark'>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Capacity (GB)</th>
                <th>Type</th>
                <th>Speed (MHz)</th>
                <th>Images</th>
                <th>Image ID</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
          </thead>";
    echo "<tbody>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['name']}</td>
        <td>{$row['capacity_gb']}</td>
        <td>{$row['type']}</td>
        <td>{$row['speed_mhz']}</td>
        <td><img src='../{$row['images']}' alt='{$row['name']}' class='img-fluid' style='width: 100px;'></td>
        <td>{$row['i_id']}</td>
        <td>{$row['price']}</td>
        <td>{$row['quantity']}</td>
              </tr>";
    }

    echo "</tbody>";
    echo "</table>";
} else {
    echo "0 results";
}


$conn->close();
?>


</div>

<script>
    // var iprice = document.getElementsByClassName('iprice');
    // var iquantity = document.getElementsByName('quantity');
    // var itotal = document.getElementsByClassName('total-value');
    // var itotalInput = document.getElementsByClassName('itotal-input');

    // function subTotal() {
    //     for (var i = 0; i < iprice.length; i++) {
    //         var totalValue = (iprice[i].value) * (iquantity[i].value);
    //         itotal[i].innerText = "Total: " + totalValue;
    //         itotalInput[i].value = totalValue;
    //     }
    // }

    // subTotal();
</script>




<?php include "footer.php"; ?>
