<?php
//Connect to the database server.
$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

//Select the database.
mysqli_select_db($link, "miniproject") or die(mysqli_error($link));

$complainid = $_GET['id'];

//SQL query
$query = "SELECT * FROM complaint_reply WHERE complaint_ID = '$complainid'"
	or die(mysqli_connect_error());
	
//Execute the query (the recordset $rs contains the result)
$result = mysqli_query($link, $query);

 $row = mysqli_fetch_assoc($result);

	$desc = $row["CR_reply"];

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
<button class="button-1" style="padding-bottom: 65px; margin-left:10px;" type="button" onclick="history.back()"><img src="https://whatemoji.org/wp-content/uploads/2020/07/Back-Arrow-Emoji.png" height="50px"></button>

<div class="center">
<h1>Complaint</h1>
<br>
<form method="post" action="update_action.php">
  <table class="center1">
    <tr>
      <td>
        Your complaint
      </td>
    </tr>      
    <tr>
      <td colspan="2">
        <textarea class="textbox-10" style="width: 100%;" name="description"><?php echo $desc;?></textarea>
      </td>
    </tr>
  </table>
  <input type="hidden" name="complain" value="<?php echo $complainid; ?>">

  <a><button class="button-81" type="submit">Update</button></a>
  <a><button class="button-81" type="reset">Reset</button></a>
  </form>
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