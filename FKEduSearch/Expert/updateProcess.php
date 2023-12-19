<?php
//Connect to the database server.
$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

//Select the database.
mysqli_select_db($link, "miniproject") or die(mysqli_error($link));

$expertid = $_GET['expert_ID'];

$userName = $_POST["username"];
$userfname = $_POST["userfname"];
$email = $_POST["email"];
$password = $_POST["password"];

$query = "UPDATE expert SET expert_userName = '$userName', expert_fullName = '$userfname', expert_email='$email', expert_password='$password'  WHERE expert_ID = '$expertid'";
$query1 = "UPDATE `login` SET login_userName = '$userName', login_password='$password' WHERE expert_ID = '$expertid'";

$result = mysqli_query($link,$query) or die ("Could not execute query in update.php");
$resultUpdate = mysqli_query($link,$query1) or die ("Could not execute query in update.php");
if($result&$resultUpdate){
	echo "<script type = 'text/javascript'> window.location='indexAdmin.php' </script>";
}
?>