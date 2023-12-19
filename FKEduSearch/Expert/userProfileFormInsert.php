<?php
session_start();

$link = mysqli_connect("localhost", "root") or die(mysqli_connect_error());
mysqli_select_db($link, "miniproject") or die(mysqli_error($link));

$user_ID = $_REQUEST["userID"];

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // untuk dapatkan data dari form
    $researchAreaName = $_REQUEST['researchAreaName'];
    $academicStatus = $_REQUEST['academicStatus_type'];
    $instagramUsername = $_REQUEST['instagram_userName'];
    $linkedinUsername = $_REQUEST['linkedin_userName'];

    //dia untuk link researchArea
	$researchAreaQuery = "SELECT researchArea_ID FROM research_area WHERE researchAreaName = '$researchAreaName'";
	$researchAreaResult = mysqli_query($link, $researchAreaQuery);

	if (mysqli_num_rows($researchAreaResult) > 0) {
    $row = mysqli_fetch_assoc($researchAreaResult);
    $researchArea_ID = $row['researchArea_ID'];

    // Insert into research_areauserexpert table
    $insertResearchAreaUserExpertQuery = "INSERT INTO research_areauserexpert (researchArea_ID, user_ID)
                                          VALUES ('$researchArea_ID', '$user_ID')";
    mysqli_query($link, $insertResearchAreaUserExpertQuery);
	}

    // Insert research area into research_area table
 /*   $queryResearch = "INSERT INTO research_area (researchAreaName) VALUES ('$researchAreaName')";
    mysqli_query($link, $queryResearch);
    $researchAreaID = mysqli_insert_id($link);

    // Insert research area and user IDs into research_areauserexpert table
    $queryResearchID = "INSERT INTO research_areauserexpert (researchArea_ID, user_ID) VALUES ('$researchAreaID', '$user_ID')";
    mysqli_query($link, $queryResearchID);  */

    // Insert academic status into academic_status table and user IDs into academic_statususerexpert table
   /* foreach ($academicStatus as $status) {
        $queryAcademicStatusType = "INSERT INTO academic_status (academicStatus_type) VALUES ('$status')";
        mysqli_query($link, $queryAcademicStatusType);
        $academicStatusID = mysqli_insert_id($link);

        $queryAcademicExpert = "INSERT INTO academic_statususerexpert (user_ID, academicStatus_ID) VALUES ('$user_ID', '$academicStatusID')";
        mysqli_query($link, $queryAcademicExpert);
    } */
	

    //gune foreach sebab academicStatus ...untuk loop for each element dalam academic status array 
	foreach ($academicStatus as $status) {
    $queryAcademicUser = "INSERT INTO academic_statususerexpert (user_ID, academicStatus_ID) SELECT '$user_ID', academicStatus_ID FROM academic_status WHERE academicStatus_type = '$status'";
    mysqli_query($link, $queryAcademicUser);
}

    // Insert instagram and linkedin usernames into social_media table
    $querySocialMedia = "INSERT INTO socialmedia (user_ID, instagram_userName, linkedin_userName) VALUES ('$user_ID', '$instagramUsername', '$linkedinUsername')";
    mysqli_query($link, $querySocialMedia);
	

    // Close the database connection
    mysqli_close($link);

    $alert_message = "Information Details Have Been Inserted";
    echo "<script>alert('$alert_message');</script>";
    echo "<script type='text/javascript'>window.location='userProfile.php';</script>";
}
?>
