<?php
$page = 'profile';
include 'headerExpert.php';
?>

<div class="page-title">
          
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li ><a href="expertHome.php">Home</a></li>
            <li>Profile</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->
	
	
	<style>
	
	
	
	.th{
		font-weight: bold;
		text-transform: uppercase;
		
	}
	
	.optionCenter {
		align: center;
		
	}
	  .profile-table {
    width: 100%;

	}
	
	</style>
	
	
	
	<form action="expertProfileFormInsert.php" method="POST" enctype="multipart/form-data">
  
  <table>
    
   <h2 align="center" style="text-transform: uppercase; color: #18A0FB;">first time Access Profile</h2>
   <h3 align="center" style="text-transform: uppercase; color:red">please fill in all information details</h3>
   
   <tr>
      <th class="th" style=" text-decoration: underline;">Expert Profile Information</th>
    </tr>
	
	<tr>
	<td>.</td>
	</tr>
	
	<tr>
      <th class="th">Research Area:</th>
      <td>
        <select name="researchAreaName">
          <option value="" selected disabled required>- Select Research Area -</option>
          <option value="Computer Systems and Networking">Computer Systems and Networking</option>
          <option value="Software Engineering">Software Engineering</option>
          <option value="Graphic and Multimedia">Graphic and Multimedia</option>
          <option value="Cyber Security">Cyber Security</option>
        </select>
      </td>
	  <td></td>
	  <td></td>
	    <th class="th">Profile Picture:</th>
      <td>
        <input type="file" name="profilePicture">
      </td>  
     </tr>
    
	
   <tr>
      <th class="th">Academic Status:</th>
      <td>
        <select name="academicStatus_type[]" multiple required>
          <option value="Diploma">Diploma</option>
          <option value="Degree">Degree</option>
          <option value="Master">Master</option>
          <option value="Phd">Phd</option>
        </select>
      </td>
	  <td></td>
	  <td></td>
	     <th class="th">CV:</th>
      <td>
        <input type="file" name="expertCV" required>
      </td>
	  
    </tr>
   
  
   <tr>
      <th class="th">Instagram Username:</th>
      <td>
        <input type="text" name="instagram_userName" style="width: 210px;" placeholder="Enter Instagram Username" required>
      </td>
    </tr>
    
	<tr>
      <th class="th">LinkedIn Username:</th>
      <td>
        <input type="text" name="linkedin_userName" style="width: 210px;" placeholder="Enter LinkedIn Username" required>
      </td>
    </tr>
  
  <tr>
  <td></td>
  <td></td>
  <td></td>
	  <td></td>
	  <td></td>
	<input type="hidden" name="expertID" value="<?php echo $_SESSION['expertID']; ?>"></td>   
	  <td><input type="submit" style="background-color: #18A0FB; color: #FFFFFF; border-radius: 5px; padding: 3px 5px; font-size: 16px;" value="Submit">
	  </td>
    </tr>
   
  
		</table>

	</form>

	
	
	
	


<?php include 'footerExpert.php'; ?>