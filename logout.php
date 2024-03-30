<?php
// resets the session and redirects to login.php
session_start();
session_destroy();
header("Location: login.php");
?>