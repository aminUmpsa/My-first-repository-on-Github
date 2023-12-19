<?php
	if(isset($_POST['submit'])) {
		$username = $_POST['user_userName'];
		$password = $_POST['user_password'];
		$result = $dbh->prepare("SELECT * FROM user WHERE user_userName= :user_userName AND user_password= :user_password");
		$result->bindParam(':user_userName', $username);
		$result->bindParam(':user_password', $password);
		$result->execute();
		$rows = $result->fetch(PDO::FETCH_NUM);
		if($rows > 0) {
			$result=$dbh->prepare("SELECT * FROM user WHERE user_userName=:user_userName");
			$result->bindParam(':user_userName', $username);
			$result->execute();
			while($row = $result->fetch(PDO::FETCH_ASSOC)){
				$res_id = $row['approval_ID'];
				$curr_status = $row['approval_status'];
			}
				if($curr_status=='Deactive') {
					$message = "Sorry <b>$username</b>, your account is temporarily deactivated by the admin.";
				}else{
					$_SESSION['approval_id'] = $res_id;
					header("location: home.php?logid=$res_id");
				}
		}
		else{
			$message = 'Username and Password are not exists.';
		}
	}
?>
