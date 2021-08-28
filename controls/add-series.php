<?php

session_start();

require_once '../config.php';

if (!($_SESSION['UserEmail'] == 'admin@admin.com')) {
  header("Location:404.php");
}
require_once '../config.php';


@$MovieName1  = $_POST['movie-name1'];
@$MovieName2  = $_POST['movie-name2'];
@$MovieCover  = $_POST['movie-imdb-img'];
@$MoviePageImdb = $_POST['movie-imdb-link'];
@$MovieStory = $_POST['movie-story'];
@$MovieYear = $_POST['movie-year'];
@$MovieLang = $_POST['movie-lang'];
@$MovieCountry = $_POST['movie-country'];
@$MovieQualiy = $_POST['movie-quality'];
@$VideoQality = $_POST['movie-camera-quality'];
@$MovieLength = $_POST['movie-length'];
@$MovieTrans = $_POST['movie-trans'];
@$actor1 = $_POST['Actor1'];
@$actor2 = $_POST['Actor2'];
@$actor3 = $_POST['Actor3'];
@$actor4 = $_POST['Actor4'];
@$MovieTrai = $_POST['movie-tra'];
@$CatName = $_POST['movie-category'];
@$sessons = $_POST['sesson'];

$sqlAddMovie = "INSERT INTO series (SeriesName1,SeriesName2,SeriesCover,SeriesPage,SeriesStory,SeriesYear,SeriesLang,SeriesCountry,SeriesQuality,VedioQuality,SeriesLength,SeriesTrans,SeriesTrai,CatName,actor1,actor2,actor3,actor4,SeriesSeasons) 
VALUES ('$MovieName1','$MovieName2','$MovieCover','$MoviePageImdb','$MovieStory','$MovieYear','$MovieLang','$MovieCountry','$MovieQualiy','$VideoQality','$MovieLength','$MovieTrans','$MovieTrai','$CatName','$actor1','$actor2','$actor3','$actor4','$sessons')";

$QuerySting = str_replace(" ", "-", $MovieName1);

if (isset($_POST['submit'])) {
  if (mysqli_query($conn, $sqlAddMovie)) {
    $screenMSG = "تم اضافه المسلسل بنجاح";
    header("Location:../series-page.php?$QuerySting");
  } else {
    $screenMSG = "لم يتم اضافة المسلسل بنجاح" . mysqli_error($conn);
  }
}

$sqlCats = "SELECT * FROM cats";
$resultCat = mysqli_query($conn, $sqlCats);

$sqlActors = "SELECT * FROM actors";
$resultActor = mysqli_query($conn, $sqlActors);


$sqlLangs = "SELECT * FROM langs";
$resultLang = mysqli_query($conn, $sqlLangs);



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>أضافة مسلسل جديد</title>
  <link rel="stylesheet" href="css/add-movie.css">
</head>

