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
  <title>لوحة التحكم</title>
  <style>
    .conta {
      position: absolute;
      top: 45%;
      left: 50%;
      transform: translate(-50%, -50%);
      text-align: center;
      font-weight: bold;
      font-size: 18px;
      background-color: #405de6;
    }

    a.con {
      display: block;
      padding: 10px;
      color: #fff;
      border: 1px solid #405de6;
      transition: all .3s;
    }

    .con:hover {
      color: #405de6;
      background-color: #fff;
    }
  </style>
</head>

<body>
  <a href="../signout.php">تسجيل الخروج</a>
  <div class="conta">
    <a class="con" href="add-actor.php">اضافة ممثل</a>
    <a class="con" href="add-movie.php">اضافة فيلم او مسرحية</a>
    <a class="con" href="add-series.php">اضافة مسلسل</a>
    <a class="con" href="sh-series.php">عرض المسلسلات</a>
    <a class="con" href="sh-epsode.php">عرض حلقات المسلسلات</a>
    <a class="con" href="sh-movies.php">عرض الافلام و المسرحيات</a>
    <a class="con" href="sh-actors.php">عرض الممثلين</a>
    <a class="con" href="sh-users.php">عرض المستخدمين</a>
    <a class="con" href="add-category.php">اضافة تصنيف</a>
    <a class="con" href="sh-category.php">عرض و تعديل التصنيفات</a>
  </div>

  <script>
    var bottomLink = document.querySelectorAll('.bottom-nav ul li a');
    bottomLink[0].href = '../index.php';
    bottomLink[1].href = '#';
    bottomLink[2].href = '../movies.php';
    bottomLink[3].href = '../series.php';
    bottomLink[4].href = '../plays.php';
    bottomLink[5].href = '../animations.php';
    bottomLink[6].href = '#';
    bottomLink[7].href = '../categores.php';
    bottomLink[8].href = '../new.php';
  </script>
</body>

</html>