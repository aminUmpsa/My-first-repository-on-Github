<?php
$page = 'add post';
// Connect to the database server
$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

// Select the database
mysqli_select_db($link, "miniproject") or die(mysqli_error($link));

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $postID = $_POST['postID'];
    $postCategory = $_POST['postCategory'];
    $postTitle = $_POST['postTitle'];
    $postQuestion = $_POST['postQuestion'];
    $postCreatedDate = date('Y-m-d');

    $queryPost = "SELECT * FROM post WHERE post_ID = $postID";
    $resultPost = mysqli_query($link, $queryPost);
    $row = mysqli_fetch_assoc($resultPost);

    // Update the post details in the database
    $query = "UPDATE post SET post_title = '$postTitle', post_content = '$postQuestion', post_createdDate = '$postCreatedDate', post_categories = '$postCategory' WHERE post_ID = $postID";
    mysqli_query($link, $query) or die(mysqli_error($link));

    // Check if the post category has changed
    if ($postCategory !== $row['post_categories']) {
        // Fetch the research area ID based on the new post category
        $researchAreaQuery = "SELECT researchArea_ID FROM research_area WHERE researchAreaName = '$postCategory'";
        $researchAreaResult = mysqli_query($link, $researchAreaQuery);

        if (mysqli_num_rows($researchAreaResult) > 0) {
            $row = mysqli_fetch_assoc($researchAreaResult);
            $researchArea_ID = $row['researchArea_ID'];

            // Fetch the experts who specialize in the new research area
            $expertQuery = "SELECT expert_ID FROM research_areauserexpert WHERE researchArea_ID = '$researchArea_ID'";
            $expertResult = mysqli_query($link, $expertQuery);

            if (mysqli_num_rows($expertResult) > 0) {
                // Randomly select a new expert from the available experts
                $experts = array();
                while ($row = mysqli_fetch_assoc($expertResult)) {
                    $experts[] = $row['expert_ID'];
                }
                $randomExpertIndex = array_rand($experts);
                $expert_ID = $experts[$randomExpertIndex];

                // Update the expert assignment in the 'post_assigned' table
                $updateAssignedQuery = "UPDATE post_assigned SET expert_ID = '$expert_ID' WHERE post_ID = $postID";
                mysqli_query($link, $updateAssignedQuery) or die(mysqli_error($link));

                echo "<script>alert('Post Has Been Submitted And Assigned To The New Expert!'); window.location.href='UserYourPostAminBetul.php';</script>";
            } else {
                $alert_message = "No Experts Available In The Research Area!";
                echo "<script>alert('$alert_message'); window.location.href='UserYourPostAminBetul.php';</script>";
            }
        } else {
            $alert_message = "Research Area Not Found!";
            echo "<script>alert('$alert_message'); window.location.href='UserYourPostAminBetul.php';</script>";
        }
    } else {
        echo "<script>alert('Post Has Been Submitted!'); window.location.href='UserYourPostAminBetul.php';</script>";
    }
    exit();
}



?>




