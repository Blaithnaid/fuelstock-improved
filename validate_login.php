<?php
include('functions.php'); // Import the functions.php file so we can use createConnection()

session_start(); // Start the session

$conn = createConnection(); // Create the connection

// Get the username and password from the form
$name = $_POST['username'];
$pass = $_POST['password'];

// Create and execute the SQL query
$search = "select * from users where username = '$name'";
$result = mysqli_query($conn, $search);

// Get the password from the result
$row = mysqli_fetch_assoc($result);
$hash = $row['password'];

// Get the number of rows returned
$num = mysqli_num_rows($result);

// If there is a user with the given username and password, and the password is correct, then log the user in
if ($num == 1 && password_verify($pass, $hash)) {
	$_SESSION['username'] = $name;
	header('location:select.php'); // Redirect to the select.php page
} else {
	header('location:login.php'); // Otherwise, redirect to the login.php page
}
?>