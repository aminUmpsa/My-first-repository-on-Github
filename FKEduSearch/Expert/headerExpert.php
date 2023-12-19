<?php
session_start();
$expertID = $_SESSION['expertID'];
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
<?php

$expertID = $_SESSION['expertID']; // Retrieve the expert ID from the session

// Retrieve the expert's profile picture or use a default picture if not available
//$profilePicture = ""; // Initialize variable

// Add your logic here to fetch the expert's profile picture based on the expert ID

/* if (!empty($profilePicture) && file_exists("uploads/$profilePicture")) {
    echo '<img src="uploads/' . $profilePicture . '" alt="Profile Picture" style="width: 70px; height: auto;">';
} else {
    echo 'Profile picture not available.';
} */

/*
$query = "SELECT expert_profilePicture FROM expert WHERE expert_ID = $expertID";
$result = mysqli_query($link, $query) or die(mysqli_error($link));

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $profilePicture = $row['expert_profilePicture']; // Get the profile picture file name
} else {
    $profilePicture = ""; // Set a default profile picture or a placeholder image file name
}

if (!empty($profilePicture) && file_exists("uploads/$profilePicture")) {
    echo '<img src="uploads/' . $profilePicture . '" alt="Profile Picture" style="width: 70px; height: auto;">';
} else {
    echo 'Profile picture not available.';
}

*/


      // Check if uploaded_file is set in the session
    if (isset($_SESSION['uploaded_file'])) {
    $uploadedFile = $_SESSION['uploaded_file'];

    if (!empty($uploadedFile) && file_exists("uploads/$uploadedFile")) {
        echo '<a href="expertProfile.php"> <img src="uploads/' . $uploadedFile . '" alt="Profile Picture" style="width: 70px; height: auto;"></a>';
    } else {
        echo 'Profile picture not available.';
    }
} else {
    // Provide a default profile picture
    echo '<a href="expertProfile.php"><img src="uploads/default_img.png" alt="Profile Picture" style="width: 70px; height: auto;"></a>';
}

      ?>


      <li <?php if ($page == 'home') echo 'class="active"'; ?>>
        <a href="expertHome.php" style="<?php if ($page == 'home') echo 'color: red;'; else echo 'color: #18A0FB;'; ?> font-weight: bold" id="home">Home</a>
      </li>
      <li <?php if ($page == 'post') echo 'class="active"'; ?>>
        <a href="expertPost.php" style="<?php if ($page == 'post') echo 'color: red;'; else echo 'color: #18A0FB;'; ?> font-weight: bold" id="post">Post</a>
      </li>
      <li <?php if ($page == 'publication') echo 'class="active"'; ?>>
        <a href="expertPublication.php" style="<?php if ($page == 'publication') echo 'color: red;'; else echo 'color: #18A0FB;'; ?> font-weight: bold" id="publication">Publication</a>
      </li>
      <li <?php if ($page == 'profile') echo 'class="active"'; ?>>
        <a href="expertProfile.php" style="<?php if ($page == 'profile') echo 'color: red;'; else echo 'color: #18A0FB;'; ?> font-weight: bold" id="profile">Profile</a>
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