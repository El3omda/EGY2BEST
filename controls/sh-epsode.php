<?php

session_start();

require_once '../config.php';

if (!($_SESSION['UserEmail'] == 'admin@admin.com')) {
  header("Location:404.php");
}
require_once '../config.php';
include_once '../bottom-nav.php';

$sql = "SELECT * FROM epsodes";
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
  echo '
    <div class="cont">
    <p class="title">عرض و تعديل و حذف الحلقات</p>

    <div class="table-box">
    <table>
    <tr>
      <th>action</th>
      <th>معرف المسلسل</th>
      <th>الحلقة</th>
      <th>الموسم</th>
    </tr>
  ';
  while ($row = $result->fetch_assoc()) {
    echo '
    <tr>
    <td>
      <span><a href="edit-epsode.php?' . $row["EpsodeID"] . '"><i class="fa fa-cog"></a></i></span>
      <span><a href="delete-epsode.php?' . $row["EpsodeID"] . '"><i class="fa fa-trash"></i></a></span>
    </td>
    <td>' . $row['SeriesID'] . '</td>
    <td>' . $row['EpsodeNum'] . '</td>
    <td>' . $row['Sesson'] . '</td>
  </tr>
    ';
  }

  echo '
  </table>
</div>
</div>
  ';
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>عرض الحلقات</title>
  <link rel="stylesheet" href="css/sh-series.css">
</head>

<body>

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