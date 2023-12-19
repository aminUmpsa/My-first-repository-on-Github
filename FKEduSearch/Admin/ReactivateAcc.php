<?php
	include 'headerAdmin.php';

	// Establish a database connection (replace the placeholder values with your actual credentials)
	$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());
	mysqli_select_db($link, "miniproject") or die(mysqli_error($link));

	// Fetch data from the admin, user, and expert tables using inner joins
	$query = "SELECT expert_userName, expert_ID
		FROM expert";

$queryU = "SELECT user_userName, user_ID
		FROM user";

	$result = mysqli_query($link, $query);
	$resultU = mysqli_query($link, $queryU);

	
$sql1="SELECT count(*) as sum1 from expert";
$result1=mysqli_query($link,$sql1);
$data1=mysqli_fetch_assoc($result1);

$sql2="SELECT count(*) as sum2 from user";
$result2=mysqli_query($link,$sql2);
$data2=mysqli_fetch_assoc($result2);

	// Close the database connection
	mysqli_close($link);
?>

<!DOCTYPE html>
<html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<style>
		.content {
			overflow-y: scroll;
			height: 1000px;
			width: 100%;
			margin: 0 auto;
		}

		.table {
			border-collapse: collapse;
			width: 100%;
		}

		.th, .td {
			padding: 8px;
			text-align: left;
		}

		.thread {
			background-color: #f2f2f2;
		}

		.button-48 {
			padding: 8px 16px;
			font-size: 14px;
			border-radius: 4px;
			cursor: pointer;
		}

		.button-48:hover {
			background-color: #4CAF50;
			color: white;
		}

		.graph {
			display: flex;
			justify-content: center;
			align-items: center;
			height: 70vh;
		}
	</style>
<head>
	<title>ADMIN</title>
	<link rel="stylesheet" type="text/css" href="style.css">
    <style>
		.content {
			overflow-y: scroll;
			height: 1000px; /* Set the desired height for the scrollable area */
			width: 100%; /* Adjust the width as needed */
			margin: 0 auto; /* Center the content horizontally */
		}

        .graph{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 70vh; /* Adjust the height as needed */
        }
	</style>
</head>
<body align="center">
<div class="content">
	<h2>Reactivate Account</h2>
	


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
	<td align="center"><a><button class="button-48" type="button" onclick="window.location.href='/FKEduSearch/Complaint/Admin/add.php';">Reason</button></a> 
	<a><button class="button-48" type="button" onclick="window.location.href='/FKEduSearch/Complaint/Admin/add.php';">Reject</button></a>
	<a><button class="button-48" type="button" onclick="window.location.href='/FKEduSearch/Complaint/Admin/add.php';">Approve</button></a></td>
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
	<td align="center"><a><button class="button-48" type="button" onclick="window.location.href='/FKEduSearch/Complaint/Admin/add.php';">Reason</button></a>
	<a><button class="button-48" type="button" onclick="window.location.href='/FKEduSearch/Complaint/Admin/add.php';">Reject</button></a>
	<a><button class="button-48" type="button" onclick="window.location.href='/FKEduSearch/Complaint/Admin/add.php';">Approve</button></a></td>
	</tr>
<?php
    }
} else {
    echo "0 results";

}
?>
</table>






<div class="graph">
<canvas id="myChart" style="width:100%;max-width:800px"></canvas>
<script>

var no1 = "<?php echo $data1['sum1'];?>";
var no2 = "<?php echo $data2['sum2'];?>";

var xValues = ["User", "Expert"];
var yValues = [no2, no1];
var barColors = [
  "#1EAE9B",
  "#0A56C1"
];

new Chart("myChart", {
  type: "doughnut",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "ACTIVE ACCOUNT GRAPH"
    }
  }
});
</script>
</div>
</div>
</body>
</html>

<?php
	include 'footerAdmin.php';
?>
