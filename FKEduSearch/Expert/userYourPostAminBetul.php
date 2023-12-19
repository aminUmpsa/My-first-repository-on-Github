<?php
$page = 'post';
include 'headerUser.php';

?>

<!-- select maksudnya ambik data dari db -->

<h3 align="center"> TOTAL NUMBER OF YOUR POSTS</h3>

<?php
$link = mysqli_connect("localhost", "root") or die(mysqli_connect_error());
mysqli_select_db($link, "miniproject") or die(mysqli_error());

 $user_ID = $_SESSION['userID'];

//$query = "SELECT * FROM post WHERE user_ID = '$user_ID'";
//  LEFT JOIN post_assigned ON post.post_ID = post_assigned.post_ID
// maksud nye dia akan retrieve all post dari post table yg related dengan specified user_ID
// left join...return all record dari left side dan record yg matching dengan right side
// kalau x ade matching dengan right side, return NULL VALUE untuk column yg right side  
$query = "SELECT post.post_ID, post.post_categories, post.post_title, post.post_content, post.post_createdDate, post.post_likes, post.post_status, post_assigned.postAssigned_Status
          FROM post 
          LEFT JOIN post_assigned ON post.post_ID = post_assigned.post_ID
          WHERE post.user_ID = '$user_ID'";


$result = mysqli_query($link, $query) or die(mysqli_error($link));

if (mysqli_num_rows($result) > 0) {
    $numberIncrement = 1;
    ?>

    <table border="2" style="width: 100%;">
	
      	<tr>
	<th>No. </th>  
    <th>Category</th> 
	<th>Post Title</th> 
	<th>Post Question </th>
    <th>Post Date Created</th>  
	<th>Total Likes </th> 
	<th>Post Status</th>
	<th colspan="2">Action</th>
	<!-- <th class="thlist">Total Comments </th>  -->

	
	</tr>

        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?php echo $numberIncrement; ?></td>
                <td align="center"><?php echo $row['post_categories']; ?></td>
                <td align="center"><?php echo $row['post_title']; ?></td>
                <td><?php echo $row['post_content']; ?></td>
                <td align="center"><?php echo $row['post_createdDate']; ?></td>
				 <td align="center"><?php echo $row['post_likes']; ?></td>	
				 <td align="center"><?php echo $row['postAssigned_Status']; ?></td>
				<td style="font-weight: bold; text-transform: uppercase" align="center"><a href="editPostForm.php?post_ID=<?php echo $row['post_ID']; ?>">EDIT</td>
				 <td style="font-weight: bold; text-transform: uppercase" align="center"><a href="postDelete.php?id=<?php echo $row['post_ID']; ?>">DELETE</a></td>
            </tr>
            <?php
            $numberIncrement++; // Increment the numberIncrement variable
        }

        
        ?>

</table>
    <?php
} else {
    echo "No Post Created Yet -----";
}
?>

<br>
<br>

<form action="addPostUIAminBetul.php" >
<div style="text-align: center;">
   <input type="hidden" name="userID" value="<?php echo $_SESSION['userID']; ?>"></td>   
<input type="submit" style="background-color: #18A0FB; color: #FFFFFF; border-radius: 5px; width: 130px; height: 25px; font-size: 12px;" value="CREATE NEW POST">
</div>
</form>
<br>
<div style="text-align: center;">
<form action="viewExpertAnswer.php" method="POST">
<input type="hidden" name="user_ID" value="<?php echo $user_ID; ?>">
  <input type="submit" style="background-color: #18A0FB; color: #FFFFFF; border-radius: 5px; width: 190px; height: 25px; font-size: 12px;" value="VIEW EXPERT ANSWER">
</div>
</form>


 <!-- <button onclick="window.location.href='addPostUIAminBetul.php'" style="background-color: #18A0FB; color: white; font-weight: bold ">CREATE NEW POST</button> -->

  

<br><br>

<h3 align="center"> TOTAL NUMBER OF POSTS BASED ON POST CATEGORIES BASED ON CREATED DATE </h3>
<br>

<!--UNTUK DISPLAY TOTAL NUMBER OF POSTS BASED ON POST CATEGORIES BASED ON DATE-->

