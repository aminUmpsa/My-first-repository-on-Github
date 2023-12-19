<?php
	session_start();
	if(!isset($_SESSION['id'])) {
		header('Location:header.php');
	}
 
	require_once('cdbconn.php');
 
	$get_userid = $_GET['user_ID'];
 
	$result=$dbh->prepare("Select * From user Where user_ID='$get_userid'");
	$result->execute();
	while($row = $result->fetch(PDO::FETCH_ASSOC)){	
		echo $curr_status = $row['approval_status'];
	}
 
	if($curr_status == "Active") {
		$sql = "UPDATE approval 
        SET approval_status=?
		WHERE approval_ID=?";
 
		$this_status = "Deactive";
		$q = $dbh->prepare($sql);
		$q->execute(array($this_status, $get_userid));
		header("location: home.php");
	} else {
		$sql = "UPDATE approval
        SET approval_status=?
		WHERE approval_ID=?";
 
		$this_status = "Active";
		$q = $dbh->prepare($sql);
		$q->execute(array($this_status, $get_userid));
		header("location: home.php");
	}
?>