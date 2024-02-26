<?php
    // Create connection credentials
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "FUELSTOCK";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    if(!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if id is set in POST
    if(isset($_POST['id'])) {
        // Get id from POST
        $id = $_POST['id'];

        // Create SQL query
        $sql = "DELETE FROM TRANSACTIONS WHERE TRANSACTION_ID = '$id'";

        // Execute SQL query and check result
        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Rest of your code...
?>
<!DOCTYPE html>
<html>

<head>
    <title>Fuel Stock Interface - Select</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Fuel Stock Interface</h1>
            <ul id="menu">
                <li><a href="select.php"><b><u>Select/Delete/Update</u></b></a></li>
                <li><a href="insert.php"><u>Insert</u></a></li>
        </div>
        <div class="content">
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
            <table>
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Fuel Type Code</th>
                        <th>Transaction Type Code</th>
                        <th>Transaction Date</th>
                        <th>Transaction Amount</th>
                        <th>Other Details</th>
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

                        // If the column is set to ALL, search all columns for the search term
                        if ($columnq == "ALL") {
                            $sql = "SELECT * FROM TRANSACTIONS WHERE TRANSACTION_ID LIKE '%$searchq%' OR FUEL_TYPE_CODE LIKE '%$searchq%' OR TRANSACTION_TYPE_CODE LIKE '%$searchq%' OR TRANSACTION_DATE LIKE '%$searchq%' OR TRANSACTION_AMOUNT LIKE '%$searchq%' OR OTHER_DETAILS LIKE '%$searchq%'";
                        }
                        // Otherwise, search the specified column for the search term
                        else {
                            $sql = "SELECT * FROM TRANSACTIONS WHERE $columnq LIKE '%$searchq%'";
                        }
                        $result = $conn->query($sql);

                        // If there are results, output them in a table
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $row["TRANSACTION_ID"] . "</td><td>" . $row["FUEL_TYPE_CODE"] . "</td><td>" . $row["TRANSACTION_TYPE_CODE"] . "</td><td>" . $row["TRANSACTION_DATE"] . "</td><td>" . $row["TRANSACTION_AMOUNT"] . "</td><td>" . $row["OTHER_DETAILS"] . "</td>";
                                echo "<td><form action='' method='post' onsubmit='return confirm(\"Are you sure you want to delete this row?\");'><input type='hidden' name='id' value='" . $row["TRANSACTION_ID"] . "'><input type='submit' value='Delete'></form></td>";
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