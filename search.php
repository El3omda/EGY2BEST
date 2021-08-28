<?php
include_once 'nav.php';
@$year = $_POST['year'];
@$lang = $_POST['lang'];
@$country = $_POST['country'];
@$category = $_POST['category'];
@$videoType = $_POST['quality-type'];
@$quality = $_POST['quality'];

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';

$explode = explode("-", $_SERVER['QUERY_STRING']);

// echo '<pre>';
// print_r($explode);
// echo '</pre>';

// Connect To Data Base

require_once 'config.php';

// Get Categores Names

$sqlGetCatName = "SELECT * FROM cats";
$resultCatName = mysqli_query($conn, $sqlGetCatName);


// Get Languages Names

$sqlGetLangName = "SELECT * FROM langs";
$resultLangName = mysqli_query($conn, $sqlGetLangName);


// Get By Categorie

$querystringCat = @$explode[3];
$querystringCatFinal = str_replace("Cat=", "", $querystringCat);

$sqlCat = "SELECT * FROM movies WHERE CatName = '$querystringCatFinal'";
$resultCat = mysqli_query($conn, $sqlCat);

$sqlCat2 = "SELECT * FROM series WHERE CatName = '$querystringCatFinal'";
$resultCat2 = mysqli_query($conn, $sqlCat2);

// Get By Lang

$querystringLang = @$explode[1];
$querystringLangFinal = str_replace("Lang=", "", $querystringLang);

if ($querystringLangFinal == 'ar') {
  $querystringLangFinal = 'العربية';
} elseif ($querystringLangFinal == 'en') {
  $querystringLangFinal = 'الانجليزية';
} elseif ($querystringLangFinal == 'fr') {
  $querystringLangFinal = 'الفرنسية';
} elseif ($querystringLangFinal == 'sp') {
  $querystringLangFinal = 'الاسبانية';
}

$sqlLang = "SELECT * FROM movies WHERE MovieLang = '$querystringLangFinal'";
$resultLang = mysqli_query($conn, $sqlLang);

$sqlLang2 = "SELECT * FROM series WHERE SeriesLang = '$querystringLangFinal'";
$resultLang2 = mysqli_query($conn, $sqlLang2);

$rowLang = $resultLang->fetch_assoc();


// Get By Year

$querystringYear = @$explode[0];
$querystringYearFinal = str_replace("Year=", "", $querystringYear);

$sqlYear = "SELECT * FROM movies WHERE MovieYear = '$querystringYearFinal'";
$resultYear = mysqli_query($conn, $sqlYear);

$sqlYear2 = "SELECT * FROM series WHERE SeriesYear = '$querystringYearFinal'";
$resultYear2 = mysqli_query($conn, $sqlYear2);


// Get By Country

$querystringCountry = @$explode[2];
$querystringCountryFinal = str_replace("Country=", "", $querystringCountry);
if ($querystringCountryFinal == "Eg") {
  $querystringCountryFinal = 'مصر';
} elseif ($querystringCountryFinal == "Usa") {
  $querystringCountryFinal = 'امريكا';
}


$sqlCountry = "SELECT * FROM movies WHERE MovieCountry = '$querystringCountryFinal'";
$resultCountry = mysqli_query($conn, $sqlCountry);

$sqlCountry1 = "SELECT * FROM series WHERE SeriesCountry = '$querystringCountryFinal'";
$resultCountry1 = mysqli_query($conn, $sqlCountry1);



// Get By Video Type

$querystringVT = @$explode[4];
$querystringVTFinal = str_replace("VideoType=", "", $querystringVT);
$sqlVT = "SELECT * FROM movies WHERE VideoQality = '$querystringVTFinal'";
$resultVT = mysqli_query($conn, $sqlVT);
$sqlVT1 = "SELECT * FROM series WHERE VedioQuality = '$querystringVTFinal'";
$resultVT1 = mysqli_query($conn, $sqlVT1);

// Get Category If IS Set

if (isset($category)) {
  header("Location:search.php?Year=$year-Lang=$lang-Country=$country-Cat=$category-VideoType=$videoType");
}

// Get Lang If IS Set

