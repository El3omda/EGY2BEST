<?php

header("Refresh:3;url=../index.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>الصفحة غير موجودة</title>
  <style>
    .container {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      text-align: center;
      font-family: Arial, Helvetica, sans-serif;
      font-size: 20px;
      color: #333;
    }

    p:first-of-type {
      font-size: 80px;
      font-weight: bold;
      margin: 5px 0;
      color: #000;
    }
  </style>
</head>

<body>

  <div class="container">
    <p>404</p>
    <p>Not Found</p>
    <p>You Will Redirected After : <span class="seconds">3</span></p>
  </div>

  <script>
    var sec = document.querySelector('.seconds');
    var countdown = setInterval(function() {
      sec.innerHTML = parseInt(sec.innerHTML) - 1;
      if (sec.innerHTML == '0') {
        clearInterval(countdown);
        sec.innerHTML = 'Redirecting ...';
      }
    }, 1000);
  </script>
</body>

</html>