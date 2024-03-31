<?php
require_once 'functions.php'; // Import the functions.php file so we can use createConnection()
// Start session
session_start();
// Check if user is logged in
redirectLogin();
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
                <label for="fuel_type_code">Fuel Type Code: </label>
                <input type="text" name="fuel_type_code" id="fuel_type_code">
                <label for="transaction_type_code">Transaction Type Code: </label>
                <input type="text" name="transaction_type_code" id="transaction_type_code">
                <label for="transaction_date">Transaction Date: </label>
                <input type="date" name="transaction_date" id="transaction_date">
                <label for="transaction_amount">Transaction Amount: </label>
                <input type="number" name="transaction_amount" id="transaction_amount">
                <label for="other_details">Other Details: </label>
                <textarea name="other_details" id="other_details"></textarea>
                <input type="submit" name="submit" value="Submit">
            </form>
            <?php
            if (isset($_POST['submit'])) {
                // Get row data from form
                $fuel_type_code = $_POST['fuel_type_code'];
                $transaction_type_code = $_POST['transaction_type_code'];
                $transaction_date = DateTime::createFromFormat('Y-m-d', $_POST['transaction_date'])->format('d/m/y');
                $transaction_amount = $_POST['transaction_amount'];
                $other_details = $_POST['other_details'];

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
        </div>
    </div>
</body>

</html>