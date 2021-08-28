<?php

require_once 'config.php';
$QueryString = $_REQUEST['Media'];
$MediaName = str_replace("-", " ", $QueryString);
$sql = "SELECT * FROM movies WHERE MovieName1 = '$MediaName'";
$result = mysqli_query($conn, $sql);
$row = $result->fetch_assoc();


$Quality = $_REQUEST['Qual'];

// Get MediaFire Link

if ($Quality == "Low") {
  $html = file_get_contents($row['Watch144']);
} else {
  $html = file_get_contents($row['Watch480']) or 'emad';
}

$stscrap = explode('aria-label="Download file"', $html);
$enscrap = explode('id="downloadButton">', $stscrap[1]);
$watchLink = str_replace("href=", "src=", $enscrap[0]);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>مشاهدة
    <?php
    if ($row['MovieLang'] == 'العربية') {
      echo $row['MovieName2'];
    } else {
      echo $row['MovieName1'];
    }
    ?>
    اونلاين</title>
  <link rel="stylesheet" href="css/watch.css">
</head>

<body style="height:150vh">

  <?php include_once 'nav.php'; ?>
  <?php include_once 'bottom-nav.php'; ?>
  <p style="font-size: 20px;font-weight:bold;text-align:center"> مشاهدة
    <?php
    if ($row['MovieLang'] == 'العربية') {
      echo $row['MovieName2'];
    } else {
      echo $row['MovieName1'];
    }
    ?>
    اونلاين</p>
  <div class="tv-container">

    <!-- Start Antana -->

    <div class="antena-right"></div>
    <div class="antena-left"></div>

    <!-- End Antana -->

    <!-- Start Tv Borders -->

    <div class="outlayer">
      <video id="vid" style="width:100%;height:100%;border-radius:50px;" <?php echo $watchLink ?> controls></video>
    </div>

    <!-- End Tv Borders -->

    <!-- Start Tv Controls -->

    <div class="tv-controls">
      <p class="name">Play</p>
      <div class="switch quality">
        <div class="pointer"></div>
      </div>
    </div>


    <div class="tv-controls1">
      <p class="name">Quality</p>
      <div class="switch">
        <div class="pointer"></div>
      </div>
    </div>


    <!-- End Tv Controls -->

    <!-- Start Tv Stand -->

    <div class="tv-stand">
      <div class="tv-right"></div>
      <div class="tv-left"></div>
    </div>

    <!-- End Tv Stand -->

  </div>
  <script>
    var controls = document.querySelector(".tv-controls");
    var controlsSwetch = document.querySelector(".tv-controls .switch");
    var controls1 = document.querySelector(".tv-controls1");
    var controls1Swetch = document.querySelector(".tv-controls1 .switch");
    var vid = document.querySelector("#vid");

    if (controls) {
      controls.onclick = function() {
        controlsSwetch.classList.toggle('on')
        if (controlsSwetch.classList.contains("on")) {
          vid.play();
        } else {
          vid.pause();
        }
      }
    }
    pathname = window.location.pathname;
    oldSearch = window.location.search;
    searchToArray = oldSearch.split("&");
    mediaName = searchToArray[0];
    quality = searchToArray[1];
    if (controls1) {
      controls1.onclick = function() {
        controls1Swetch.classList.toggle('on')
        if (controls1Swetch.classList.contains("on")) {
          location.replace(location.protocol + "//" + location.host + location.pathname + mediaName + "&Qual=High")
        }
        if (!controls1Swetch.classList.contains("on")) {
          location.replace(location.protocol + "//" + location.host + location.pathname + mediaName + "&Qual=Low")
        }
      }
    }
    if (location.href == (location.protocol + "//" + location.host + location.pathname + mediaName + "&Qual=High")) {
      controls1Swetch.classList.add("on")
    } else {
      if (controls1Swetch.classList.contains("on")) {
        controls1Swetch.classList.remove("on")
      }
    }
  </script>
</body>

</html>