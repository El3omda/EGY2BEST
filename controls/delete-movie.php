<?php

session_start();

require_once '../config.php';

if (!($_SESSION['UserEmail'] == 'admin@admin.com')) {
  header("Location:404.php");
}
require_once '../config.php';
$MovieID = $_SERVER['QUERY_STRING'];
$sql = "DELETE FROM movies WHERE MovieID = '$MovieID'";

if (mysqli_query($conn, $sql)) {
  echo 'تم حذف الفيلم بنجاح';
} else {
  echo 'لم يتم حذف الفيلم';
}
header("Refresh:2;url = sh-movies.php");
