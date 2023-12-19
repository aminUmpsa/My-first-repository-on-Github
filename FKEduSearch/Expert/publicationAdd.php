<?php
session_start();
$page = 'publication';

?>
<html> 
<body>
 
  <?php 
  
  
  	$link = mysqli_connect("localhost", "root") or die(mysqli_connect_error());
  
	mysqli_select_db($link, "miniproject") or die(mysqli_error());
  
  //  Untuk dapatkan expertID daripada form submission dari page expertPublication.php
$expertID = $_POST['expertID'];
  
  // Untuk dapatkan current date and time
	$publicationCreatedDate = date('Y-m-d');
	

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Check if file was uploaded without any errors
  //isset = untuk variable dengan value (not null)
  if (isset($_FILES['publicationFile']) && $_FILES['publicationFile']['error'] === UPLOAD_ERR_OK) {
    //tmp = temporary
    $tmpFilePath = $_FILES['publicationFile']['tmp_name'];
    $fileName = $_FILES['publicationFile']['name'];
    // Move the uploaded file to the desired location
    $destinationPath = 'uploads/' . $fileName;
    move_uploaded_file($tmpFilePath, $destinationPath);
	
	
  $title = $_REQUEST["publicationTitle"];
  $name = $_REQUEST["publisherName"];
  $type = $_REQUEST["publicationCategories"];
  
  
  $query = "INSERT INTO publication (expert_ID, publicationTitle, publicationDate, publisherName, publicationType, publicationFile)
          VALUES ('$expertID', '$title', '$publicationCreatedDate', '$name', '$type', '$fileName')";

	/*  $query = "INSERT INTO publication (publicationTitle, publicationDate, publisherName, publicationType, publicationFile)
              VALUES ('$title', '$publicationCreatedDate', '$name', '$type', '')" */
    
		
  
	$result = mysqli_query($link, $query);
	     
	if($result) 
	    {
			
					
		$alert_message = "Publication Has Been Saved !!!";	
		echo "<script>alert('$alert_message');</script>";
		 echo "<script type = 'text/javascript'> window.location='expertPublication.php' </script>";
					
		}
		else 
	    {
			        
	        die("Insert failed");
	    }
		
		 } else {
    // Handle file upload errors
    echo "Error uploading the file.";
  }
}
		  
  //Close the database connection
mysqli_close($link);
 
 
  ?>
  </body>
  </html>
