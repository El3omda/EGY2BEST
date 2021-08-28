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
  <title>عرض المستخدمين</title>
  <link rel="stylesheet" href="css/sh-series.css">
</head>

<body>
  <div class="cont">
    <p class="title">عرض و تعديل و حذف المستخدمين</p>

    <div class="table-box">
      <table>
        <tr>
          <th>action</th>
          <th>المعرف</th>
          <th>اسم</th>
          <th>الايمال</th>
          <th>الباسورد</th>
          <th>النوع</th>
        </tr>
        <tr>
          <td>
            <span><a href="delete-user.php"><i class="fa fa-trash"></i></a></span>
          </td>
          <td>1</td>
          <td>hassan ahmed</td>
          <td>hassanahmed@gmail.com</td>
          <td>0147852369</td>
          <td>ذكر</td>
        </tr>
      </table>
    </div>
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