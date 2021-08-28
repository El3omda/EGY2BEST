<?php

session_start();

require_once '../config.php';

if (!($_SESSION['UserEmail'] == 'admin@admin.com')) {
  header("Location:404.php");
}
require_once '../config.php';

include_once '../bottom-nav.php';
$Series = $_SERVER['QUERY_STRING'];
@$SeriesID = $_POST['movie-name1'];
@$EpsodeNum = $_POST['movie-name2'];
@$IsLast = $_POST['islast'];
@$Sesson = $_POST['sesson'];
@$Volume1080 = $_POST['movie-volume1080'];
@$Volume720 = $_POST['movie-volume720'];
@$Volume480 = $_POST['movie-volume480'];
@$Volume360 = $_POST['movie-volume360'];
@$Volume244 = $_POST['movie-volume244'];
@$Volume144 = $_POST['movie-volume144'];
@$Watch1080 = $_POST['movie-wurl1080'];
@$Watch720 = $_POST['movie-wurl720'];
@$Watch480 = $_POST['movie-wurl480'];
@$Watch360 = $_POST['movie-wurl360'];
@$Watch244 = $_POST['movie-wurl244'];
@$Watch144 = $_POST['movie-wurl144'];
@$download1080 = $_POST['movie-durl1080'];
@$download720   = $_POST['movie-durl720'];
@$download480 = $_POST['movie-durl480'];
@$download360 = $_POST['movie-durl360'];
@$download244 = $_POST['movie-durl244'];
@$download144 = $_POST['movie-durl144'];

$EpsodeID = $_SERVER['QUERY_STRING'];

$sqlEdit = "UPDATE epsodes SET EpsodeNum = '$EpsodeNum',IsLast = '$IsLast',Sesson = '$Sesson',`movie-volume1080` = '$Volume1080',`movie-volume720` = '$Volume720',`movie-volume480` = '$Volume480',`movie-volume360` = '$Volume360',`movie-volume244` = '$Volume244',`movie-volume144` = '$Volume144',`movie-wurl1080` = '$Watch1080',`movie-wurl720` = '$Watch720',`movie-wurl480` = '$Watch480',`movie-wurl360` = '$Watch360',`movie-wurl244` = '$Watch244',`movie-wurl144` = '$Watch144',`movie-durl1080` = '$download1080',`movie-durl720` = '$download720',`movie-durl480` = '$download480',`movie-durl360` = '$download360',`movie-durl244` = '$download244',`movie-durl144` = '$download144' WHERE EpsodeID = '$EpsodeID'";

if (isset($_POST['submit'])) {
  if (mysqli_query($conn, $sqlEdit)) {
    $screenMSG = 'تم تعديل الحلقة بنجاح';
  } else {
    $screenMSG = 'لم يتم تعديل الحلقة بنجاح' . mysqli_error($conn);
  }
}

$sql = "SELECT * FROM epsodes";
$result = mysqli_query($conn, $sql);
$row = $result->fetch_assoc();

// echo '<pre>';
// print_r($row);
// echo '</pre>';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>أضافة حلقة جديدة</title>
  <link rel="stylesheet" href="css/add-movie.css">
</head>

