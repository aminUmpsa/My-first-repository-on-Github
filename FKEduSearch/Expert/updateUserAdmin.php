<?php
    include'headerAdmin.php';
	
	$userid = $_GET['user_ID'];
?>



<!DOCTYPE html>
<html>
<head>
	<title>Update Page</title>
	<style>
		body {
			font-family: Arial, sans-serif;
		}

		h1 {
			text-align: center;
		}

		form {
			width: 300px;
			margin: 0 auto;
		}

		label {
			display: block;
			margin-bottom: 5px;
		}

		input[type="text"],
		input[type="email"],
		input[type="password"] {
			width: 100%;
			padding: 8px;
			margin-bottom: 10px;
			border-radius: 4px;
			border: 1px solid #ccc;
			box-sizing: border-box;
		}

		input[type="submit"] {
			background-color: #4CAF50;
			color: white;
			padding: 10px 15px;
			border: none;
			border-radius: 4px;
			cursor: pointer;
			width: 100%;
		}

		input[type="submit"]:hover {
			background-color: #45a049;
		}
	</style>
</head>
<body>
	<h1>Update User Profile</h1>
	<form action="updateUserProcess.php?user_ID=<?php echo $userid ?>" method="POST">
		<label for="username">Username:</label>
		<input type="text" id="username" name="username" required>

		<label for="userfname">User Fullname:</label>
		<input type="text" id="userfname" name="userfname" required>

		<label for="email">Email:</label>
		<input type="email" id="email" name="email" required>

		<label for="password">New Password:</label>
		<input type="password" id="password" name="password" required>

		<input type="submit" value="Update">
	</form>
</body>
</html>


<?php
    include'footerAdmin.php';
?>
