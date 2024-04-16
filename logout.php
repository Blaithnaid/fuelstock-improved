<?php
session_start();
// clear cookies and session variables
// this works by setting the cookie values to empty strings,
// and setting the expiration time to a time in the past
if (isset($_COOKIE["user_id"]) && isset($_COOKIE["username"])){
    $user_id = $_COOKIE["user_id"];
    $username = $_COOKIE["username"];
    setcookie("user_id", $user_id, time()-3600);
    setcookie("username", $username, time()-3600);
    if (isset($_COOKIE["isAdmin"])){
        $isAdmin = $_COOKIE["isAdmin"];
        setcookie("isAdmin", $isAdmin, time()-3600);
    }
}

// resets the session and redirects to login.php
session_destroy();
header("Location: login.php");
exit();
