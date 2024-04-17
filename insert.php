<?php
require_once 'functions.php'; // Import the functions.php file so we can use createConnection()
// Start session
session_start();
error_reporting(E_ALL); // report errors of all levels
ini_set("display_errors", 1); // display those errors
// Check if user is logged in
checkLogin();

// Set error text to empty
$errorText = "";
?>
<!DOCTYPE html>
<html>

<head>
    <title>Fuel Stock Interface - Insert</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <div id="contextbox">
        <a href="logout.php">
            <div>Logout</div>
        </a>
        <?php if ($_SESSION["isAdmin"] === true) {
            echo "<a href='admin.php'><div>Admin Settings</div></a>";
        } ?>
    </div>
    <div class="container">
        <div class="header">
            <h1>Fuel Stock Interface</h1>
            <ul id="menu">
                <li><a href="select.php"><u>Select/Delete/Update</u></a></li>
                <li><a href="insert.php"><b><u>Insert</u></b></a></li>
        </div>
        <div class="content">
            <form action="insert.php" method="post" class="insert">
                <label for="fuel_type_code">Fuel Type: </label>
                <select required name="fuel_type_code" id="fuel_type_code">
                    <option value="1">Petrol</option>
                    <option value="2">Diesel</option>
                    <option value="3">Electricity</option>
                </select>
                <label for="transaction_type_code">Transaction Type: </label>
                <select required name="transaction_type_code" id="transaction_type_code">
                    <option value="1">Purchase</option>
                    <option value="2">Sale</option>
                    <option value="3">Refund</option>
                </select>
                <label for="transaction_date">Transaction Date: </label>
                <input required type="date" name="transaction_date" id="transaction_date">
                <label for="transaction_amount">Transaction Amount: </label>
                <input required type="number" name="transaction_amount" id="transaction_amount">
                <label for="other_details">Other Details: </label>
                <textarea name="other_details" id="other_details"></textarea>
                <input type="submit" name="submit" value="Submit">
            </form>
            <?php
            if (isset($_POST['submit'])) {
                // Get row data from form
                $fuel_type_code = $_POST['fuel_type_code'];
                $transaction_type_code = $_POST['transaction_type_code'];
                $transaction_date = $_POST['transaction_date'];
                $transaction_amount = $_POST['transaction_amount'];
                $other_details = $_POST['other_details'];


                // Check if any fields are empty
                if (empty($fuel_type_code) || empty($transaction_type_code) || empty($transaction_date) || empty($transaction_amount)) {
                    $errorText = "Error: One or more fields are empty";
                    return;
                }

                // Check if transaction amount is negative
                if ($transaction_amount < 0) {
                    $errorText = "Error: Transaction amount cannot be negative";
                    return;
                }

                // Check if transaction date is in the future
                if (new DateTime($transaction_date) > new DateTime()) {
                    $errorText = "Error: Transaction date cannot be in the future";
                    return;
                }

                // Create connection
                $conn = createConnection();
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Create SQL query
                $sql = "INSERT INTO TRANSACTIONS (FUEL_TYPE_CODE, TRANSACTION_TYPE_CODE, TRANSACTION_DATE, TRANSACTION_AMOUNT, OTHER_DETAILS) VALUES ('$fuel_type_code', '$transaction_type_code', '$transaction_date', '$transaction_amount', '$other_details')";

                // Execute SQL query and check result
                if ($conn->query($sql) === TRUE) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                // Close connection
                $conn->close();
            }
            ?>
            <div class="error-text">
                <p><?php echo $errorText ?></p>
            </div>
        </div>
    </div>
</body>

</html>