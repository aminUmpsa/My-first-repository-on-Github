<?php
//Connect to the database server.
$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

$userid=$_GET['iduser'];
$post=$_GET['post'];

//Select the database.
mysqli_select_db($link, "miniproject") or die(mysqli_error($link));

$query = "SELECT complaint_ID FROM complaint WHERE user_ID = $userid AND post_AnswerID = $post"
	or die(mysqli_connect_error());
	
	
//link to query
$result = mysqli_query($link, $query);

$row = mysqli_fetch_assoc($result);

$complain=$row["complaint_ID"];

//update the complaint id in post answer table
$sql = "UPDATE post_answer SET complaint_ID = $complain WHERE post_AnswerID = '$post'";

$result = mysqli_query($link,$sql) or die ("Could not add a query");

if($result){
	echo "<script type = 'text/javascript'> window.location='ComplaintInterface.php?id=$userid' </script>";
}
?>