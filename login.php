<?php
require_once "functions.php"; // include the functions file so we can use createConnection() and validateUser()
session_start(); // start or resume the session
error_reporting(E_ALL); // report errors of all levels
ini_set("display_errors", 1); // display those errors

if (isset($_SESSION["noCredentials"])) { // if the user tried to access a page without logging in
    $promptText = "You must log in to access that page.";
    unset($_SESSION["noCredentials"]);
} else {
    $promptText = "Please enter a username and password.";
}
if (isset($_SESSION["user_id"])) { // if the user is already logged in, redirect them to the select page
    header("Location: select.php");
} elseif (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $rememberme = isset($_POST["rememberme"]);

    $conn = createConnection();
    if (!$conn) {
        $promptText = "Connection failed: " . mysqli_connect_error();
    }
    if (validateUser($username, $password, $rememberme) === true) {
        header("Location: select.php");
    } else {
        $promptText =
            "The entered username or password is incorrect.<br>Please try again.";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Fuel Stock Interface - Login</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        #loginbox {
            margin-top: 20px;
        }

        #loginbox input {
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Fuel Stock Interface</h1>
            <ul id="menu">
                <li><a href="login.php"><b><u>Log In</u></b></a></li>
                <li><a href="signup.php"><u>Sign Up</u></a></li>
            </ul>
        </div>
        <div id="loginbox">
            <h1>Login</h1>
            <form action="login.php" method="post">
                <label for="username">Username:</label><br>
                <input type="text" name="username" placeholder="Username" required><br>
                <label for="password">Password:</label><br>
                <input type="password" name="password" placeholder="Password" required><br><br>
                <input type="checkbox" name="rememberme" value="0"> Remember me<br><br>
                <input type="submit" value="Login">
            </form>
            <p>
                <?php echo $promptText; ?>
            </p>
       </div>
    </div>
</body>

</html>
