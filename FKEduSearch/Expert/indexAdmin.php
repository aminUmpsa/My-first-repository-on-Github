<?php
session_start();
	include'headerAdmin.php';

	// Establish a database connection (replace the placeholder values with your actual credentials)
	$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());
	mysqli_select_db($link, "miniproject") or die(mysqli_error($link));

	// Fetch data from the user, and expert tables using SELECT
	$query = "SELECT expert_userName, expert_ID
		FROM expert";

$queryU = "SELECT user_userName, user_ID
		FROM user";

	$result = mysqli_query($link, $query);
	$resultU = mysqli_query($link, $queryU);

	// Close the database connection
	mysqli_close($link);
?>

<!DOCTYPE html>
<html>
<head>
	<title>ADMIN</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: white;
			margin: 0;
			padding: 0;
		}

		.container {
			max-width: 800px;
			margin: 0 auto;
			padding: 20px;
			background-color: #fff;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		}

		h1 {
			text-align: center;
			margin-bottom: 30px;
		}

		form {
			margin-bottom: 20px;
		}

		label {
			display: block;
			font-weight: bold;
			margin-bottom: 5px;
		}

		input[type="text"],
		input[type="email"],
		input[type="password"],
		select {
			width: 100%;
			padding: 10px;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
		}

		.error {
			color: red;
			margin-bottom: 10px;
		}

		.btn {
			display: inline-block;
			background-color: #4CAF50;
			color: #fff;
			padding: 10px 20px;
			border-radius: 4px;
			border: none;
			cursor: pointer;
			transition: background-color 0.3s;
		}

		.btn:hover {
			background-color: #45a049;
		}

		.table {
			width: 100%;
			border-collapse: collapse;
			margin-bottom: 20px;
		}

		.table th,
		.table td {
			padding: 8px;
			border: 1px solid #ddd;
		}

		.table th {
			background-color: #f2f2f2;
			font-weight: bold;
		}

		.table tr:nth-child(even) {
			background-color: #f9f9f9;
		}

		.content {
			overflow-y: scroll;
			height: 1000px;
			width: 100%;
			margin: 0 auto;
			padding: 20px;
			display: flex;
			flex-direction: column;
			align-items: center;
		}

		.graph {
			width: 100%;
			max-width: 800px;
			margin-top: 30px;
			text-align: center;
		}
	</style>
</head>
<body align="center">
	<div class="content">
	<form action="register.php" method="post">
		<h2>Registered New User</h2>
		
		<?php if(isset($_GET['error'])) { ?>
			<p class="error"><?php echo $_GET['error']; ?></p> 
		<?php } ?>
		
		<label>Username :</label>
		<input type="text" name="uname" placeholder="Username" required><br><br>
		<label>Full Name: </label>
		<input type="text" name="fname" placeholder="Fullname" required><br><br>
		
	
		
		<label>Email :</label>
		<input type="text" name="email" placeholder="Email" required><br><br>
		
		<label>Password :</label>
		<input type="text" name="password" placeholder="Password" required><br><br>
		
			<label>Select Role :</label>
		<select name="role" required>
			<option value="">Role</option>
			<option value="Admin">Admin</option>
			<option value="Expert">Expert</option>
			<option value="User">User</option>
		</select><br><br>
		
		<p><a href="index.php">Log in here</a></p>
		<button type="submit">Add Registration</button><br><br>
		
		
		
	</form>
	<table border="1" class="table" style="width: 100%">
<tr class="thread">
  <th class="th" scope="col">No</th>
  <th class="th" scope="col">Expert Username</th>
  <th class="th" scope="col">Expert ID</th>
  <th class="th" scope="col">Reactivate Approval</th>
            </tr>
            <tr>
<?php  if (mysqli_num_rows($result) > 0){
    // output data of each row
    $no = 0;
    while($row = mysqli_fetch_assoc($result) ){
    $no = $no + 1;
    $expertname = $row["expert_userName"];
    $expertid = $row["expert_ID"];   
?>	
 <td class="td"><?php echo $no; ?></td>
    <td class="td"><?php echo $expertname; ?></td>
		<td class="td"><?php echo $expertid; ?></td>
	<td align="center"> 
	<a><button class="button-48" type="button" onclick="window.location.href='/FKEduSearch/Expert/updateAdmin.php?expert_ID=<?php echo $expertid?>'">Update</button></a>
	<a><button class="button-48" type="button" onclick="window.location.href='/FKEduSearch/Expert/deleteAdmin.php?expert_ID=<?php echo $expertid?>'">Delete</button></td>
	</tr>
<?php
    }
} else {
    echo "0 results";

}
?>
</table>

<br><br>

<table border="1" class="table" style="width: 100%">
<tr class="thread">
  <th class="th" scope="col">No</th>
  <th class="th" scope="col">User Username</th>
  <th class="th" scope="col">User ID</th>
  <th class="th" scope="col">Reactivate Approval</th>
            </tr>
            <tr>
<?php  if (mysqli_num_rows($resultU) > 0){
    // output data of each row
    $no = 0;
    while($rowU = mysqli_fetch_assoc($resultU) ){
    $no = $no + 1;
    $username = $rowU["user_userName"];
    $userid = $rowU["user_ID"];   
?>	
 <td class="td"><?php echo $no; ?></td>
    <td class="td"><?php echo $username; ?></td>
    <td class="td"><?php echo $userid; ?></td>
	<td align="center">
	<a><button class="button-48" type="button" onclick="window.location.href='/FKEduSearch/Expert/updateUserAdmin.php?user_ID=<?php echo $userid?>'">Update</button></a>
	<a><button class="button-48" type="button" onclick="window.location.href='/FKEduSearch/Expert/deleteUAdmin.php?user_ID=<?php echo $userid?>'">Delete</button></td>
	</tr>
<?php
    }
} else {
    echo "0 results";

}
?>
</table>
</div>
<script>
	function updateExpert(expertID) {
		window.location.href = "/FKEduSearch/Expert/updateAdmin.php?expert_id=" + expertID;
	}

	function deleteExpert(expertID) {
		// Send an AJAX request to delete.php passing expertID as a parameter
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				// Process the response here if needed
				alert("Expert deleted successfully!");
				// For example, display a success message or refresh the table
			}
		};
		xhttp.open("GET", "/FKEduSearch/Expert/deleteAdmin.php?expert_id=" + expertID, true);
		xhttp.send();
	}

	function updateUser(userID) {
		window.location.href = "/FKEduSearch/Expert/updateAdmin.php?user_id=" + userID;
	}

	function deleteUser(userID) {
		// Send an AJAX request to delete.php passing userID as a parameter
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				// Process the response here if needed
				alert("User deleted successfully!");
				// For example, display a success message or refresh the table
			}
		};
		xhttp.open("GET", "/FKEduSearch/Expert/deleteAdmin.php?user_id=" + userID, true);
		xhttp.send();
	}
</script>
</body>
</html>



<?php
	include'footerAdmin.php';
?>