<?php
include_once 'nav.php';
include_once 'bottom-nav.php';
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
// Get Page By Query String

$queryString = $_SERVER['QUERY_STRING'];
$queryStringFinal = str_replace("-", " ", $queryString);

// Connect To DB

require_once 'config.php';

$sql = "SELECT * FROM movies WHERE MovieName1 = '$queryStringFinal'";

$result = mysqli_query($conn, $sql);
$row = $result->fetch_assoc();


if ($row['MovieLang'] != 'العربية') {
  // scrap IMDB
  $scrapImdb = file_get_contents($row['MoviePageImdb']);
  $startscrap = explode('"bestRating":10,"worstRating":1,"ratingValue":', $scrapImdb);
  $endscrap = explode('},"duration":"', $startscrap[1]);
} else {
  // scrap ELCINEMA
  $scrapImdb = file_get_contents($row['MoviePageImdb']);
  $startscrap = explode("<span class=\"legend\"><i class='fa fa-star'></i>", $scrapImdb);
  $endscrap = explode(" </span><div class=\"rating show-for-large-up\"><i class=\"fa fa-star rate-me \" data-key=\"", $startscrap[1]);
}






// Update Rate Into DAta Base

$sqlUpdateRate = "UPDATE movies SET IMDBRate = '$endscrap[0]' WHERE MovieName1 = '$queryStringFinal'";
mysqli_query($conn, $sqlUpdateRate);


// Add Movie To Favorites

@$UserEmail = $_SESSION['UserEmail'];

# Get Movie Or Series Name
$MovieOrSeries = str_replace('-', ' ', $queryString);

$sqlAddToFav = "INSERT INTO fav SET UserEmail = '$UserEmail',MovieOrSeries = '$MovieOrSeries'";

if (isset($_POST['fav'])) {
  if (mysqli_query($conn, $sqlAddToFav)) {
    $screen = 'تمت الاضافة بنجاح';
  } else {
    $screen = 'الفيلم موجود في المفضلة بالفعل';
  }
}



// Add Movie To Watch Later

$sqlAddToLater = "INSERT INTO later SET UserEmail = '$UserEmail',MovieOrSeries = '$MovieOrSeries'";

if (isset($_POST['later'])) {
  if (mysqli_query($conn, $sqlAddToLater)) {
    $screen = 'تمت الاضافة بنجاح';
  } else {
    $screen = 'الفيلم موجود في المضاهدة لاحقا بالفعل';
  }
}

// Get Favorites Items

$sqlGetFav = "SELECT * FROM fav WHERE MovieOrSeries = '$MovieOrSeries'";
$resultGetFav = mysqli_query($conn, $sqlGetFav);

// Remove From Favorites

$sqlRemoveFav = "DELETE FROM fav WHERE MovieOrSeries = '$MovieOrSeries'";

if (isset($_POST['removefav'])) {
  if (mysqli_query($conn, $sqlRemoveFav)) {
    $screen = 'تمت الحذف بنجاح';
  } else {
    $screen = 'تم الحذف بالفعل';
  }
}

// Get Watch Later Items

$sqlGetLater = "SELECT * FROM later WHERE MovieOrSeries = '$MovieOrSeries'";
$resultGetLater = mysqli_query($conn, $sqlGetLater);

// Remove From Watch Later

$sqlRemoveLater = "DELETE FROM later WHERE MovieOrSeries = '$MovieOrSeries'";

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
  <title><?php echo $row['AddType'] ?> <?php if ($row['MovieLang'] == 'العربية') {
                                          echo $row['MovieName2'];
                                        } else {
                                          echo $row['MovieName1'];
                                        } ?></title>
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/movie-page.css">
</head>

