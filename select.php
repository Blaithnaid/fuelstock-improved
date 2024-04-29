<?php
require_once "functions.php"; // Import createConnection(); function
session_start(); // Start session
checkLogin(); // Check if user is logged in
$conn = createConnection(); // Create a connection to the database via createConnection();

if (!$conn) { // Check connection
    die("Connection failed: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Fuel Stock Interface - Select</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <?php
    // Check if id is set in POST
    if (isset($_POST['row_id'])) {
        // Get id from POST
        $id = $_POST['row_id'];

        // Create SQL query
        $sql = "DELETE FROM TRANSACTIONS WHERE TRANSACTION_ID = '$id'";

        // Execute SQL query and check result
        if ($conn->query($sql) === true) {
            echo "<span id='confirm_deletion'>Record deleted successfully</span>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>
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
            <h1>Fuel Stock Interface - Select/Update/Delete</h1>
            <ul id="menu">
                <li><a href="select.php"><b><u>Select/Delete/Update</u></b></a></li>
                <li><a href="insert.php"><u>Insert</u></a></li>
            </ul>
        </div>
        <div class="content">
            <h3>
                Welcome, <?php echo $_SESSION["username"]; ?>.
            </h3>
            <p>Enter a search term below to query the database. Pick a table from the drop-down on the right to refine
                your selection.</p>
            <form action="select.php" method="post">
                <label for="searchq">Search Query: </label>
                <input type="text" name="searchq" id="searchq">
                <input type="submit" name="submit" value="Submit">
                <label for="columnq">In Column: </label>
                <select name="columnq" id="columnq">
                    <option value="ALL">All</option>
                    <option value="TRANSACTION_ID">Transaction ID</option>
                    <option value="FUEL_TYPE_CODE">Fuel Type Code</option>
                    <option value="TRANSACTION_TYPE_CODE">Transaction Type Code</option>
                    <option value="TRANSACTION_DATE">Transaction Date</option>
                    <option value="TRANSACTION_AMOUNT">Transaction Amount</option>
                    <option value="OTHER_DETAILS">Other Details</option>
                </select>
            </form>
            <br>
            <table aria-label="Fuel Stock Transactions">
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Fuel Type Code</th>
                        <th>Transaction Type Code</th>
                        <th>Transaction Date</th>
                        <th>Transaction Amount</th>
                        <th>Other Details</th>
                        <th>Last Edited</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Check if file is being called from a post request
                    if (isset($_POST['submit'])) {
                        // Get search term and column to search in
                        $searchq = $_POST['searchq'];
                        $columnq = $_POST['columnq'];

                        if ($columnq == "ALL") {
                            $sql = "SELECT t.*, f.fuel_type_name, tr.transaction_type_name FROM TRANSACTIONS t 
                                    LEFT JOIN ref_fuel_types f ON t.FUEL_TYPE_CODE = f.fuel_type_code 
                                    LEFT JOIN ref_transaction_types tr ON t.TRANSACTION_TYPE_CODE = tr.transaction_type_code 
                                    WHERE t.TRANSACTION_ID LIKE '%$searchq%' 
                                    OR t.FUEL_TYPE_CODE LIKE '%$searchq%' 
                                    OR t.TRANSACTION_TYPE_CODE LIKE '%$searchq%' 
                                    OR t.TRANSACTION_DATE LIKE '%$searchq%' 
                                    OR t.TRANSACTION_AMOUNT LIKE '%$searchq%' 
                                    OR t.OTHER_DETAILS LIKE '%$searchq%'
                                    OR f.fuel_type_name LIKE '%$searchq%'
                                    OR tr.transaction_type_name LIKE '%$searchq%'";
                        } else {
                            $sql = "SELECT t.*, f.fuel_type_name, tr.transaction_type_name FROM TRANSACTIONS t 
                                    LEFT JOIN ref_fuel_types f ON t.FUEL_TYPE_CODE = f.fuel_type_code 
                                    LEFT JOIN ref_transaction_types tr ON t.TRANSACTION_TYPE_CODE = tr.transaction_type_code 
                                    WHERE t.$columnq LIKE '%$searchq%'";
                        }
                        $result = $conn->query($sql);

                        // If there are results, output them in a table
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $row["TRANSACTION_ID"] . "</td><td>" . $row["fuel_type_name"] . "</td><td>" . $row["transaction_type_name"] . "</td><td>" . $row["TRANSACTION_DATE"] . "</td><td>" . $row["CURRENCY_SYMBOL"] . $row["TRANSACTION_AMOUNT"] . "</td><td>" . $row["OTHER_DETAILS"] . "</td><td>" . $row["LAST_EDITED"] . "</td>";
                                echo "<td><form action='' method='post' onsubmit='return confirm(\"Are you sure you want to delete this row?\");'><input type='hidden' name='row_id' value='" . $row["TRANSACTION_ID"] . "'><input type='submit' value='Delete'></form></td>";
                                echo "<td><form action='update.php' method='post'><input type='hidden' name='id' value='" . $row["TRANSACTION_ID"] . "'><input type='submit' value='Update'></form></td></tr>";
                            }
                        } else {
                            echo "0 results";
                        }
                        $conn->close();
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>