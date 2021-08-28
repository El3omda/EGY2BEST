<?php

session_start();

require_once '../config.php';

if (!($_SESSION['UserEmail'] == 'admin@admin.com')) {
  header("Location:404.php");
}
require_once '../config.php';
include_once '../bottom-nav.php';

@$CatName = $_POST['cat-name'];

$sql = "INSERT INTO langs (Lang) VALUES ('$CatName')";

if (isset($_POST['submit'])) {
  if (mysqli_query($conn, $sql)) {
    $screenMSG = 'تم اضافة التصنيف بنجاح';
  } else {
    $screenMSG = 'التصنيف موجود بالفعل';
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>أضافة لغة جديدة</title>
  <link rel="stylesheet" href="css/add-movie.css">
</head>

<body>
  <div class="containe">
    <p class="screen"><?php echo @$screenMSG; ?></p>
    <p class="title">أضافة لغة جديدة</p>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <div class="r1">
        <p class="head">تفاصيل اللغة</p>
        <div class="right" style="min-height: 100px;">
          <div class="input-feild">
            <label for="actor-name"> اللغة</label>
            <input id="actor-name" type="text" name="cat-name" placeholder="اكتب اللغة" required>
          </div>
        </div>

      </div>
      <div class="clearfix"></div>
      <div class="input-submit" style="text-align:center;">
        <input name="submit" type="submit" value="اضافة التصنيف">
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