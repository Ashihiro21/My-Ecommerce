<style>
    body {
        padding-top: 5rem;
    }
</style>

<?php include "nav.php"; ?>

<div class="container mt-5" style="margin-bottom: 20rem;">

    <h1 class="text-center">Motherboards</h1>

    <?php
    // Assuming you have a database connection established
    include "../connectiion.php";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // SELECT query with a while loop
    $sql = "SELECT * FROM motherboards"; // Updated table name to 'motherboards'
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table class='table table-bordered'>";
        echo "<thead class='thead-dark'>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Manufacturer</th>
                <th>Image</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
          </thead>";
        echo "<tbody>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['name']}</td>
        <td>{$row['manufacturer']}</td>
        <td><img src='../{$row['images']}' alt='{$row['name']}' class='img-fluid' style='width: 100px;'></td>
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
    // Your JavaScript code here (if needed)
</script>

<?php include "footer.php"; ?>
