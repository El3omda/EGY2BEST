<?php

session_start();

require_once '../config.php';

if (!($_SESSION['UserEmail'] == 'admin@admin.com')) {
  header("Location:404.php");
}

@$ActorName = $_POST['actor-name'];
@$ArabicName = $_POST['actor-nameAR'];
@$ActorCountry = $_POST['actor-country'];
@$ActorImage = $_POST['actor-imdb-img'];

$sql = "INSERT INTO actors (ActorName,ActorCountry,ActorImage,ArabicName) VALUES ('$ActorName','$ActorCountry','$ActorImage','$ArabicName')";

if (isset($_POST['submit'])) {
  if (mysqli_query($conn, $sql)) {
    $screenMSG = 'تم اضافة الممثل بنجاح';
  } else {
    $screenMSG = 'الممثل موجود بالفعل';
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>أضافة ممثل جديد</title>
  <link rel="stylesheet" href="css/add-movie.css">
</head>

<body>

  <?php include_once '../bottom-nav.php'; ?>
  <div class="containe">
    <p class="screen"><?php echo @$screenMSG; ?></p>
    <p class="title">أضافة ممثل جديد</p>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <div class="r1">
        <p class="head">تفاصيل الممثل</p>
        <div class="right" style="min-height: 100px;">
          <div class="input-feild">
            <label for="actor-name">اسم الممثل</label>
            <input id="actor-name" type="text" name="actor-name" placeholder="اكتب اسم الممثل">
          </div>
          <div class="input-feild">
            <label for="actor-name">اسم الممثل لو عربي</label>
            <input id="actor-name" type="text" name="actor-nameAR" placeholder="اكتب اسم الممثل">
          </div>
          <div class="input-feild">
            <label for="actor-country">جنسية الممثل</label>
            <input id="actor-country" type="text" name="actor-country" placeholder="اكتب جنسية الممثل" required>
          </div>
        </div>
        <div class="left" style="min-height: 100px;">
          <div class="input-feild">
            <label for="actor-imdb-img">صورة الممثل</label>
            <input id="actor-imdb-img" type="url" name="actor-imdb-img" placeholder="Wiki اكتب رابط صورة الممثل" required>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="input-submit" style="text-align:center;">
        <input name="submit" type="submit" value="اضافة الممثل">
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