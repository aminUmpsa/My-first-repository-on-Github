<?php

session_start();

/*
    UPDATE research_area
    SET researchAreaName = '$researchAreaName'
    WHERE researchArea_ID IN (
	SELECT researchArea_ID 
	FROM research_areauserexpert
	WHERE expert_ID = '$expertID'
	);

	UPDATE academic_status
    SET academicStatus_type = '$academicStatus_type'
    WHERE academicStatus_ID IN (
    SELECT academicStatus_ID
    FROM academic_statususerexpert
    WHERE expert_ID = '$expertID'
    );
*/

//Connect to the database server.
$link = mysqli_connect("localhost", "root") or die(mysqli_connect_error());

//Select the database.
mysqli_select_db($link, "miniproject") or die(mysqli_error($link));

$expertID = $_REQUEST['expertID'];

$email = $_REQUEST['email'];
$profilePicture = $_FILES['profilePicture']['name'];
$profilePictureTmp = $_FILES['profilePicture']['tmp_name'];
$targetPath = 'uploads/' . $profilePicture;
move_uploaded_file($profilePictureTmp, $targetPath);

// Store the uploaded file name in the session variable
$_SESSION['uploaded_file'] = $profilePicture;

$expertCV = $_FILES['expertCV']['name'];
$expertCVTmp = $_FILES['expertCV']['tmp_name'];
$destinationPath = 'uploads/' . $expertCV;
move_uploaded_file($expertCVTmp, $destinationPath);

$researchAreaName = $_REQUEST['researchAreaName'];

$academicStatusType = $_REQUEST["academicStatus_type"];
$academicStatus_type = implode(',', $academicStatusType);

$instagram_userName = $_REQUEST['instagram_userName'];
$linkedin_userName = $_REQUEST['linkedin_userName'];

// Begin the transaction ..
mysqli_query($link, "START TRANSACTION") or die(mysqli_error($link));

$query = "
    UPDATE expert
    SET expert_email = '$email',
        expert_profilePicture = '$profilePicture',
        expert_CV = '$expertCV'
    WHERE expert_ID = '$expertID';


	UPDATE research_areauserexpert
    INNER JOIN research_area ON research_areauserexpert.researchArea_ID = research_area.researchArea_ID
    SET research_area.researchAreaName = '$researchAreaName'
    WHERE research_areauserexpert.expert_ID = '$expertID';
	

	UPDATE academic_statususerexpert
    INNER JOIN academic_status ON academic_statususerexpert.academicStatus_ID = academic_status.academicStatus_ID
    SET academic_status.academicStatus_type = '$academicStatus_type'
    WHERE academic_statususerexpert.expert_ID = '$expertID';


    UPDATE socialmedia
    SET instagram_userName = '$instagram_userName',
        linkedin_userName = '$linkedin_userName'
    WHERE expert_ID = '$expertID';
";

$result = mysqli_multi_query($link, $query) or die("Could not execute query in expertProfile.php");

// Iterate over the result sets and discard them
while (mysqli_more_results($link) && mysqli_next_result($link)) {
    if ($result = mysqli_store_result($link)) {
        mysqli_free_result($result);
    }
}

// Commit the transaction if all operations are successful.
mysqli_query($link, "COMMIT") or die(mysqli_error($link));

$alert_message = "Expert Profile Information has been updated!";
echo "<script>alert('$alert_message');</script>";
echo "<script type='text/javascript'> window.location='/FKEduSearch/Expert/expertProfile.php' </script>";
?>