<body>
  <p class="screen" style="font-weight: bold;text-align: center;"><?php echo @$screen; ?></p>
  <div class="main-container">
    <div class="r1">
      <p class="name">
        <?php if ($row['MovieLang'] == 'العربية') {
          echo $row['MovieName2'];
        } else {
          echo $row['MovieName1'];
        }
        echo ' ' . $row['MovieYear'];
        ?></p>
    </div>
    <div class="r2">
      <div class="right">
        <div class="imdb-rate">
          <span><?php echo $endscrap[0]; ?></span>
          <span><i class="fa fa-imdb"></i></span>
        </div>
        <div class="cover">
          <img src="<?php echo $row['MovieCover']; ?>" alt="">
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
          <li>80 %</li>
          <li><i class="fa fa-thumbs-down"></i></li>
        </ul> -->
      </div>
      <div class="left">
        <div class="story">
          <p class="title"><i class="fa fa-hashtag"></i> القصة</p>
          <p class="story-name"><?php echo $row['MovieName2']; ?></p>
          <p class="story-content"><?php echo $row['MovieStory']; ?></p>
        </div>
        <div class="movie-info">
          <table>
            <tr>
              <td>السنة</td>
              <td><?php echo $row['MovieYear']; ?></td>
            </tr>
            <tr>
              <td>اللغة</td>
              <td><?php echo $row['MovieLang']; ?></td>
            </tr>
            <tr>
              <td>البلد</td>
              <td><?php echo $row['MovieCountry']; ?></td>
            </tr>
            <tr>
              <td>المدة</td>
              <td><?php echo $row['MovieLength']; ?> دقيقة</td>
            </tr>
            <tr>
              <td>الجودة</td>
              <td><?php echo $row['MovieQualiy']; ?></td>
            </tr>
            <tr>
              <td>الترجمة</td>
              <td><?php echo $row['MovieTrans']; ?></td>
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
        $ytTrailar = $row['MovieTrai'];

        $embeded1 = str_replace("&t=1s", "", $ytTrailar);
        $embeded = str_replace("watch?v=", "embed/", $embeded1);
        ?>
        <iframe src="<?php echo $embeded; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <ul>
          <li><a href="<?php echo "watch-online.php?Media=" . $queryString . "&Qual=Low"; ?>">مشاهدة مباشرة</a></li>
          <li><a href="#watch">تحميل مباشر</a></li>
        </ul>
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

        if (!($row['Watch1080'] == '' && $row['download1080'] == '')) {
          echo '
          <tr>
          <td>' . $row['VideoQality'] . '</td>
          <td> Full HD 1080p <i class="fa fa-desktop"></i></td>
          <td>GB ' . $row['Volume1080'] . '</td>
          <td>';
          if (!($row['download1080'] == '')) {
            echo '
            <span> 
            <a href="' . $row['download1080'] . '">تحميل</a>
          </span>
            ';
          }
          if (!($row['Watch1080'] == '')) {
            echo '
          <span>
            <a href="' . $row['Watch1080'] . '">مشاهدة</a>
          </span>
        </td>
            ';
          }
          echo '
        </tr>
        <tr class="spare">
          <td colspan="3">
          ';
          if (!($row['Watch1080'] == '')) {
            echo '<a href="' . $row['Watch1080'] . '">مشاهدة</a>';
          }
          if (!($row['download1080'] == '')) {
            echo '<a href="' . $row['download1080'] . '">تحميل</a>';
          }
          echo '
            </td>
          <td></td>
        </tr>
          ';
        }

        ?>

        <?php

        if (!($row['Watch720'] == '' && $row['download720'] == '')) {
          echo '
  <tr>
  <td>' . $row['VideoQality'] . '</td>
  <td> HD 720p <i class="fa fa-laptop"></i></td>
  <td>GB ' . $row['Volume720'] . '</td>
  <td>';
          if (!($row['download720'] == '')) {
            echo '
    <span> 
    <a href="' . $row['download720'] . '">تحميل</a>
  </span>
    ';
          }
          if (!($row['Watch720'] == '')) {
            echo '
  <span>
    <a href="' . $row['Watch720'] . '">مشاهدة</a>
  </span>
</td>
    ';
          }
          echo '
</tr>
<tr class="spare">
  <td colspan="3">
  ';
          if (!($row['Watch720'] == '')) {
            echo '<a href="' . $row['Watch720'] . '">مشاهدة</a>';
          }
          if (!($row['download720'] == '')) {
            echo '<a href="' . $row['download720'] . '">تحميل</a>';
          }
          echo '
  </td>
  <td></td>
</tr>
  ';
        }

        ?>
        <?php

        if (!($row['Watch480'] == '' && $row['download480'] == '')) {
          echo '
  <tr>
  <td>' . $row['VideoQality'] . '</td>
  <td> SD 480p <i class="fa fa-tablet"></i></td>
  <td>GB ' . $row['Volume480'] . '</td>
  <td>';
          if (!($row['download480'] == '')) {
            echo '
    <span> 
    <a href="' . $row['download480'] . '">تحميل</a>
  </span>
    ';
          }
          if (!($row['Watch480'] == '')) {
            echo '
  <span>
    <a href="watch-online.php?Media=' . $row['MovieName1'] . '&Qual=High">مشاهدة</a>
  </span>
</td>
    ';
          }
          echo '
</tr>
<tr class="spare">
  <td colspan="3">
  ';
          if (!($row['Watch480'] == '')) {
            echo '    <a href="watch-online.php?Media=' . $row['MovieName1'] . '&Qual=High">مشاهدة</a>
            ';
          }
          if (!($row['download480'] == '')) {
            echo '<a href="' . $row['download480'] . '">تحميل</a>';
          }
          echo '
  </td>
  <td></td>
</tr>
  ';
        }
        ?>
        <?php

        if (!($row['Watch360'] == '' && $row['download360'] == '')) {
          echo '
  <tr>
  <td>' . $row['VideoQality'] . '</td>
  <td> SD 360p <i style="font-size: 24px;" class="fa fa-mobile"></i></td>
  <td>MB ' . $row['Volume360'] . '</td>
  <td>';
          if (!($row['download360'] == '')) {
            echo '
    <span> 
    <a href="' . $row['download360'] . '">تحميل</a>
  </span>
    ';
          }
          if (!($row['Watch360'] == '')) {
            echo '
  <span>
    <a href="' . $row['Watch360'] . '">مشاهدة</a>
  </span>
</td>
    ';
          }
          echo '
</tr>
<tr class="spare">
  <td colspan="3">
  ';
          if (!($row['Watch360'] == '')) {
            echo '<a href="' . $row['Watch360'] . '">مشاهدة</a>';
          }
          if (!($row['download360'] == '')) {
            echo '<a href="' . $row['download360'] . '">تحميل</a>';
          }
          echo '
  </td>
  <td></td>
</tr>
  ';
        }
        ?>
        <?php

        if (!($row['Watch244'] == '' && $row['download244'] == '')) {
          echo '
  <tr>
  <td>' . $row['VideoQality'] . '</td>
  <td> SD 244p <i class="fa fa-mobile"></i></td>
  <td>MB ' . $row['Volume244'] . '</td>
  <td>';
          if (!($row['download244'] == '')) {
            echo '
    <span> 
    <a href="' . $row['download244'] . '">تحميل</a>
  </span>
    ';
          }
          if (!($row['Watch244'] == '')) {
            echo '
  <span>
    <a href="' . $row['Watch244'] . '">مشاهدة</a>
  </span>
</td>
    ';
          }
          echo '
</tr>
<tr class="spare">
  <td colspan="3">
  ';
          if (!($row['Watch244'] == '')) {
            echo '<a href="' . $row['Watch244'] . '">مشاهدة</a>';
          }
          if (!($row['download244'] == '')) {
            echo '<a href="' . $row['download244'] . '">تحميل</a>';
          }
          echo '
  </td>
  <td></td>
</tr>
  ';
        }
        ?>
        <?php

        if (!($row['Watch144'] == '' && $row['download144'] == '')) {
          echo '
  <tr>
  <td>' . $row['VideoQality'] . '</td>
  <td> SD 144p <i class="fa fa-mobile"></i></td>
  <td>MB ' . $row['Volume144'] . '</td>
  <td>';
          if (!($row['download144'] == '')) {
            echo '
    <span> 
    <a href="' . $row['download144'] . '">تحميل</a>
  </span>
    ';
          }
          if (!($row['Watch144'] == '')) {
            echo '
  <span>
  <a href="watch-online.php?Media=' . $row['MovieName1'] . '&Qual=Low">مشاهدة</a>
  </span>
</td>
    ';
          }
          echo '
</tr>
<tr class="spare">
  <td colspan="3">
  ';
          if (!($row['Watch144'] == '')) {
            echo '
            <a href="watch-online.php?Media=' . $row['MovieName1'] . '&Qual=Low">مشاهدة</a>
            ';
          }
          if (!($row['download144'] == '')) {
            echo '<a href="' . $row['download144'] . '">تحميل</a>';
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
        $name1 = $row['actor1'];
        $sqlactor1 = "SELECT * FROM actors WHERE ActorName = '$name1'";
        $result1 = mysqli_query($conn, $sqlactor1);
        $row1 = $result1->fetch_assoc();
        if (isset($row['actor1']) && !empty($row['actor1'])) {
          // Generate Main Page
          $mainPage = $row1['ActorName'];
          $generateLink = str_replace(" ", "-", $mainPage);
          echo '
  <div class="actor-box">
  <div class="block"></div>
  <div class="act-info">
    <div class="image">
      <img src="' . $row1['ActorImage'] . '" alt="">
      <p class="act-name"><a href="act-page.php?' . $generateLink . '">';
          if (in_array($row1['ActorCountry'], $arabCountry)) {
            echo $row1['ArabicName'];
          } else {
            echo $row1['ActorName'];
          }
          echo
          '</a></p>
      <p class="role-name">' . $row['Act1Role'] . '</p>
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
          // Generate Main Page
          $mainPage = $row2['ActorName'];
          $generateLink = str_replace(" ", "-", $mainPage);
          echo '
          <div class="actor-box">
          <div class="block"></div>
          <div class="act-info">
            <div class="image">
              <img src="' . $row2['ActorImage'] . '" alt="">
              <p class="act-name"><a href="act-page.php?' . $generateLink . '">';

          if (in_array($row2['ActorCountry'], $arabCountry)) {
            echo $row2['ArabicName'];
          } else {
            echo $row2['ActorName'];
          }

          echo
          '</a></p>
              <p class="role-name">' . $row['Act2Role'] . '</p>
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
          // Generate Main Page
          $mainPage = $row3['ActorName'];
          $generateLink = str_replace(" ", "-", $mainPage);
          echo '
  <div class="actor-box">
  <div class="block"></div>
  <div class="act-info">
    <div class="image">
      <img src="' . $row3['ActorImage'] . '" alt="">
      <p class="act-name"><a href="act-page.php?' . $generateLink . '">';
          if (in_array($row3['ActorCountry'], $arabCountry)) {
            echo $row3['ArabicName'];
          } else {
            echo $row3['ActorName'];
          }
          echo
          '</a></p>
      <p class="role-name">' . $row['Act3Role'] . '</p>
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
          // Generate Main Page
          $mainPage = $row4['ActorName'];
          $generateLink = str_replace(" ", "-", $mainPage);
          echo '
  <div class="actor-box">
  <div class="block"></div>
  <div class="act-info">
    <div class="image">
      <img src="' . $row4['ActorImage'] . '" alt="">
      <p class="act-name"><a href="act-page.php?' . $generateLink . '">';
          if (in_array($row4['ActorCountry'], $arabCountry)) {
            echo $row4['ArabicName'];
          } else {
            echo $row4['ActorName'];
          }
          echo
          '</a></p>
      <p class="role-name">' . $row['Act4Role'] . '</p>
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