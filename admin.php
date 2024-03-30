<?php
include_once "functions.php"; // Import createConnection(); function
redirectLogin(); // Check if user is logged in
if (!isset($_SESSION["isAdmin"])) {
    header("Location: select.php");
    exit();
}
$conn = createConnection(); // Create a connection to the database via createConnection(); 

if (!$conn) { // Check connection
    die("Connection failed: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Fuel Stock Interface - Admin Console</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <div id="logout"><a href="logout.php">Logout</a></div>
    <div class="container">
        <div class="header">
            <h1>Fuel Stock Interface</h1>
            <ul id="menu">
                <li><a href="select.php"><b><u>Select/Delete/Update</u></b></a></li>
                <li><a href="insert.php"><u>Insert</u></a></li>
            </ul>
        </div>
        <div class="content">
        </div>
    </div>
</body>

</html>
