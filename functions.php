<?php
function createConnection() {
    $servername = "localhost";
    $username = "fueladmin";
    $password = "petrolhead";
    $dbname = "fuelstock";

    // Create connection
    $connection = new mysqli($servername, $username, $password, $dbname);
    if(!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $connection;
}