<body>
  <div class="containe">
    <p class="screen"><?php echo @$screenMSG; ?></p>
    <p class="title">أضافة حلقة جديدة</p>
    <form action="" method="POST">
      <div class="r1">
        <p class="head">تفاصيل الحلقة</p>
        <div class="right" style="width: 100%;">
          <div class="input-feild">
            <label for="movie-name1">معرف المسلسل</label>
            <input readonly value="<?php echo $Series; ?>" id="movie-name1" type="number" name="movie-name1" placeholder="اكتب اسم المسلسل بالانجليزية" required>
          </div>
          <div class="input-feild">
            <label for="movie-name2">رقم الحلقة</label>
            <input list="epsode" name="movie-name2" value="<?php echo $row['EpsodeNum']; ?>">
            <datalist id="epsode">
              <option value="الاولي">
              <option value="الثانية">
              <option value="الثالثة">
              <option value="الرابعة">
              <option value="الخامسة">
              <option value="السادسة">
              <option value="السابعة">
              <option value="الثامنة">
              <option value="التاسعة">
              <option value="العاشرة">
              <option value="الحادية عشر">
              <option value="الثانية عشر">
              <option value="الثالثة عشر">
              <option value="الرابعة عشر">
              <option value="الخامسة عشر">
              <option value="السادسة عشر">
              <option value="السابعة عشر">
              <option value="الثامنة عشر">
              <option value="التاسعة عشر">
              <option value="العشرون">
              <option value="الواحد و العشرون">
              <option value="الثانية و العشرون">
              <option value="الثالثة و العشرون">
              <option value="الرابعة و العشرون">
              <option value="الخامسة و العشرون">
              <option value="السادسة و العشرون">
              <option value="السابعة و العشرون">
              <option value="الثامنة و العشرون">
              <option value="التاسعة و العشرون">
              <option value="الثلاثون">
              <option value="الواحد و ثلاثون">
              <option value="الثانية و الثلاثون">
              <option value="الثالثة و الثلاثون">
              <option value="الرابعة و الثلاثون">
              <option value="الخامسة و الثلاثون">
              <option value="السادسة و الثلاثون">
              <option value="السابعة و الثلاثون">
              <option value="الثامنة و الثلاثون">
              <option value="التاسعة و الثلاثون">
              <option value="الاربعون">
            </datalist>
          </div>
          <div class="input-feild">
            <label for="movie-name2">هل هي الحلقة الاخيرة</label>
            <select name="islast" id="islast" value="<?php echo $row['IsLast']; ?>">
              <option selected value="no">ليست الاخيرة</option>
              <option value="yes">الاخيرة</option>
            </select>
          </div>
          <div class="input-feild">
            <label for="sesson">الموسم </label>
            <input list="sesson" value="<?php echo $row['Sesson']; ?>">
            <datalist id="sesson">
              <option value="الاول">
              <option value="الثاني">
              <option value="الثالث">
              <option value="الرابع">
              <option value="الخامس">
              <option value="السادس">
              <option value="السابع">
              <option value="الثامن">
              <option value="التاسع">
              <option value="العاشر">
            </datalist>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="r2">
        <p class="head">احجام الملفات</p>
        <div class="right" style="width: 100%;">

          <div class="input-feild">
            <label for="movie-volume1080">حجم الـ1080</label>
            <input value="<?php echo $row['movie-volume1080']; ?>" id="movie-volume1080" type="text" name="movie-volume1080" placeholder="اكتب حجم الـ1080">
          </div>
          <div class="input-feild">
            <label for="movie-volume720">حجم الـ720</label>
            <input value="<?php echo $row['movie-volume720']; ?>" id="movie-volume720" type="text" name="movie-volume720" placeholder="اكتب حجم الـ720">
          </div>
          <div class="input-feild">
            <label for="movie-volume480">حجم الـ480</label>
            <input value="<?php echo $row['movie-volume480']; ?>" id="movie-volume480" type="text" name="movie-volume480" placeholder="اكتب حجم الـ480">
          </div>
          <div class="input-feild">
            <label for="movie-volume360">حجم الـ360</label>
            <input value="<?php echo $row['movie-volume360']; ?>" id="movie-volume360" type="text" name="movie-volume360" placeholder="اكتب حجم الـ360">
          </div>
          <div class="input-feild">
            <label for="movie-volume244">حجم الـ244</label>
            <input value="<?php echo $row['movie-volume244']; ?>" id="movie-volume244" type="text" name="movie-volume244" placeholder="اكتب حجم الـ244">
          </div>
          <div class="input-feild">
            <label for="movie-volume144">حجم الـ144</label>
            <input value="<?php echo $row['movie-volume144']; ?>" id="movie-volume144" type="text" name="movie-volume144" placeholder="اكتب حجم الـ144">
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="r3">
        <p class="head">روابط التحميل و المشاهدة</p>
        <div class="right">
          <div class="input-feild">
            <label for="movie-wurl1080">مشاهدة الـ1080</label>
            <input value="<?php echo $row['movie-wurl1080']; ?>" id="movie-wurl1080" type="url" name="movie-wurl1080" placeholder="اكتب رابط مشاهدة الـ1080">
          </div>
          <div class="input-feild">
            <label for="movie-wurl720">مشاهدة الـ720</label>
            <input value="<?php echo $row['movie-wurl720']; ?>" id="movie-wurl720" type="url" name="movie-wurl720" placeholder="اكتب رابط مشاهدة الـ720">
          </div>
          <div class="input-feild">
            <label for="movie-wurl480">مشاهدة الـ480</label>
            <input value="<?php echo $row['movie-wurl480']; ?>" id="movie-wurl480" type="url" name="movie-wurl480" placeholder="اكتب رابط مشاهدة الـ480">
          </div>
          <div class="input-feild">
            <label for="movie-wurl360">مشاهدة الـ360</label>
            <input value="<?php echo $row['movie-wurl360']; ?>" id="movie-wurl360" type="url" name="movie-wurl360" placeholder="اكتب رابط مشاهدة الـ360">
          </div>
          <div class="input-feild">
            <label for="movie-wurl244">مشاهدة الـ244</label>
            <input value="<?php echo $row['movie-wurl244']; ?>" id="movie-wurl244" type="url" name="movie-wurl244" placeholder="اكتب رابط مشاهدة الـ244">
          </div>
          <div class="input-feild">
            <label for="movie-wurl144">مشاهدة الـ144</label>
            <input value="<?php echo $row['movie-wurl144']; ?>" id="movie-wurl144" type="url" name="movie-wurl144" placeholder="اكتب رابط مشاهدة الـ144">
          </div>
        </div>
        <div class="left">
          <div class="input-feild">
            <label for="movie-durl1080">تحميل الـ1080</label>
            <input value="<?php echo $row['movie-durl1080']; ?>" id="movie-durl1080" type="url" name="movie-durl1080" placeholder="اكتب رابط تحميل الـ1080">
          </div>
          <div class="input-feild">
            <label for="movie-durl720">تحميل الـ720</label>
            <input value="<?php echo $row['movie-durl720']; ?>" id="movie-durl720" type="url" name="movie-durl720" placeholder="اكتب رابط تحميل الـ720">
          </div>
          <div class="input-feild">
            <label for="movie-durl480">تحميل الـ480</label>
            <input value="<?php echo $row['movie-durl480']; ?>" id="movie-durl480" type="url" name="movie-durl480" placeholder="اكتب رابط تحميل الـ480">
          </div>
          <div class="input-feild">
            <label for="movie-durl360">تحميل الـ360</label>
            <input value="<?php echo $row['movie-durl360']; ?>" id="movie-durl360" type="url" name="movie-durl360" placeholder="اكتب رابط تحميل الـ360">
          </div>
          <div class="input-feild">
            <label for="movie-durl244">تحميل الـ244</label>
            <input value="<?php echo $row['movie-durl244']; ?>" id="movie-durl244" type="url" name="movie-durl244" placeholder="اكتب رابط تحميل الـ244">
          </div>
          <div class="input-feild">
            <label for="movie-durl144">تحميل الـ144</label>
            <input value="<?php echo $row['movie-durl144']; ?>" id="movie-durl144" type="url" name="movie-durl144" placeholder="اكتب رابط تحميل الـ144">
          </div>
        </div>
        <div class="input-submit">
          <input name="submit" type="submit" value="اضافة الحلقة">
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