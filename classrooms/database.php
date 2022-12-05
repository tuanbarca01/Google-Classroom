<?php
$server_username = "root";
$server_password = "";
$server_host = "localhost";
$database = 'classroom';

$conn = mysqli_connect($server_host,$server_username,$server_password,$database);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
mysqli_query($conn,"SET NAMES 'UTF8'");
?>