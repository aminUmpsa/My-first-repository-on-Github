<?php
//Connect to the database server.
$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

//Select the database.
mysqli_select_db($link, "miniproject") or die(mysqli_error($link));

$expertid = $_GET['expert_ID'];

//SQL query
$query = "SELECT * FROM expert WHERE expert_ID = '$expertid'"
	or die(mysqli_connect_error());

//Execute the query (the recordset $rs contains the result)
$result = mysqli_query($link, $query);

$row = mysqli_fetch_assoc($result);

// del to delete a record
$del = "DELETE FROM expert WHERE expert_ID='$expertid'";

if (mysqli_query($link, $del)) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
  echo "Error deleting record: " . mysqli_error($link);
}

?>