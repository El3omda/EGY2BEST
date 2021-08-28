<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'egy2best';

@$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
  echo 'Error Connect To DB => ' . mysqli_connect_error();
}
