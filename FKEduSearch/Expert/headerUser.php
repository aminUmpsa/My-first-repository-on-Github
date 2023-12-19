<?php
session_start();
$user_ID = $_SESSION['userID'];
?>


<!DOCTYPE html>
<html>
<head>
  <title>FK-EduSearch</title>
<link rel="stylesheet" type="text/css" href="styleSheets/stylesExpert.css">
<meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="styleSheets/img/logoUMPIcon.jpeg" rel="icon">
  
    <style>
    .date {
      color: #18A0FB;
      font-weight: bold;
      text-align: right;
    }
  </style>
  
</head>

<body>


<!-- HEADER -->
<div class="topnav">
<a href="https://ump.edu.my/en" target="_blank"><img src="https://umplive.ump.edu.my/images/2020/07/26/logo-ump-transparent-blue__1122x561.png"  style="width: 100px;"></a>
<p  style="text-align:center ; color: #18A0FB; font-weight: bold">Universiti Malaysia Pahang</p>
<p class="date"><?php echo "<b> Date Today: ".date("j F ,  Y")."</b>"; ?></p>
<hr>    
</div>

<div class="topnav">
  <nav id="navmenu" class="navmenu" style="display: flex; justify-content: center;">
    <ul>
      <li <?php if ($page == 'home') echo 'class="active"'; ?>>
        <a href="userHomeAmin.php" style="<?php if ($page == 'home') echo 'color: red;'; else echo 'color: #18A0FB;'; ?> font-weight: bold" id="home">Home</a>
      </li>
      <li <?php if ($page == 'post') echo 'class="active"'; ?>>
        <a href="userYourPostAminBetul.php" style="<?php if ($page == 'post') echo 'color: red;'; else echo 'color: #18A0FB;'; ?> font-weight: bold" id="post">Your Post</a>
      </li>
      <li <?php if ($page == 'complaint') echo 'class="active"'; ?>>
        <a href="/FKEduSearch/Complaint/User/ComplaintInterface.php" style="<?php if ($page == 'publication') echo 'color: red;'; else echo 'color: #18A0FB;'; ?> font-weight: bold" id="publication">Complaint</a>
      </li>
      <li <?php if ($page == 'profile') echo 'class="active"'; ?>>
        <a href="userProfile.php" style="<?php if ($page == 'profile') echo 'color: red;'; else echo 'color: #18A0FB;'; ?> font-weight: bold" id="profile">Profile</a>
      </li>
      <li><a href="logout.php" style="color: #18A0FB; font-weight: bold">Logout</a></li>
    </ul>
  </nav>
</div>

  
<!-- 
  <div class="search-container">
    <form action="">
      <input class="input" type="text" name="search">
      <button type="submit">Search</button>
    </form>
  </div>
</div>
-->

<hr>

</body>

</html>