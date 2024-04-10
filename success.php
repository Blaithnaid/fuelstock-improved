<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
// Import the functions.php file
require_once "functions.php";
?>
<!DOCTYPE html>
<html>

<head>
    <title>Fuel Stock Interface - Success</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Fuel Stock Interface - Success</h1>
            <ul id="menu">
                <li><a href="login.php"><u>Log In</u></a></li>
                <li><a href="signup.php"><b><u>Sign Up</u></b></a></li>
            </ul>
        </div>
        <div class="content">
            <h3>You have successfully created an account.<br>Redirecting to login page in 3s...</h3>
            <?php if (!isset($_SESSION["user_id"])) {
                header("refresh:3;url=login.php");
            } else {
                header("login.php");
            } ?>
        </div>
    </div>
</body>

</html>