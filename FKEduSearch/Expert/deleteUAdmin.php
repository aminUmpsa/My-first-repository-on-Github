<?php
//Connect to the database server.
$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

//Select the database.
mysqli_select_db($link, "miniproject") or die(mysqli_error($link));

$userid = $_GET['user_ID'];

//SQL query
$query = "SELECT * FROM user WHERE user_ID = '$userid'"
	or die(mysqli_connect_error());

//Execute the query (the recordset $rs contains the result)
$result = mysqli_query($link, $query);

$row = mysqli_fetch_assoc($result);

// del to delete a record
$del = "DELETE FROM user WHERE user_ID='$userid'";

if (mysqli_query($link, $del)) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
  echo "Error deleting record: " . mysqli_error($link);
}

?>