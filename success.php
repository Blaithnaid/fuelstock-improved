<?php
require_once "functions.php";
session_start();
if (!isset($_SESSION["user_id"])) {
    $confirmationText = "You have successfully logged in!<br>Redirecting you to the select page...";
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Fuel Stock Interface - Success</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        #confirmation {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Fuel Stock Interface</h1>
        </div>
        <div id="confirmation">
            <h1>Success</h1>
            <p><?php echo $confirmationText; ?></p>
        </div>
    </div>