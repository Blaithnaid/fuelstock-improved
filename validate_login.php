<?php
include('functions.php'); // Import the functions.php file so we can use createConnection()

session_start(); // Start the session

$conn = createConnection(); // Create the connection

$name = $_POST['user'];
$pass = $_POST['password'];

$s= "select * from users where username = '$name' && password ='$pass'";

$result = mysqli_query($con,$s);

$num = mysqli_num_rows($result);

if($num==1){
	$_SESSION['username']= $name;
	header('location:select.php');
}else{
	header('location:login.php');
}

?>