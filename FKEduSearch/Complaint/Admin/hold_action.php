<?php
//Connect to the database server.
$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

//Select the database.
mysqli_select_db($link, "miniproject") or die(mysqli_error($link));

$complainid = $_GET["id"];

$query = "UPDATE complaint SET complaintStatus_ID = 2 WHERE complaint_ID = '$complainid'";

$resultUpdate = mysqli_query($link,$query) or die ("Could not add a query");
if($resultUpdate){
	echo "<script type = 'text/javascript'> window.location='ComplaintListInterface.php' </script>";
}
?>