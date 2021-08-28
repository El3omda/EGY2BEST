<?php
include_once 'loader.php';
include_once 'nav.php';
include_once 'bottom-nav.php';

// Start Conect To DB
require_once 'config.php';

$seriesname = $_SERVER['QUERY_STRING'];
$filter1Seriesname = str_replace(array('-sesson-1', '-sesson-2', '-sesson-3', '-sesson-4', '-sesson-5', '-sesson-6', '-sesson-7', '-sesson-8', '-sesson-9', '-sesson-10',), "", $seriesname);
$filter2Seriesname = str_replace("-", " ", $filter1Seriesname);


// Get Series Data

$sqlseriesData = "SELECT ID FROM series WHERE SeriesName1 = '$filter2Seriesname'";
$result1 = mysqli_query($conn, $sqlseriesData);
$row1 = $result1->fetch_assoc();
$seriesID = $row1['ID'];

// Get Epsodes
$sql = "SELECT * FROM epsodes WHERE SeriesID = '$seriesID'";
$result = mysqli_query($conn, $sql);


// Get series
$sqlseries = "SELECT * FROM series WHERE SeriesName1 = '$filter2Seriesname'";
$result2 = mysqli_query($conn, $sqlseries);
$row2 = $result2->fetch_assoc();

// Get Sesson
$sqlsesson = "SELECT * FROM epsodes WHERE SeriesID = '$seriesID'";
$result4 = mysqli_query($conn, $sqlsesson);
$row4 = $result4->fetch_assoc();

// echo "<pre>";
// print_r($row4);
// echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>مسلسل <?php echo $filter2Seriesname; ?> الموسم <?php echo $row4['Sesson']; ?></title>
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/movie-page.css">
  <link rel="stylesheet" href="css/series-page.css">
</head>

