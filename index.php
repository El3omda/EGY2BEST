<?php
include_once 'loader.php';
include_once 'nav.php';
// Start Connect to DB

require_once 'config.php';



// Just Added

$sqlMoviesLastId = "SELECT MovieID  FROM movies ORDER BY MovieID";
$resultMoviesLastId = mysqli_query($conn, $sqlMoviesLastId);

while ($rowMoviesLastId = $resultMoviesLastId->fetch_assoc()) {
  $moviesLastId = $rowMoviesLastId['MovieID'];
}
$moviesLastMins10 = $moviesLastId - 10;


$sqlMainContent = "SELECT * FROM movies WHERE movies.MovieID BETWEEN $moviesLastMins10 AND $moviesLastId";
$resultMainContent = mysqli_query($conn, $sqlMainContent);

$sqlSeriesLastId = "SELECT ID  FROM series ORDER BY ID";
$resultSeriesLastId = mysqli_query($conn, $sqlSeriesLastId);

while ($rowSeriesLastId = $resultSeriesLastId->fetch_assoc()) {
  $seriesLastId = $rowSeriesLastId['ID'];
}
$seriesLastMins10 = $seriesLastId - 10;
$sqlMainContent1 = "SELECT * FROM series WHERE series.ID BETWEEN $seriesLastMins10 AND $seriesLastId";
$resultMainContent1 = mysqli_query($conn, $sqlMainContent1);

// Get Plays

$sqlGetPlays = "SELECT * FROM movies WHERE AddType = 'مسرحية' LIMIT 10";
$resultGetPlays = mysqli_query($conn, $sqlGetPlays);

// Get Series

$sqlGetSeries = "SELECT * FROM series LIMIT 10";
$resultGetSeries = mysqli_query($conn, $sqlGetSeries);


// Get Arabic Movies

$sqlGetArabMovies = "SELECT * FROM movies WHERE AddType = 'فيلم' AND MovieLang = 'العربية' LIMIT 10";
$resultGetArabMovies = mysqli_query($conn, $sqlGetArabMovies);

// Get Animation Movies

$sqlGetAnimationMovies = "SELECT * FROM movies WHERE AddType = 'فيلم' AND CatName = 'animation' LIMIT 10";
$resultGetAnimationMovies = mysqli_query($conn, $sqlGetAnimationMovies);
?>
<!DOCTYPE html>
<html lang="en">

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>EGY2BEST تحميل و مشاهدة اجدد الافلام</title>
<link rel="stylesheet" href="css/splide.min.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/main.css">

