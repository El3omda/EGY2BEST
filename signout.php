<?php
session_start();


session_destroy();


header("Refresh:2;url = index.php");


?>
<style>
  @font-face {
    font-family: cairo;
    src: url('fonts/cairo.ttf');
  }

  .container {
    width: 90%;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    font-size: 40px;
    font-family: cairo, Arial, Helvetica, sans-serif;
  }
</style>
<div class="container">
  <img src="https://images6.fanpop.com/image/photos/39700000/SpongeBob-sticker-spongebob-squarepants-39750367-500-500.gif" alt="">
  <p>تم تسجيل الخروج بنجاح</p>
</div>