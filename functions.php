<?php
function createConnection() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "FUELSTOCK";

    // Create connection
    $connection = new mysqli($servername, $username, $password, $dbname);
    if(!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $connection;
}
?>