<?php
//Connect to the database server.
$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

//Select the database.
mysqli_select_db($link, "miniproject") or die(mysqli_error($link));


$newDate = $_POST["newdate"];
$newType = $_POST["newtype"];

//SQL query
$query = "SELECT c.*, cs.complaintStatus_type,u.user_fullName FROM complaint c INNER JOIN complaint_status cs ON c.complaintStatus_ID = cs.complaintStatus_ID INNER JOIN user u ON u.user_ID = c.user_ID WHERE complaint_Date = '$newDate' AND complaint_Type = '$newType'"
	or die(mysqli_connect_error());

//Execute the query (the recordset $rs contains the result)
$result = mysqli_query($link, $query);

$sql="SELECT count(*) as total from complaint where complaint_Date = '$newDate' AND complaint_Type = '$newType'";
$resultall=mysqli_query($link,$sql);
$data=mysqli_fetch_assoc($resultall);

?>	

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/FKEduSearch/Complaint/Admin/styleAdmin.css">

</head>
<body>

<!-- HEADER -->
<div class="topnav">
  <a><img src="https://umplive.ump.edu.my/images/2020/07/26/logo-ump-transparent-blue__1122x561.png" style="width: 40px;"></a>
  <a href="/FKEduSearch/Admin/ReactivateAcc.php" style="margin-left: 400px;">Reactivate Acc</a>
  <a href="/FKEduSearch/Expert/indexAdmin.php">Manage Acc</a>
  <a class="active" href="/FKEduSearch/Complaint/Admin/ComplaintListInterface.php">Complaint</a>
  <a href="/FKEduSearch/Complaint/Admin/reportpost.php">Report Post</a>
  <a href="/FKEduSearch/Expert/logout.php">Logout</a>

</div>
<hr style="box-shadow: 5px 0px 1px #6DE4EA;">

<!-- YOUR CONTENT -->
<div>
<div>
    <br>
    <div>
    <div>
        <a style="margin-left: 30px;">All (<?php echo $data['total']; ?>)</a>  
    </div>
    <button class="button-1" style="padding-bottom: 65px; margin-right:10px; float:right; margin-bottom:10px;" type="button" onclick="history.back()"><img src="https://whatemoji.org/wp-content/uploads/2020/07/Back-Arrow-Emoji.png" height="50px"></button>
    </div>
    <br>
<div>
<form method="post">
<table border="1" class="table" style="width: 100%">
<tr class="thread">
  <th class="th" scope="col">No</th>
  <th class="th" scope="col">Name</th>
  <th class="th" scope="col">Date</th>
  <th class="th" scope="col">Time</th>
  <th class="th" scope="col">Type of complaint</th>
  <th class="th" scope="col">Description</th>
  <th class="th" scope="col">Status</th>
  <th class="th" scope="col">Action</th>
            </tr>
            <tr>
<?php  if (mysqli_num_rows($result) > 0){
    // output data of each row
    $no = 0;
    while($row = mysqli_fetch_assoc($result) ){
    $no = $no + 1;
    $complainid = $row["complaint_ID"];
    $name = $row["user_fullName"];
    $date = $row["complaint_Date"];
    $time = $row["complaint_Time"];
	  $type = $row["complaint_Type"];
    $desc = $row["complaint_Desc"];
    $status = $row["complaintStatus_type"];
      
    
?>	
	
    <td class="td"><?php echo $no; ?></td>
    <td class="td"><?php echo $name; ?></td>
		<td class="td"><?php echo $date; ?></td>
    <td class="td"><?php echo $time; ?></td>
    <td class="td"><?php echo $type; ?></td>
    <td class="td"><?php echo $desc; ?></td>
    <td class="td"><?php echo $status; ?></td>
		<td class="td">
    <input type="hidden" name="comid" value="<?php echo $complainid; ?>">
			<a><button class="button-48" type="button" onclick="window.location.href='/FKEduSearch/Complaint/User/update.php?comid=<?php echo $complainid; ?>';">✏️</button></a> 
      <a><button class="button-48" type="button" onclick="window.location.href='/FKEduSearch/Complaint/User/view.php?comid=<?php echo $complainid; ?>';">👀</button></a> 
			<a><button class="button-48" type="button" onclick="window.location.href='/FKEduSearch/Complaint/User/delete.php?comid=<?php echo $complainid; ?>';">🗑️</button></a>
		</td>
	</tr>
<?php
    }
} else {
    echo "0 results";

}
?>
</table>
</form>

</div>
    
</div>
</div>

<!-- FOOTER -->
<footer style="bottom : 2px;position:fixed;width:100%;">

      <div class="foot">
        <a>
          <img src="https://icon.ump.edu.my/images/ICoN/logo-pusat-jaringan-industri-dan-masyarakat.png" style="width: 80px;">
        </a>
        <a href="https://ump.edu.my/en" style="margin-top: 20px; margin-left: 400px;">UMP - Official</a>
        <a href="https://kalam.ump.edu.my/login/index.php" style="margin-top: 20px;">Kalam</a>
        <a href="https://community.ump.edu.my/ecommstaff/login_eccom/" style="margin-top: 20px;">E-Comm</a>
        <a style="margin-top: 20px; float: right;">© Universiti Malaysia Pahang 2023. We love you!</a>
      </div>
</footer>
</body>
</html>