<body>

  <div class="main-container">
    <div class="r1">
      <p class="name">الموسم <?php echo $row4['Sesson']; ?> <?php echo $filter2Seriesname; ?></p>
    </div>
    <div class="r2">
      <div class="right">
        <!-- <div class="imdb-rate">
          <span>8.2</span>
          <span><i class="fa fa-imdb"></i></span>
        </div> -->
        <div class="cover">
          <img src="<?php echo $row2['SeriesCover']; ?>" alt="">
        </div>
        <!-- <ul class="rate">
          <p style="text-align: center;font-weight:bold;margin-bottom:5px;">قيم الفيلم</p>
          <li><i class="fa fa-thumbs-up"></i></li>
          <li>95 %</li>
          <li><i class="fa fa-thumbs-down"></i></li>
        </ul> -->
      </div>
      <div class="left">
        <div class="story">
          <p class="title"><i class="fa fa-hashtag"></i> القصة</p>
          <p class="story-name"><?php echo $row2['SeriesName2']; ?></p>
          <p class="story-content"><?php echo $row2['SeriesStory']; ?></p>
        </div>
        <div class="movie-info">
          <table>
            <tr>
              <td>السنة</td>
              <td><?php echo $row2['SeriesYear']; ?></td>
            </tr>
            <tr>
              <td>اللغة</td>
              <td><?php echo $row2['SeriesLang']; ?></td>
            </tr>
            <tr>
              <td>البلد</td>
              <td><?php echo $row2['SeriesCountry']; ?></td>
            </tr>
            <tr>
              <td>المدة</td>
              <td><?php echo $row2['SeriesLength']; ?> دقيقة</td>
            </tr>
            <tr>
              <td>الجودة</td>
              <td><?php echo $row2['SeriesQuality']; ?></td>
            </tr>
            <tr>
              <td>الترجمة</td>
              <td><?php echo $row2['SeriesTrans']; ?></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <div class="r3">
      <p class="trailer">
        <i class="fa fa-hashtag"></i> الاعلان الرسمي
      </p>
      <div class="trailer-box">
        <?php
        $ytTrailar = $row2['SeriesTrai'];

        $embeded1 = str_replace("&t=1s", "", $ytTrailar);
        $embeded2 = str_replace("&t=2s", "", $embeded1);
        $embeded = str_replace("watch?v=", "embed/", $embeded2);
        ?>
        <iframe style="height: 100%;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;" src="<?php echo $embeded; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
    </div>
    <div class="r5">
      <p class="actors">
        <i class="fa fa-hashtag"></i> طاقم العمل
      </p>
      <div class="actors-container">
        <?php
        $name1 = $row2['actor1'];
        $sqlactor1 = "SELECT * FROM actors WHERE ActorName = '$name1'";
        $result1 = mysqli_query($conn, $sqlactor1);
        $row1 = $result1->fetch_assoc();
        if (isset($row1['actor1']) && !empty($row2['actor1'])) {
          $mainPage = $row2['ActorName'];
          $generateLink = str_replace(" ", "-", $mainPage);
          echo '
  <div class="actor-box">
  <div class="block"></div>
  <div class="act-info">
    <div class="image">
      <img src="' . $row1['ActorImage'] . '" alt="">
      <p class="act-name"><a href="act-page.php?' . $generateLink . '">' . $row2['actor1'] . '</a></p>
      <p class="role-name">Black Widow</p>
    </div>
  </div>
</div>
  ';
        }

        ?>
        <?php
        $name2 = $row2['actor2'];
        $sqlactor2 = "SELECT * FROM actors WHERE ActorName = '$name2'";
        $result2 = mysqli_query($conn, $sqlactor2);
        $row3 = $result2->fetch_assoc();
        if (isset($row2['actor2']) && !empty($row2['actor2'])) {
          $mainPage = $row3['ActorName'];
          $generateLink = str_replace(" ", "-", $mainPage);
          echo '
  <div class="actor-box">
  <div class="block"></div>
  <div class="act-info">
    <div class="image">
      <img src="' . $row3['ActorImage'] . '" alt="">
      <p class="act-name"><a href="act-page.php?' . $generateLink . '">' . $row2['actor2'] . '</a></p>
      <p class="role-name">Black Widow</p>
    </div>
  </div>
</div>
  ';
        }

        ?>
        <?php
        $name3 = $row2['actor3'];
        $sqlactor3 = "SELECT * FROM actors WHERE ActorName = '$name3'";
        $result3 = mysqli_query($conn, $sqlactor3);
        $row4 = $result3->fetch_assoc();
        if (isset($row2['actor3']) && !empty($row2['actor3'])) {
          $mainPage = $row4['ActorName'];
          $generateLink = str_replace(" ", "-", $mainPage);
          echo '
  <div class="actor-box">
  <div class="block"></div>
  <div class="act-info">
    <div class="image">
      <img src="' . $row4['ActorImage'] . '" alt="">
      <p class="act-name"><a href="act-page.php?' . $generateLink . '">' . $row2['actor3'] . '</a></p>
      <p class="role-name">Black Widow</p>
    </div>
  </div>
</div>
  ';
        }
        ?>
        <?php
        $name4 = $row2['actor4'];
        $sqlactor4 = "SELECT * FROM actors WHERE ActorName = '$name4'";
        $result4 = mysqli_query($conn, $sqlactor4);
        $row5 = $result4->fetch_assoc();
        if (isset($row2['actor4']) && !empty($row2['actor4'])) {
          $mainPage = $row5['ActorName'];
          $generateLink = str_replace(" ", "-", $mainPage);
          echo '
  <div class="actor-box">
  <div class="block"></div>
  <div class="act-info">
    <div class="image">
      <img src="' . $row5['ActorImage'] . '" alt="">
      <p class="act-name"><a href="act-page.php?' . $generateLink . '">' . $row2['actor4'] . '</a></p>
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
  <div class="r4">
    <p class="take-action">
      <i class="fa fa-hashtag"></i> جميع حلقات الموسم
    </p>
    <div class="content">
      <?php
      while ($row = $result->fetch_assoc()) {
        echo '
            <a href="epsode-page.php?' . $row['EpsodeID'] . '">
              <div class="box">
                <img src="' . $row2['SeriesCover'] . '" alt="">
                <p class="sesson">الحلقة ' . $row['EpsodeNum'] . '</p>
              </div>
            </a>
          ';
      }
      ?>
    </div>
  </div>
  <script src="js/splide.min.js"></script>
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
  <script>
    window.onload = function() {
      $('.loader-container').fadeOut(1000);
    }
  </script>
</body>

</html>