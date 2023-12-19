<?php
$page = 'home';
include 'headerExpert.php';
?>

<?php
$link = mysqli_connect("localhost", "root") or die(mysqli_connect_error());
mysqli_select_db($link, "miniproject") or die(mysqli_error());

$expertID = $_SESSION["expertID"];

$query = "SELECT COUNT(*) as total FROM publication where expert_ID = '$expertID' ";
$result = mysqli_query($link, $query);
$row = mysqli_fetch_assoc($result);
$totalPublications = $row['total'];

$queryRating = "SELECT SUM(rating_value) AS total_rating, COUNT(rating_ID) AS rating_count FROM rating WHERE expert_ID = '$expertID'";
$result = mysqli_query($link, $queryRating);
$row = mysqli_fetch_assoc($result);
$rating_sum = $row['total_rating'];
$rating_count = $row['rating_count'];

$average_rating = ($rating_count > 0) ? ($rating_sum / $rating_count) : 0;
?>

<!DOCTYPE html>
<html>

<head>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    h1,
    h2,
    h3 {
      text-align: center;
    }

    h1, h2 {
      text-decoration: underline;
    }

    table {
      margin-left: auto;
      margin-right: auto;
      margin-top: 10px;
    }

    th,
    td {
      padding: 10px;
    }

    .publicationChart {
      width: 50%;
      height: 400px;
      margin-bottom: 50px;
      margin-left: auto;
      margin-right: auto;
    }

    .rating-form {
      text-align: center;
      margin-top: 20px;
    }

    .rating-form input[type="number"] {
      width: 100px;
      height: 25px;
      padding: 5px;
      font-size: 14px;
      border-radius: 5px;
    }

    .rating-form input[type="submit"] {
      background-color: #18A0FB;
      color: #FFFFFF;
      border: none;
      border-radius: 5px;
      width: 70px;
      height: 25px;
      font-size: 14px;
    }

    .rating-summary {
      margin-left: auto;
      margin-right: auto;
      margin-top: 20px;
      width: 300px;
    }

    .expert-details {
      margin-top: 20px;
      text-align: center;
    }

    .expert-details h3 {
      font-size: 18px;
      margin-bottom: 10px;
    }

    .expert-details table {
      margin: 0 auto;
      width: 300px;
      border-collapse: collapse;
    }

    .expert-details th,
    .expert-details td {
      padding: 8px;
      border: 1px solid #ddd;
    }
  </style>
</head>

<body>
  <h1>Summary</h1>
  <h2>Display Academic Details</h2>


  <?php
  $expertID = $_SESSION['expertID'];

  $link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());
  mysqli_select_db($link, "miniproject") or die(mysqli_error($link));

  //gune find_in_set ...biase nye sbb dalam column value....dia ada comma (,) 
  $queryDetails = "
      SELECT a.academicStatus_type, e.expert_fullName
      FROM academic_statususerexpert ase
      INNER JOIN academic_status a ON FIND_IN_SET(a.academicStatus_ID, ase.academicStatus_ID)
      INNER JOIN expert e ON ase.expert_ID = e.expert_ID
      WHERE ase.expert_ID = '$expertID'
  ";

  $resultDetails = mysqli_query($link, $queryDetails);

  if (mysqli_num_rows($resultDetails) > 0) {
    $row = mysqli_fetch_assoc($resultDetails);
    $academicStatuses = $row['academicStatus_type'];
    $expertFullName = $row['expert_fullName'];

    $academicStatusArray = explode(",", $academicStatuses);
    echo "<div class='expert-details'>";
    echo "<h3>Expert's Full Name: $expertFullName</h3>";
    echo "<table>";
    echo "<tr><th>Expert's Academic Details:</th><td>";
    foreach ($academicStatusArray as $academicStatus) {
      echo "$academicStatus<br>";
    }
    echo "</td></tr>";
    echo "</table>";
    echo "</div>";
  } else {
    echo "No records found.";
  }

  mysqli_close($link);
  ?>

  <div class="publicationChart" data-expertid="<?php echo $expertID; ?>"></div>

  <script src="https://code.highcharts.com/highcharts.js"></script>

  <script>
    var container = document.querySelector('.publicationChart[data-expertid="<?php echo $expertID; ?>"]');

    Highcharts.chart(container, {
      chart: {
        type: 'column'
      },
      title: {
        text: 'Total Publications, Total Ratings, and Average Ratings'
      },
      xAxis: {
        categories: ['']
      },
      yAxis: {
        title: {
          text: ''
        }
      },
      series: [{
        name: 'Publications',
        data: [{
          y: <?php echo $totalPublications; ?>,
          dataLabels: {
            enabled: true,
            format: 'Total Publications: <?php echo $totalPublications; ?>'
          }
        }],
        color: 'rgba(75, 192, 192, 0.8)'
      }, {
        name: 'Total Ratings',
        data: [{
          y: <?php echo $rating_sum; ?>,
          dataLabels: {
            enabled: true,
            format: 'Total Ratings: <?php echo $rating_sum; ?>'
          }
        }],
        color: 'rgba(192, 75, 75, 0.8)'
      }, {
        name: 'Average Ratings',
        data: [{
          y: <?php echo $average_rating; ?>,
          dataLabels: {
            enabled: true,
            format: 'Average Ratings: {point.y:.2f}'
          }
        }],
        color: 'turquoise'
      }],
      plotOptions: {
        column: {
          pointWidth: 30
        }
      }
    });
  </script>

</body>

</html>

<?php include 'footerExpert.php'; ?>