<body>
  <?php include_once 'bottom-nav.php'; ?>
  <section class="r1">
    <div class="splide" id="splide">
      <div class="splide__slider">
        <div class="splide__track">
          <ul class="splide__list">

            <?php

            while ($rowMainContent1 = $resultMainContent1->fetch_assoc()) {
              // Generate Main Page
              $mainPage = $rowMainContent1['SeriesName1'];
              $generateLink = str_replace(" ", "-", $mainPage);
              echo '
              <li class="splide__slide movie-cover">
                <img src="' . $rowMainContent1['SeriesCover'] . '" alt="">
                <div class="overlay">
                </div>
                <div class="video-type">
                  ' . $rowMainContent1['VedioQuality'] . ' ' . $rowMainContent1['SeriesYear'] . '
                </div>
                <a href="series-page.php?' . $generateLink . '">

                <div class="movie-info">
                  <div class="head">
                    <p class="movie-name">';
              if ($rowMainContent1['SeriesLang'] == 'العربية') {
                echo $rowMainContent1['SeriesName2'];
              } else {
                echo $rowMainContent1['SeriesName1'];
              }
              echo
              '</p>
                    <ul>
                      <li><i class="fa fa-clock-o"></i><br>' . $rowMainContent1['SeriesLength'] . ' Min</li>
                      <li><i class="fa fa-imdb"></i><br>' . $rowMainContent1['IMDBRate'] . '</li>
                    </ul>
                    <div class="description">
                      ' . $rowMainContent1['SeriesStory'] . '
                    </div>
                  </div>
                </div>
              </a>
              </li>
              ';
            }
            ?>

            <?php

            while ($rowMainContent = $resultMainContent->fetch_assoc()) {
              $mainPage = $rowMainContent['MovieName1'];
              $generateLink = str_replace(" ", "-", $mainPage);
              echo '
              <li class="splide__slide movie-cover">
                <img src="' . $rowMainContent['MovieCover'] . '" alt="">
                <div class="overlay">
                </div>
                <div class="video-type">
                  ' . $rowMainContent['VideoQality'] . ' ' . $rowMainContent['MovieYear'] . '
                </div>
                <a href="movie-page.php?' . $generateLink . '">

                <div class="movie-info">
                  <div class="head">
                    <p class="movie-name">';

              if ($rowMainContent['MovieLang'] == 'العربية') {
                echo $rowMainContent['MovieName2'];
              } else {
                echo $rowMainContent['MovieName1'];
              }
              echo
              '</p>
                    <ul>
                      <li><i class="fa fa-clock-o"></i><br>' . $rowMainContent['MovieLength'] . ' Min</li>
                      <li><i class="fa fa-imdb"></i><br>' . $rowMainContent['IMDBRate'] . '</li>
                    </ul>
                    <div class="description">
                      ' . $rowMainContent['MovieStory'] . '
                    </div>
                  </div>
                </div>
              </a>
              </li>
              ';
            }
            ?>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <section class="r2">
    <div class="main-container">
      <div class="catbox">
        <div class="cat-info">
          <p>مسرحيات</p>
          <p><a href="plays.php">عرض المزيد</a></p>
        </div>
        <div class="content">
          <div class="splide" id='cat-slide'>
            <div class="splide__track cat-slide">
              <ul class="splide__list">

                <?php

                while ($rowGetPlays = $resultGetPlays->fetch_assoc()) {
                  $mainPage = $rowGetPlays['MovieName1'];
                  $generateLink = str_replace(" ", "-", $mainPage);
                  echo '
                <li class="splide__slide movie-cover">
                  <img src="' . $rowGetPlays['MovieCover'] . '" alt="">
                  <div class="overlay">

                  </div>
                  <div class="video-type">
                    ' . $rowGetPlays['VideoQality'] . ' ' . $rowGetPlays['MovieYear'] . '
                  </div>
                  <a href="movie-page.php?' . $generateLink . '">

                    <div class="movie-info">
                      <div class="head">
                        <p class="movie-name">' . $rowGetPlays['MovieName2'] . '</p>
                        <ul>
                          <li><i class="fa fa-clock-o"></i><br>' . $rowGetPlays['MovieLength'] . ' Min</li>
                          <li><i class="fa fa-imdb"></i><br>' . $rowGetPlays['IMDBRate'] . '</li>
                        </ul>
                        <div class="description">
                          ' . $rowGetPlays['MovieStory'] . '
                        </div>
                      </div>
                    </div>
                  </a>
                </li>
                ';
                }

                ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="r2">
    <div class="main-container">
      <div class="catbox">
        <div class="cat-info">
          <p>مسلسلات</p>
          <p><a href="series.php">عرض المزيد</a></p>
        </div>
        <div class="content">
          <div class="splide" id='cat-slide1'>
            <div class="splide__track cat-slide">
              <ul class="splide__list">
                <?php

                while ($rowGetSeries = $resultGetSeries->fetch_assoc()) {
                  // Generate Main Page
                  $mainPage = $rowGetSeries['SeriesName1'];
                  $generateLink = str_replace(" ", "-", $mainPage);
                  echo '
                  <li class="splide__slide movie-cover">
                    <img src="' . $rowGetSeries['SeriesCover'] . '" alt="">
                    <div class="overlay">
                    </div>
                    <div class="video-type">
                      ' . $rowGetSeries['VedioQuality'] . ' ' . $rowGetSeries['SeriesYear'] . '
                    </div>
                    <a href="series-page.php?' . $generateLink . '">
    
                    <div class="movie-info">
                      <div class="head">
                        <p class="movie-name">';
                  if ($rowGetSeries['SeriesLang'] == 'العربية') {
                    echo $rowGetSeries['SeriesName2'];
                  } else {
                    echo $rowGetSeries['SeriesName1'];
                  }
                  echo
                  '</p>
                        <ul>
                          <li><i class="fa fa-clock-o"></i><br>' . $rowGetSeries['SeriesLength'] . ' Min</li>
                          <li><i class="fa fa-imdb"></i><br>' . $rowGetSeries['IMDBRate'] . '</li>
                        </ul>
                        <div class="description">
                          ' . $rowGetSeries['SeriesStory'] . '
                        </div>
                      </div>
                    </div>
                  </a>
                  </li>
                  ';
                }

                ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="r2">
    <div class="main-container">
      <div class="catbox">
        <div class="cat-info">
          <p>افلام عربي</p>
          <p><a href="movies.php">عرض المزيد</a></p>
        </div>
        <div class="content">
          <div class="splide" id='cat-slide2'>
            <div class="splide__track cat-slide">
              <ul class="splide__list">
                <?php

                while ($rowGetArabMovies = $resultGetArabMovies->fetch_assoc()) {
                  $mainPage = $rowGetArabMovies['MovieName1'];
                  $generateLink = str_replace(" ", "-", $mainPage);
                  echo '
  <li class="splide__slide movie-cover">
    <img src="' . $rowGetArabMovies['MovieCover'] . '" alt="">
    <div class="overlay">
    </div>
    <div class="video-type">
      ' . $rowGetArabMovies['VideoQality'] . ' ' . $rowGetArabMovies['MovieYear'] . '
    </div>
    <a href="movie-page.php?' . $generateLink . '">

    <div class="movie-info">
      <div class="head">
        <p class="movie-name">';

                  if ($rowGetArabMovies['MovieLang'] == 'العربية') {
                    echo $rowGetArabMovies['MovieName2'];
                  } else {
                    echo $rowGetArabMovies['MovieName1'];
                  }
                  echo
                  '</p>
        <ul>
          <li><i class="fa fa-clock-o"></i><br>' . $rowGetArabMovies['MovieLength'] . ' Min</li>
          <li><i class="fa fa-imdb"></i><br>' . $rowGetArabMovies['IMDBRate'] . '</li>
        </ul>
        <div class="description">
          ' . $rowGetArabMovies['MovieStory'] . '
        </div>
      </div>
    </div>
  </a>
  </li>
  ';
                }
                ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="r2">
    <div class="main-container">
      <div class="catbox">
        <div class="cat-info">
          <p>افلام انيميشن</p>
          <p><a href="animations.php">عرض المزيد</a></p>
        </div>
        <div class="content">
          <div class="splide" id='cat-slide3'>
            <div class="splide__track cat-slide">
              <ul class="splide__list">
                <?php

                while ($rowGetAnimationMovies = $resultGetAnimationMovies->fetch_assoc()) {
                  $mainPage = $rowGetAnimationMovies['MovieName1'];
                  $generateLink = str_replace(" ", "-", $mainPage);
                  echo '
  <li class="splide__slide movie-cover">
    <img src="' . $rowGetAnimationMovies['MovieCover'] . '" alt="">
    <div class="overlay">
    </div>
    <div class="video-type">
      ' . $rowGetAnimationMovies['VideoQality'] . ' ' . $rowGetAnimationMovies['MovieYear'] . '
    </div>
    <a href="movie-page.php?' . $generateLink . '">

    <div class="movie-info">
      <div class="head">
        <p class="movie-name">';

                  if ($rowGetAnimationMovies['MovieLang'] == 'العربية') {
                    echo $rowGetAnimationMovies['MovieName2'];
                  } else {
                    echo $rowGetAnimationMovies['MovieName1'];
                  }
                  echo
                  '</p>
        <ul>
          <li><i class="fa fa-clock-o"></i><br>' . $rowGetAnimationMovies['MovieLength'] . ' Min</li>
          <li><i class="fa fa-imdb"></i><br>' . $rowGetAnimationMovies['IMDBRate'] . '</li>
        </ul>
        <div class="description">
          ' . $rowGetAnimationMovies['MovieStory'] . '
        </div>
      </div>
    </div>
  </a>
  </li>
  ';
                }
                ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="r3">
    <footer>
      <div class="main-container">
        <p class="logo">
        <div class="anim-logo logo">
          EGY2BEST
        </div>
        </p>
        <p class="copy">
          جميع الحقوق محفوظة <?php echo date('Y'); ?>
        </p>
      </div>
    </footer>
  </section>
  <script src="js/splide.min.js"></script>
  <script>
    if (innerWidth >= 280 && innerWidth < 430) {
      new Splide('#splide', {
        type: 'loop',
        perPage: 1,
        focus: 'center',
        autoplay: true
      }).mount();
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
      new Splide('#cat-slide2', {
        type: 'loop',
        perPage: 1,
        focus: 'center',
      }).mount();
      new Splide('#cat-slide3', {
        type: 'loop',
        perPage: 1,
        focus: 'center',
      }).mount();
    }
    if (innerWidth > 430 && innerWidth < 674) {
      new Splide('#splide', {
        type: 'loop',
        perPage: 2,
        focus: 'center',
        autoplay: true
      }).mount();
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
      new Splide('#cat-slide2', {
        type: 'loop',
        perPage: 2,
        focus: 'center',
      }).mount();
      new Splide('#cat-slide3', {
        type: 'loop',
        perPage: 2,
        focus: 'center',
      }).mount();
    }
    if (innerWidth > 675 && innerWidth < 1199) {
      new Splide('#splide', {
        type: 'loop',
        perPage: 3,
        focus: 'center',
        autoplay: true
      }).mount();
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
      new Splide('#cat-slide2', {
        type: 'loop',
        perPage: 3,
        focus: 'center',
      }).mount();
      new Splide('#cat-slide3', {
        type: 'loop',
        perPage: 3,
        focus: 'center',
      }).mount();
    }
    if (innerWidth > 1200 && innerWidth < 1790) {
      new Splide('#splide', {
        type: 'loop',
        perPage: 4,
        focus: 'center',
        autoplay: true
      }).mount();
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
      new Splide('#cat-slide2', {
        type: 'loop',
        perPage: 4,
        focus: 'center',
      }).mount();
      new Splide('#cat-slide3', {
        type: 'loop',
        perPage: 4,
        focus: 'center',
      }).mount();
    }
    if (innerWidth > 1790 && innerWidth < 2000) {
      new Splide('#splide', {
        type: 'loop',
        perPage: 5,
        focus: 'center',
        autoplay: true
      }).mount();
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
      new Splide('#cat-slide2', {
        type: 'loop',
        perPage: 5,
        focus: 'center',
      }).mount();
      new Splide('#cat-slide3', {
        type: 'loop',
        perPage: 5,
        focus: 'center',
      }).mount();
    }
    if (innerWidth > 2000) {
      new Splide('#splide', {
        type: 'loop',
        perPage: 6,
        focus: 'center',
        autoplay: true
      }).mount();
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
      new Splide('#cat-slide2', {
        type: 'loop',
        perPage: 6,
        focus: 'center',
      }).mount();
      new Splide('#cat-slide3', {
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
    window.onload = function() {
      $('.loader-container').fadeOut(1000);
    }
  </script>
</body>

</html>