<?php

session_start();

require_once '../config.php';

if (!($_SESSION['UserEmail'] == 'admin@admin.com')) {
  header("Location:404.php");
}
require_once '../config.php';
include_once '../bottom-nav.php';

$CatID = $_SERVER['QUERY_STRING'];

$sql = "SELECT * FROM cats WHERE CatID = '$CatID'";

$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
}

@$CatName = $_POST['cat-name'];
@$CatName2 = $_POST['cat-name2'];

$sqlEdit = "UPDATE cats SET CatName = '$CatName',CatName2 = '$CatName2' WHERE CatID = '$CatID'";

if (isset($_POST['submit'])) {
  if (mysqli_query($conn, $sqlEdit)) {
    $screenMSG = 'تم تعديل بيانات التصنيف بنجاح';
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
  <title>تعديل بيانات التصنيف </title>
  <link rel="stylesheet" href="css/add-movie.css">
</head>

<body>
  <div class="containe">
    <p class="screen"><?php echo @$screenMSG; ?></p>
    <p class="title">تعديل بيانات التصنيف</p>
    <form action="" method="POST">
      <div class="r1">
        <p class="head">تفاصيل الممثل</p>
        <div class="right" style="min-height: 200px;">
          <div class="input-feild">
            <label for="cat-name">اسم التصنيف عربي</label>
            <input value="<?php echo $row['CatName']; ?>" id="cat-name" type="text" name="cat-name" placeholder="اكتب اسم الممثل" required>
          </div>
          <div class="input-feild">
            <label for="cat-name">اسم التصنيف انجليزي</label>
            <input value="<?php echo $row['CatName2']; ?>" id="cat-name" type="text" name="cat-name2" placeholder="اكتب اسم الممثل" required>
          </div>
        </div>
        <div class="input-submit" style="text-align:center;">
          <input name="submit" type="submit" value="تعديل التصنيف">
        </div>
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