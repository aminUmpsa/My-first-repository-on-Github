<?php
$page = 'publication';
include 'headerExpert.php';

// Retrieve the search query from the URL parameter
$searchQuery = $_REQUEST['searchQuery'] ?? '';
?>

<div data-aos="fade" class="page-title">
    <nav class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="expertHome.php">Home</a></li>
                <li>Publication</li>
            </ol>
        </div>
    </nav>
</div><!-- End Page Title -->

<style>
    .th {
        font-weight: bold;
        text-transform: uppercase;
        width: auto;
    }

    .publication-table {
        width: 100%;
    }
    
    .search-form {
        text-align: center;
        margin-bottom: 20px;
    }

    .search-form input[type="text"] {
        width: 30%;
        height: 20px;
    }

    .search-form input[type="submit"] {
        background-color: #18A0FB;
        color: #FFFFFF;
        border-radius: 5px;
        width: 70px;
        height: 25px;
        font-size: 18px;
    }
</style>

<div class="search-form">
    <form method="get" action="expertPublication.php">
        <input type="text" name="searchQuery" placeholder="Search Publications Title or Publisher Name">
        <input type="submit" value="Search">
    </form>
</div>

<div class="container">
    <form action="publicationAdd.php" method="post" enctype="multipart/form-data">
        <table class="publication-table" border="0">
            <tr>
                <th class="th" colspan="4" style=" text-decoration: underline;">Add Publication</th>
            </tr>
            <tr>
                <td>.</td>
            </tr>
            <tr>
                <th class="th">Publication Title:</th>
                <td colspan="3"><input type="text" name="publicationTitle" style="width: 400px;" placeholder="Enter Publication Title" required></td>
            </tr>
            <tr>
                <th class="th">Publication File:</th>
                <td><input type="file" name="publicationFile" required></td>
                <th class="th">Publisher Name:</th>
                <td><input type="text" name="publisherName" placeholder="Enter Publisher Name" style="width: 340px;" required></td>
            </tr>
            <tr>
                <th class="th">Categories:</th>
                <td colspan="3">
                    <select name="publicationCategories" required>
                        <option value="" selected align="center">-Select Categories-</option>
                        <option value="Networking">Networking</option>
                        <option value="Software Engineering">Software Engineering</option>
                        <option value="Graphic and Multimedia">Graphic and Multimedia</option>
                        <option value="Cyber Security">Cyber Security</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <input type="hidden" name="expertID" value="<?php echo $_SESSION['expertID']; ?>">
                <td><input type="submit" style="background-color: #18A0FB; color: white" value="SAVE"></td>
            </tr>
        </table>
    </form>

    <table class="publication-table" border="1">
        <tr>
            <th class="th">Lists of Publications</th>
        </tr>
        <tr></tr>
    </table>

    <?php
    $link = mysqli_connect("localhost", "root") or die(mysqli_connect_error());
    mysqli_select_db($link, "miniproject") or die(mysqli_error());

    $expertID = $_SESSION["expertID"];

    $query = "SELECT * FROM publication WHERE expert_ID = $expertID" or die(mysqli_connect_error());
    $result = mysqli_query($link, $query) or die(mysqli_error($link));

    if (mysqli_num_rows($result) > 0) {
        $numberIncrement = 1;
        ?>

        <table class="publication-table" border="2" style="width: 100%;">
            <tr>
                <th class="th">No.</th>
                <th class="th">Publication Title</th>
                <th class="th">Publisher Name</th>
                <th class="th">Categories</th>
                <th class="th">Date Uploaded</th>
                <th></th>
            </tr>

            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr class="trlist">
                    <td align="center"><?php echo $numberIncrement; ?></td>
                    <td align="center"><?php echo $row['publicationTitle']; ?></td>
                    <td align="center"><?php echo $row['publisherName']; ?></td>
                    <td align="center"><?php echo $row['publicationType']; ?></td>
                    <td align="center"><?php echo $row['publicationDate']; ?></td>
                    <td class="th" align="center">
                        <a href="uploads/<?php echo $row['publicationFile']; ?>" download>DOWNLOAD</a>
                        <a href="publicationDelete.php?id=<?php echo $row['publication_ID']; ?>">DELETE</a>
                    </td>
                </tr>
                <?php
                $numberIncrement++; // Increment the numberIncrement variable
            }
            ?>

        </table>

        <?php
    } else {
        echo "No Publications Uploaded Yet -----";
    }
    ?>

    <br><br><br><br>

    <table class="publication-table" border="1">
        <tr>
            <th class="th">Total Publication Based on Date Created</th>
        </tr>
        <tr></tr>
    </table>

    <?php
    $link = mysqli_connect("localhost", "root") or die(mysqli_connect_error());
    mysqli_select_db($link, "miniproject") or die(mysqli_error($link));

    $expertID = $_SESSION["expertID"];

    $queryCreated = "SELECT publicationDate, COUNT(*) AS publicationCount FROM publication where expert_ID = $expertID GROUP BY publicationDate" or die(mysqli_connect_error());

    $resultCreated = mysqli_query($link, $queryCreated);

    if (mysqli_num_rows($resultCreated) > 0) {
        $numberIncrement = 1;
        ?>

        <table class="publication-table" border="2" style="width: 100%;">
            <tr>
                <th class="th">No.</th>
                <th class="th">Date Publication Created</th>
                <th class="th">Total Publication</th>
            </tr>

            <?php
            while ($row = mysqli_fetch_assoc($resultCreated)) {
                ?>
                <tr class="trlist">
                    <td align="center"><?php echo $numberIncrement; ?></td>
                    <td align="center"><?php echo $row['publicationDate']; ?></td>
                    <td align="center"><?php echo $row['publicationCount']; ?></td>
                </tr>
                <?php
                $numberIncrement++; // Increment the numberIncrement variable
            }
            ?>

        </table>

        <?php
    } else {
        echo "No Publications Data in Database -----";
    }
    ?>

    <br><br>
    <br><br>

    <?php
    $link = mysqli_connect("localhost", "root") or die(mysqli_connect_error());
    mysqli_select_db($link, "miniproject") or die(mysqli_error($link));

    if (isset($_REQUEST['searchQuery']) && !empty($_REQUEST['searchQuery'])) {
        $searchQuery = $_GET['searchQuery'];

        $querySearch = "SELECT * FROM publication WHERE publicationTitle LIKE '%$searchQuery%' OR publisherName LIKE '%$searchQuery%'";
        $resultSearch = mysqli_query($link, $querySearch) or die(mysqli_error($link));

        if (mysqli_num_rows($resultSearch) > 0) {
            $numberIncrement = 1;
            ?>

            <table class="publication-table" border="1">
                <tr>
                    <th class="th">Result of Searched Publications</th>
                </tr>
                <tr></tr>
            </table>

            <table class="publication-table" border="2" style="width: 100%;">
                <tr>
                    <th class="th">No.</th>
                    <th class="th">Publication Title</th>
                    <th class="th">Publisher Name</th>
                    <th class="th">Categories</th>
                    <th class="th">Date Uploaded</th>
                    <th></th>
                </tr>

                <?php
                while ($row = mysqli_fetch_assoc($resultSearch)) {
                    ?>
                    <tr class="trlist">
                        <td align="center"><?php echo $numberIncrement; ?></td>
                        <td align="center"><?php echo $row['publicationTitle']; ?></td>
                        <td align="center"><?php echo $row['publisherName']; ?></td>
                        <td align="center"><?php echo $row['publicationType']; ?></td>
                        <td align="center"><?php echo $row['publicationDate']; ?></td>
                        <td class="th" align="center">
                            <a href="uploads/<?php echo $row['publicationFile']; ?>" download>DOWNLOAD</a>
                            <?php // echo $row['publicationFile']; ?>
                        </td>
                    </tr>
                    <?php
                    $numberIncrement++; // Increment the numberIncrement variable
                }
                ?>

            </table>

            <?php
        } else {
            ?>
            <table class="publication-table" border="1">
                <tr>
                    <th class="th">Result of Searched Publications</th>
                </tr>
                <tr>
                    <td align="center">No Publications Found.</td>
                </tr>
            </table>
            <?php
        }
    } else {
        ?>
        <table class="publication-table" border="1">
            <tr>
                <th class="th">Result of Searched Publications</th>
            </tr>
            <tr>
                <td align="center">Please Search Publication's Title or Publisher's Name.</td>
            </tr>
        </table>
        <?php
    }
    ?>

    <?php include 'footerExpert.php'; ?>
