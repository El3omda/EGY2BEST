<?php

session_start();

require_once '../config.php';

if (!($_SESSION['UserEmail'] == 'admin@admin.com')) {
  header("Location:404.php");
}
require_once '../config.php';
$MovieID = $_SERVER['QUERY_STRING'];
$sql = "DELETE FROM series WHERE ID = '$MovieID'";

if (mysqli_query($conn, $sql)) {
  echo 'تم حذف المسلسل بنجاح';
} else {
  echo 'لم يتم حذف المسلسل' . mysqli_error($conn);
}
header("Refresh:2;url = sh-series.php");
