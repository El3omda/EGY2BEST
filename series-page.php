<?php
include_once 'nav.php';
include_once 'bottom-nav.php';


// Get Page By Query String

$queryString = $_SERVER['QUERY_STRING'];
$queryStringFinal = str_replace("-", " ", $queryString);


// Connect To DB

require_once 'config.php';

$sql = "SELECT * FROM series WHERE SeriesName1 = '$queryStringFinal'";

$result = mysqli_query($conn, $sql);
$row = $result->fetch_assoc();


if ($row['SeriesLang'] != 'العربية') {
  // scrap IMDB
  $scrapImdb = file_get_contents($row['SeriesPage']);
  $startscrap = explode('<span class="AggregateRatingButton__RatingScore-sc-1ll29m0-1 iTLWoV">', $scrapImdb);
  $endscrap = explode('<span>/<!-- -->10</span>', $startscrap[1]);
} else {
  // scrap ELCINEMA
  $scrapImdb = file_get_contents($row['SeriesPage']);
  $startscrap = explode("<span class=\"legend\"><i class='fa fa-star'></i>", $scrapImdb);
  $endscrap = explode(" </span><div class=\"rating show-for-large-up\"><i class=\"fa fa-star rate-me \" data-key=\"", $startscrap[1]);
}
$sqlUpdateRate = "UPDATE series SET IMDBRate = '$endscrap[0]' WHERE SeriesName1 = '$queryStringFinal'";
mysqli_query($conn, $sqlUpdateRate);

// Add Movie To Favorites

@$UserEmail = $_SESSION['UserEmail'];

# Get Movie Or Series Name
$MovieOrSeries = str_replace('-', ' ', $queryString);

$sqlAddToFav = "INSERT INTO fav1 SET UserEmail = '$UserEmail',MovieOrSeries = '$MovieOrSeries'";

if (isset($_POST['fav'])) {
  if (mysqli_query($conn, $sqlAddToFav)) {
    $screen = 'تمت الاضافة بنجاح';
  } else {
    $screen = 'الفيلم موجود في المفضلة بالفعل';
  }
}



// Add Movie To Watch Later

$sqlAddToLater = "INSERT INTO later1 SET UserEmail = '$UserEmail',MovieOrSeries = '$MovieOrSeries'";

if (isset($_POST['later'])) {
  if (mysqli_query($conn, $sqlAddToLater)) {
    $screen = 'تمت الاضافة بنجاح';
  } else {
    $screen = 'المسلسل موجود في المضاهدة لاحقا بالفعل';
  }
}

// Get Favorites Items

$sqlGetFav = "SELECT * FROM fav1 WHERE MovieOrSeries = '$MovieOrSeries'";
$resultGetFav = mysqli_query($conn, $sqlGetFav);

// Remove From Favorites

$sqlRemoveFav = "DELETE FROM fav1 WHERE MovieOrSeries = '$MovieOrSeries'";

if (isset($_POST['removefav'])) {
  if (mysqli_query($conn, $sqlRemoveFav)) {
    $screen = 'تمت الحذف بنجاح';
  } else {
    $screen = 'تم الحذف بالفعل';
  }
}

// Get Watch Later Items

$sqlGetLater = "SELECT * FROM later1 WHERE MovieOrSeries = '$MovieOrSeries'";
$resultGetLater = mysqli_query($conn, $sqlGetLater);

// Remove From Watch Later

$sqlRemoveLater = "DELETE FROM later1 WHERE MovieOrSeries = '$MovieOrSeries'";

