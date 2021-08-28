<?php
include_once 'nav.php';
include_once 'bottom-nav.php';

// Get Page By Query String

$queryString = $_SERVER['QUERY_STRING'];
$queryStringFinal = str_replace("-", " ", $queryString);

// Connect To DB

require_once 'config.php';

// Epsodes
$sql = "SELECT * FROM epsodes WHERE EpsodeID = '$queryStringFinal'";

$result = mysqli_query($conn, $sql);
$row10 = $result->fetch_assoc();

// Series
// echo '<pre>';
// print_r($row);
// echo '</pre>';

$seriesID = $row10['SeriesID'];

$sqlSeries = "SELECT * FROM series WHERE ID = '$seriesID'";

$resultSeries = mysqli_query($conn, $sqlSeries);
$rowSeries = $resultSeries->fetch_assoc();

$scrapImdb = file_get_contents($rowSeries['SeriesPage']);
$startscrap = explode('<span class="AggregateRatingButton__RatingScore-sc-1ll29m0-1 iTLWoV">', $scrapImdb);
$endscrap = explode('<span>/<!-- -->10</span>', $startscrap[1]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>مسلسل <?php echo $rowSeries['SeriesName1']; ?> الحلقة <?php echo $row10['EpsodeNum']; ?></title>
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/movie-page.css">
</head>

<body>

  <div class="main-container">
    <div class="r1">
      <p class="name">الحلقة <?php echo $row10['EpsodeNum']; ?> <?php echo $rowSeries['SeriesName1']; ?> </p>
    </div>
    <div class="r2">
      <div class="right">
        <div class="imdb-rate">
          <span><?php echo $endscrap[0]; ?></span>
          <span><i class="fa fa-imdb"></i></span>
        </div>
        <div class="cover">
          <img src="<?php echo $rowSeries['SeriesCover']; ?>" alt="">
        </div>
        <!-- <ul class="rate">
          <p style="text-align: center;font-weight:bold;margin-bottom:5px;">قيم الفيلم</p>
          <li><i class="fa fa-thumbs-up"></i></li>
          <li>80 %</li>
          <li><i class="fa fa-thumbs-down"></i></li>
        </ul> -->
      </div>
      <div class="left">
        <div class="story">
          <p class="title"><i class="fa fa-hashtag"></i> القصة</p>
          <p class="story-name"><?php echo $rowSeries['SeriesName2']; ?></p>
          <p class="story-content"><?php echo $rowSeries['SeriesStory']; ?></p>
        </div>
        <div class="movie-info">
          <table>
            <tr>
              <td>الحلقة</td>
              <td><?php echo $row10['EpsodeNum']; ?></td>
            </tr>
            <tr>
              <td>الموسم</td>
              <td><?php echo $row10['Sesson']; ?></td>
            </tr>
            <tr>
              <td>المدة</td>
              <td><?php echo $rowSeries['SeriesLength']; ?> دقيقة</td>
            </tr>
            <tr>
              <td>الجودة</td>
              <td><?php echo $rowSeries['SeriesQuality']; ?></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <div class="r4">
      <p class="take-action">
        <i class="fa fa-hashtag"></i> التحميل و المشاهدة
      </p>
      <table id="watch">
        <tr>
          <th>الجودة</th>
          <th>الدقة</th>
          <th>الحجم</th>
          <th>روابط مباشرة</th>
        </tr>
        <?php

        if (!($row10['movie-wurl1080'] == '' && $row10['movie-durl1080'] == '')) {
          echo '
          <tr>
          <td>' . $rowSeries['VedioQuality'] . '</td>
          <td> Full HD 1080p <i class="fa fa-desktop"></i></td>
          <td>GB ' . $row10['movie-volume1080'] . '</td>
          <td>';
          if (!($row10['movie-durl1080'] == '')) {
            echo '
            <span> 
            <a href="' . $row10['movie-durl1080'] . '">تحميل</a>
          </span>
            ';
          }
          if (!($row10['movie-wurl1080'] == '')) {
            echo '
          <span>
            <a href="' . $row10['movie-wurl1080'] . '">مشاهدة</a>
          </span>
        </td>
            ';
          }
          echo '
        </tr>
        <tr class="spare">
          <td colspan="3">
          ';
          if (!($row10['movie-wurl1080'] == '')) {
            echo '<a href="' . $row10['movie-wurl1080'] . '">مشاهدة</a>';
          }
          if (!($row['movie-durl1080'] == '')) {
            echo '<a href="' . $row10['movie-durl1080'] . '">تحميل</a>';
          }
          echo '
            </td>
          <td></td>
        </tr>
          ';
        }

        ?>

        <?php

        if (!($row10['movie-wurl720'] == '' && $row10['movie-durl720'] == '')) {
          echo '
  <tr>
  <td>' . $rowSeries['VedioQuality'] . '</td>
  <td> HD 720p <i class="fa fa-laptop"></i></td>
  <td>GB ' . $row10['movie-volume720'] . '</td>
  <td>';
          if (!($row10['movie-durl720'] == '')) {
            echo '
    <span> 
    <a href="' . $row10['movie-durl720'] . '">تحميل</a>
  </span>
    ';
          }
          if (!($row10['movie-wurl720'] == '')) {
            echo '
  <span>
    <a href="' . $row10['movie-wurl720'] . '">مشاهدة</a>
  </span>
</td>
    ';
          }
          echo '
</tr>
<tr class="spare">
  <td colspan="3">
  ';
          if (!($row10['movie-wurl720'] == '')) {
            echo '<a href="' . $row10['movie-wurl720'] . '">مشاهدة</a>';
          }
          if (!($row10['movie-durl720'] == '')) {
            echo '<a href="' . $row10['movie-durl720'] . '">تحميل</a>';
          }
          echo '
  </td>
  <td></td>
</tr>
  ';
        }

        ?>
        <?php

        if (!($row10['movie-wurl480'] == '' && $row10['movie-durl480'] == '')) {
          echo '
  <tr>
  <td>' . $rowSeries['VedioQuality'] . '</td>
  <td> SD 480p <i class="fa fa-tablet"></i></td>
  <td>GB ' . $row10['movie-volume480'] . '</td>
  <td>';
          if (!($row10['movie-durl480'] == '')) {
            echo '
    <span> 
    <a href="' . $row10['movie-durl480'] . '">تحميل</a>
  </span>
    ';
          }
          if (!($row10['movie-wurl480'] == '')) {
            echo '
  <span>
    <a href="watch-online.php?Media=' . $rowSeries['SeriesName1'] . '&Qual=High">مشاهدة</a>
  </span>
</td>
    ';
          }
          echo '
</tr>
<tr class="spare">
  <td colspan="3">
  ';
          if (!($row10['movie-wurl480'] == '')) {
            echo '    <a href="watch-online.php?Media=' . $rowSeries['SeriesName1'] . '&Qual=High">مشاهدة</a>
            ';
          }
          if (!($row['movie-durl480'] == '')) {
            echo '<a href="' . $row10['movie-durl480'] . '">تحميل</a>';
          }
          echo '
  </td>
  <td></td>
</tr>
  ';
        }
        ?>
        <?php

        if (!($row10['movie-wurl360'] == '' && $row10['movie-durl360'] == '')) {
          echo '
  <tr>
  <td>' . $rowSeries['VedioQuality'] . '</td>
  <td> SD 360p <i style="font-size: 24px;" class="fa fa-mobile"></i></td>
  <td>MB ' . $row10['movie-volume360'] . '</td>
  <td>';
          if (!($row10['movie-durl360'] == '')) {
            echo '
    <span> 
    <a href="' . $row10['movie-durl360'] . '">تحميل</a>
  </span>
    ';
          }
          if (!($row10['movie-wurl360'] == '')) {
            echo '
  <span>
    <a href="' . $row10['movie-wurl360'] . '">مشاهدة</a>
  </span>
</td>
    ';
          }
          echo '
</tr>
<tr class="spare">
  <td colspan="3">
  ';
          if (!($row10['movie-wurl360'] == '')) {
            echo '<a href="' . $row10['movie-wurl360'] . '">مشاهدة</a>';
          }
          if (!($row10['movie-durl360'] == '')) {
            echo '<a href="' . $row10['movie-durl360'] . '">تحميل</a>';
          }
          echo '
  </td>
  <td></td>
</tr>
  ';
        }
        ?>
        <?php

        if (!($row10['movie-wurl244'] == '' && $row10['movie-durl244'] == '')) {
          echo '
  <tr>
  <td>' . $rowSeries['VedioQuality'] . '</td>
  <td> SD 244p <i class="fa fa-mobile"></i></td>
  <td>MB ' . $row10['movie-volume244'] . '</td>
  <td>';
          if (!($row10['movie-durl244'] == '')) {
            echo '
    <span> 
    <a href="' . $row10['movie-durl244'] . '">تحميل</a>
  </span>
    ';
          }
          if (!($row10['movie-wurl244'] == '')) {
            echo '
  <span>
    <a href="' . $row10['movie-wurl244'] . '">مشاهدة</a>
  </span>
</td>
    ';
          }
          echo '
</tr>
<tr class="spare">
  <td colspan="3">
  ';
          if (!($row10['movie-wurl244'] == '')) {
            echo '<a href="' . $row10['movie-wurl244'] . '">مشاهدة</a>';
          }
          if (!($row10['movie-durl244'] == '')) {
            echo '<a href="' . $row10['movie-durl244'] . '">تحميل</a>';
          }
          echo '
  </td>
  <td></td>
</tr>
  ';
        }
        ?>
        <?php

        if (!($row10['movie-wurl144'] == '' && $row10['movie-durl144'] == '')) {
          echo '
  <tr>
  <td>' . $rowSeries['VedioQuality'] . '</td>
  <td> SD 144p <i class="fa fa-mobile"></i></td>
  <td>MB ' . $row10['movie-volume144'] . '</td>
  <td>';
          if (!($row10['movie-durl144'] == '')) {
            echo '
    <span> 
    <a href="' . $row10['movie-durl144'] . '">تحميل</a>
  </span>
    ';
          }
          if (!($row10['movie-wurl144'] == '')) {
            echo '
  <span>
  <a href="watch-online.php?Media=' . $rowSeries['SeriesName1'] . '&Qual=Low">مشاهدة</a>
  </span>
</td>
    ';
          }
          echo '
</tr>
<tr class="spare">
  <td colspan="3">
  ';
          if (!($row10['movie-wurl144'] == '')) {
            echo '
            <a href="watch-online.php?Media=' . $rowSeries['SeriesName1'] . '&Qual=Low">مشاهدة</a>
            ';
          }
          if (!($row10['movie-durl144'] == '')) {
            echo '<a href="' . $row10['movie-durl144'] . '">تحميل</a>';
          }
          echo '
  </td>
  <td></td>
</tr>
  ';
        }
        ?>

      </table>
    </div>
    <div class="r5">
      <p class="actors">
        <i class="fa fa-hashtag"></i> طاقم العمل
      </p>
      <div class="actors-container">
        <?php
        $name1 = $rowSeries['actor1'];
        $sqlactor1 = "SELECT * FROM actors WHERE ActorName = '$name1'";
        $result1 = mysqli_query($conn, $sqlactor1);
        $row1 = $result1->fetch_assoc();
        if (isset($rowSeries['actor1']) && !empty($rowSeries['actor1'])) {
          // Generate Main Page
          $mainPage = $row1['ActorName'];
          $generateLink = str_replace(" ", "-", $mainPage);
          echo '
  <div class="actor-box">
  <div class="block"></div>
  <div class="act-info">
    <div class="image">
      <img src="' . $row1['ActorImage'] . '" alt="">
      <p class="act-name"><a href="act-page.php?' . $generateLink . '">' . $rowSeries['actor1'] . '</a></p>
      <p class="role-name">Black Widow</p>
    </div>
  </div>
</div>
  ';
        }

        ?>
        <?php
        $name2 = $rowSeries['actor2'];
        $sqlactor2 = "SELECT * FROM actors WHERE ActorName = '$name2'";
        $result2 = mysqli_query($conn, $sqlactor2);
        $row2 = $result2->fetch_assoc();
        if (isset($rowSeries['actor2']) && !empty($rowSeries['actor2'])) {
          // Generate Main Page
          $mainPage = $row2['ActorName'];
          $generateLink = str_replace(" ", "-", $mainPage);
          echo '
          <div class="actor-box">
          <div class="block"></div>
          <div class="act-info">
            <div class="image">
              <img src="' . $row2['ActorImage'] . '" alt="">
              <p class="act-name"><a href="act-page.php?' . $generateLink . '">' . $rowSeries['actor2'] . '</a></p>
              <p class="role-name">Black Widow</p>
            </div>
          </div>
        </div>
          ';
        }

        ?>
        <?php
        $name3 = $rowSeries['actor3'];
        $sqlactor3 = "SELECT * FROM actors WHERE ActorName = '$name3'";
        $result3 = mysqli_query($conn, $sqlactor3);
        $row3 = $result3->fetch_assoc();
        if (isset($rowSeries['actor3']) && !empty($rowSeries['actor3'])) {
          // Generate Main Page
          $mainPage = $row3['ActorName'];
          $generateLink = str_replace(" ", "-", $mainPage);
          echo '
  <div class="actor-box">
  <div class="block"></div>
  <div class="act-info">
    <div class="image">
      <img src="' . $row3['ActorImage'] . '" alt="">
      <p class="act-name"><a href="act-page.php?' . $generateLink . '">' . $rowSeries['actor3'] . '</a></p>
      <p class="role-name">Black Widow</p>
    </div>
  </div>
</div>
  ';
        }

        ?>
        <?php
        $name4 = $rowSeries['actor4'];
        $sqlactor4 = "SELECT * FROM actors WHERE ActorName = '$name4'";
        $result4 = mysqli_query($conn, $sqlactor4);
        $row4 = $result4->fetch_assoc();
        if (isset($rowSeries['actor4']) && !empty($rowSeries['actor4'])) {
          // Generate Main Page
          $mainPage = $row4['ActorName'];
          $generateLink = str_replace(" ", "-", $mainPage);
          echo '
  <div class="actor-box">
  <div class="block"></div>
  <div class="act-info">
    <div class="image">
      <img src="' . $row4['ActorImage'] . '" alt="">
      <p class="act-name"><a href="act-page.php?' . $generateLink . '">' . $rowSeries['actor4'] . '</a></p>
      <p class="role-name">Black Widow</p>
    </div>
  </div>
</div>
  ';
        }

        ?>
      </div>
    </div>
  </div>
  <script>
    var rate = document.querySelectorAll('.rate li');
    rate[0].onclick = function() {
      if (rate[2].classList.contains('rateactive')) {
        rate[2].classList.remove('rateactive');
        rate[0].classList.toggle('rateactive');
      } else {
        rate[0].classList.toggle('rateactive');
      }
    }
    rate[2].onclick = function() {
      if (rate[0].classList.contains('rateactive')) {
        rate[0].classList.remove('rateactive');
        rate[2].classList.toggle('rateactive');
      } else {
        rate[2].classList.toggle('rateactive');
      }
    }
  </script>

</body>

</html>