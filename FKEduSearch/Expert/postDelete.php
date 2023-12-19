
<?php

$page = 'post';

?>


<?php
	if (isset($_REQUEST['id'])) {
    $idDelete = $_REQUEST['id'];
    
   $link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());


	mysqli_select_db($link, "miniproject") or die(mysqli_error($link));
    
    // Retrieve the publication record
    $query = "SELECT * FROM post WHERE post_ID = $idDelete";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_assoc($result);
    
    // Delete the record from the database
    $delete_query = "DELETE FROM post WHERE post_ID = $idDelete";
    mysqli_query($link, $delete_query);
    
    // Close the database connection
    mysqli_close($link);
  	$alert_message = "Post Has Been Deleted !!!";	
	echo "<script>alert('$alert_message');</script>";
	echo "<script type = 'text/javascript'> window.location='userYourPostAminBetul.php' </script>";
    exit;
} else {
    // ID not provided
    echo 'Invalid request !!!';
}
?>
