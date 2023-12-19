<?php
//Connect to the database server.
$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

//Select the database.
mysqli_select_db($link, "miniproject") or die(mysqli_error($link));

$userid = $_GET['id'];

//SQL query
$query = "SELECT c.*, cs.complaintStatus_type FROM complaint c INNER JOIN complaint_status cs ON c.complaintStatus_ID = cs.complaintStatus_ID WHERE user_ID = '$userid'"
	or die(mysqli_connect_error());

$queryUser = "SELECT user_fullName FROM user WHERE complaint_Type = 'Wrongly Assigned Research Area'"
	or die(mysqli_connect_error());

//Execute the query (the recordset $rs contains the result)
$result = mysqli_query($link, $query);

$sql1="SELECT count(*) as total from complaint WHERE user_ID = '$userid' AND complaint_Type = 'Wrongly Assigned Research Area'";
$result1=mysqli_query($link,$sql1);
$data1=mysqli_fetch_assoc($result1);

$sql2="SELECT count(*) as total2 from complaint WHERE user_ID = '$userid' AND complaint_Type = 'Unsatisfied Expert Feedback'";
$result2=mysqli_query($link,$sql2);
$data2=mysqli_fetch_assoc($result2);

$sql3="SELECT count(*) as total3 from complaint WHERE user_ID = '$userid' AND complaint_Type = 'Other'";
$result3=mysqli_query($link,$sql3);
$data3=mysqli_fetch_assoc($result3);

?>	

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/FKEduSearch/Complaint/styleUser.css">

</head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<style>
    .button-1 {
    background-color: #b2ebfb;
    border: 0 solid #e2e8f0;
    border-radius: 3rem;
    box-sizing: border-box;
    color: white;
    cursor: pointer;
    display: inline-block;
    font-family: "Basier circle",-apple-system,system-ui,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
    font-size: 1.1rem;
    font-weight: 600;
    line-height: 1;
    padding: 1rem 1.6rem;
    text-align: center;
    text-decoration: none #0d172a solid;
    transition: all .1s cubic-bezier(.4, 0, .2, 1);
    box-shadow: 0px 1px 2px rgba(166, 175, 195, 0.25);
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
    margin-left: 10px;
  }
  
  .button-1:hover {
    background-color: #A5DBFF;
    color: #0b3b5c;
  }
</style>
<body>

<!-- HEADER -->
<div class="topnav">
<a><img src="https://umplive.ump.edu.my/images/2020/07/26/logo-ump-transparent-blue__1122x561.png" style="width: 40px;"></a>
  <a href="/FKEduSearch/Expert/userHomeAmin.php" style="margin-left: 400px;">Home</a>
  <a href="/FKEduSearch/Expert/userYourPostAminBetul.php">Your Post</a>
  <a class="active" href="/FKEduSearch/Complaint/User/ComplaintInterface.php?id=<?php echo $userid?>">Complaint</a>
  <a href="/FKEduSearch/Expert/userProfile.php">Profile</a>

  <div class="search-container">
    
  </div>
</div>
<hr style="box-shadow: 5px 0px 1px #6DE4EA;">

<!-- YOUR CONTENT -->

<button class="button-1" type="button" onclick="history.back()"><img src="https://whatemoji.org/wp-content/uploads/2020/07/Back-Arrow-Emoji.png" height="50px"></button>

<canvas id="myChart" style="width:100%; height:60%; margin-top:-50px; margin-left:-50px;"></canvas>

<script>
var no1 = "<?php echo $data1['total'];?>";
var no2 = "<?php echo $data2['total2'];?>";
var no3 = "<?php echo $data3['total3'];?>";


var xValues = ["Wrongly Assigned Research Area", "Unsatisfied Expert's Feedback", "Other"];
var yValues = [no1, no2, no3];
var barColors = [
  "#b91d47",
  "#00aba9",
  "#31c346"
];

new Chart("myChart", {
  type: "pie",
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
      text: "Type of Complaint"
    }
  }
});
</script>

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