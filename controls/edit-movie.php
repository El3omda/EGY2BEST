<?php
require_once '../config.php';

session_start();

require_once '../config.php';

if (!($_SESSION['UserEmail'] == 'admin@admin.com')) {
  header("Location:404.php");
}
$MovieID = $_SERVER['QUERY_STRING'];


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
@$Volume1080 = $_POST['movie-volume1080'];
@$Volume720 = $_POST['movie-volume720'];
@$Volume480 = $_POST['movie-volume480'];
@$Volume360 = $_POST['movie-volume360'];
@$Volume244 = $_POST['movie-volume244'];
@$Volume144 = $_POST['movie-volume144'];
@$actor1 = $_POST['actor1'];
@$actor2 = $_POST['actor2'];
@$actor3 = $_POST['actor3'];
@$actor4 = $_POST['actor4'];
@$Act1Role = $_POST['Act1Role'];
@$Act2Role = $_POST['Act2Role'];
@$Act3Role = $_POST['Act3Role'];
@$Act4Role = $_POST['Act4Role'];
@$MovieTrai = $_POST['movie-tra'];
@$CatName = $_POST['movie-category'];
@$Watch1080 = $_POST['movie-wurl1080'];
@$Watch720 = $_POST['movie-wurl720'];
@$Watch480 = $_POST['movie-wurl480'];
@$Watch360 = $_POST['movie-wurl360'];
@$Watch244 = $_POST['movie-wurl244'];
@$Watch144 = $_POST['movie-wurl144'];
@$download1080 = $_POST['movie-durl1080'];
@$download720  = $_POST['movie-durl720'];
@$download480 = $_POST['movie-durl480'];
@$download360 = $_POST['movie-durl360'];
@$download244 = $_POST['movie-durl244'];
@$download144 = $_POST['movie-durl144'];

$sqlEdit = "UPDATE movies SET MovieName1 = '$MovieName1',MovieName2 = '$MovieName2',
 MovieCover = '$MovieCover',MoviePageImdb = '$MoviePageImdb',MovieStory = '$MovieStory',
 MovieYear = '$MovieYear',
 MovieLang = '$MovieLang',
 MovieCountry = '$MovieCountry',
 MovieQualiy = '$MovieQualiy',VideoQality = '$VideoQality',MovieLength = '$MovieLength',MovieTrans = '$MovieTrans',
 Volume1080 = '$Volume1080',Volume720 = '$Volume720',Volume480 = '$Volume480',Volume360 = '$Volume360',Volume244 = '$Volume244',Volume144 = '$Volume144',
MovieTrai = '$MovieTrai',
 Watch1080 = '$Watch1080',Watch720 = '$Watch720',Watch480 = '$Watch480',Watch360 = '$Watch360',
 Watch244 = '$Watch244',Watch144 = '$Watch144',download1080 = '$download1080',download720 = '$download720',download480 = '$download480',
 download360 = '$download360',download244 = '$download244',download144 = '$download144',CatName = '$CatName',
 actor1 = '$actor1',actor2 = '$actor2',actor3 = '$actor3',actor4 = '$actor4'
 ,Act1Role = '$Act1Role',Act2Role = '$Act2Role',Act3Role = '$Act3Role',Act4Role = '$Act4Role'
 WHERE MovieID = '$MovieID'";

if (isset($_POST['submit'])) {
  if (mysqli_query($conn, $sqlEdit)) {
    $screenMSG = 'تم تعديل الفيلم بنجاح';
    header("Location:../movie-page.php?$MakeQueryString");
  } else {
    $screenMSG = 'لم يتم تعديل الفيلم بنجاح' . mysqli_error($conn);
  }
}

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';

$sqlselect = "SELECT * FROM movies WHERE MovieID = '$MovieID'";

$result = mysqli_query($conn, $sqlselect);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
}

$sqlActors = "SELECT * FROM actors";
$resultActor = mysqli_query($conn, $sqlActors);


$sqlLangs = "SELECT * FROM langs";
$resultLang = mysqli_query($conn, $sqlLangs);

$sqlCats = "SELECT * FROM cats";
$resultCat = mysqli_query($conn, $sqlCats);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>تعديل بيانات الفيلم </title>
  <link rel="stylesheet" href="css/add-movie.css">
</head>

