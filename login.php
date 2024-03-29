<?php
require_once "functions.php"; // include the functions file so we can use createConnection() and validateUser()
session_start(); // start or resume the session
error_reporting(E_ALL); // report errors of all levels
ini_set("display_errors", 1); // display those errors

if (isset($_SESSION["user_id"])) { // if the user is already logged in, redirect them to the select page
    header("Location: select.php");
} elseif (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $conn = createConnection();
    if (!$conn) {
        $promptText = "Connection failed: " . mysqli_connect_error();
    }
    if (validateUser($username, $password) === true) {
        header("Location: index.php");
    } else {
        $promptText =
            "The entered username or password is incorrect.<br>Please try again.";
    }
} else {
    $promptText = "Please enter a username and password.";
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Fuel Stock Interface - Login</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
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
            <p>
                <?php echo $promptText; ?>
            </p>
            <form action="login.php" method="post">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" value="Login">
            </form>
       </div>
    </div>
</body>

</html>