<?php

session_start();

require_once '../config.php';

if (!($_SESSION['UserEmail'] == 'admin@admin.com')) {
  header("Location:404.php");
}
require_once '../config.php';
$ActorID = $_SERVER['QUERY_STRING'];
$sql = "DELETE FROM actors WHERE ActorID = '$ActorID'";

if (mysqli_query($conn, $sql)) {
  echo 'تم حذف الممثل بنجاح';
} else {
  echo 'لم يتم حذف الممثل';
}
header("Refresh:2;url = sh-actors.php");