if (isset($lang)) {
  header("Location:search.php?Year=$year-Lang=$lang-Country=$country-Cat=$category-VideoType=$videoType");
}

// Get Year If IS Set

if (isset($year)) {
  header("Location:search.php?Year=$year-Lang=$lang-Country=$country-Cat=$category-VideoType=$videoType");
}
// Get Country If IS Set

if (isset($country)) {
  header("Location:search.php?Year=$year-Lang=$lang-Country=$country-Cat=$category-VideoType=$videoType");
}

// Get Country If IS Set

if (isset($videoType)) {
  header("Location:search.php?Year=$year-Lang=$lang-Country=$country-Cat=$category-VideoType=$videoType");
}

// $cond1 = "MovieYear = " . $querystringYearFinal;
// echo $cond1;
// $sqlGetSpacific = "SELECT * FROM Movies WHERE $cond1";
// $resultSpacific = mysqli_query($conn, $sqlGetSpacific);
// $rowSpacific = $resultSpacific->fetch_assoc();



?>
<!DOCTYPE html>
<html lang="ar">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> البحث <?php echo @$_POST['search']; ?> </title>
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
  <?php include_once 'bottom-nav.php'; ?>

  <div class="fillter">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <ul>
        <li>
          <select id="Year" name="year">
            <option selected disabled>
              <?php

              if (empty($querystringYearFinal)) {
                echo 'السنة';
              } else {
                echo $querystringYearFinal;
              }

              ?>
            </option>
            <?php
            for ($i = date('Y'); $i >= 1800; $i--) {
              echo '
                  <option value="' . $i . '">' . $i .  '</option>
                ';
            }
            ?>

          </select>
        </li>
        <li>
          <select name="lang">

            <?php

            echo '<option selected disabled>';
            if ($querystringLangFinal == 'العربية') {
              echo 'العربية';
            } elseif ($querystringLangFinal == 'الانجليزية') {
              echo 'الانجليزية';
            } elseif ($querystringLangFinal == 'الفرنسية') {
              echo  'الفرنسية';
            } elseif ($querystringLangFinal == 'الاسبانية') {
              echo 'الاسبانية';
            } else {
              echo 'اللغة';
            }
            while ($rowLangName = $resultLangName->fetch_assoc()) {
              echo '
                  <option value="' . $rowLangName['Lang1'] . '">' . $rowLangName['Lang'] . '</option>
                ';
            }

            ?>

          </select>
        </li>
        <li>
          <select id="Country1" name="country">
            <option id="Country" selected disabled>
              <?php

              if (empty($querystringCountryFinal)) {
                echo 'الدولة';
              } else {
                echo $querystringCountryFinal;
              }

              ?>
            </option>
            <option value="Eg">مصر</option>
            <option value="Usa">امريكا</option>
          </select>
        </li>
        <li>
          <select name="category">
            <?php
            $sqlGetArabicNameCat = "SELECT CatName FROM cats WHERE CatName2 = '$querystringCatFinal'";
            $resultGetArabicNameCat = mysqli_query($conn, $sqlGetArabicNameCat);
            $rowGetArabicNameCat = $resultGetArabicNameCat->fetch_assoc();
            echo '<option selected disabled>';
            if ($rowGetArabicNameCat['CatName'] == '') {
              echo 'التصنيف';
            } else {
              echo $rowGetArabicNameCat['CatName'];
            }
            echo
            '</option>';
            while ($rowCatName = $resultCatName->fetch_assoc()) {
              echo '
                    <option value="' . $rowCatName['CatName2'] . '">' . $rowCatName['CatName'] . '</option>
                  ';
            }

            ?>
          </select>
        </li>
        <li>
          <select id="VT1" name="quality-type">
            <option selected disabled id="VT">
              <?php

              if (empty($querystringVTFinal)) {
                echo 'الجودة';
              } else {
                echo $querystringVTFinal;
              }

              ?>
            </option>
            <option value="BlueRay">BlueRay</option>
            <option value="WEB-DL">WEB-DL</option>
            <option value="dvdrip">DVDRip</option>
            <option value="DVDRip">DVDScr</option>
            <option value="HDCAm">HDCAm</option>
            <option value="HDRip">HDRip</option>
            <option value="HDTC">HDTC</option>
            <option value="HDTS">HDTS</option>
            <option value="HDTV">HDTV</option>
            <option value="TIVRip">TIVRip</option>
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

    // Category
    while ($rowCat = $resultCat->fetch_assoc()) {
      // Generate Main Page
      $mainPage = $rowCat['MovieName1'];
      $generateLink = str_replace(" ", "-", $mainPage);

      echo '
      <div class="box">
        <div class="cover">
          <img src="' . $rowCat['MovieCover'] . '" alt="">
        </div>
        <p class="name"><a href="' . 'movie-page.php?' . $generateLink . '">';
      if ($rowCat['MovieLang'] == 'العربية') {
        echo $rowCat['MovieName2'];
      } else {
        echo $rowCat['MovieName1'];
      }
      echo '
        </a></p>
        <div class="box-info">
          <ul>
            <li><i class="fa fa-imdb"></i>' . $rowCat['IMDBRate'] . '</li>
            <li><i class="fa fa-clock-o"></i>' . $rowCat['MovieLength'] . ' Min</li>
          </ul>
        </div>
        <div class="video-year">' . $rowCat['VideoQality'] . '  ' . $rowCat['MovieYear'] .  ' </div>
      </div>
      ';
    }

    // Languages
    while ($rowLang = $resultLang->fetch_assoc()) {
      // Generate Main Page
      $mainPage = $rowLang['MovieName1'];
      $generateLink = str_replace(" ", "-", $mainPage);

      echo '
      <div class="box">
        <div class="cover">
          <img src="' . $rowLang['MovieCover'] . '" alt="">
        </div>
        <p class="name"><a href="' . 'movie-page.php?' . $generateLink . '">';
      if ($rowLang['MovieLang'] == 'العربية') {
        echo $rowLang['MovieName2'];
      } else {
        echo $rowLang['MovieName1'];
      }
      echo '
        </a></p>
        <div class="box-info">
          <ul>
            <li><i class="fa fa-imdb"></i>' . $rowLang['IMDBRate'] . '</li>
            <li><i class="fa fa-clock-o"></i>' . $rowLang['MovieLength'] . ' Min</li>
          </ul>
        </div>
        <div class="video-year">' . $rowLang['VideoQality'] . '  ' . $rowLang['MovieYear'] .  ' </div>
      </div>
      ';
    }
    // Year
    while ($rowYear = $resultYear->fetch_assoc()) {
      // Generate Main Page
      $mainPage = $rowYear['MovieName1'];
      $generateLink = str_replace(" ", "-", $mainPage);

      echo '
      <div class="box">
        <div class="cover">
          <img src="' . $rowYear['MovieCover'] . '" alt="">
        </div>
        <p class="name"><a href="' . 'movie-page.php?' . $generateLink . '">';
      if ($rowYear['MovieLang'] == 'العربية') {
        echo $rowYear['MovieName2'];
      } else {
        echo $rowYear['MovieName1'];
      }
      echo '
        </a></p>
        <div class="box-info">
          <ul>
            <li><i class="fa fa-imdb"></i>' . $rowYear['IMDBRate'] . '</li>
            <li><i class="fa fa-clock-o"></i>' . $rowYear['MovieLength'] . ' Min</li>
          </ul>
        </div>
        <div class="video-year">' . $rowYear['VideoQality'] . '  ' . $rowYear['MovieYear'] .  ' </div>
      </div>
      ';
    }

    // Country
    while ($rowCountry = $resultCountry->fetch_assoc()) {
      // Generate Main Page
      $mainPage = $rowCountry['MovieName1'];
      $generateLink = str_replace(" ", "-", $mainPage);

      echo '
      <div class="box">
        <div class="cover">
          <img src="' . $rowCountry['MovieCover'] . '" alt="">
        </div>
        <p class="name"><a href="' . 'movie-page.php?' . $generateLink . '">';
      if ($rowCountry['MovieLang'] == 'العربية') {
        echo $rowCountry['MovieName2'];
      } else {
        echo $rowCountry['MovieName1'];
      }
      echo '
        </a></p>
        <div class="box-info">
          <ul>
            <li><i class="fa fa-imdb"></i>' . $rowCountry['IMDBRate'] . '</li>
            <li><i class="fa fa-clock-o"></i>' . $rowCountry['MovieLength'] . ' Min</li>
          </ul>
        </div>
        <div class="video-year">' . $rowCountry['VideoQality'] . '  ' . $rowCountry['MovieYear'] .  ' </div>
      </div>
      ';
    }

    // Video Quality
    while ($rowVT = $resultVT->fetch_assoc()) {
      // Generate Main Page
      $mainPage = $rowVT['MovieName1'];
      $generateLink = str_replace(" ", "-", $mainPage);

      echo '
      <div class="box">
        <div class="cover">
          <img src="' . $rowVT['MovieCover'] . '" alt="">
        </div>
        <p class="name"><a href="' . 'movie-page.php?' . $generateLink . '">';
      if ($rowVT['MovieLang'] == 'العربية') {
        echo $rowVT['MovieName2'];
      } else {
        echo $rowVT['MovieName1'];
      }
      echo '
        </a></p>
        <div class="box-info">
          <ul>
            <li><i class="fa fa-imdb"></i>' . $rowVT['IMDBRate'] . '</li>
            <li><i class="fa fa-clock-o"></i>' . $rowVT['MovieLength'] . ' Min</li>
          </ul>
        </div>
        <div class="video-year">' . $rowVT['VideoQality'] . '  ' . $rowVT['MovieYear'] .  ' </div>
      </div>
      ';
    }

    // Country
    while ($rowCountry = $resultCountry->fetch_assoc()) {
      // Generate Main Page
      $mainPage = $rowCountry['MovieName1'];
      $generateLink = str_replace(" ", "-", $mainPage);

      echo '
      <div class="box">
        <div class="cover">
          <img src="' . $rowCountry['MovieCover'] . '" alt="">
        </div>
        <p class="name"><a href="' . 'movie-page.php?' . $generateLink . '">';
      if ($rowCountry['MovieLang'] == 'العربية') {
        echo $rowCountry['MovieName2'];
      } else {
        echo $rowCountry['MovieName1'];
      }
      echo '
        </a></p>
        <div class="box-info">
          <ul>
            <li><i class="fa fa-imdb"></i>' . $rowCountry['IMDBRate'] . '</li>
            <li><i class="fa fa-clock-o"></i>' . $rowCountry['MovieLength'] . ' Min</li>
          </ul>
        </div>
        <div class="video-year">' . $rowCountry['VideoQality'] . '  ' . $rowCountry['MovieYear'] .  ' </div>
      </div>
      ';
    }

    ?>
    <?php

    // Category

    while ($rowCat2 = $resultCat2->fetch_assoc()) {

      // Generate Main Page
      $mainPage = $rowCat2['SeriesName1'];
      $generateLink = str_replace(" ", "-", $mainPage);

      echo '
  <div class="box">
    <div class="cover">
      <img src="' . $rowCat2['SeriesCover'] . '" alt="">
    </div>
    <p class="name"><a href="' . 'series-page.php?' . $generateLink . '">';
      if ($rowCat2['SeriesLang'] == 'العربية') {
        echo $rowCat2['SeriesName2'];
      } else {
        echo $rowCat2['SeriesName1'];
      }
      echo '
    </a></p>
    <div class="box-info">
      <ul>
        <li><i class="fa fa-imdb"></i>' . $rowCat2['IMDBRate'] . '</li>
        <li><i class="fa fa-clock-o"></i>' . $rowCat2['SeriesLength'] . ' Min</li>
      </ul>
    </div>
    <div class="video-year">' . $rowCat2['VedioQuality'] . '  ' . $rowCat2['SeriesYear'] .  ' </div>
  </div>
  ';
    }

    // Languages

    while ($rowLang2 = $resultLang2->fetch_assoc()) {

      // Generate Main Page
      $mainPage = $rowLang2['SeriesName1'];
      $generateLink = str_replace(" ", "-", $mainPage);

      echo '
  <div class="box">
    <div class="cover">
      <img src="' . $rowLang2['SeriesCover'] . '" alt="">
    </div>
    <p class="name"><a href="' . 'series-page.php?' . $generateLink . '">';
      if ($rowLang2['SeriesLang'] == 'العربية') {
        echo $rowLang2['SeriesName2'];
      } else {
        echo $rowLang2['SeriesName1'];
      }
      echo '
    </a></p>
    <div class="box-info">
      <ul>
        <li><i class="fa fa-imdb"></i>' . $rowLang2['IMDBRate'] . '</li>
        <li><i class="fa fa-clock-o"></i>' . $rowLang2['SeriesLength'] . ' Min</li>
      </ul>
    </div>
    <div class="video-year">' . $rowLang2['VedioQuality'] . '  ' . $rowLang2['SeriesYear'] .  ' </div>
  </div>
  ';
    }

    // Year

    while ($rowYear2 = $resultYear2->fetch_assoc()) {

      // Generate Main Page
      $mainPage = $rowYear2['SeriesName1'];
      $generateLink = str_replace(" ", "-", $mainPage);

      echo '
  <div class="box">
    <div class="cover">
      <img src="' . $rowYear2['SeriesCover'] . '" alt="">
    </div>
    <p class="name"><a href="' . 'series-page.php?' . $generateLink . '">';
      if ($rowYear2['SeriesLang'] == 'العربية') {
        echo $rowYear2['SeriesName2'];
      } else {
        echo $rowYear2['SeriesName1'];
      }
      echo '
    </a></p>
    <div class="box-info">
      <ul>
        <li><i class="fa fa-imdb"></i>' . $rowYear2['IMDBRate'] . '</li>
        <li><i class="fa fa-clock-o"></i>' . $rowYear2['SeriesLength'] . ' Min</li>
      </ul>
    </div>
    <div class="video-year">' . $rowYear2['VedioQuality'] . '  ' . $rowYear2['SeriesYear'] .  ' </div>
  </div>
  ';
    }

    // Year

    while ($rowCountry1 = $resultCountry1->fetch_assoc()) {

      // Generate Main Page
      $mainPage = $rowCountry1['SeriesName1'];
      $generateLink = str_replace(" ", "-", $mainPage);

      echo '
  <div class="box">
    <div class="cover">
      <img src="' . $rowCountry1['SeriesCover'] . '" alt="">
    </div>
    <p class="name"><a href="' . 'series-page.php?' . $generateLink . '">';
      if ($rowCountry1['SeriesLang'] == 'العربية') {
        echo $rowCountry1['SeriesName2'];
      } else {
        echo $rowCountry1['SeriesName1'];
      }
      echo '
    </a></p>
    <div class="box-info">
      <ul>
        <li><i class="fa fa-imdb"></i>' . $rowCountry1['IMDBRate'] . '</li>
        <li><i class="fa fa-clock-o"></i>' . $rowCountry1['SeriesLength'] . ' Min</li>
      </ul>
    </div>
    <div class="video-year">' . $rowCountry1['VedioQuality'] . '  ' . $rowCountry1['SeriesYear'] .  ' </div>
  </div>
  ';
    }

    // Video Quality

    while ($rowVT1 = $resultVT1->fetch_assoc()) {

      // Generate Main Page
      $mainPage = $rowVT1['SeriesName1'];
      $generateLink = str_replace(" ", "-", $mainPage);

      echo '
  <div class="box">
    <div class="cover">
      <img src="' . $rowVT1['SeriesCover'] . '" alt="">
    </div>
    <p class="name"><a href="' . 'series-page.php?' . $generateLink . '">';
      if ($rowVT1['SeriesLang'] == 'العربية') {
        echo $rowVT1['SeriesName2'];
      } else {
        echo $rowVT1['SeriesName1'];
      }
      echo '
    </a></p>
    <div class="box-info">
      <ul>
        <li><i class="fa fa-imdb"></i>' . $rowVT1['IMDBRate'] . '</li>
        <li><i class="fa fa-clock-o"></i>' . $rowVT1['SeriesLength'] . ' Min</li>
      </ul>
    </div>
    <div class="video-year">' . $rowVT1['VedioQuality'] . '  ' . $rowVT1['SeriesYear'] .  ' </div>
  </div>
  ';
    }

    ?>
  </div>
  </div>

</body>

</html>