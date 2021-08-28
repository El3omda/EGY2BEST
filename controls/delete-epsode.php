<?php

session_start();

require_once '../config.php';

if (!($_SESSION['UserEmail'] == 'admin@admin.com')) {
  header("Location:404.php");
}
require_once '../config.php';
$CatID = $_SERVER['QUERY_STRING'];
$sql = "DELETE FROM epsodes WHERE EpsodeID = '$CatID'";

if (mysqli_query($conn, $sql)) {
  echo 'تم حذف الحلقة بنجاح';
} else {
  echo 'لم يتم حذف الحلقة';
}
header("Refresh:2;url = sh-epsode.php");