<body>
  <div class="containe">
    <p class="screen"><?php echo @$screenMSG; ?></p>
    <p class="title">تعديل بيانات الفيلم</p>
    <form action="" method="POST">
      <div class="r1">
        <p class="head">تفاصيل الفيلم</p>
        <div class="right">
          <div class="input-feild">
            <label for="movie-name1">اسم الفيلم</label>
            <input value="<?php echo $row['MovieName1']; ?>" id="movie-name" type="text" name="movie-name1" placeholder="اكتب اسم الفيلم بالانجليزية" required>
          </div>
          <div class="input-feild">
            <label for="movie-name2">اسم الفيلم</label>
            <input value="<?php echo $row['MovieName2']; ?>" id="movie-name" type="text" name="movie-name2" placeholder="اكتب اسم الفيلم بالعربية" required>
          </div>
          <div class="input-feild">
            <label for="movie-imdb-img">صورة الفيلم</label>
            <input value="<?php echo $row['MovieCover']; ?>" id="movie-imdb-img" type="url" name="movie-imdb-img" placeholder="imdb اكتب رابط صورة الفيلم" required>
          </div>
          <div class="input-feild">
            <label for="movie-imdb-link">imdb صفحة</label>
            <input value="<?php echo $row['MoviePageImdb']; ?>" id="movie-imdb-link" type="url" name="movie-imdb-link" placeholder="imdb اكتب رابط صفحة الفيلم" required>
          </div>
          <div class="input-feild">
            <label for="story">القصة</label>
            <textarea id="story" name="movie-story" placeholder="اكتب قصة الفيلم بالعربية" required><?php echo $row['MovieStory']; ?></textarea>
          </div>
          <div class="input-feild">
            <label for="movie-year">سنة الاصدار</label>
            <input value="<?php echo $row['MovieYear']; ?>" id="movie-year" type="number" name="movie-year" placeholder="اكتب سنة الاصدار" required>
          </div>
        </div>
        <div class="left">
          <div class="input-feild">
            <label for="movie-lang">لغة الفيلم</label>
            <input list="movie-lang" name="movie-lang" value="<?php echo $row['MovieLang']; ?>">
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
            <label for="movie-country">بلد الفيلم</label>
            <select name="movie-country" id="movie-country">
              <option disabled selected value="no">اختر البلد</option>
              <option value="مصر">مصر</option>
              <option value="امريكا">امريكا</option>
              <option value="بريطانيا">بريطانيا</option>
            </select>
          </div>
          <div class="input-feild">
            <label for="movie-quality">جودة الفيلم</label>
            <select name="movie-quality" id="movie-quality" value="<?php echo $row['MovieQualiy']; ?>">
              <option disabled selected value="no">اختر جودة</option>
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
              <option selected disabled value="no">اختر جودة التصوير</option>
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
            <input value="<?php echo $row['MovieLength']; ?>" id="movie-length" type="number" name="movie-length" placeholder="اكتب المدة" required>
          </div>
          <div class="input-feild">
            <label for="movie-trans">المترجمين</label>
            <input value="<?php echo $row['MovieTrans']; ?>" id="movie-trans" type="text" name="movie-trans" placeholder="اكتب المترجمين" required>
          </div>
          <div class="input-feild">

            <label for="movie-category">التصنيف</label>
            <input list="movie-category" name="movie-category" value="<?php echo $row['CatName']; ?>">
            <datalist id="movie-category">
              <?php

              if ($resultCat->num_rows > 0) {
                while ($rowCat = $resultCat->fetch_assoc()) {
                  echo '<option value="' . $rowCat['CatName2'] . '">' . $rowCat['CatName'] . '</option>';
                }
              }

              ?>
            </datalist>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="r2">
        <p class="head">احجام الملفات و الاعلان</p>
        <div class="right">

          <div class="input-feild">
            <label for="movie-volume1080">حجم الـ1080</label>
            <input value="<?php echo $row['Volume1080']; ?>" id="movie-volume1080" type="text" name="movie-volume1080" placeholder="اكتب حجم الـ1080">
          </div>
          <div class="input-feild">
            <label for="movie-volume720">حجم الـ720</label>
            <input value="<?php echo $row['Volume720']; ?>" id="movie-volume720" type="text" name="movie-volume720" placeholder="اكتب حجم الـ720">
          </div>
          <div class="input-feild">
            <label for="movie-volume480">حجم الـ480</label>
            <input value="<?php echo $row['Volume480']; ?>" id="movie-volume480" type="text" name="movie-volume480" placeholder="اكتب حجم الـ480">
          </div>
          <div class="input-feild">
            <label for="movie-volume360">حجم الـ360</label>
            <input value="<?php echo $row['Volume360']; ?>" id="movie-volume360" type="text" name="movie-volume360" placeholder="اكتب حجم الـ360">
          </div>
          <div class="input-feild">
            <label for="movie-volume244">حجم الـ244</label>
            <input value="<?php echo $row['Volume244']; ?>" id="movie-volume244" type="text" name="movie-volume244" placeholder="اكتب حجم الـ244">
          </div>
          <div class="input-feild">
            <label for="movie-volume144">حجم الـ144</label>
            <input value="<?php echo $row['Volume144']; ?>" id="movie-volume144" type="text" name="movie-volume144" placeholder="اكتب حجم الـ144">
          </div>
        </div>
        <div class="left">
          <div class="input-feild">
            <label for="movie-crew1">الممثل الاول </label>
            <input list="movie-crew1" name="actor1" value="<?php echo $row['actor1']; ?>" />
            <datalist id="movie-crew1">
              <?php
              if ($result->num_rows > 0) {
                while ($rowActor = $resultActor->fetch_assoc()) {
                  echo '<option value="' . $rowActor['ActorName'] . '">';
                }
              }
              ?>
            </datalist>
          </div>
          <div class="input-feild">
            <label for="Act1Role"> دور الممثل الاول </label>
            <input type="text" name="Act1Role" value="<?php echo $row['Act1Role']; ?>" />
          </div>
          <div class="input-feild">
            <label for="movie-crew2">الممثل الثاني</label>
            <input list="movie-crew1" name="actor2" value="<?php echo $row['actor2']; ?>" />
          </div>
          <div class="input-feild">
            <label for="Act2Role"> دور الممثل الثاني </label>
            <input type="text" name="Act2Role" value="<?php echo $row['Act2Role']; ?>" />
          </div>
          <div class="input-feild">
            <label for="movie-crew3">الممثل الثالث</label>
            <input list="movie-crew1" name="actor3" value="<?php echo $row['actor3']; ?>" />
          </div>
          <div class="input-feild">
            <label for="Act3Role"> دور الممثل الثالث </label>
            <input type="text" name="Act3Role" value="<?php echo $row['Act3Role']; ?>" />
          </div>
          <div class="input-feild">
            <label for="movie-crew4">الممثل الرابع</label>
            <input list="movie-crew1" name="actor4" value="<?php echo $row['actor4']; ?>" />
          </div>
          <div class="input-feild">
            <label for="Act4Role"> دور الممثل الرابع </label>
            <input type="text" name="Act4Role" value="<?php echo $row['Act4Role']; ?>" />
          </div>
          <div class="input-feild">
            <label for="movie-tra">اعلان اليوتيوب</label>
            <input value="<?php echo $row['MovieTrai']; ?>" id="movie-tra" type="url" name="movie-tra" placeholder="اكتب رابط الاعلان" required>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="r3">
        <p class="head">روابط التحميل و المشاهدة</p>
        <div class="right">
          <div class="input-feild">
            <label for="movie-wurl1080">مشاهدة الـ1080</label>
            <input value="<?php echo $row['Watch1080']; ?>" id="movie-wurl1080" type="url" name="movie-wurl1080" placeholder="اكتب رابط مشاهدة الـ1080">
          </div>
          <div class="input-feild">
            <label for="movie-wurl720">مشاهدة الـ720</label>
            <input value="<?php echo $row['Watch720']; ?>" id="movie-wurl720" type="url" name="movie-wurl720" placeholder="اكتب رابط مشاهدة الـ720">
          </div>
          <div class="input-feild">
            <label for="movie-wurl480">مشاهدة الـ480</label>
            <input value="<?php echo $row['Watch480']; ?>" id="movie-wurl480" type="url" name="movie-wurl480" placeholder="اكتب رابط مشاهدة الـ480">
          </div>
          <div class="input-feild">
            <label for="movie-wurl360">مشاهدة الـ360</label>
            <input value="<?php echo $row['Watch360']; ?>" id="movie-wurl360" type="url" name="movie-wurl360" placeholder="اكتب رابط مشاهدة الـ360">
          </div>
          <div class="input-feild">
            <label for="movie-wurl244">مشاهدة الـ244</label>
            <input value="<?php echo $row['Watch244']; ?>" id="movie-wurl244" type="url" name="movie-wurl244" placeholder="اكتب رابط مشاهدة الـ244">
          </div>
          <div class="input-feild">
            <label for="movie-wurl144">مشاهدة الـ144</label>
            <input value="<?php echo $row['Watch144']; ?>" id="movie-wurl144" type="url" name="movie-wurl144" placeholder="اكتب رابط مشاهدة الـ144">
          </div>
        </div>
        <div class="left">
          <div class="input-feild">
            <label for="movie-durl1080">تحميل الـ1080</label>
            <input value="<?php echo $row['download1080']; ?>" id="movie-durl1080" type="url" name="movie-durl1080" placeholder="اكتب رابط تحميل الـ1080">
          </div>
          <div class="input-feild">
            <label for="movie-durl720">تحميل الـ720</label>
            <input value="<?php echo $row['download720']; ?>" id="movie-durl720" type="url" name="movie-durl720" placeholder="اكتب رابط تحميل الـ720">
          </div>
          <div class="input-feild">
            <label for="movie-durl480">تحميل الـ480</label>
            <input value="<?php echo $row['download480']; ?>" id="movie-durl480" type="url" name="movie-durl480" placeholder="اكتب رابط تحميل الـ480">
          </div>
          <div class="input-feild">
            <label for="movie-durl360">تحميل الـ360</label>
            <input value="<?php echo $row['download360']; ?>" id="movie-durl360" type="url" name="movie-durl360" placeholder="اكتب رابط تحميل الـ360">
          </div>
          <div class="input-feild">
            <label for="movie-durl244">تحميل الـ244</label>
            <input value="<?php echo $row['download244']; ?>" id="movie-durl244" type="url" name="movie-durl244" placeholder="اكتب رابط تحميل الـ244">
          </div>
          <div class="input-feild">
            <label for="movie-durl144">تحميل الـ144</label>
            <input value="<?php echo $row['download144']; ?>" id="movie-durl144" type="url" name="movie-durl144" placeholder="اكتب رابط تحميل الـ144">
          </div>
        </div>
        <div class="input-submit">
          <input name="submit" type="submit" value="تعديل الفيلم">
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