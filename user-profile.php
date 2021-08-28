<?php

session_start();

include_once 'bottom-nav.php';

// Connect To DataBase 

require_once 'config.php';

// Fetch Favorites Movies And Series

$UserEmail = $_SESSION['UserEmail'];

$sqlGetFavName = "SELECT MovieOrSeries FROM fav WHERE UserEmail = '$UserEmail'";
$resultGetFavName = mysqli_query($conn, $sqlGetFavName);

// Fetch Watch Later Movies And Series

$sqlGetLaterName = "SELECT MovieOrSeries FROM later WHERE UserEmail = '$UserEmail'";
$resultGetLaterName = mysqli_query($conn, $sqlGetLaterName);

// Series

$sqlGetFavName1 = "SELECT MovieOrSeries FROM fav1 WHERE UserEmail = '$UserEmail'";
$resultGetFavName1 = mysqli_query($conn, $sqlGetFavName1);

// Fetch Watch Later Movies And Series

$sqlGetLaterName1 = "SELECT MovieOrSeries FROM later1 WHERE UserEmail = '$UserEmail'";
$resultGetLaterName1 = mysqli_query($conn, $sqlGetLaterName1);


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> <?php echo $_SESSION['UserName'] ?> مرحبا بعودتك</title>
  <link rel="stylesheet" href="css/splide.min.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/main.css">
  <style>
    body {
      margin-bottom: 100px;
    }

    .container {
      width: 95%;
      margin: auto;
    }

    nav {
      overflow: hidden;
      background: linear-gradient(45deg, #405de6, #5851db, #833ab4, #c13584, #e1306c, #fd1d1d);
      color: #fff;
      padding: 10px 0;
      font-size: 18px;
    }

    .right a {
      color: #fff;
      border: 1px solid #e1306c;
      padding: 2px 8px;
      border-radius: 5px;
      background-color: #e1306c;
      transition: all .3s;
    }

    .right a:hover {
      color: #e1306c;
      background-color: #fff;
    }

    nav .right {
      float: left;
      text-align: left;
      width: 49%;
      padding-left: 1%;
    }

    nav .left {
      float: right;
      text-align: right;
      width: 49%;
      padding-right: 1%;
    }
  </style>
</head>

<body>
  <nav>
    <div class="left">
      <?php echo $_SESSION['UserName'] . ' مرحبا بعودتك يا '; ?>
    </div>
    <div class="right">
      <a href="signout.php">تسجيل الخروج</a>
    </div>
  </nav>
  <section class="r2">
    <div class="main-container">
      <div class="catbox">
        <div class="cat-info">
          <p>المفضلة</p>
          <p><a href="fav.php">عرض المزيد</a></p>
        </div>
        <div class="content">
          <div class="splide" id='cat-slide'>
            <div class="splide__track cat-slide">
              <ul class="splide__list">

                <?php

                while ($rowFavName = $resultGetFavName->fetch_assoc()) {
                  $favName = $rowFavName['MovieOrSeries'];
                  $sqlGetFav = "SELECT * FROM movies WHERE MovieName1 = '$favName'";
                  $resultFav = mysqli_query($conn, $sqlGetFav);
                  while ($rowFavoriteVideo = $resultFav->fetch_assoc()) {
                    $mainPage = $rowFavoriteVideo['MovieName1'];
                    $generateLink = str_replace(" ", "-", $mainPage);
                    echo '
                    <li class="splide__slide movie-cover">
                  <img src="' . $rowFavoriteVideo['MovieCover'] . '" alt="">
                  <div class="overlay">

                  </div>
                  <div class="video-type">
                    ' . $rowFavoriteVideo['VideoQality'] . ' ' . $rowFavoriteVideo['MovieYear'] . ' 
                  </div>
                  <a href="movie-page.php?' . $generateLink . '">

                    <div class="movie-info">
                      <div class="head">
                        <p class="movie-name">';
                    if ($rowFavoriteVideo['MovieLang'] == 'العربية') {
                      echo $rowFavoriteVideo['MovieName2'];
                    } else {
                      echo $rowFavoriteVideo['MovieName1'];
                    }

                    echo
                    '</p>
                        <ul>
                          <li><i class="fa fa-clock-o"></i><br>' . $rowFavoriteVideo['MovieLength'] . ' Min</li>
                          <li><i class="fa fa-imdb"></i><br>' . $rowFavoriteVideo['IMDBRate'] . '</li>
                        </ul>
                        <div class="description">
                          ' . $rowFavoriteVideo['MovieStory'] . '
                        </div>
                      </div>
                    </div>
                  </a>
                </li>
                    ';
                  }
                }
                ?>
                <?php

                while ($rowFavName1 = $resultGetFavName1->fetch_assoc()) {
                  $favName = $rowFavName1['MovieOrSeries'];
                  $sqlGetFav1 = "SELECT * FROM series WHERE SeriesName1 = '$favName'";
                  $resultFav1 = mysqli_query($conn, $sqlGetFav);
                  while ($rowFavoriteVideo1 = $resultFav1->fetch_assoc()) {
                    $mainPage = $rowFavoriteVideo1['SeriesName1'];
                    $generateLink = str_replace(" ", "-", $mainPage);
                    echo '
                    <li class="splide__slide movie-cover">
                  <img src="' . $rowFavoriteVideo1['SeriesCover'] . '" alt="">
                  <div class="overlay">

                  </div>
                  <div class="video-type">
                    ' . $rowFavoriteVideo1['VedioQuality'] . ' ' . $rowFavoriteVideo1['SeriesYear'] . ' 
                  </div>
                  <a href="movie-page.php?' . $generateLink . '">

                    <div class="movie-info">
                      <div class="head">
                        <p class="movie-name">';
                    if ($rowFavoriteVideo1['SeriesLang'] == 'العربية') {
                      echo $rowFavoriteVideo1['SeriesName2'];
                    } else {
                      echo $rowFavoriteVideo1['SeriesName1'];
                    }

                    echo
                    '</p>
                        <ul>
                          <li><i class="fa fa-clock-o"></i><br>' . $rowFavoriteVideo1['SeriesLength'] . ' Min</li>
                          <li><i class="fa fa-imdb"></i><br>' . $rowFavoriteVideo1['IMDBRate'] . '</li>
                        </ul>
                        <div class="description">
                          ' . $rowFavoriteVideo1['SeriesStory'] . '
                        </div>
                      </div>
                    </div>
                  </a>
                </li>
                    ';
                  }
                }
                ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Watch Later -->
  <section class="r2">
    <div class="main-container">
      <div class="catbox">
        <div class="cat-info">
          <p>المشاهدة لاحقا</p>
          <p><a href="later.php">عرض المزيد</a></p>
        </div>
        <div class="content">
          <div class="splide" id='cat-slide1'>
            <div class="splide__track cat-slide">
              <ul class="splide__list">

                <?php

                while ($rowLaterName1 = $resultGetLaterName1->fetch_assoc()) {
                  $LaterName = $rowLaterName1['MovieOrSeries'];
                  $sqlGetLater1 = "SELECT * FROM series WHERE SeriesName1 = '$LaterName'";
                  $resultLater1 = mysqli_query($conn, $sqlGetLater1);
                  while ($rowLaterVideo1 = $resultLater1->fetch_assoc()) {
                    $mainPage = $rowLaterVideo1['SeriesName1'];
                    $generateLink = str_replace(" ", "-", $mainPage);
                    echo '
                    <li class="splide__slide movie-cover">
                  <img src="' . $rowLaterVideo1['SeriesCover'] . '" alt="">
                  <div class="overlay">

                  </div>
                  <div class="video-type">
                    ' . $rowLaterVideo1['VedioQuality'] . ' ' . $rowLaterVideo1['SeriesYear'] . ' 
                  </div>
                  <a href="series-page.php?' . $generateLink . '">

                    <div class="movie-info">
                      <div class="head">
                        <p class="movie-name">';

                    if ($rowLaterVideo1['SeriesLang'] == 'العربية') {
                      echo $rowLaterVideo1['SeriesName2'];
                    } else {
                      echo $rowLaterVideo1['SeriesName1'];
                    }

                    echo
                    '</p>
                        <ul>
                          <li><i class="fa fa-clock-o"></i><br>' . $rowLaterVideo1['SeriesLength'] . ' Min</li>
                          <li><i class="fa fa-imdb"></i><br>' . $rowLaterVideo1['IMDBRate'] . '</li>
                        </ul>
                        <div class="description">
                          ' . $rowLaterVideo1['SeriesStory'] . '
                        </div>
                      </div>
                    </div>
                  </a>
                </li>
                    ';
                  }
                }
                ?>
                <?php

                while ($rowLaterName = $resultGetLaterName->fetch_assoc()) {
                  $LaterName = $rowLaterName['MovieOrSeries'];
                  $sqlGetLater = "SELECT * FROM movies WHERE MovieName1 = '$LaterName'";
                  $resultLater = mysqli_query($conn, $sqlGetLater);
                  while ($rowLaterVideo = $resultLater->fetch_assoc()) {
                    $mainPage = $rowLaterVideo['MovieName1'];
                    $generateLink = str_replace(" ", "-", $mainPage);
                    echo '
                    <li class="splide__slide movie-cover">
                  <img src="' . $rowLaterVideo['MovieCover'] . '" alt="">
                  <div class="overlay">

                  </div>
                  <div class="video-type">
                    ' . $rowLaterVideo['VideoQality'] . ' ' . $rowLaterVideo['MovieYear'] . ' 
                  </div>
                  <a href="movie-page.php?' . $generateLink . '">

                    <div class="movie-info">
                      <div class="head">
                        <p class="movie-name">';

                    if ($rowLaterVideo['MovieLang'] == 'العربية') {
                      echo $rowLaterVideo['MovieName2'];
                    } else {
                      echo $rowLaterVideo['MovieName1'];
                    }

                    echo
                    '</p>
                        <ul>
                          <li><i class="fa fa-clock-o"></i><br>' . $rowLaterVideo['MovieLength'] . ' Min</li>
                          <li><i class="fa fa-imdb"></i><br>' . $rowLaterVideo['IMDBRate'] . '</li>
                        </ul>
                        <div class="description">
                          ' . $rowLaterVideo['MovieStory'] . '
                        </div>
                      </div>
                    </div>
                  </a>
                </li>
                    ';
                  }
                }
                ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="js/splide.min.js"></script>
  <script>
    if (innerWidth >= 280 && innerWidth < 430) {
      new Splide('#cat-slide', {
        type: 'loop',
        perPage: 1,
        focus: 'center',
      }).mount();
      new Splide('#cat-slide1', {
        type: 'loop',
        perPage: 1,
        focus: 'center',
      }).mount();
    }
    if (innerWidth > 430 && innerWidth < 674) {
      new Splide('#cat-slide', {
        type: 'loop',
        perPage: 2,
        focus: 'center',
      }).mount();
      new Splide('#cat-slide1', {
        type: 'loop',
        perPage: 2,
        focus: 'center',
      }).mount();
    }
    if (innerWidth > 675 && innerWidth < 1199) {
      new Splide('#cat-slide', {
        type: 'loop',
        perPage: 3,
        focus: 'center',
      }).mount();
      new Splide('#cat-slide1', {
        type: 'loop',
        perPage: 3,
        focus: 'center',
      }).mount();
    }

    if (innerWidth > 1200 && innerWidth < 1790) {
      new Splide('#cat-slide', {
        type: 'loop',
        perPage: 4,
        focus: 'center',
      }).mount();
      new Splide('#cat-slide1', {
        type: 'loop',
        perPage: 4,
        focus: 'center',
      }).mount();
    }
    if (innerWidth > 1790 && innerWidth < 2000) {
      new Splide('#cat-slide', {
        type: 'loop',
        perPage: 5,
        focus: 'center',
      }).mount();
      new Splide('#cat-slide1', {
        type: 'loop',
        perPage: 5,
        focus: 'center',
      }).mount();
    }
    if (innerWidth > 2000) {
      new Splide('#cat-slide', {
        type: 'loop',
        perPage: 6,
        focus: 'center',
      }).mount();
      new Splide('#cat-slide1', {
        type: 'loop',
        perPage: 6,
        focus: 'center',
      }).mount();
    }

    window.onresize = function() {
      window.location.reload(true)
    }
    var search = document.querySelector('.search');
    search.onclick = function() {
      $('.search-bar').fadeToggle();
      window.scrollTo(0, 0);
    }
  </script>
</body>

</html>