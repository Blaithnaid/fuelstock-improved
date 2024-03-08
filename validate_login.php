<?php
include('functions.php'); // Import the functions.php file so we can use createConnection()

session_start(); // Start the session

$conn = createConnection(); // Create the connection

// Get the username and password from the form
$name = $_POST['user'];
$pass = $_POST['password'];

// Create the SQL query
$search = "select * from users where username = '$name' && password ='$pass'";

// Execute the query
$result = mysqli_query($con, $search);

// Get the number of rows returned
$num = mysqli_num_rows($result);

if ($num == 1) { // If there is a user with the given username and password
	$_SESSION['username'] = $name;
	header('location:select.php'); // Redirect to the select.php page
} else {
	header('location:login.php'); // Otherwise, redirect to the login.php page
}

?>