<?php

$page = 'post';

include 'headerUser.php';

?>



<form action="userAddPostDBBetul.php" method="post">
<table align=center>

<tr>

<td><label for="category">Category:</label></td>

<td>
<select name="category">
<option value="" selected align="center" required>-Select Categories-</option>
     <option value="" selected disabled required>- Select Research Area -</option>
          <option value="Computer Systems and Networking">Computer Systems and Networking</option>
          <option value="Software Engineering">Software Engineering</option>
          <option value="Graphic and Multimedia">Graphic and Multimedia</option>
          <option value="Cyber Security">Cyber Security</option>
        </select>
</td> 
 
</tr>


   <tr>
   <td>Post Title:</td>  
   <td><input type="text" name="postTitle" placeholder="Write Your Post Title Here" style="width: 300px;" required> </td> 
   
   </tr>

   <td>Post:</td>
   <td><textarea name ="postQuestion"  placeholder="Write Your Post Here..." 
   rows = "7" cols = "40"></textarea></td>
   </tr>
   
   <tr>
   <input type="hidden" name="userID" value="<?php echo $_SESSION['userID']; ?>">
   <td><input type="submit" align="center" style="background-color: #18A0FB; color: #FFFFFF; border-radius: 5px;" value="Submit"></td>
   
   </tr>

</table>
</form>


 
   <!--  <td><br><input type="submit" style="color:black ; border-radius: 5px; float: right" value="Submit"></td> -->

</form>

<!-- "background-color: #18A0FB;  -->

<?php

include 'footerUser.php';

?>