<?php
session_start();
$page = 'add post';
?>
<html> 
<body>
 
 <?php 
$link = mysqli_connect("localhost", "root") or die(mysqli_connect_error($link));
mysqli_select_db($link, "miniproject") or die(mysqli_error($link)); 

$user_ID = $_REQUEST['userID'];

  // Untuk dapatkan current date
	$post_createdDate = date('Y-m-d');

$post_categories = $_REQUEST["category"];
$postTitle = $_REQUEST["postTitle"];
$postQuestion = $_REQUEST["postQuestion"];

// Untuk check post count session variable exist atau tak 
if (!isset($_SESSION['postCount'])) {
    $_SESSION['postCount'] = 0;
}


// Check if the post count exceeds the limit (3)
if ($_SESSION['postCount'] >= 3) {
    $alert_message = "You Have Reached The Maximum Limit For Posts In This Session!";
    echo "<script>alert('$alert_message');</script>";
    echo "<script type='text/javascript'>window.location='addPostUIAminBetul.php'</script>";
    exit(); // Stop execution code
}

$query = "INSERT INTO post (user_ID, post_title, post_content, post_createdDate, post_categories) 
          VALUES ('$user_ID', '$postTitle', '$postQuestion', '$post_createdDate', '$post_categories')";

$result = mysqli_query($link, $query);

if ($result) {
	
	// Increment the post count session variable
    $_SESSION['postCount']++;

$post_ID = mysqli_insert_id($link);


 // Untuk select an expert secara random from the 'expert' table
    $selectExpertQuery = "SELECT expert_ID FROM expert ORDER BY RAND() LIMIT 1";
    $expertResult = mysqli_query($link, $selectExpertQuery);
	
	// Untuk dapatkan research area ID based on post_categories
	$researchAreaQuery = "SELECT researchArea_ID FROM research_area WHERE researchAreaName = '$post_categories'";
	$researchAreaResult = mysqli_query($link, $researchAreaQuery);

 if (mysqli_num_rows($researchAreaResult) > 0) {
    $row = mysqli_fetch_assoc($researchAreaResult);
    $researchArea_ID = $row['researchArea_ID'];

    // Fetch the experts who specialize in the research area
    $expertQuery = "SELECT expert_ID FROM research_areauserexpert WHERE researchArea_ID = '$researchArea_ID'";
    $expertResult = mysqli_query($link, $expertQuery);

    if (mysqli_num_rows($expertResult) > 0) {
        // Randomly select an expert from the available experts
        $experts = array();
        while ($row = mysqli_fetch_assoc($expertResult)) {
            $experts[] = $row['expert_ID'];
        }
        $randomExpertIndex = array_rand($experts);
        $expert_ID = $experts[$randomExpertIndex];

        // Insert the assigned post into the 'post_assigned' table
        $date_assigned = date('Y-m-d');
        $postAssigned_status = 'Accepted';

        $insertAssignedQuery = "INSERT INTO post_assigned (post_ID, expert_ID, date_assigned, postAssigned_status)
                                VALUES ('$post_ID', '$expert_ID', '$date_assigned', '$postAssigned_status')";

        $insertAssignedResult = mysqli_query($link, $insertAssignedQuery);

        if ($insertAssignedResult) {
            $alert_message = "Post Has Been Submitted And Assigned To An Expert !";
            echo "<script>alert('$alert_message');</script>";
        } else {
            $alert_message = "Post Has Been Submitted, But Assigned Failed!";
            echo "<script>alert('$alert_message');</script>";
        }
    } else {
        $alert_message = "No Experts Available In The Research Area!";
        echo "<script>alert('$alert_message');</script>";
    }
} else {
    $alert_message = "Research Area Not Found!";
    echo "<script>alert('$alert_message');</script>";
}

    // Redirect to the 'addPostUIAminBetul.php' page
    echo "<script type='text/javascript'>window.location='addPostUIAminBetul.php'</script>";
} else {
    $alert_message = "Post not submitted!";
    echo "<script>alert('$alert_message');</script>";
    echo "<script type='text/javascript'>window.location='addPostUIAminBetul.php'</script>";
}

// Close the database connection
mysqli_close($link);
?>

  </body>
  </html>
