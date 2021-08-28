<?php

include_once 'loader.php';
include_once 'nav.php';
include_once 'bottom-nav.php';

// Connect To DB
require_once 'config.php';

$sql = "SELECT * FROM cats";
$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>الاقسام</title>
  <style>
    .main-container {
      width: 95%;
      margin: 0 auto 80px;
      overflow: hidden;
    }

    .main-container form {
      float: left;
      margin: 15px;
      width: calc(100% / 6);
    }

    input[type="submit"]:not(nav input[type="submit"]) {
      width: 100%;
      height: 50px;
      background: linear-gradient(45deg, #405de6, #5851db, #833ab4, #c13584, #e1306c, #fd1d1d);
      color: #fff;
      border: 2px solid #fd1d1d;
      outline: none;
      cursor: pointer;
      font-size: 20px;
      font-weight: bold;
      border-radius: 5px;
      transition: all .3s;
    }

    input[type="submit"]:hover {
      background: #fff;
      color: #405de6;
    }

    @media (max-width:950px) {
      .main-container form {
        width: calc((100% / 5) - 30px);
      }
    }

    @media (max-width:650px) {
      .main-container form {
        width: calc((100% / 3) - 30px);
      }
    }

    @media (max-width:400px) {
      .main-container form {
        width: calc((100% / 2) - 30px);
      }
    }
  </style>
</head>

<body>

  <div class="main-container">
    <?php
    while ($row = $result->fetch_assoc()) {
      echo '
      <form action="search.php?Cat=' . $row['CatName2'] . '" method="POST">
        <input type="submit" name="' . $row['CatName2'] . '" value="' . $row['CatName'] . '">
      </form>
      ';
    }
    ?>
  </div>
  <script>
    window.onload = function() {
      $('.loader-container').fadeOut(1000);
    }
  </script>
</body>

</html>