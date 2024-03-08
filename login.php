<?php 
    session_start();
    if (isset($_SESSION['username'])) {
        header("Location: home.php");
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
                <li><a href="login.html"><b><u>Log In</u></b></a></li>
                <li><a href="signup.html"><u>Sign Up</u></a></li>
            </ul>
        </div>
        <div class="content">
            <p>Enter login details below.</p>
            <form id="loginform" action="select.php" method="post">
                <label for="username">Username: </label>
                <input type="text" name="username" id="username">
                <label for="password">Password: </label>
                <input type="password" name="password" id="password">
                <input type="submit" name="submit" value="Submit">
            </form>
            <p>Please take note:</p>
            <ul>
                <li>Your username must be unique.</li>
                <li>Your password must be at least 8 characters long.</li>
            </ul>
        </div>
    </div>
</body>

</html>