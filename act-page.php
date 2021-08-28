<?php
include_once 'loader.php';
include_once 'nav.php';
include_once 'bottom-nav.php';

// Get Page By Query String

$queryString = $_SERVER['QUERY_STRING'];
$queryStringFinal = str_replace("-", " ", $queryString);

// Connect To DB

require_once 'config.php';

$sql = "SELECT * FROM actors WHERE ActorName = '$queryStringFinal'";

$result = mysqli_query($conn, $sql);
$row = $result->fetch_assoc();

// Get Actor Movies

$sqlMovies1 = "SELECT * FROM MOVIES WHERE actor1 = '$queryStringFinal'";
$sqlMovies2 = "SELECT * FROM MOVIES WHERE actor2 = '$queryStringFinal'";
$sqlMovies3 = "SELECT * FROM MOVIES WHERE actor3 = '$queryStringFinal'";
$sqlMovies4 = "SELECT * FROM MOVIES WHERE actor4 = '$queryStringFinal'";

$result1 = mysqli_query($conn, $sqlMovies1);
$result2 = mysqli_query($conn, $sqlMovies2);
$result3 = mysqli_query($conn, $sqlMovies3);
$result4 = mysqli_query($conn, $sqlMovies4);

// Get Actor Series

$sqlSeries1 = "SELECT * FROM series WHERE actor1 = '$queryStringFinal'";
$sqlSeries2 = "SELECT * FROM series WHERE actor2 = '$queryStringFinal'";
$sqlSeries3 = "SELECT * FROM series WHERE actor3 = '$queryStringFinal'";
$sqlSeries4 = "SELECT * FROM series WHERE actor4 = '$queryStringFinal'";

$result5 = mysqli_query($conn, $sqlSeries1);
$result6 = mysqli_query($conn, $sqlSeries2);
$result7 = mysqli_query($conn, $sqlSeries3);
$result8 = mysqli_query($conn, $sqlSeries4);

// Works Numbers

$sqlMovies1Count = "SELECT COUNT(*) AS count FROM MOVIES WHERE actor1 = '$queryStringFinal'";
$sqlMovies2Count = "SELECT COUNT(*) AS count FROM MOVIES WHERE actor2 = '$queryStringFinal'";
$sqlMovies3Count = "SELECT COUNT(*) AS count FROM MOVIES WHERE actor3 = '$queryStringFinal'";
$sqlMovies4Count = "SELECT COUNT(*) AS count FROM MOVIES WHERE actor4 = '$queryStringFinal'";

$sqlSeries1Count = "SELECT COUNT(*) AS count FROM series WHERE actor1 = '$queryStringFinal'";
$sqlSeries2Count = "SELECT COUNT(*) AS count FROM series WHERE actor2 = '$queryStringFinal'";
$sqlSeries3Count = "SELECT COUNT(*) AS count FROM series WHERE actor3 = '$queryStringFinal'";
$sqlSeries4Count = "SELECT COUNT(*) AS count FROM series WHERE actor4 = '$queryStringFinal'";

$result1Count = mysqli_query($conn, $sqlMovies1Count);
$result2Count = mysqli_query($conn, $sqlMovies2Count);
$result3Count = mysqli_query($conn, $sqlMovies3Count);
$result4Count = mysqli_query($conn, $sqlMovies4Count);

$result5Count = mysqli_query($conn, $sqlSeries1Count);
$result6Count = mysqli_query($conn, $sqlSeries2Count);
$result7Count = mysqli_query($conn, $sqlSeries3Count);
$result8Count = mysqli_query($conn, $sqlSeries4Count);

$rowmoviecount1 = $result1Count->fetch_assoc();
$rowmoviecount2 = $result2Count->fetch_assoc();
$rowmoviecount3 = $result3Count->fetch_assoc();
$rowmoviecount4 = $result4Count->fetch_assoc();

$rowseriescount1 = $result5Count->fetch_assoc();
$rowseriescount2 = $result6Count->fetch_assoc();
$rowseriescount3 = $result7Count->fetch_assoc();
$rowseriescount4 = $result8Count->fetch_assoc();

$countMovie1 = $rowmoviecount1['count'];
$countMovie2 = $rowmoviecount2['count'];
$countMovie3 = $rowmoviecount3['count'];
$countMovie4 = $rowmoviecount4['count'];

$countSeries1 = $rowseriescount1['count'];
$countSeries2 = $rowseriescount2['count'];
$countSeries3 = $rowseriescount3['count'];
$countSeries4 = $rowseriescount4['count'];
$totalMoviesCount = (int)$countMovie1 + (int)$countMovie2 + (int)$countMovie3 + (int)$countMovie4;
$totalSeriesCount = (int)$countSeries1 + (int)$countSeries2 + (int)$countSeries3 + (int)$countSeries4;

