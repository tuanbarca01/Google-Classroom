<?php
require('database.php');
$email = $_POST["email"];
$reset_token = $_POST["reset_token"];
$new_password = $_POST["new_password"];

$connection = mysqli_connect("localhost", "root", "", "classroom");

$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($connection, $sql);
if (mysqli_num_rows($result) > 0)
{
	$user = mysqli_fetch_object($result);
	if ($user->reset_token == $reset_token)
	{
		$sql = "UPDATE users SET reset_token='', password='$new_password' WHERE email='$email'";
		mysqli_query($connection, $sql);
		echo '<script language="javascript">';
		echo 'alert("Password has been changed")';
		echo '</script>';
	}
	else
	{
		echo '<script language="javascript">';
		echo 'alert("Recovery email has been expired")';
		echo '</script>';
	}
}
else
{
	echo '<script language="javascript">';
	echo 'alert("Email does not exists")';
	echo '</script>';
}
