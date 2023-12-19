<?php
    include 'headerAdminUpper.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>LOGIN</title>
    <link rel="stylesheet" type="text/css" href="styleSheets/style.css">
    <link rel="stylesheet" type="text/css" href="styleSheets/styleHeadFoot.css">
  
  <style>
        body {
            background-color: black;
            color: white;
        }
        
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .logo img {
            width: 200px;
        }
    </style>
</head>


<body>
    <form action="login.php" method="post" align="center">
        <div class="logo">
          <img src="styleSheets/img/logoUmpLogin.png" style="width: 250px;" alt="Logo"> 
        </div>
        
        <i><h1>Welcome To FK-Edu Search</h1></i>
        <h2>Login</h2>
        
        <label>Username :</label>
        <input type="text" name="userName" placeholder="Enter Username"><br><br>
        <label>Password :</label>
        <input type="password" name="password" placeholder="Enter Password"><br><br>
        
        <select name="role">
            <option value="">Role</option>
            <option value="Admin">Admin</option>
            <option value="Expert">Expert</option>
            <option value="User">User</option>
        </select><br><br>
        
        <label>
            <input type="checkbox" name="remember" value="1"> Remember My Password
        </label><br><br>
        
        <p><a href="#">Forgot username or password?</a></p>
        <button type="submit" style="background-color: #18A0FB; color: white; width: 230px; height: 30px; font-weight:bold">LOGIN</button>
    </form>
</body>
</html>
<?php
    include 'footerAdmin.php';
?>