$totalWorks = $totalMoviesCount + $totalSeriesCount;

$arabCountry = array(
  'مصر',
  'تونس',
  'السعودية',
  'المغرب',
  'الجزئر',
  'عمان',
  'قطر',
  'البحرين',
  'السودان',
  'العراق',
  'اليمن',
  'الكويت',
  'ليبيا',
  'لبنان',
  'سوريا',
);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $row['ActorName']; ?> صفحة الممثل</title>
  <link rel="stylesheet" href="css/act-page.css">
</head>

<body>

  <div class="main-container">
    <div class="r1">
      <div class="act-image">
        <img src="<?php echo $row['ActorImage']; ?>" alt="">
      </div>
      <div class="act-info">
        <p class="act-name"><?php
                            if (in_array($row['ActorCountry'], $arabCountry)) {
                              echo $row['ArabicName'];
                            } else {
                              echo $row['ActorName'];
                            }
                            ?></p>
        <p class="works"><span><?php echo $totalWorks; ?></span> أعمال</p>
      </div>
    </div>
    <div class="r2">
      <div class="content-box">


        <?php
        while ($row1 = $result1->fetch_assoc()) {
          // Generate Main Page
          $mainPage = $row1['MovieName1'];
          $generateLink = str_replace(" ", "-", $mainPage);
          echo '
          <div class="box">
            <div class="cover">
              <img src="' . $row1['MovieCover'] . '" alt="">
            </div>
            <p class="name"><a href="' . 'movie-page.php?' . $generateLink . '">';

          if ($row1['MovieLang'] == 'العربية') {
            echo $row1['MovieName2'];
          } else {
            echo $row1['MovieName1'];
          }
          echo '
            </a></p>
            <div class="box-info">
              <ul>
                <li><i class="fa fa-imdb"></i>' . $row1['IMDBRate'] . '</li>
                <li><i class="fa fa-clock-o"></i>' . $row1['MovieLength'] . ' Min</li>
              </ul>
            </div>
            <div class="video-year">' . $row1['VideoQality'] . '  ' . $row1['MovieYear'] .  '</div>
          </div>
        ';
        }
        ?>
        <?php
        while ($row2 = $result2->fetch_assoc()) {
          // Generate Main Page
          $mainPage = $row2['MovieName1'];
          $generateLink = str_replace(" ", "-", $mainPage);
          echo '
          <div class="box">
            <div class="cover">
              <img src="' . $row2['MovieCover'] . '" alt="">
            </div>
            <p class="name"><a href="' . 'movie-page.php?' . $generateLink . '">';
          if ($row2['MovieLang'] == 'العربية') {
            echo $row2['MovieName2'];
          } else {
            echo $row2['MovieName1'];
          }
          echo
          '</a></p>
            <div class="box-info">
              <ul>
                <li><i class="fa fa-imdb"></i>' . $row2['IMDBRate'] . '</li>
                <li><i class="fa fa-clock-o"></i>' . $row2['MovieLength'] . ' Min</li>
              </ul>
            </div>
            <div class="video-year">' . $row2['VideoQality'] . '  ' . $row2['MovieYear'] .  '</div>
          </div>
        ';
        }
        ?>
        <?php
        while ($row3 = $result3->fetch_assoc()) {
          // Generate Main Page
          $mainPage = $row3['MovieName1'];
          $generateLink = str_replace(" ", "-", $mainPage);
          echo '
          <div class="box">
            <div class="cover">
              <img src="' . $row3['MovieCover'] . '" alt="">
            </div>
            <p class="name"><a href="' . 'movie-page.php?' . $generateLink . '">';
          if ($row3['MovieLang'] == 'العربية') {
            echo $row3['MovieName2'];
          } else {
            echo $row3['MovieName1'];
          }
          echo
          '</a></p>
            <div class="box-info">
              <ul>
                <li><i class="fa fa-imdb"></i>' . $row3['IMDBRate'] . '</li>
                <li><i class="fa fa-clock-o"></i>' . $row3['MovieLength'] . ' Min</li>
              </ul>
            </div>
            <div class="video-year">' . $row3['VideoQality'] . '  ' . $row3['MovieYear'] .  '</div>
          </div>
        ';
        }
        ?>
        <?php
        while ($row4 = $result4->fetch_assoc()) {
          // Generate Main Page
          $mainPage = $row4['MovieName1'];
          $generateLink = str_replace(" ", "-", $mainPage);
          echo '
          <div class="box">
            <div class="cover">
              <img src="' . $row4['MovieCover'] . '" alt="">
            </div>
            <p class="name"><a href="' . 'movie-page.php?' . $generateLink . '">';
          if ($row4['MovieLang'] == 'العربية') {
            echo $row4['MovieName2'];
          } else {
            echo $row4['MovieName1'];
          }
          echo
          '</a></p>
            <div class="box-info">
              <ul>
                <li><i class="fa fa-imdb"></i>' . $row4['IMDBRate'] . '</li>
                <li><i class="fa fa-clock-o"></i>' . $row4['MovieLength'] . ' Min</li>
              </ul>
            </div>
            <div class="video-year">' . $row4['VideoQality'] . '  ' . $row4['MovieYear'] .  '</div>
          </div>
        ';
        }
        ?>
        <!-- Start Series -->
        <?php
        while ($row5 = $result5->fetch_assoc()) {
          // Generate Main Page
          $mainPage = $row5['SeriesName1'];
          $generateLink = str_replace(" ", "-", $mainPage);
          echo '
          <div class="box">
            <div class="cover">
              <img src="' . $row5['SeriesCover'] . '" alt="">
            </div>
            <p class="name"><a href="' . 'series-page.php?' . $generateLink . '">';

          if ($row5['SeriesLang'] == 'العربية') {
            echo $row5['SeriesName2'];
          } else {
            echo $row5['SeriesName1'];
          }
          echo
          '</a></p>
            <div class="box-info">
              <ul>
                <li><i class="fa fa-imdb"></i>' . $row5['IMDBRate'] . '</li>
                <li><i class="fa fa-clock-o"></i>' . $row5['SeriesLength'] . ' Min</li>
              </ul>
            </div>
            <div class="video-year">' . $row5['SeriesQuality'] . '  ' . $row5['SeriesYear'] .  '</div>
          </div>
          ';
        }
        ?>
        <?php
        while ($row6 = $result6->fetch_assoc()) {
          // Generate Main Page
          $mainPage = $row6['SeriesName1'];
          $generateLink = str_replace(" ", "-", $mainPage);
          echo '
          <div class="box">
            <div class="cover">
              <img src="' . $row6['SeriesCover'] . '" alt="">
            </div>
            <p class="name"><a href="' . 'series-page.php?' . $generateLink . '">';

          if ($row6['SeriesLang'] == 'العربية') {
            echo $row6['SeriesName2'];
          } else {
            echo $row6['SeriesName1'];
          }
          echo
          '</a></p>
            <div class="box-info">
              <ul>
                <li><i class="fa fa-imdb"></i>' . $row6['IMDBRate'] . '</li>
                <li><i class="fa fa-clock-o"></i>' . $row6['SeriesLength'] . ' Min</li>
              </ul>
            </div>
            <div class="video-year">' . $row6['SeriesQuality'] . '  ' . $row6['SeriesYear'] .  '</div>
          </div>
        ';
        }
        ?>
        <?php
        while ($row7 = $result7->fetch_assoc()) {
          // Generate Main Page
          $mainPage = $row7['SeriesName1'];
          $generateLink = str_replace(" ", "-", $mainPage);
          echo '
          <div class="box">
            <div class="cover">
              <img src="' . $row7['SeriesCover'] . '" alt="">
            </div>
            <p class="name"><a href="' . 'series-page.php?' . $generateLink . '">';
          if ($row7['SeriesLang'] == 'العربية') {
            echo $row7['SeriesName2'];
          } else {
            echo $row7['SeriesName1'];
          }
          echo
          '</a></p>
            <div class="box-info">
              <ul>
                <li><i class="fa fa-imdb"></i>' . $row7['IMDBRate'] . '</li>
                <li><i class="fa fa-clock-o"></i>' . $row7['SeriesLength'] . ' Min</li>
              </ul>
            </div>
            <div class="video-year">' . $row7['SeriesQuality'] . '  ' . $row7['SeriesYear'] .  '</div>
          </div>
        ';
        }
        ?>
        <?php
        while ($row8 = $result8->fetch_assoc()) {
          // Generate Main Page
          $mainPage = $row8['SeriesName1'];
          $generateLink = str_replace(" ", "-", $mainPage);
          echo '
          <div class="box">
            <div class="cover">
              <img src="' . $row8['SeriesCover'] . '" alt="">
            </div>
            <p class="name"><a href="' . 'series-page.php?' . $generateLink . '">';
          if ($row8['SeriesLang'] == 'العربية') {
            echo $row8['SeriesName2'];
          } else {
            echo $row8['SeriesName1'];
          }
          echo
          '</a></p>
            <div class="box-info">
              <ul>
                <li><i class="fa fa-imdb"></i>' . $row8['IMDBRate'] . '</li>
                <li><i class="fa fa-clock-o"></i>' . $row8['SeriesLength'] . ' Min</li>
              </ul>
            </div>
            <div class="video-year">' . $row8['SeriesQuality'] . '  ' . $row8['SeriesYear'] .  '</div>
          </div>
        ';
        }

        ?>

      </div>
    </div>
  </div>
  <script>
    window.onload = function() {
      $('.loader-container').fadeOut(1000);
    }
  </script>
</body>

</html>