if (isset($_POST['removelater'])) {
  if (mysqli_query($conn, $sqlRemoveLater)) {
    $screen = 'تمت الحذف بنجاح';
  } else {
    $screen = 'تم الحذف بالفعل';
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>مسلسل <?php if ($row['SeriesLang'] == 'العربية') {
                  echo $row['SeriesName2'];
                } else {
                  echo $row['SeriesName1'];
                } ?></title>
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/movie-page.css">
  <link rel="stylesheet" href="css/series-page.css">
</head>

<body>
  <p class="screen" style="font-weight: bold;text-align: center;"><?php echo @$screen; ?></p>

  <div class="main-container">
    <div class="r1">
      <p class="name">
        <?php if ($row['SeriesLang'] == 'العربية') {
          echo $row['SeriesName2'];
        } else {
          echo $row['SeriesName1'];
        }
        echo ' ' . $row['SeriesYear'];
        ?>
      </p>
    </div>
    <div class="r2">
      <div class="right">
        <div class="imdb-rate">
          <span><?php echo $endscrap[0]; ?></span>
          <span><i class="fa fa-imdb"></i></span>
        </div>
        <div class="cover">
          <img src="<?php echo $row['SeriesCover']; ?>" alt="">
        </div>
        <?php

        if (isset($_SESSION['UserEmail']) && $_SESSION['UserEmail'] != 'admin@admin.com') {

          echo '
          <div class="user-action">
          <form action="' . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'] . ' " method="POST">
          ';

          if ($resultGetFav->num_rows == 1) {
            echo '
              <input type="submit" name="removefav" value="حذف من المفضلة">
              ';
          } else {
            echo '
              <input type="submit" name="fav" value="إضافة للمفضلة">
              ';
          }

          if ($resultGetLater->num_rows == 1) {
            echo '
              <input type="submit" name="removelater" value="حذف من المشاهدة لاحقا">
              ';
          } else {
            echo '
              <input type="submit" name="later" value="المشاهدة لاحقا">
              ';
          }

          echo '
          </form>
        </div>
            ';
        }

        ?>

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
          <p class="story-name"><?php echo $row['SeriesName2']; ?></p>
          <p class="story-content"><?php echo $row['SeriesStory']; ?></p>
        </div>
        <div class="movie-info">
          <table>
            <tr>
              <td>السنة</td>
              <td><?php echo $row['SeriesYear']; ?></td>
            </tr>
            <tr>
              <td>اللغة</td>
              <td><?php echo $row['SeriesLang']; ?></td>
            </tr>
            <tr>
              <td>البلد</td>
              <td><?php echo $row['SeriesCountry']; ?></td>
            </tr>
            <tr>
              <td>المدة</td>
              <td><?php echo $row['SeriesLength']; ?> دقيقة</td>
            </tr>
            <tr>
              <td>الجودة</td>
              <td><?php echo $row['SeriesQuality']; ?></td>
            </tr>
            <tr>
              <td>الترجمة</td>
              <td><?php echo $row['SeriesTrans']; ?></td>
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
        $ytTrailar = $row['SeriesTrai'];

        $embeded1 = str_replace("&t=1s", "", $ytTrailar);
        $embeded2 = str_replace("&t=2s", "", $embeded1);
        $embeded = str_replace("watch?v=", "embed/", $embeded2);
        ?>
        <iframe style="height: 100%;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;" src="<?php echo $embeded; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
    </div>
    <div class="r4">
      <p class="take-action">
        <i class="fa fa-hashtag"></i> جميع المواسم
      </p>
      <div class="content">
        <?php
        $i = 1;
        while ($i <= $row['SeriesSeasons']) {
          if ($i == 1) {
            $ses = 'الموسم الاول';
          }
          if ($i == 2) {
            $ses = 'الموسم الثاني';
          }
          if ($i == 3) {
            $ses = 'الموسم الثالث';
          }
          if ($i == 4) {
            $ses = 'الموسم الرابع';
          }
          if ($i == 5) {
            $ses = 'الموسم الخامس';
          }
          if ($i == 6) {
            $ses = 'الموسم السادس';
          }
          if ($i == 7) {
            $ses = 'الموسم السابع';
          }
          if ($i == 8) {
            $ses = 'الموسم الثامن';
          }
          if ($i == 9) {
            $ses = 'الموسم التاسع';
          }
          echo '
            <a href="sesson.php?' . $queryString . '-sesson-' . $i . '">
              <div class="box">
                <img src="' . $row['SeriesCover'] . '" alt="">
                <p class="sesson">' . $ses . '</p>
              </div>
            </a>
            ';
          $i++;
        }
        ?>
      </div>
    </div>
    <div class="r5">
      <p class="actors">
        <i class="fa fa-hashtag"></i> طاقم العمل
      </p>
      <div class="actors-container">
        <?php
        $name1 = $row['actor1'];
        $sqlactor1 = "SELECT * FROM actors WHERE ActorName = '$name1'";
        $result1 = mysqli_query($conn, $sqlactor1);
        $row1 = $result1->fetch_assoc();
        if (isset($row['actor1']) && !empty($row['actor1'])) {
          $mainPage = $row1['ActorName'];
          $generateLink = str_replace(" ", "-", $mainPage);
          echo '
  <div class="actor-box">
  <div class="block"></div>
  <div class="act-info">
    <div class="image">
      <img src="' . $row1['ActorImage'] . '" alt="">
      <p class="act-name"><a href="act-page.php?' . $generateLink . '">' . $row['actor1'] . '</a></p>
      <p class="role-name">Black Widow</p>
    </div>
  </div>
</div>
  ';
        }

        ?>
        <?php
        $name2 = $row['actor2'];
        $sqlactor2 = "SELECT * FROM actors WHERE ActorName = '$name2'";
        $result2 = mysqli_query($conn, $sqlactor2);
        $row2 = $result2->fetch_assoc();
        if (isset($row['actor2']) && !empty($row['actor2'])) {
          $mainPage = $row2['ActorName'];
          $generateLink = str_replace(" ", "-", $mainPage);
          echo '
          <div class="actor-box">
          <div class="block"></div>
          <div class="act-info">
            <div class="image">
              <img src="' . $row2['ActorImage'] . '" alt="">
              <p class="act-name"><a href="act-page.php?' . $generateLink . '">' . $row['actor2'] . '</a></p>
              <p class="role-name">Black Widow</p>
            </div>
          </div>
        </div>
          ';
        }

        ?>
        <?php
        $name3 = $row['actor3'];
        $sqlactor3 = "SELECT * FROM actors WHERE ActorName = '$name3'";
        $result3 = mysqli_query($conn, $sqlactor3);
        $row3 = $result3->fetch_assoc();
        if (isset($row['actor3']) && !empty($row['actor3'])) {
          $mainPage = $row3['ActorName'];
          $generateLink = str_replace(" ", "-", $mainPage);
          echo '
  <div class="actor-box">
  <div class="block"></div>
  <div class="act-info">
    <div class="image">
      <img src="' . $row3['ActorImage'] . '" alt="">
      <p class="act-name"><a href="act-page.php?' . $generateLink . '">' . $row['actor3'] . '</a></p>
      <p class="role-name">Black Widow</p>
    </div>
  </div>
</div>
  ';
        }

        ?>
        <?php
        $name4 = $row['actor4'];
        $sqlactor4 = "SELECT * FROM actors WHERE ActorName = '$name4'";
        $result4 = mysqli_query($conn, $sqlactor4);
        $row4 = $result4->fetch_assoc();
        if (isset($row['actor4']) && !empty($row['actor4'])) {
          $mainPage = $row4['ActorName'];
          $generateLink = str_replace(" ", "-", $mainPage);
          echo '
  <div class="actor-box">
  <div class="block"></div>
  <div class="act-info">
    <div class="image">
      <img src="' . $row4['ActorImage'] . '" alt="">
      <p class="act-name"><a href="act-page.php?' . $generateLink . '">' . $row['actor4'] . '</a></p>
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
</body>

</html>