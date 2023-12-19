<?php
session_start();
$user_ID = $_SESSION['userID'];
$page = 'post';
$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());
mysqli_select_db($link, "miniproject") or die(mysqli_error($link));

// Check if the form is submitted......$_SERVER is superglobal variable yg ad information yg related dgn server.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // untuk dapatkan value rating dari form submission dari page viewExpertAnswer.php
    $ratingValue = $_POST['rating'];

    // untuk dapatkan expert_ID yang relate dgn post tuh
    $expertID = $_GET['expert_ID'];


    // Check if the user has already given a rating for the expert
    $checkQuery = "SELECT * FROM rating WHERE user_ID = '$user_ID' AND expert_ID = '$expertID'";
    $checkResult = mysqli_query($link, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // The user has already given a rating for this expert
        $alert_message = "You Have Already Given a Rating For This Expert.";
        echo "<script>alert('$alert_message');</script>";
        echo "<script type='text/javascript'> window.location='userYourPostAminBetul.php' </script>";
    } else {
        // Insert the rating into the database
        $insertQuery = "INSERT INTO rating (expert_ID, user_ID, rating_value)
                        VALUES ('$expertID', '$user_ID', '$ratingValue')";
        $insertResult = mysqli_query($link, $insertQuery);

        if ($insertResult) {
            $alert_message = "Rating Submitted Successfully!";
            echo "<script>alert('$alert_message');</script>";
            echo "<script type='text/javascript'> window.location='userYourPostAminBetul.php' </script>";
        } else {
            $alert_message = "Error Submitting The Rating!";
            echo "<script>alert('$alert_message');</script>";
            echo "<script type='text/javascript'> window.location='userYourPostAminBetul.php' </script>";
        }
    }
} else {
    $alert_message = "Invalid Request!";
    echo "<script>alert('$alert_message');</script>";
    echo "<script type='text/javascript'> window.location='userYourPostAminBetul.php' </script>";
}


?>
