<style>
    .center-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    
    .page-title {
        padding: 20px 0;
    }
    
    .container {
        margin: 20px auto;
        max-width: 800px;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    
    h2 {
        margin-bottom: 20px;
    }
    
    h3 {
        margin-bottom: 10px;
    }
    
    p {
        margin-bottom: 5px;
    }
    
    hr {
        margin: 20px 0;
        border: none;
        border-top: 1px solid #ccc;
    }
    
    textarea {
        width: 100%;
        margin-bottom: 10px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        resize: vertical;
    }
    
    input[type="submit"] {
        padding: 10px 20px;
        font-size: 16px;
        background-color: #18A0FB;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    
    input[type="submit"]:hover {
        background-color: #45a049;
    }
</style>

<?php
$page = 'post';
include 'headerExpert.php';

// Connect to the database server.
$link = mysqli_connect("localhost", "root") or die(mysqli_connect_error());

// Select the database.
mysqli_select_db($link, "miniproject") or die(mysqli_error($link));

// Retrieve the expert ID from the session
$expertID = $_SESSION['expertID'];

$query = "SELECT research_area.researchAreaName
          FROM research_areauserexpert 
          JOIN research_area  ON research_area.researchArea_ID = research_areauserexpert.researchArea_ID
          WHERE research_areauserexpert.expert_ID = $expertID";

$result = mysqli_query($link, $query) or die(mysqli_error($link));
$row = mysqli_fetch_assoc($result);

$researchArea = $row['researchAreaName'];

// Query the post_assigned and post tables to get the assigned posts
$queryAssigned = "SELECT post.post_title, post.post_content, post.post_createdDate, post.post_categories,
          post_assigned.postAssigned_ID
          FROM post_assigned 
          INNER JOIN post ON post_assigned.post_ID = post.post_ID
          WHERE post_assigned.expert_ID = $expertID AND post.post_categories = '$researchArea'";
$result = mysqli_query($link, $queryAssigned) or die(mysqli_error($link));
?>

<div class="page-title">
    <nav class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="expertHome.php">Home</a></li>
                <li>Post</li>
            </ol>
        </div>
    </nav>
</div><!-- End Page Title -->

<div class="container">
    <h2 align="center" style=" text-decoration: underline;" >Assigned Posts</h2>
    <?php
    if (mysqli_num_rows($result) > 0) {
        // Display the assigned posts
        while ($row = mysqli_fetch_assoc($result)) {
            $title = $row['post_title'];
            $content = $row['post_content'];
            $postCategories = $row['post_categories'];
           // $remainingDuration = $row['post_remainingDuration'];
            $date = $row['post_createdDate'];
            $postAssignedID = $row['postAssigned_ID']; 

            echo "<h3><strong>Post Title:</strong> $title</h3>";
            echo "<p><strong>Post Content:</strong> $content</p>";
            echo "<p><strong>Post Categories:</strong> $postCategories</p>";
          //  echo "<p><strong>Post Remaining:</strong> $remainingDuration</p>";
            echo "<p><strong>Post Created Date:</strong> $date</p>";
            echo "<hr>";

            // Query the post_answer table to get the expert's answer
            $answerQuery = "SELECT post_answer FROM post_answer
                            WHERE postAssigned_ID = '$postAssignedID' AND expert_ID = '$expertID'";
            $answerResult = mysqli_query($link, $answerQuery) or die(mysqli_error($link));
            $row = mysqli_fetch_assoc($answerResult);
            $answer = isset($row['post_answer']) ? $row['post_answer'] : null;

            // Form to submit the answer
            echo "<form method='POST' action='expertSubmitAnswer.php'>";
            echo "<input type='hidden' name='expertID' value='" . $_SESSION['expertID'] . "'>"; 
            echo "<input type='hidden' name='postAssignedID' value='$postAssignedID'>"; 

            echo "<div class='center-container'>";
            echo "<p><strong>Post Answer:</strong></p>";
            if (!empty($answer)) {
                echo "<textarea name='answer' rows='5' cols='50' disabled>$answer</textarea>";
            } else {
                echo "<textarea name='answer' rows='5' cols='50'></textarea>";
                echo "<br>";
                echo "<input type='submit' value='Submit Answer'>";
            }
            echo "</div>";
            echo "</form>";
        }
    } else {
        echo "<p>No Assigned Posts Found.</p>";
    }
    ?>
</div>

<?php include 'footerExpert.php'; ?>
