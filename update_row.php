<!DOCTYPE html>
<html>

<head>
    <title>Fuel Stock Interface - Updating...</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        p {
            text-align: center;
            font-size: 20px;
            margin-top: 20px;
        }

        body {
            background: black;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .textcentre {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="textcentre">
        <?php
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $fuel_type_code = $_POST['fuel_type_code'];
            $transaction_type_code = $_POST['transaction_type_code'];
            $transaction_date = $_POST['transaction_date'];
            $transaction_amount = $_POST['transaction_amount'];
            $other_details = $_POST['other_details'];

            // Create connection credentials
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "FUELSTOCK";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Create SQL query
            $sql = "UPDATE TRANSACTIONS SET FUEL_TYPE_CODE = '$fuel_type_code', TRANSACTION_TYPE_CODE = '$transaction_type_code', TRANSACTION_DATE = '$transaction_date', TRANSACTION_AMOUNT = '$transaction_amount', OTHER_DETAILS = '$other_details' WHERE TRANSACTION_ID = '$id'";

            // Execute SQL query and check result
            if ($conn->query($sql) === TRUE) {
                echo "<p>Record updated successfully</p>";
            } else {
                echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
            }
            echo "<p>Returning to Select/Delete/Update page in 3 seconds...</p>";
            header("refresh:3;url=select.php");
            // Close connection
            $conn->close();
        }
        ?>
    </div>
</body>

<style