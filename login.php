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
		<a href="register.php">
			<h4>Create an Account</h4>
		</a>
	</div>
    </div>
</body>

</html>