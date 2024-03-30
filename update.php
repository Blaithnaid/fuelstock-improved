<?php
require_once "functions.php";
session_start();
redirectLogin();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Fuel Stock Interface - Update</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        .insert {
            margin: 0 auto;
            width: 50%;
            padding: 20px;
            border: 1px solid #B0C4DE;
            background: black;
            border-radius: 0px 0px 10px 10px;
        }
        .insert label {
            display: block;
            margin: 10px 0px 5px;
        }
        .insert input[type=text], .insert input[type=date], .insert input[type=number], .insert textarea {
            width: 100%;
            padding: 5px;
            border: 1px solid #B0C4DE;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .insert input[type=submit] {
            width: 100%;
            padding: 10px;
            border: 1px solid #B0C4DE;
            border-radius: 5px;
            background: #B0C4DE;
            cursor: pointer;
            font-weight: bold;
            color: white;
        }
        .insert input[type=submit]:hover {
            background: #A9A9A9;
        }
        .insert textarea {
            height: 100px;
        }
    </style>
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
            <?php
            if (isset($_POST['id'])) {
                $id = $_POST['id'];

                // Create connection credentials
                $conn = createConnection();

                // Create SQL query
                $sql = "SELECT * FROM TRANSACTIONS WHERE TRANSACTION_ID = '$id'";

                // Execute SQL query and get result
                $result = $conn->query($sql);

                // Check if row exists
                if ($result->num_rows > 0) {
                    // Get row data
                    $row = $result->fetch_assoc();
                    ?>
                    <form action='update_row.php' method='post' class='insert'>
                        <h2>Transaction ID: <?php echo $row["TRANSACTION_ID"]; ?></h2>
                        <input type='hidden' name='id' value='<?php echo $row["TRANSACTION_ID"]; ?>'>
                        <label for='fuel_type_code'>Fuel Type Code: </label>
                        <input type='text' name='fuel_type_code' value='<?php echo $row["FUEL_TYPE_CODE"]; ?>'>
                        <label for='transaction_type_code'>Transaction Type Code: </label>
                        <input type='text' name='transaction_type_code' value='<?php echo $row["TRANSACTION_TYPE_CODE"]; ?>'>
                        <label for='transaction_date'>Transaction Date: </label>
                        <input type='text' name='transaction_date' value='<?php echo $row["TRANSACTION_DATE"]; ?>'>
                        <label for='transaction_amount'>Transaction Amount: </label>
                        <input type='text' name='transaction_amount' value='<?php echo $row["TRANSACTION_AMOUNT"]; ?>'>
                        <label for='other_details'>Other Details: </label>
                        <input type='text' name='other_details' value='<?php echo $row["OTHER_DETAILS"]; ?>'>
                        <input type='submit' value='Update'>
                    </form>
                    <?php
                } else {
                    echo "No row found with id $id";
                }

                // Close connection
                $conn->close();
            }
            ?>
        </div>
    </div>
</body>

</html>