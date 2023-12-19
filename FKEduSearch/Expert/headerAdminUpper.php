<!DOCTYPE html>
<html>
<head>
  <title>FK-EduSearch</title>
  <link rel="stylesheet" type="text/css" href="styleSheets/style.css">
  <link rel="stylesheet" type="text/css" href="styleSheets/styleHeadFoot.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="styleSheets/img/logoUMPIcon.jpeg" rel="icon">
  
  <style>
    .date {
      color: #18A0FB;
      font-weight: bold;
      text-align: right;
    }

    .header{
      background: white;
    }

  </style>
  
</head>

<body>
<!-- HEADER -->
<div class="topnav header">
  <a href="https://ump.edu.my/en" target="_blank">
    <img src="https://umplive.ump.edu.my/images/2020/07/26/logo-ump-transparent-blue__1122x561.png" style="width: 100px;">
  </a>
  <h3 style="text-align: center; color: #18A0FB; font-weight: bold;">Universiti Malaysia Pahang</h3>
  <p class="date"><?php echo "<b>Date Today: " . date("j F, Y") . "</b>"; ?></p>
  <hr>
</div>

</body>

</html>
