<link rel="shortcut icon" href="imgs/favicon.png">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/normal.css">
<style>
  p.screen {
    text-align: center;
    font-weight: bold;
  }

  * {
    padding: 0;
    margin: 0;
  }

  @font-face {
    font-family: cairo;
    src: url(fonts/cairo.ttf);
  }

  html {
    line-height: unset;
  }

  body {
    font-family: cairo, Arial, Helvetica, sans-serif;
  }

  a {
    text-decoration: none;
  }

  .bottom-nav {
    position: fixed;
    bottom: 0;
    right: 0;
    left: 0;
    z-index: 100;
  }

  .bottom-nav ul {
    list-style-type: none;
    user-select: none;
    border: 1px solid #000;
    border-top-left-radius: 30px;
    border-top-right-radius: 30px;
    padding-top: 10px;
    background-color: #2C2E43;
  }

  .bottom-nav ul li {
    display: inline-block;
    width: calc((100% / 5) - 5px);
    text-align: center;
  }

  .container {
    position: absolute;
    bottom: -1px;
    width: 100%;
  }

  .bottom-nav ul li:nth-of-type(3) {
    position: absolute;
    top: -35px;
    margin: auto;
    border-radius: 50%;
    width: 80px;
    height: 80px;
    left: 50%;
    transform: translateX(-50%);
    background: linear-gradient(45deg, #405de6, #5851db, #833ab4, #c13584, #e1306c, #fd1d1d);
  }

  .bottom-nav ul li:nth-of-type(3) i {
    line-height: 80px;
    color: #fff;
    cursor: pointer;
    font-size: 35px;
  }

  .bottom-nav ul li:nth-of-type(3) i:hover {
    color: #fff;
  }

  .bottom-nav ul li i {
    font-size: 25px;
    display: block;
    color: #fff;
    transition: all .3s;
  }

  .bottom-nav ul li i:hover,
  .bottom-nav ul li a:hover {
    color: #e1306c;
  }

  .bottom-nav ul li a {
    transition: all .3s;
    color: #fff;
  }

  .circle {
    position: relative;
  }

  .circle p {
    position: absolute;
    background: linear-gradient(45deg, #405de6, #5851db, #833ab4, #c13584, #e1306c, #fd1d1d);
    line-height: 50px;
    border-radius: 50%;
  }

  .circle p:first-of-type {
    left: 0;
    bottom: 0;
    width: 70px;
    height: 70px;
    display: none;
  }

  .circle p:nth-of-type(2) {
    left: 0;
    bottom: 0;
    width: 70px;
    height: 70px;
    display: none;
  }

  .circle p:nth-of-type(3) {
    left: 0;
    bottom: 0;
    width: 70px;
    height: 70px;
    display: none;
  }

  .circle p:nth-of-type(4) {
    left: 0;
    bottom: 0;
    width: 70px;
    height: 70px;
    display: none;
  }

  .circle p:nth-of-type(5) {
    left: 0;
    bottom: 0;
    width: 70px;
    height: 70px;
    display: none;
  }

  .circle p a {
    color: #fff !important;
  }

  .circle p a i {
    color: #fff !important;
    font-size: 25px !important;
    line-height: 44px !important;
  }

  .circle p span {
    display: block;
    font-size: 15px;
    margin: -22px 0;
  }

  @media (max-width:550px) {
    .bottom-nav ul li a {
      font-size: 12px;
    }

    .bottom-nav ul li i {
      font-size: 20px;
    }

    .bottom-nav ul li:nth-of-type(3) i {
      font-size: 30px;
      line-height: 75px;
    }

    .bottom-nav ul li:nth-of-type(3) {
      width: 70px;
      height: 70px;
    }

    .circle p a i {
      font-size: 19px !important;
    }

    .circle p:nth-of-type(1),
    .circle p:nth-of-type(2),
    .circle p:nth-of-type(3),
    .circle p:nth-of-type(4),
    .circle p:nth-of-type(5) {
      width: 60px;
      height: 60px;
    }

    .circle p:first-of-type {
      left: 75px;
      bottom: 46px;
    }

    .circle p:nth-of-type(3) {
      left: -25px;
      bottom: 100px;
    }

    .circle p:nth-of-type(4) {
      left: -66px;
      bottom: 44px;
    }

    .circle p:nth-of-type(5) {
      bottom: 180px;
      left: 12px;
    }

    .circle p:nth-of-type(2) {
      left: 39px;
      bottom: 100px;
    }

    .circle p span {
      font-size: 10px !important;
      font-weight: bold;
    }

    .circle p:not(:first-of-type) span {
      margin-top: -27px;
    }
  }

  .slide1up {
    animation: slide1up 1s forwards;
  }

  .slide1down {
    animation: slide1down 1s forwards;
  }

  .slide2up {
    animation: slide2up 1s forwards;
  }

  .slide2down {
    animation: slide2down 1s forwards;
  }

  .slide3up {
    animation: slide3up 1s forwards;
  }

  .slide3down {
    animation: slide3down 1s forwards;
  }

  .slide4up {
    animation: slide4up 1s forwards;
  }

  .slide4down {
    animation: slide4down 1s forwards;
  }

  .slide5up {
    animation: slide5up 1s forwards;
  }

  .slide5down {
    animation: slide5down 1s forwards;
  }

  @keyframes slide1up {
    0% {
      left: 6px;
      bottom: 3px;

    }

    100% {
      left: 90px;
      bottom: 50px;
    }
  }

  @keyframes slide1down {
    0% {
      left: 90px;
      bottom: 50px;
    }

    100% {
      left: 6px;
      bottom: 3px;
    }
  }

  @keyframes slide2up {
    0% {
      left: 6px;
      bottom: 4px;
    }

    100% {
      left: 50px;
      bottom: 116px;
    }
  }

  @keyframes slide2down {
    0% {
      left: 50px;
      bottom: 116px;
    }

    100% {
      left: 6px;
      bottom: 4px;
    }
  }

  @keyframes slide3up {
    0% {
      left: 1px;
      bottom: 0px;
    }

    100% {
      left: -29px;
      bottom: 119px;
    }
  }

  @keyframes slide3down {
    0% {
      left: -29px;
      bottom: 119px;
    }

    100% {
      left: 1px;
      bottom: 0px;
    }
  }

  @keyframes slide4up {
    0% {
      left: 1px;
      bottom: 0px;
    }

    100% {
      left: -76px;
      bottom: 50px;
    }
  }

  @keyframes slide4down {
    0% {
      left: -76px;
      bottom: 50px;
    }

    100% {
      left: 1px;
      bottom: 0px;
    }
  }

  @keyframes slide5up {
    0% {
      left: 1px;
      bottom: 0px;
    }

    100% {
      bottom: 180px;
      left: 12px;
    }
  }

  @keyframes slide5down {
    0% {
      bottom: 180px;
      left: 12px;
    }

    100% {
      left: 1px;
      bottom: 0px;
    }
  }

  .close {
    color: #F00;
    position: absolute;
    text-align: center;
    border-radius: 50%;
    width: 25px;
    height: 25px;
    background-color: #333;
    overflow: hidden;
    line-height: 25px;
    border: 1px solid #f00;
    cursor: pointer;
  }
</style>

<div class="container" style="direction: rtl;">
  <div class="bottom-nav">
    <div class="close"><i class="fa fa-arrow-down"></i></div>
    <ul>
      <li><a href="index.php"><i class="fa fa-home fa-1x"></i>الرئيسية</a></li>
      <li><a class="search"><i style="cursor: pointer;" class="fa fa-search fa-1x"></i>البحث</a></li>
      <li class="open-cat"><i class="fa fa-desktop fa-1x"></i>
        <div class="circle">
          <p><a href="movies.php"><i class="fa fa-film"></i><span>افلام</span></a></p>
          <p><a href="series.php"><i class="fa fa-video-camera"></i><span>مسلسلات</span></a></p>
          <p><a href="plays.php"><i class="fa fa-users"></i><span>مسرحيات</span></a></p>
          <p><a href="animations.php"><i class="fa fa-gamepad"></i><span>انيميشن</span></a></p>
          <?php
          if (isset($_SESSION['UserEmail'])) {
            if ($_SESSION['UserEmail'] == 'admin@admin.com') {
              echo '
                 <p><a href="controls/controls.php"><i class="fa fa-cogs"></i><span>التحكم</span></a></p>
                ';
            } else {
              echo '
                    <p><a href="user-profile.php"><i class="fa fa-user"></i><span>مكتبتك</span></a></p>
                    ';
            }
          }
          ?>
        </div>
      </li>
      <li class="open-cat"><i class=""></i></li>
      <li><a href="categores.php"><i class="fa fa-tags fa-1x"></i>الاقسام</a></li>
      <li><a href="new.php"><i class="fa fa-fire fa-1x"></i>جديد</a></li>
    </ul>
  </div>
</div>
<script src="js/jquery.main.js"></script>
<script>
  var screen = document.querySelector('.open-cat'),
    catBox = document.querySelectorAll('.circle p');

  screen.onclick = function() {
    if (catBox[0].classList.contains('slide1up')) {
      catBox[0].classList.remove("slide1up");
      catBox[0].classList.add("slide1down");
    } else {
      catBox[0].classList.remove("slide1down");
      catBox[0].classList.add("slide1up");
    }
    if (catBox[0].classList.contains('slide1down')) {
      $(catBox[0]).fadeOut()
    } else {
      $(catBox[0]).fadeIn()
    }

    if (catBox[1].classList.contains('slide2up')) {
      catBox[1].classList.remove("slide2up");
      catBox[1].classList.add("slide2down");
    } else {
      catBox[1].classList.remove("slide2down");
      catBox[1].classList.add("slide2up");
    }
    if (catBox[1].classList.contains('slide2down')) {
      $(catBox[1]).fadeOut()
    } else {
      $(catBox[1]).fadeIn()
    }


    if (catBox[2].classList.contains('slide3up')) {
      catBox[2].classList.remove("slide3up");
      catBox[2].classList.add("slide3down");
    } else {
      catBox[2].classList.remove("slide3down");
      catBox[2].classList.add("slide3up");
    }
    if (catBox[2].classList.contains('slide3down')) {
      $(catBox[2]).fadeOut()
    } else {
      $(catBox[2]).fadeIn()
    }

    if (catBox[3].classList.contains('slide4up')) {
      catBox[3].classList.remove("slide4up");
      catBox[3].classList.add("slide4down");
    } else {
      catBox[3].classList.remove("slide4down");
      catBox[3].classList.add("slide4up");
    }
    if (catBox[3].classList.contains('slide4down')) {
      $(catBox[3]).fadeOut()
    } else {
      $(catBox[3]).fadeIn()
    }
    if (catBox[4]) {
      if (catBox[4].classList.contains('slide5up')) {
        catBox[4].classList.remove("slide5up");
        catBox[4].classList.add("slide5down");
      } else {
        catBox[4].classList.remove("slide5down");
        catBox[4].classList.add("slide5up");
      }
      if (catBox[4].classList.contains('slide5down')) {
        $(catBox[4]).fadeOut()
      } else {
        $(catBox[4]).fadeIn()
      }
    }
  }
  var search = document.querySelector('.search');
  var close = document.querySelector('.close');
  var closei = document.querySelector('.close i');
  var botn = document.querySelector('.bottom-nav ul');
  var ser = document.querySelector('#ser');
  search.onclick = function() {
    $('.search-bar').fadeToggle();
    $('.search-bar').css('display', 'inline-block');
    window.scrollTo(0, 0);
  }
  close.onclick = function() {
    $(botn).slideToggle('slow', function() {
      if (botn.style.display == 'none') {
        close.style = "top:-30px;";

        closei.classList.remove('fa-arrow-down');
        closei.classList.add('fa-arrow-up');
      } else {
        close.style = "top:0;";
        closei.classList.remove('fa-arrow-up');
        closei.classList.add('fa-arrow-down');
      }
    })
  }
</script>