<?php
//Connect to the database server.
$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

//Select the database.
mysqli_select_db($link, "miniproject") or die(mysqli_error($link));

$complainid = $_POST["complain"];
$desc = $_POST["description"];

$query = "UPDATE complaint_reply SET CR_reply = '$desc' WHERE complaint_ID = '$complainid'";

$result = mysqli_query($link,$query) or die ("Could not execute query in update.php");
if($result){
	echo "<script type = 'text/javascript'> window.location='ComplaintListInterface.php' </script>";
}
?>