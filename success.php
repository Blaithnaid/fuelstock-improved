<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
// Import the functions.php file
require_once "functions.php";
redirectLogin();
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
            <h1>Fuel Stock Interface</h1>
            <ul id="menu">
                <li><a href="login.php"><u>Log In</u></a></li>
                <li><a href="signup.php"><b><u>Sign Up</u></b></a></li>
            </ul>
        </div>
        <div class="content">
            <h1>Sign up</h1>
            <p>Enter your details below to sign up for an account.</p>
            <form id="signupform" action="signup.php" method="post">
                <label for="username">Username: </label>
                <input type="text" name="username" id="username">
                <label for="password">Password: </label>
                <input type="password" name="password" id="password">
                <label for="confirmpassword">Confirm password: </label>
                <input type="password" name="confirmpassword" id="confirmpassword"><br>
                <input type="submit" name="submit" value="Submit">
            </form>
            <div>
                <h2>You have successfully created an account. Redirecting to login page in 3s...</h2>
                <?php header("refresh:3;url=login.php"); ?>
            </div>
        </div>
    </div>
</body>

</html>
