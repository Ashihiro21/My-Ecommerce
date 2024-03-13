<?php
include "nav.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>User Profile</title>
</head>
<body>
<style>
    body{
        padding-top: 54px;
    }
 
</style>

<div class="center">
    <div class="row">
        <div class="col-md-6 offset-3 mt-5">
            <?php
            include("connectiion.php");

            $currentUser = $_SESSION['username'];

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
                // Process form submission
                $updatedUsername = $_POST['updateuserName'];
                $updatedUserfullname = $_POST['updateuserfullname'];
                $updatedPhoneNumber = $_POST['updatephoneNumber'];
                $updatedGender = $_POST['updategender'];
                $updatedBirthMonth = $_POST['updatebirthMonth'];
                $updatedBirthDate = $_POST['updatebirthDate'];
                $updatedBirthYear = $_POST['updatebirthYear'];
                $updatedAddress = $_POST['updateaddress'];
                $updatedPassword = $_POST['updatepassword'];
                $updatedPassword = $_POST['updatepassword'];
                $hashed_password = password_hash($updatedPassword, PASSWORD_DEFAULT);

                $updatedPaymentMode = $_POST['updatepaymentMode'];

                // Handle uploaded image
                $userImage = $_FILES['userimage'];
                $imageTmpName = $userImage['tmp_name'];

                // Validate and move uploaded image
                if (!empty($imageTmpName)) {
                    $imagePath = "img/" . basename($userImage['name']);
                    move_uploaded_file($imageTmpName, $imagePath);
                } else {
                    // No new image uploaded
                    $imagePath = $row['user_images']; // Set default image path or keep the existing one
                }

                // Update database with new information
                $sql = "UPDATE registration_user SET 
                        username = '$updatedUsername', 
                        fullname = '$updatedUserfullname', 
                        phone_number = '$updatedPhoneNumber', 
                        gender = '$updatedGender', 
                        birth_month = '$updatedBirthMonth', 
                        birth_date = '$updatedBirthDate', 
                        birth_year = '$updatedBirthYear', 
                        address = '$updatedAddress', 
                        password = '$hashed_password', 
                        payment_mode = '$updatedPaymentMode',
                        user_images = '$imagePath'
                        WHERE username = '$currentUser'";

                $updateResult = mysqli_query($conn, $sql);

                if (mysqli_affected_rows($conn) > 0) {
                    echo "Update successful!";
                } else if (mysqli_affected_rows($conn) == 0) {
                    echo "No changes were made.";
                }
            }

            $sql = "SELECT * FROM registration_user WHERE username = '$currentUser'";
            $gotResults = mysqli_query($conn, $sql);

            if ($gotResults && mysqli_num_rows($gotResults) > 0) {
                while ($row = mysqli_fetch_array($gotResults)) {
                    ?>
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" name="updateuserName" class="form-control"
                                   value="<?= $row['username']; ?>">
                        </div>

                        <div class="form-group">
                            <input type="text" name="updateuserfullname" class="form-control"
                                   value="<?= $row['fullname']; ?>">
                        </div>
                            <div class="form-group">
        <label for="updatephoneNumber">Phone Country Code:</label>
        <div class="input-group">
            <input type="text" name="updatephoneNumber" id="updatephoneNumber" class="form-control" placeholder="Phone Number" value="<?= htmlspecialchars($row['phone_number']); ?>">
        </div>
    </div>


                     
                        <div class="form-group">
                            <label for="updategender">Gender:</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="updategender" id="male"
                                       value="male" <?= $row['gender'] == 'male' ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="updategender" id="female"
                                       value="female" <?= $row['gender'] == 'female' ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="updatebirthdate">Birthday:</label>
                            <!-- Add options for months -->
<select name="updatebirthMonth" class="form-control">
    <?php
    $months = [
        '01' => 'January', '02' => 'February', '03' => 'March',
        '04' => 'April', '05' => 'May', '06' => 'June',
        '07' => 'July', '08' => 'August', '09' => 'September',
        '10' => 'October', '11' => 'November', '12' => 'December'
    ];

    foreach ($months as $key => $value) {
        echo '<option value="' . $key . '" ' . ($row['birth_month'] == $key ? 'selected' : '') . '>' . $value . '</option>';
    }
    ?>
</select>

<!-- Add options for dates -->
<select name="updatebirthDate" class="form-control">
    <?php
    for ($i = 1; $i <= 31; $i++) {
        echo '<option value="' . sprintf("%02d", $i) . '" ' . ($row['birth_date'] == sprintf("%02d", $i) ? 'selected' : '') . '>' . $i . '</option>';
    }
    ?>
</select>

<!-- Add options for years -->
<select name="updatebirthYear" class="form-control">
    <?php
    $currentYear = date('Y');
    $startYear = $currentYear - 100; // Change this range as needed
    $endYear = $currentYear - 18;   // Example: limit to 18 years ago

    for ($year = $startYear; $year <= $endYear; $year++) {
        echo '<option value="' . $year . '" ' . ($row['birth_year'] == $year ? 'selected' : '') . '>' . $year . '</option>';
    }
    ?>
</select>

                        </div>

                        <div class="form-group">
                            <textarea name="updateaddress" class="form-control"
                                      placeholder="Address"><?= $row['address']; ?></textarea>
                        </div>

                                        <div class="form-group">
                    <input type="password" name="updatepassword" class="form-control" id="passwordInput" placeholder="New Password">
                    <span toggle="#passwordInput" class="checkbox" onclick="togglePasswordVisibility()">&#128065;</span>
                </div>



                        <div class="form-group">
                            <label for="updatepaymentMode">Payment Mode:</label>
                            <select name="updatepaymentMode" class="form-control">
                                <option value="credit_card" <?= $row['payment_mode'] == 'credit_card' ? 'selected' : ''; ?>>Credit Card</option>
                                <option value="debit_card" <?= $row['payment_mode'] == 'debit_card' ? 'selected' : ''; ?>>Debit Card</option>
                                <option value="paypal" <?= $row['payment_mode'] == 'paypal' ? 'selected' : ''; ?>>PayPal</option>
                                <option value="COD" <?= $row['payment_mode'] == 'COD' ? 'selected' : ''; ?>>COD</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="file" name="userimage" class="form-control">
                        </div>

                        <div class="form-group">
                            <input type="submit" name="update" class="btn btn-info" value="Update">
                        </div>
                    </form>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>


<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('passwordInput');
        const currentType = passwordInput.getAttribute('type');
        const newType = (currentType === 'password') ? 'text' : 'password';

        passwordInput.setAttribute('type', newType);
    }
</script>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
