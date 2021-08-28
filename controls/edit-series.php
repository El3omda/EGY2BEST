<?php

session_start();

require_once '../config.php';

if (!($_SESSION['UserEmail'] == 'admin@admin.com')) {
  header("Location:404.php");
}
include_once '../bottom-nav.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>تعديل بيانات مسلسل </title>
  <link rel="stylesheet" href="css/add-movie.css">
</head>

<body>
  <div class="containe">
    <p class="title">تعديل بيانات مسلسل</p>
    <form action="" method="POST">
      <div class="r1">
        <p class="head">تفاصيل المسلسل</p>
        <div class="right">
          <div class="input-feild">
            <label for="movie-name1">اسم المسلسل</label>
            <input value="The Flash" id="movie-name" type="text" name="movie-name1" placeholder="اكتب اسم المسلسل بالانجليزية" required>
          </div>
          <div class="input-feild">
            <label for="movie-name2">اسم المسلسل</label>
            <input value="ذا فلاش" id="movie-name" type="text" name="movie-name2" placeholder="اكتب اسم المسلسل بالعربية" required>
          </div>
          <div class="input-feild">
            <label for="movie-imdb-img">صورة المسلسل</label>
            <input value="https://www.facebook.com" id="movie-imdb-img" type="url" name="movie-imdb-img" placeholder="imdb اكتب رابط صورة المسلسل" required>
          </div>
          <div class="input-feild">
            <label for="movie-imdb-link">imdb صفحة</label>
            <input value="https://www.facebook.com" id="movie-imdb-link" type="url" name="movie-imdb-link" placeholder="imdb اكتب رابط صفحة المسلسل" required>
          </div>
          <div class="input-feild">
            <label for="story">القصة</label>
            <textarea id="story" name="movie-story" placeholder="اكتب قصة المسلسل بالعربية" required>تدور الأحداث في فترة ما بين الحرب الأهلية بين توني وستيف والحرب الأبدية مع ثانوس، حيث تذهب ناتاشا رومانوف المعروفة لدى الجميع باﻷرملة السوداء في مهمة جديدة بروسيا.</textarea>
          </div>
          <div class="input-feild">
            <label for="movie-year">سنة الاصدار</label>
            <input value="2021" id="movie-year" type="number" name="movie-year" placeholder="اكتب سنة الاصدار" required>
          </div>
        </div>
        <div class="left">
          <div class="input-feild">
            <label for="movie-lang">لغة المسلسل</label>
            <select name="movie-lang" id="movie-lang">
              <option value="العربية">العربية</option>
              <option selected value="الانجليزية">الانجليزية</option>
            </select>
          </div>
          <div class="input-feild">
            <label for="movie-country">بلد المسلسل</label>
            <select name="movie-country" id="movie-country">
              <option value="مصر">مصر</option>
              <option selected value="امريكا">امريكا</option>
              <option value="بريطانيا">بريطانيا</option>
            </select>
          </div>
          <div class="input-feild">
            <label for="movie-quality">جودة المسلسل</label>
            <select name="movie-quality" id="movie-quality">
              <option selected value="1080p">1080p</option>
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
              <option selected value="blueray">BlueRay</option>
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
            <input value="50" id="movie-length" type="number" name="movie-length" placeholder="اكتب المدة" required>
          </div>
          <div class="input-feild">
            <label for="movie-trans">المترجمين</label>
            <input value="شـكـراً عمر الشققي & إسلام الجيز!وي" id="movie-trans" type="text" name="movie-trans" placeholder="اكتب المترجمين" required>
          </div>
          <div class="input-feild">

            <label for="movie-category">التصنيف</label>
            <select name="movie-category" id="movie-category">
              <option value="اكشن">اكشن</option>
              <option value="مغامرة">مغامرة</option>
              <option value="دراما">دراما</option>
            </select>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="r2">
        <p class="head">احجام الملفات و الاعلان و الموسم</p>
        <div class="right">

          <div class="input-feild">
            <label for="movie-volume1080">حجم الـ1080</label>
            <input value="2100" id="movie-volume1080" type="number" name="movie-volume1080" placeholder="اكتب حجم الـ1080" required>
          </div>
          <div class="input-feild">
            <label for="movie-volume720">حجم الـ720</label>
            <input value="1500" id="movie-volume720" type="number" name="movie-volume720" placeholder="اكتب حجم الـ720" required>
          </div>
          <div class="input-feild">
            <label for="movie-volume480">حجم الـ480</label>
            <input value="1200" id="movie-volume480" type="number" name="movie-volume480" placeholder="اكتب حجم الـ480" required>
          </div>
          <div class="input-feild">
            <label for="movie-volume360">حجم الـ360</label>
            <input value="800" id="movie-volume360" type="number" name="movie-volume360" placeholder="اكتب حجم الـ360" required>
          </div>
          <div class="input-feild">
            <label for="movie-volume244">حجم الـ244</label>
            <input value="450" id="movie-volume244" type="number" name="movie-volume244" placeholder="اكتب حجم الـ244" required>
          </div>
          <div class="input-feild">
            <label for="movie-volume144">حجم الـ144</label>
            <input value="300" id="movie-volume144" type="number" name="movie-volume144" placeholder="اكتب حجم الـ144" required>
          </div>
        </div>
        <div class="left">
          <div class="input-feild">
            <label for="movie-crew">طاقم العمل</label>
            <select name="movie-crew" id="movie-crew">
              <option value="">actor name</option>
              <option selected value="">Grant Gustin</option>
              <option value="">actor name</option>
            </select>
          </div>
          <div class="input-feild">
            <label for="movie-tra">اعلان اليوتيوب</label>
            <input value="https://www.google.com" id="movie-tra" type="url" name="movie-tra" placeholder="اكتب رابط الاعلان" required>
          </div>
          <div class="input-feild">

            <label for="sesson">الموسم</label>
            <select name="sesson" id="sesson">
              <option selected value="الاول">الاول</option>
              <option value="الثاني">الثاني</option>
              <option value="الثالث">الثالث</option>
              <option value="الرابع">الرابع</option>
              <option value="الخامس">الخامس</option>
              <option value="السادس">السادس</option>
              <option value="السابع">السابع</option>
              <option value="الثامن">الثامن</option>
              <option value="التاسع">التاسع</option>
              <option value="العاشر">العاشر</option>
            </select>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="r3">
        <p class="head">روابط التحميل و المشاهدة</p>
        <div class="right">
          <div class="input-feild">
            <label for="movie-wurl1080">مشاهدة الـ1080</label>
            <input value="https://www.google.com" id="movie-wurl1080" type="url" name="movie-wurl1080" placeholder="اكتب رابط مشاهدة الـ1080">
          </div>
          <div class="input-feild">
            <label for="movie-wurl720">مشاهدة الـ720</label>
            <input value="https://www.google.com" id="movie-wurl720" type="url" name="movie-wurl720" placeholder="اكتب رابط مشاهدة الـ720">
          </div>
          <div class="input-feild">
            <label for="movie-wurl480">مشاهدة الـ480</label>
            <input value="https://www.google.com" id="movie-wurl480" type="url" name="movie-wurl480" placeholder="اكتب رابط مشاهدة الـ480">
          </div>
          <div class="input-feild">
            <label for="movie-wurl360">مشاهدة الـ360</label>
            <input value="https://www.google.com" id="movie-wurl360" type="url" name="movie-wurl360" placeholder="اكتب رابط مشاهدة الـ360">
          </div>
          <div class="input-feild">
            <label for="movie-wurl244">مشاهدة الـ244</label>
            <input value="https://www.google.com" id="movie-wurl244" type="url" name="movie-wurl244" placeholder="اكتب رابط مشاهدة الـ244">
          </div>
          <div class="input-feild">
            <label for="movie-wurl144">مشاهدة الـ144</label>
            <input value="https://www.google.com" id="movie-wurl144" type="url" name="movie-wurl144" placeholder="اكتب رابط مشاهدة الـ144">
          </div>
        </div>
        <div class="left">
          <div class="input-feild">
            <label for="movie-durl1080">تحميل الـ1080</label>
            <input value="https://www.google.com" id="movie-durl1080" type="url" name="movie-durl1080" placeholder="اكتب رابط تحميل الـ1080">
          </div>
          <div class="input-feild">
            <label for="movie-durl720">تحميل الـ720</label>
            <input value="https://www.google.com" id="movie-durl720" type="url" name="movie-durl720" placeholder="اكتب رابط تحميل الـ720">
          </div>
          <div class="input-feild">
            <label for="movie-durl480">تحميل الـ480</label>
            <input value="https://www.google.com" id="movie-durl480" type="url" name="movie-durl480" placeholder="اكتب رابط تحميل الـ480">
          </div>
          <div class="input-feild">
            <label for="movie-durl360">تحميل الـ360</label>
            <input value="https://www.google.com" id="movie-durl360" type="url" name="movie-durl360" placeholder="اكتب رابط تحميل الـ360">
          </div>
          <div class="input-feild">
            <label for="movie-durl244">تحميل الـ244</label>
            <input value="https://www.google.com" id="movie-durl244" type="url" name="movie-durl244" placeholder="اكتب رابط تحميل الـ244">
          </div>
          <div class="input-feild">
            <label for="movie-durl144">تحميل الـ144</label>
            <input value="https://www.google.com" id="movie-durl144" type="url" name="movie-durl144" placeholder="اكتب رابط تحميل الـ144">
          </div>
        </div>
        <div class="input-submit">
          <input type="submit" value="تعديل المسلسل">
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