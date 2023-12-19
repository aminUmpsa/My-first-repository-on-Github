<?php
$page = 'post';
include 'headerUser.php';

// Connect to the database server
$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

// Select the database
mysqli_select_db($link, "miniproject") or die(mysqli_error($link));

//isset = untuk check variable and value bukan NULL
$postID = isset($_REQUEST['post_ID']) ? $_REQUEST['post_ID'] : '';

if (!empty($postID)) {
    $queryPost = "SELECT * FROM post WHERE post_ID = $postID";
    $resultPost = mysqli_query($link, $queryPost);
    $row = mysqli_fetch_assoc($resultPost);
} else {
    // Handle the case when post_ID is not set or empty
    // For example, you can redirect the user to an error page or display an error message.
    echo "Invalid post ID";
    exit;
}
?>


<!-- edit post form -->
<form method="POST" action="editPost.php" style="max-width: 500px; margin: 0 auto;">
    <h2>Edit Post</h2>
    <input type="hidden" name="postID" value="<?php echo $postID; ?>">

    <div style="margin-bottom: 10px;">
        <label for="category" style="display: block; font-weight: bold;">Category:</label>
        <select name="postCategory" style="width: 100%; padding: 5px;">
            <option value="" selected disabled>- Select Categories -</option>
            <option value="Computer Systems and Networking" <?php if ($row && $row['post_categories'] === 'Computer Systems and Networking') echo 'selected'; ?>>Computer Systems and Networking</option>
            <option value="Software Engineering" <?php if ($row && $row['post_categories'] === 'Software Engineering') echo 'selected'; ?>>Software Engineering</option>
            <option value="Graphic and Multimedia" <?php if ($row && $row['post_categories'] === 'Graphic and Multimedia') echo 'selected'; ?>>Graphic and Multimedia</option>
            <option value="Cyber Security" <?php if ($row && $row['post_categories'] === 'Cyber Security') echo 'selected'; ?>>Cyber Security</option>
        </select>
    </div>

    <div style="margin-bottom: 10px;">
        <label for="postTitle" style="display: block; font-weight: bold;">Post Title:</label>
        <input type="text" name="postTitle" style="width: 100%; padding: 5px;" value="<?php echo $row['post_title']; ?>">
    </div>

    <div style="margin-bottom: 10px;">
        <label for="postQuestion" style="display: block; font-weight: bold;">Post Question:</label>
        <textarea name="postQuestion" style="width: 100%; height: 150px; padding: 5px;"><?php echo $row['post_content']; ?></textarea>
    </div>

    <div style="text-align: center;">
        <input type="submit" value="Update" style="padding: 10px 20px; background-color: #18A0FB; color: #fff; font-weight: bold; font-size: 14px; border: none">
    </div>
</form>
