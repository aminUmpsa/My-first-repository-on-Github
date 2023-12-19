<?php
session_start();

$link = mysqli_connect("localhost", "root") or die(mysqli_connect_error());

// Select the database.
mysqli_select_db($link, "miniproject") or die(mysqli_error($link));

$expertID = $_REQUEST['expertID'];

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $researchAreaName = $_REQUEST['researchAreaName'];
    $academicStatus = $_REQUEST['academicStatus_type'];
    $instagramUsername = $_REQUEST['instagram_userName'];
    $linkedinUsername = $_REQUEST['linkedin_userName'];

    // Insert research area into research_area table
 //   $queryResearch = "INSERT INTO research_area (researchAreaName) VALUES ('$researchAreaName')";
  //  mysqli_query($link, $queryResearch);
  //  $researchAreaID = mysqli_insert_id($link);

    // Insert research area and expert IDs into research_areauserexpert table
  //  $queryResearchID = "INSERT INTO research_areauserexpert (researchArea_ID, expert_ID) VALUES ('$researchAreaID', '$expertID')";
  //  mysqli_query($link, $queryResearchID);

    // Insert academic status into academic_status table and expert IDs into academic_statususerexpert table
	
	
	$researchAreaQuery = "SELECT researchArea_ID FROM research_area WHERE researchAreaName = '$researchAreaName'";
	$researchAreaResult = mysqli_query($link, $researchAreaQuery);

	if (mysqli_num_rows($researchAreaResult) > 0) {
    $row = mysqli_fetch_assoc($researchAreaResult);
    $researchArea_ID = $row['researchArea_ID'];

    // Insert into research_areauserexpert table
    $insertResearchAreaUserExpertQuery = "INSERT INTO research_areauserexpert (researchArea_ID, expert_ID)
                                          VALUES ('$researchArea_ID', '$expertID')";
    mysqli_query($link, $insertResearchAreaUserExpertQuery);
	}
	
	
		foreach ($academicStatus as $status) {
    $queryAcademicExpert = "INSERT INTO academic_statususerexpert (expert_ID, academicStatus_ID) SELECT '$expertID', academicStatus_ID FROM academic_status WHERE academicStatus_type = '$status'";
    mysqli_query($link, $queryAcademicExpert);
}
	
	
  /*  foreach ($academicStatus as $status) {
        $queryAcademicStatusType = "INSERT INTO academic_status (academicStatus_type) VALUES ('$status')";
        mysqli_query($link, $queryAcademicStatusType);
        $academicStatusID = mysqli_insert_id($link);

        $queryAcademicExpert = "INSERT INTO academic_statususerexpert (expert_ID, academicStatus_ID) VALUES ('$expertID', '$academicStatusID')";
        mysqli_query($link, $queryAcademicExpert);
    }
	
	*/

    // Insert instagram and linkedin usernames into social_media table
    $querySocialMedia = "INSERT INTO socialmedia (expert_ID, instagram_userName, linkedin_userName) VALUES ('$expertID', '$instagramUsername', '$linkedinUsername')";
    mysqli_query($link, $querySocialMedia);

    // Insert profile picture, expert CV, and email into expert table
    $profilePicture = $_FILES['profilePicture']['name'];
    $expertCV = $_FILES['expertCV']['name'];

    $targetDirectory = "uploads/";
    $profilePictureTarget = $targetDirectory . basename($profilePicture);
    $expertCVTarget = $targetDirectory . basename($expertCV);

    // Move uploaded files to the target directory
    move_uploaded_file($_FILES['profilePicture']['tmp_name'], $profilePictureTarget);
    move_uploaded_file($_FILES['expertCV']['tmp_name'], $expertCVTarget);

	$_SESSION['uploaded_file'] = $profilePicture;

    // Check if expert record already exists
    $queryCheckExpert = "SELECT * FROM expert WHERE expert_ID = '$expertID'";
    $resultCheckExpert = mysqli_query($link, $queryCheckExpert);

    if (mysqli_num_rows($resultCheckExpert) == 0) {
        // Insert profile picture, expert CV, and expert ID into expert table
        $queryExpert = "INSERT INTO expert (expert_ID, expert_profilePicture, expert_CV) VALUES ('$expertID', '$profilePicture', '$expertCV')";
        mysqli_query($link, $queryExpert);
    } else {
        $queryUpdateExpert = "
            UPDATE expert
            SET expert_profilePicture = '$profilePicture',
                expert_CV = '$expertCV'
            WHERE expert_ID = '$expertID'";
        mysqli_query($link, $queryUpdateExpert);
    }

    // Close the database connection
    mysqli_close($link);

    $alert_message = "Information Details Has Been Inserted";
    echo "<script>alert('$alert_message');</script>";
    echo "<script type='text/javascript'>window.location='expertProfile.php';</script>";
}
?>
