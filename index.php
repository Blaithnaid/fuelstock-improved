<?php // this just redirects the user to the select page if they're already logged in, or to the login page if they're not
session_start(); // start or resume the session
if (isset($_SESSION["user_id"])) {
    header("Location: select.php");
} else {
    header("Location: login.php");
}
?>