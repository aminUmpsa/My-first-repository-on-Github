<?php
//Connect to the database server.
$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

//Select the database.
mysqli_select_db($link, "miniproject") or die(mysqli_error($link));

$complainid = $_GET['comid'];

//SQL query
$query = "SELECT c.*,u.user_userName FROM complaint c inner join user u on u.user_ID = c.user_ID WHERE complaint_ID = '$complainid'"
	or die(mysqli_connect_error());
	
//Execute the query (the recordset $rs contains the result)
$result = mysqli_query($link, $query);
?>	

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/FKEduSearch/Complaint/styleUser.css">

</head>
<body>

<!-- HEADER -->
<div class="topnav">
<a><img src="https://umplive.ump.edu.my/images/2020/07/26/logo-ump-transparent-blue__1122x561.png" style="width: 40px;"></a>
  <a href="/FKEduSearch/Expert/userHomeAmin.php" style="margin-left: 400px;">Home</a>
  <a href="/FKEduSearch/Expert/userYourPostAminBetul.php">Your Post</a>
  <a class="active" href="/FKEduSearch/Complaint/User/ComplaintInterface.php?id=<?php echo $userid?>">Complaint</a>
  <a href="/FKEduSearch/Expert/userProfile.php">Profile</a>
 
  <div class="search-container">
    <form action="/action_page.php">
      <input class="input" type="text" name="search">
      <button type="submit">Search</button>
    </form>
  </div>
</div>
<hr style="box-shadow: 5px 0px 1px #6DE4EA;">

<!-- YOUR CONTENT -->
<?php  if (mysqli_num_rows($result) > 0){
    // output data of each row
    $row = mysqli_fetch_assoc($result);

    $complainid = $row["complaint_ID"];
    $name = $row["user_userName"];
	$type = $row["complaint_Type"];
	$desc = $row["complaint_Desc"];
} else {
    echo "0 results";

}
?>

<div class="center">
<h1>Complaint</h1>

<form method="post">
  <table class="center1">
    <tr>
      <td>
      Username
      </td>
    </tr>
    <tr>
      <td>
        <input class="textbox-10" type="text" name="name" placeholder="<?php echo $name; ?>" readonly>
      </td>
    </tr>
    <tr><td><br></td></tr>
    <tr>
      <td>
        Type of complaint
      </td>
    </tr>      
    <tr>
      <td>
      <input class="textbox-10" type="text" name="complainttype" placeholder="<?php echo $type; ?>" readonly>
      </td>
    </tr>
    <tr><td><br></td></tr>
    <tr>
      <td>
        Your complaint
      </td>
    </tr>      
    <tr>
      <td colspan="2">
        <textarea class="textbox-10" style="width: 100%;" name="description" placeholder="<?php echo $desc; ?>" readonly></textarea>
      </td>
    </tr>
  </table>

  <button class="button-81" type="button" onclick="history.back();">
    Return
  </button>
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