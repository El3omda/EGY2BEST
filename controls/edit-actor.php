<?php

session_start();

require_once '../config.php';

if (!($_SESSION['UserEmail'] == 'admin@admin.com')) {
  header("Location:404.php");
}
require_once '../config.php';
include_once '../bottom-nav.php';

$ActorID = $_SERVER['QUERY_STRING'];

$sql = "SELECT * FROM actors WHERE ActorID = '$ActorID'";

$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
}

@$ActorName = $_POST['actor-name'];
@$ArabicName = $_POST['actor-nameAR'];
@$ActorCountry = $_POST['actor-country'];
@$ActorImage = $_POST['actor-imdb-img'];

$sqlEdit = "UPDATE actors SET ActorName = '$ActorName', ActorCountry = '$ActorCountry', ActorImage = '$ActorImage',ArabicName = '$ArabicName' WHERE ActorID = '$ActorID'";

if (isset($_POST['submit'])) {
  if (mysqli_query($conn, $sqlEdit)) {
    $screenMSG = 'تم تعديل بيانات الممثل بنجاح';
  } else {
    $screenMSG = 'لم يتم تحديث البيانات بنجاح';
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>تعديل بيانات ممثل </title>
  <link rel="stylesheet" href="css/add-movie.css">
</head>

<body>
  <div class="containe">
    <p class="screen"><?php echo @$screenMSG; ?></p>
    <p class="title">تعديل بيانات ممثل</p>
    <form action="" method="POST">
      <div class="r1">
        <p class="head">تفاصيل الممثل</p>
        <div class="right" style="min-height: 200px;">
          <div class="input-feild">
            <label for="actor-name">اسم الممثل</label>
            <input value="<?php echo $row['ActorName']; ?>" id="actor-name" type="text" name="actor-name" placeholder="اكتب اسم الممثل" required>
          </div>
          <div class="input-feild">
            <label for="actor-nameAR">اسم الممثل</label>
            <input value="<?php echo $row['ArabicName']; ?>" id="actor-nameAR" type="text" name="actor-nameAR" placeholder="اكتب اسم الممثل" required>
          </div>
          <div class="input-feild">
            <label for="actor-name">جنسية الممثل</label>
            <input value="<?php echo $row['ActorCountry']; ?>" id="actor-country" type="text" name="actor-country" placeholder="اكتب جنسية الممثل" required>
          </div>
        </div>
        <div class="left" style="min-height: 200px;">
          <div class="input-feild">
            <label for="actor-imdb-img">صورة الممثل</label>
            <input value="<?php echo $row['ActorImage']; ?>" id="actor-imdb-img" type="url" name="actor-imdb-img" placeholder="imdb اكتب رابط صورة الممثل" required>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="input-submit" style="text-align:center;">
        <input name="submit" type="submit" value="تعديل الممثل">
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