<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
// Import the functions.php file
require_once "functions.php";
$returnText = "Usernames must be unique. Passwords must match.";
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the username and password from the form
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmpassword"];
    $returnText = "An error occurred. Please try again."; // default return text

    // check if the password and confirm password match
    if ($password !== $confirmPassword) {
        $returnText = "Passwords do not match";
        exit();
        // check if the username is already taken
    } elseif (usernameExists($username)) {
        $returnText = "Username already taken";
        exit();
    } else {
        // hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // create a database connection
        $connection = createConnection();

        // insert the username and hashed password into the database
        $query = "INSERT INTO users (`username`, `password`) VALUES ('$username', '$hashedPassword')";
        mysqli_query($connection, $query);

        // close the database connection
        mysqli_close($connection);

        // redirect to a success page
        header("Location: success.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Fuel Stock Interface - Signup</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        #signupform {
            margin-top: 20px;
        }

        #signupform label {
            display: block;
            margin-top: 10px;
        }

        #signupform input {
            margin-top: 5px;
        }
        #signupform input[type="submit"] {
            margin-top: 10px;
        }
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
                <p><?php echo $returnText;?></p>
            </div>
        </div>
    </div>
</body>

</html>
