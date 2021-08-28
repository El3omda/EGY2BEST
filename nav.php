<?php
session_start();
?>
<link rel="shortcut icon" href="imgs/favicon.png">
<style>
  nav {
    overflow: hidden;
    padding: 10px;
    background: linear-gradient(45deg, #405de6, #5851db, #833ab4, #c13584, #e1306c, #fd1d1d);
    user-select: none;
  }

  .nav-container {
    width: 97%;
    margin: auto;
  }

  .logo {
    float: right;
    color: #fff;
    font-size: 22px;
    font-weight: bold;
    user-select: none;
  }

  nav ul {
    float: left;
    list-style: none;
  }

  nav ul li {
    display: inline-block;
    margin-right: 5px;
    font-size: 18px;
    background: #e1306c;
    border: 1px solid #e1306c;
    border-radius: 5px;
    transition: background-color .3s;
  }

  nav ul li a {
    display: inline-block;
    padding: 4px 10px;
    color: #fff;
  }

  nav ul li:hover {
    background-color: #405de6;
  }

  .result-box {
    position: absolute;
    top: 62px;
    right: 0;
    left: 0;
    /* width: 90%; */
    background-color: #F1F1F1;
    border: 1px solid #ccc;
    z-index: 100;
    display: none;
    overflow-y: scroll;
    overflow-x: hidden;
    max-height: 500px;
    padding-top: 30px;
  }

  /* .close1 {
    color: #e1306c;
    position: absolute;
    top: 60px;
    right: 40px;
    z-index: 100;
    font-size: 20px;
    display: none;
  } */

  /* .close1 i {
    cursor: pointer;
  } */

  @media (max-width: 380px) {
    nav ul li a {
      font-size: 13px;
      font-weight: bold;
    }
  }

  @media (max-width: 280px) {
    .nav-container {
      width: 99%;
    }

    nav ul li {
      margin-right: 2px;
    }

    nav ul li a {
      font-size: 12px;
      font-weight: bold;
      padding: 4px;
    }
  }

  .search-bar {
    display: none;
    width: 50%;
    height: 41px;
    outline: none;
    border: 1px solid #CCC;
    border-radius: 7px;
    direction: rtl;
    font-family: cairo, Arial, Helvetica, sans-serif;
    background-color: #fff;
  }

  .search-bar input {
    width: 88%;
    height: 100%;
    padding: 0 10px;
    border: none;
    outline: none;
    background-color: transparent;
  }

  .search-bar .btn-search {
    display: inline-block;
    width: 10%;
    font-size: 20px;
    text-align: center;
    cursor: pointer;
  }

  .disinbloc {
    display: inline-block;
  }

  @media(max-width:850px) {
    .search-bar .btn-search {
      width: 43px;
    }

    .search-bar input {
      width: 80%;
    }
  }

  @media (max-width:440px) {
    .search-bar input {
      width: 100%;
    }

    .search-bar .btn-search {
      width: 100%;
      color: #fff;
      background-color: #e1306c;
    }

  }
</style>

<nav>
  <div class="nav-container">
    <div class="logo">
      EGY<span>2</span>BEST
    </div>
    <div class="search-bar">
      <form action="search.php" method="POST" style="display: inline;">
        <input autocomplete="off" autofocus id="ser" name="search" type="search" placeholder="اكتب كلمة للبحث" onkeyup="getResultDB(this.value)" required />
        <!-- <input class="btn-search" type="submit" value="بحث"> -->
      </form>
    </div>
    <ul>
      <?php
      if (isset($_SESSION['UserName'])) {
        if ($_SESSION['UserEmail'] == 'admin@admin.com') {
          echo '<li><a href="controls/controls.php">لوحة التحكم</a></li>';
        } else {
          echo '<li><a href="user-profile.php">مكتبتك</a></li>';
        }
      } else {
        echo '
          <li><a href="login.php">دخول النادي</a></li>
          ';
      }
      ?>
    </ul>
  </div>
  <div class="result-box">

  </div>
  <!-- <div class="close1">
    <i class="fa fa-times"></i>
  </div> -->
</nav>
<script>
  function getResultDB(str) {
    document.querySelector(".result-box").style.display = "block";
    if (str == "") {
      document.querySelector(".result-box").innerHTML = "لا يوجد شئ لعرضة"
      return;
    } else {
      const xhttp = new XMLHttpRequest();
      xhttp.onload = function() {
        document.querySelector(".result-box").innerHTML = this.responseText;
      }
      xhttp.open("GET", "ajax.php?wordToSearch=" + str);
      xhttp.send();
    }
  }
  // var resultBox = document.querySelector('.result-box');
  // var close1 = document.querySelector('.close1');
  // if (resultBox.style.display == "none") {
  //   close1.style.display = "none";
  // } else {
  //   close1.style.display = "block";
  // }
</script>