<?php
// session_start();
// $page = 'page';

// //Connect to the database server.
// $link = mysqli_connect("localhost", "root") or die(mysqli_connect_error());

// //Select the database.
// mysqli_select_db($link, "miniproject") or die(mysqli_error($link));
// // Retrieve the expert ID from the session
// $postAssignedID = $_POST['postAssignedID'];
// //$complaintID = $_POST['complaintID'];
// $expertID = $_POST['expertID'];

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Retrieve the answer from the form
//     $answer = $_POST['answer'];

// // Display the values to check if they are assigned correctly
// var_dump($postAssignedID);
// var_dump($expertID);

//     // Insert the answer into the post_answer table
//     $insertQuery = "INSERT INTO post_answer (postAssigned_ID, expert_ID, post_answer)
//                     VALUES ('$postAssignedID', '$expertID', '$answer')";
//     mysqli_query($link, $insertQuery) or die(mysqli_error($link));

//     // Update the post_assigned table to change the status to Completed
//     $updateQuery = "UPDATE post_assigned SET postAssigned_status = 'Completed' WHERE postAssigned_ID = '$postAssignedID'";
//     mysqli_query($link, $updateQuery) or die(mysqli_error($link));

					
// 		$alert_message = "Post Answer Has Been Submitted !!!";	
// 		echo "<script>alert('$alert_message');</script>";
// 		 echo "<script type = 'text/javascript'> window.location='expertPost.php' </script>";

//     // Redirect to a success page or display a success message
//   //  header("Location: expertPost.php");
//     exit();
// }

session_start();
$page = 'page';

// Connect to the database server.
$link = mysqli_connect("localhost", "root") or die(mysqli_connect_error());

// Select the database.
mysqli_select_db($link, "miniproject") or die(mysqli_error($link));

// Retrieve the expert ID from the session
$postAssignedID = $_POST['postAssignedID'];
$expertID = $_POST['expertID'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the answer from the form
    $answer = $_POST['answer'];

    // Prepare the INSERT query with parameter placeholders
    // ? = parameter binding
    $insertQuery = "INSERT INTO post_answer (postAssigned_ID, expert_ID, post_answer)
                    VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($link, $insertQuery);
    
    // Bind the values to the prepared statement
    // iis = integer, integer, string
    mysqli_stmt_bind_param($stmt, "iis", $postAssignedID, $expertID, $answer);

    // Execute the prepared statement
    mysqli_stmt_execute($stmt);

    // Check if the query was successful
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        // Update the post_assigned table to change the status to Completed
        $updateQuery = "UPDATE post_assigned SET postAssigned_status = 'Completed' WHERE postAssigned_ID = ?";
        $stmt = mysqli_prepare($link, $updateQuery);
        mysqli_stmt_bind_param($stmt, "i", $postAssignedID); //mysqli_stmt_bind_param -> actual value untuk dari placeholder are separate dgn gune function ni...  
        mysqli_stmt_execute($stmt);

        $alert_message = "Post Answer Has Been Submitted!";
        echo "<script>alert('$alert_message');</script>";
        echo "<script type='text/javascript'>window.location='expertPost.php'</script>";
    } else {
        // Display an error message if the query failed
        echo "Failed to submit the post answer.";
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);

    // Close the database connection
    mysqli_close($link);

    exit();
}


?>