<?php
$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());
mysqli_select_db($link, "miniproject") or die(mysqli_error($link));

$user_ID = $_SESSION['userID'];


// SQL Statement to fetch the total number of posts by post_categories and post_createdDate
$queryDisplay = "SELECT post_categories, post_createdDate, COUNT(*) AS totalPosts 
          FROM post WHERE user_ID = '$user_ID'
          GROUP BY post_categories, post_createdDate";

$resultDisplay = mysqli_query($link, $queryDisplay);

if (mysqli_num_rows($resultDisplay) > 0) {
    $numberIncrement = 1;
    ?>

    <table border="3" style="width: 100%;">
        <tr>
            <th class="th">No. </th>  
            <th class="th">Post Categories</th>
            <th class="th">Post Created Date</th>
            <th class="th">Total Posts</th>		
        </tr>

        <?php
        while ($row = mysqli_fetch_assoc($resultDisplay)) {
            ?>
            <tr>
                <td align="center"><?php echo $numberIncrement; ?></td>
                <td align="center"><?php echo $row['post_categories']; ?></td>
                <td align="center"><?php echo $row['post_createdDate']; ?></td>
                <td align="center"><?php echo $row['totalPosts']; ?></td>
            </tr>
            <?php
            $numberIncrement++;
        }
        ?>

    </table>

    <?php
} else {
    echo "No Data in Database -----";
}

// Close the database connection
mysqli_close($link);
?>

<br><br>
<br><br>

  <style>
  .publicationChart {
  width: 50%;
  height: 400px;
  margin: 0 auto; /* This will center the element horizontally */
  margin-bottom: 50px;
}

  </style>






<!-- Untuk display Bar Chart --> 
<div class="publicationChart" style="width: 50%; height: 400px; margin-bottom: 50px;"></div>


<!-- Include Highcharts library -->
<script src="https://code.highcharts.com/highcharts.js"></script>

<!-- JavaScript code to create the bar chart -->
<script>
  // PHP code to fetch the data from the database
  <?php
  $link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());
  mysqli_select_db($link, "miniproject") or die(mysqli_error($link));

$user_ID = $_SESSION['userID'];

  $queryChart = "SELECT post_createdDate, COUNT(*) AS totalPosts 
            FROM post WHERE user_ID = '$user_ID'
            GROUP BY post_createdDate";

  $resultChart = mysqli_query($link, $queryChart);

  $data = array();
  while ($row = mysqli_fetch_assoc($resultChart)) {
    $data[] = array(
      'date' => $row['post_createdDate'],
      'totalPosts' => (int) $row['totalPosts']
    );
  }

  // Convert PHP data to JavaScript array
  $jsData = json_encode($data);
  ?>

  // JavaScript code to create the Highcharts bar chart
  var data = <?php echo $jsData; ?>;

  var container = document.querySelector('.publicationChart');

  Highcharts.chart(container, {
    chart: {
      type: 'column'
    },
    title: {
      text: 'Total Number of Posts Based on Created Date'
    },
    xAxis: {
      categories: data.map(function(item) {
        return item.date;
      })
    },
    yAxis: {
      title: {
        text: 'Total Posts'
      }
    },
	
	/* syntax assign color mula dari sini
	series: [{
  name: 'Posts',
  data: data.map(function(item) {
    return {
      y: item.totalPosts,
      color: item.date === '2023-06-13' ? 'yellow' : (item.date === '2023-06-04' ? 'green' : (item.date === '2023-06-02' ? 'purple'	: '' )) // Untuk assign color kepada specific date
    };
  }),
   smpai sini */
	
   // sini syntax --> kalo tak nak assign color,,,system akan assign automatic
	  series: [{
      name: 'Posts',
      data: data.map(function(item) {
        return item.totalPosts;
      }),
       colorByPoint: true, // Set color by point...Yang ni, system akan assign sendiri color untuk setiap bar chart 
	// SYNTAX sampai sini
	 
      dataLabels: {
        enabled: true,
        format: '{point.y}'
      }
    }],
    plotOptions: {
      column: {
        pointPadding: 0.2,
        borderWidth: 0
      }
    }
  });
</script>




<?php

include 'footerUser.php';

?>