<body>
  <?php include_once '../bottom-nav.php'; ?>
  <div class="containe">
    <p class="screen"><?php echo @$screenMSG; ?></p>
    <p class="title">أضافة مسلسل جديد</p>
    <form action="" method="POST">
      <div class="r1">
        <p class="head">تفاصيل المسلسل</p>
        <div class="right">
          <div class="input-feild">
            <label for="movie-name1">اسم المسلسل</label>
            <input id="movie-name" type="text" name="movie-name1" placeholder="اكتب اسم المسلسل بالانجليزية" required>
          </div>
          <div class="input-feild">
            <label for="movie-name2">اسم المسلسل</label>
            <input id="movie-name" type="text" name="movie-name2" placeholder="اكتب اسم المسلسل بالعربية" required>
          </div>
          <div class="input-feild">
            <label for="movie-imdb-img">صورة المسلسل</label>
            <input id="movie-imdb-img" type="url" name="movie-imdb-img" placeholder="imdb اكتب رابط صورة المسلسل" required>
          </div>
          <div class="input-feild">
            <label for="movie-imdb-link">imdb صفحة</label>
            <input id="movie-imdb-link" type="url" name="movie-imdb-link" placeholder="imdb اكتب رابط صفحة المسلسل" required>
          </div>
          <div class="input-feild">
            <label for="story">القصة</label>
            <textarea id="story" name="movie-story" placeholder="اكتب قصة المسلسل بالعربية" required></textarea>
          </div>
          <div class="input-feild">
            <label for="movie-year">سنة الاصدار</label>
            <input id="movie-year" type="number" name="movie-year" placeholder="اكتب سنة الاصدار" required>
          </div>
        </div>
        <div class="left">
          <div class="input-feild">
            <label for="movie-lang">لغة الفيلم</label>
            <input list="movie-lang" name="movie-lang">
            <datalist id="movie-lang">
              <?php

              if ($resultLang->num_rows > 0) {
                while ($rowlang = $resultLang->fetch_assoc()) {
                  echo '<option value="' . $rowlang['Lang'] . '"/>';
                }
              }

              ?>
            </datalist>
          </div>
          <div class="input-feild">
            <label for="movie-country">بلد المسلسل</label>
            <select name="movie-country" id="movie-country">
              <option value="مصر">مصر</option>
              <option value="امريكا">امريكا</option>
              <option value="بريطانيا">بريطانيا</option>
            </select>
          </div>
          <div class="input-feild">
            <label for="movie-quality">جودة المسلسل</label>
            <select name="movie-quality" id="movie-quality">
              <option value="1080p">1080p</option>
              <option value="720p">720p</option>
              <option value="480p">480p</option>
              <option value="360p">360p</option>
              <option value="244p">244p</option>
              <option value="144p">144p</option>
            </select>
          </div>
          <div class="input-feild">
            <label for="movie-camera-quality">جودة التصوير</label>
            <select name="movie-camera-quality" id="movie-camera-quality">
              <option value="blueray">BlueRay</option>
              <option value="webdl">WEB-DL</option>
              <option value="dvdrip">DVDRip</option>
              <option value="dvdscr">DVDScr</option>
              <option value="hdcam">HDCAm</option>
              <option value="hdrip">HDRip</option>
              <option value="hdtc">HDTC</option>
              <option value="hdts">HDTS</option>
              <option value="hdtv">HDTV</option>
              <option value="hdtv">TIVRip</option>
            </select>
          </div>
          <div class="input-feild">
            <label for="movie-length">المدة</label>
            <input id="movie-length" type="number" name="movie-length" placeholder="اكتب المدة" required>
          </div>
          <div class="input-feild">
            <label for="movie-trans">المترجمين</label>
            <input id="movie-trans" type="text" name="movie-trans" placeholder="اكتب المترجمين" required>
          </div>
          <div class="input-feild">

            <label for="movie-category">التصنيف</label>
            <input list="movie-category" name="movie-category">
            <datalist id="movie-category">
              <?php

              if ($resultCat->num_rows > 0) {
                while ($rowCat = $resultCat->fetch_assoc()) {
                  echo '<option value="' . $rowCat['CatName'] . '"/>';
                }
              }

              ?>
            </datalist>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="r2">
        <p class="head">احجام الملفات و الاعلان و الموسم</p>
        <div class="left">
          <div class="input-feild">
            <label for="movie-crew1">الممثل الاول </label>
            <input list="movie-crew1" name="Actor1" />
            <datalist id="movie-crew1">
              <?php
              if ($resultActor->num_rows > 0) {
                while ($rowActor = $resultActor->fetch_assoc()) {
                  echo '<option value="' . $rowCat['CatName2'] . '">' . $rowCat['CatName'] . '</option>';
                }
              }
              ?>
            </datalist>
          </div>
          <div class="input-feild">
            <label for="movie-crew2">الممثل الثاني</label>
            <input list="movie-crew1" name="Actor2" />
          </div>
          <div class="input-feild">
            <label for="movie-crew3">الممثل الثالث</label>
            <input list="movie-crew1" name="Actor3" />
          </div>
          <div class="input-feild">
            <label for="movie-crew4">الممثل الرابع</label>
            <input list="movie-crew1" name="Actor4" />
          </div>
          <div class="input-feild">
            <label for="movie-tra">اعلان اليوتيوب</label>
            <input id="movie-tra" type="url" name="movie-tra" placeholder="اكتب رابط الاعلان" required>
          </div>
          <div class="input-feild">

            <label for="sesson">عدد المواسم</label>
            <select name="sesson" id="sesson">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
            </select>
          </div>
        </div>
        <div class="input-submit">
          <input name="submit" type="submit" value="اضافة المسلسل">
        </div>
    </form>

  </div>
  <script>
    var bottomLink = document.querySelectorAll('.bottom-nav ul li a');
    bottomLink[0].href = '../index.php';
    bottomLink[1].href = '#';
    bottomLink[2].href = '../movies.php';
    bottomLink[3].href = '../series.php';
    bottomLink[4].href = '../plays.php';
    bottomLink[5].href = '../animations.php';
    bottomLink[6].href = 'controls.php';
    bottomLink[7].href = '../categores.php';
    bottomLink[8].href = '../new.php';
  </script>
</body>

</html>