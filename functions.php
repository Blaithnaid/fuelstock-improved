<?php
function createConnection() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "fuelstock_beta";

    // Create connection
    $connection = new mysqli($servername, $username, $password, $dbname);
    if(!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $connection;
}

function redirectLogin() {
    header("Location: login.php");
    exit();
}
