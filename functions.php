<?php
function createConnection()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "fuelstock_beta";

    // Create connection
    $connection = new mysqli($servername, $username, $password, $dbname);
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $connection;
}

function checkLogin()
{
    if (isset($_COOKIE["user_id"]) && isset($_COOKIE["username"])) { // First, check if the user has a cookie
        // If they do, set the session variables to the cookie values
        $_SESSION["user_id"] = $_COOKIE["user_id"];
        $_SESSION["username"] = $_COOKIE["username"];
        // If the user is an admin, set the session variable to true
        if (isset($_COOKIE["isAdmin"]) && $_COOKIE["isAdmin"] == 1) {
            $_SESSION["isAdmin"] = true;
        }
    } else if (!isset($_SESSION["user_id"])) {
        // If the user doesn't have a cookie, check if they have a session
        // If they don't have a session, redirect them to the login page
        header("Location: login.php");
        exit();
    }
}

// Function to validate and authenticate user login
function validateUser($username, $password, $rememberme)
{
    $conn = createConnection();
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            if ($row['isAdmin'] == 1) {
                $_SESSION['isAdmin'] = true;
            }
            if (isset($rememberme)) {
                setcookie("user_id", $row['id'], time() + (86400 * 30), "/"); // 86400 = 1 day
                setcookie("username", $row['username'], time() + (86400 * 30), "/");
                if ($row['isAdmin'] == 1) {
                    setcookie("isAdmin", 1, time() + (86400 * 30), "/");
                }
            }
            return true;
        }
        return "The entered password is incorrect. Please try again.";
        // returning two separate outcomes isn't very secure, but I just think it looks fancier
    }
    return "A user with that username does not exist. Please try again.";
}
function usernameExists($username)
{
    $conn = createConnection();
    $query = "SELECT * FROM `users` WHERE `username` = '$username'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        return true;
    }
    return false;
}
