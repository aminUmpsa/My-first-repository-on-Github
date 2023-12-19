<?php
//Connect to the database server.
$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

//Select the database.
mysqli_select_db($link, "miniproject") or die(mysqli_error($link));

$userid = $_GET['user_ID'];

$userName = $_POST["username"];
$userFullName = $_POST["userfname"];
$email = $_POST["email"];
$password = $_POST["password"];

$query = "UPDATE user SET user_userName = '$userName', user_fullName = '$userfname', user_email='$email', user_password='$password'  WHERE user_ID = '$userid'";
$query1 = "UPDATE `login` SET login_userName = '$userName', login_password='$password' WHERE user_ID = '$userid'";

$result = mysqli_query($link,$query) or die ("Could not execute query in update.php");
$resultUpdate = mysqli_query($link,$query1) or die ("Could not execute query in update.php");
if($result&$resultUpdate){
	echo "<script type = 'text/javascript'> window.location='indexAdmin.php' </script>";
}
?>