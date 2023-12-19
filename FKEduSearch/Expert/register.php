<?php
//_SERVER REQUEST METHOD...LEBIH KURANG MACAM ISSET....UNTUK CHECKED SUBMITTED FORM
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['uname'];
    $fullName = $_POST['fname'];
    $role = $_POST['role'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    $link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());
    mysqli_select_db($link, "miniproject") or die(mysqli_error($link));

    // gune switch case ...based on role yang pilih dekat dropdown list
    switch ($role) {
        case 'Admin':
            // Insert into the admin table
            $adminQuery = "INSERT INTO admin (admin_userName, admin_password, admin_email) 
                           VALUES ('$username', '$password', '$email')";
            mysqli_query($link, $adminQuery);
            $adminId = mysqli_insert_id($link);

            // Insert into the login table with the admin role_id
            $loginQuery = "INSERT INTO login (role_id, admin_ID, login_userName, login_password) 
                           VALUES ('1', '$adminId', '$username', '$password')";
            mysqli_query($link, $loginQuery);
            break;

        case 'Expert':
            // Insert into the expert table
            $expertQuery = "INSERT INTO expert (expert_userName, expert_password, expert_email, expert_fullName) 
                            VALUES ('$username', '$password', '$email', '$fullName')";
            mysqli_query($link, $expertQuery);
            $expertId = mysqli_insert_id($link);

            // Insert into the login table with the expert role_id
            $loginQuery = "INSERT INTO login (role_id, expert_ID, login_userName, login_password) 
                           VALUES ('2', '$expertId', '$username', '$password')";
            mysqli_query($link, $loginQuery);
            break;

        case 'User':
            // Insert into the user table
            $userQuery = "INSERT INTO user (user_userName, user_password, user_email, user_fullName) 
                          VALUES ('$username', '$password', '$email', '$fullName')";
            mysqli_query($link, $userQuery);
            $userId = mysqli_insert_id($link);

            // Insert into the login table with the user role_id
            $loginQuery = "INSERT INTO login (role_id, user_ID, login_userName, login_password) 
                           VALUES ('3', '$userId', '$username', '$password')";
            mysqli_query($link, $loginQuery);
            break;

        default:
            // Untuk kalo bila tak ade role selected....
            break;
    }

    // Close the database connection
    mysqli_close($link);

    $alert_message = "Done Registration New Account !!!";
    echo "<script>alert('$alert_message');</script>";
    echo "<script type='text/javascript'>window.location='indexAdmin.php'</script>";
}
?>
