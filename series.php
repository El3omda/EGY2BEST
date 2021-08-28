<?php
include_once 'loader.php';
include_once 'nav.php';
include_once 'bottom-nav.php';
@$year = $_POST['year'];
@$lang = $_POST['lang'];
@$country = $_POST['country'];
@$category = $_POST['category'];
@$videoType = $_POST['quality-type'];
@$quality = $_POST['quality'];


// Start Conect To DB
require_once 'config.php';

$sql = "SELECT * FROM series";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="ar">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>المسلسلات</title>
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/new.css">
  <style>
    form ul li {
      width: calc(100% / 7);
    }

    @media (max-width:600px) {
      form ul li {
        display: inline-block;
        float: none;
        margin-top: 5px;
      }

      form ul li:first-of-type {
        width: 48.6%;
      }

      form ul li:nth-of-type(2) {
        width: 48.6%;
      }

      form ul li:nth-of-type(3) {
        width: 48.6%;
      }

      form ul li:nth-of-type(4) {
        width: 48.6%;
      }

      form ul li:nth-of-type(5) {
        width: 48.6%;
      }

      form ul li:nth-of-type(6) {
        width: 48.6%;
        margin-top: 5px;
      }

      form ul li:nth-of-type(7) {
        width: 48.6%;
        margin-top: 5px;
      }

      form ul li select {
        width: 100%;
      }
    }
  </style>
</head>

<body>
  <div class="fillter">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <ul>
        <li>
          <select name="year">
            <option selected disabled><?php
                                      if (isset($year)) {
                                        echo $year;
                                      } else {
                                        echo 'السنة';
                                      }
                                      ?></option>
            <?php
            for ($i = 2010; $i <= date('Y'); $i++) {
              echo '
                  <option value="' . $i . '">' . $i .  '</option>
                ';
            }
            ?>
          </select>
        </li>
        <li>
          <select name="lang">
            <option selected disabled><?php
                                      if (isset($lang)) {
                                        echo $lang;
                                      } else {
                                        echo 'اللغة';
                                      }
                                      ?></option>
            <option value="عربي">عربي</option>
            <option value="انجليزي">انجليزي</option>
          </select>
        </li>
        <li>
          <select name="country">
            <option selected disabled><?php
                                      if (isset($country)) {
                                        echo $country;
                                      } else {
                                        echo 'البلد';
                                      }
                                      ?></option>
            <option value="مصر">مصر</option>
            <option value="امريكا">امريكا</option>
          </select>
        </li>
        <li>
          <select name="category">
            <option selected disabled><?php
                                      if (isset($category)) {
                                        echo $category;
                                      } else {
                                        echo 'التصنيف';
                                      }
                                      ?></option>
            <option value="اكشن">اكشن</option>
            <option value="رعب">رعب</option>
            <option value="خيال علمي">خيال علمي</option>
          </select>
        </li>
        <li>
          <select name="quality-type">
            <option selected disabled><?php
                                      if (isset($videoType)) {
                                        echo $videoType;
                                      } else {
                                        echo 'الجودة';
                                      }
                                      ?></option>
            <option value="BlueRay">BluRAy</option>
            <option value="WebDL">WEBDL</option>
            <option value="DVDRIP">DVDRip</option>
          </select>
        </li>
        <li>
          <select name="quality">
            <option selected disabled><?php
                                      if (isset($quality)) {
                                        echo $quality;
                                      } else {
                                        echo 'الدقة';
                                      }
                                      ?></option>
            <option value="1080p">1080p</option>
            <option value="720p">720p</option>
            <option value="480p">480p</option>
            <option value="360p">360p</option>
          </select>
        </li>
        <li>
          <input class="btnsearch" type="submit" value="بحث">
        </li>
      </ul>
    </form>
  </div>
  <div class="content-box">
    <?php

    while ($row = $result->fetch_assoc()) {
      // Generate Main Page
      $mainPage = $row['SeriesName1'];
      $generateLink = str_replace(" ", "-", $mainPage);

      echo '
      <div class="box">
        <div class="cover">
          <img src="' . $row['SeriesCover'] . '" alt="">
        </div>
        <p class="name"><a href="' . 'series-page.php?' . $generateLink . '">';
      if ($row['SeriesLang'] == 'العربية') {
        echo $row['SeriesName2'];
      } else {
        echo $row['SeriesName1'];
      }
      echo '
        </a></p>
        <div class="box-info">
          <ul>
            <li><i class="fa fa-imdb"></i>' . $row['IMDBRate'] . '</li>
            <li><i class="fa fa-clock-o"></i>' . $row['SeriesLength'] . ' Min</li>
          </ul>
        </div>
        <div class="video-year">' . $row['VedioQuality'] . '  ' . $row['SeriesYear'] .  ' </div>
      </div>
      ';
    }

    ?>
  </div>
  <script>
    window.onload = function() {
      $('.loader-container').fadeOut(1000);
    }
  </script>
</body>

</html>