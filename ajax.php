<?php

require_once 'config.php';

$wordToSearch = $_REQUEST['wordToSearch'];
// Start Movies

// Search By Movie Name English Characters

$sqlMovieName1Caracter = "SELECT * FROM movies WHERE MovieName1 LIKE '$wordToSearch%' OR MovieName1 LIKE '%$wordToSearch' OR MovieName1 LIKE '_$wordToSearch%' OR MovieName1 LIKE '__$wordToSearch%' OR MovieName1 LIKE '____$wordToSearch%' OR MovieName1 LIKE '_____$wordToSearch%' OR MovieName1 LIKE '______$wordToSearch%'";
$resultMovieName1Caracter = mysqli_query($conn, $sqlMovieName1Caracter);


// Search By Movie Name Arabic Characters

$sqlMovieName2Caracter = "SELECT * FROM movies WHERE MovieName2 LIKE '$wordToSearch%' OR MovieName2 LIKE '%$wordToSearch' OR MovieName2 LIKE '_$wordToSearch%' OR MovieName2 LIKE '__$wordToSearch%' OR MovieName2 LIKE '____$wordToSearch%' OR MovieName2 LIKE '_____$wordToSearch%' OR MovieName2 LIKE '______$wordToSearch%'";
$resultMovieName2Caracter = mysqli_query($conn, $sqlMovieName2Caracter);



// Search By Year Characters

$sqlMovieYearCaracter = "SELECT * FROM movies WHERE MovieYear LIKE '$wordToSearch%' OR MovieYear LIKE '%$wordToSearch' OR MovieYear LIKE '_$wordToSearch%' OR MovieYear LIKE '__$wordToSearch%' OR MovieYear LIKE '____$wordToSearch%'";
$resultMovieYearCaracter = mysqli_query($conn, $sqlMovieYearCaracter);



// Start Series

// Search By Series Name English Characters

$sqlSeriesName1Caracter = "SELECT * FROM series WHERE SeriesName1 LIKE '$wordToSearch%' OR SeriesName1 LIKE '%$wordToSearch' OR SeriesName1 LIKE '_$wordToSearch%' OR SeriesName1 LIKE '__$wordToSearch%' OR SeriesName1 LIKE '____$wordToSearch%'";
$resultSeriesName1Caracter = mysqli_query($conn, $sqlSeriesName1Caracter);




// Search By Series Name Arabic Characters

$sqlSeriesName2Caracter = "SELECT * FROM series WHERE SeriesName2 LIKE '$wordToSearch%' OR SeriesName2 LIKE '%$wordToSearch' OR SeriesName2 LIKE '_$wordToSearch%' OR SeriesName2 LIKE '__$wordToSearch%' OR SeriesName2 LIKE '____$wordToSearch%'";
$resultSeriesName2Caracter = mysqli_query($conn, $sqlSeriesName2Caracter);




// Search By Series Year Num Characters

$sqlSeriesYearCaracter = "SELECT * FROM series WHERE SeriesYear LIKE '$wordToSearch%' OR SeriesYear LIKE '%$wordToSearch' OR SeriesYear LIKE '_$wordToSearch%' OR SeriesYear LIKE '__$wordToSearch%' OR SeriesYear LIKE '____$wordToSearch%'";
$resultSeriesYearCaracter = mysqli_query($conn, $sqlSeriesYearCaracter);


// Start Actor


// Search By Actor Arabic Name Characters

$sqlActorCaracter = "SELECT * FROM actors WHERE ArabicName LIKE '$wordToSearch%' OR ArabicName LIKE '%$wordToSearch' OR ArabicName LIKE '_$wordToSearch%' OR ArabicName LIKE '__$wordToSearch%' OR ArabicName LIKE '____$wordToSearch%'";
$resultActorArabicNameChar = mysqli_query($conn, $sqlActorCaracter);



// Search By Actor English Name Characters

$sqlActorCaracter1 = "SELECT * FROM actors WHERE ActorName LIKE '$wordToSearch%' OR ActorName LIKE '%$wordToSearch' OR ActorName LIKE '_$wordToSearch%' OR ActorName LIKE '__$wordToSearch%' OR ActorName LIKE '____$wordToSearch%'";
$resultActorEnglishNameChar = mysqli_query($conn, $sqlActorCaracter1);


?>
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/new.css">
<style>
</style>
<div class="content-box">

  <?php
  // Search Movie By English Name Characters

  while ($rowMovieName1Character = $resultMovieName1Caracter->fetch_assoc()) {
    // Generate Main Page
    $mainPage = $rowMovieName1Character['MovieName1'];
    $generateLink = str_replace(" ", "-", $mainPage);

    echo '
      <div class="box">
        <div class="cover">
          <img src="' . $rowMovieName1Character['MovieCover'] . '" alt="">
        </div>
        <p class="name"><a href="' . 'movie-page.php?' . $generateLink . '">';
    if ($rowMovieName1Character['MovieLang'] == 'العربية') {
      echo $rowMovieName1Character['MovieName2'];
    } else {
      echo $rowMovieName1Character['MovieName1'];
    }
    echo '
        </a></p>
        <div class="video-year">' . $rowMovieName1Character['VideoQality'] . '  ' . $rowMovieName1Character['MovieYear'] .  ' </div>
      </div>
      ';
  }

  // Search Movie By Arabic Name Characters

  while ($rowMovieName2Character = $resultMovieName2Caracter->fetch_assoc()) {
    // Generate Main Page
    $mainPage = $rowMovieName2Character['MovieName1'];
    $generateLink = str_replace(" ", "-", $mainPage);

    echo '
      <div class="box">
        <div class="cover">
          <img src="' . $rowMovieName2Character['MovieCover'] . '" alt="">
        </div>
        <p class="name"><a href="' . 'movie-page.php?' . $generateLink . '">';
    if ($rowMovieName2Character['MovieLang'] == 'العربية') {
      echo $rowMovieName2Character['MovieName2'];
    } else {
      echo $rowMovieName2Character['MovieName1'];
    }
    echo '
        </a></p>
        <div class="video-year">' . $rowMovieName2Character['VideoQality'] . '  ' . $rowMovieName2Character['MovieYear'] .  ' </div>
      </div>
      ';
  }

  // Search Movie By Year Number Characters

  while ($rowMovieYearCharacter = $resultMovieYearCaracter->fetch_assoc()) {
    // Generate Main Page
    $mainPage = $rowMovieYearCharacter['MovieName1'];
    $generateLink = str_replace(" ", "-", $mainPage);

    echo '
      <div class="box">
        <div class="cover">
          <img src="' . $rowMovieYearCharacter['MovieCover'] . '" alt="">
        </div>
        <p class="name"><a href="' . 'movie-page.php?' . $generateLink . '">';
    if ($rowMovieYearCharacter['MovieLang'] == 'العربية') {
      echo $rowMovieYearCharacter['MovieName2'];
    } else {
      echo $rowMovieYearCharacter['MovieName1'];
    }
    echo '
        </a></p>
        <div class="video-year">' . $rowMovieYearCharacter['VideoQality'] . '  ' . $rowMovieYearCharacter['MovieYear'] .  ' </div>
      </div>
      ';
  }

  // Actor

  // Search By Actor Aabic Name Characters

  while ($rowActorArabicNameChar = $resultActorArabicNameChar->fetch_assoc()) {
    // Generate Main Page
    $mainPage = $rowActorArabicNameChar['ActorName'];
    $generateLink = str_replace(" ", "-", $mainPage);

    echo '
      <div class="box">
        <div class="cover">
          <img src="' . $rowActorArabicNameChar['ActorImage'] . '" alt="">
        </div>
        <p class="name"><a href="' . 'act-page.php?' . $generateLink . '">';
    if ($rowActorArabicNameChar['ArabicName'] != '') {
      echo $rowActorArabicNameChar['ArabicName'];
    } else {
      echo $rowActorArabicNameChar['ActorName'];
    }
    echo '
        </a></p>
      </div>
      ';
  }

  // Search By Actor English Name Characters

  while ($rowActorEnglishNameChar = $resultActorEnglishNameChar->fetch_assoc()) {
    // Generate Main Page
    $mainPage = $rowActorEnglishNameChar['ActorName'];
    $generateLink = str_replace(" ", "-", $mainPage);

    echo '
      <div class="box">
        <div class="cover">
          <img src="' . $rowActorEnglishNameChar['ActorImage'] . '" alt="">
        </div>
        <p class="name"><a href="' . 'act-page.php?' . $generateLink . '">';
    if ($rowActorEnglishNameChar['ArabicName'] != '') {
      echo $rowActorEnglishNameChar['ArabicName'];
    } else {
      echo $rowActorEnglishNameChar['ActorName'];
    }
    echo '
        </a></p>
      </div>
      ';
  }

  // Start Series

  // Searsh Series By English Name Character

  while ($rowSeriesName1Char = $resultSeriesName1Caracter->fetch_assoc()) {
    // Generate Main Page
    $mainPage = $rowSeriesName1Char['SeriesName1'];
    $generateLink = str_replace(" ", "-", $mainPage);

    echo '
      <div class="box">
        <div class="cover">
          <img src="' . $rowSeriesName1Char['SeriesCover'] . '" alt="">
        </div>
        <p class="name"><a href="' . 'series-page.php?' . $generateLink . '">';
    if ($rowSeriesName1Char['SeriesLang'] == 'العربية') {
      echo $rowSeriesName1Char['SeriesName2'];
    } else {
      echo $rowSeriesName1Char['SeriesName1'];
    }
    echo '
        </a></p>
        <div class="video-year">' . $rowSeriesName1Char['VedioQuality'] . '  ' . $rowSeriesName1Char['SeriesYear'] .  ' </div>
        </div>
      ';
  }

  // Searsh Series By Arabic Name Character

  while ($rowSeriesYearChar = $resultSeriesYearCaracter->fetch_assoc()) {
    // Generate Main Page
    $mainPage = $rowSeriesYearChar['SeriesName1'];
    $generateLink = str_replace(" ", "-", $mainPage);

    echo '
      <div class="box">
        <div class="cover">
          <img src="' . $rowSeriesYearChar['SeriesCover'] . '" alt="">
        </div>
        <p class="name"><a href="' . 'series-page.php?' . $generateLink . '">';
    if ($rowSeriesYearChar['SeriesLang'] == 'العربية') {
      echo $rowSeriesYearChar['SeriesName2'];
    } else {
      echo $rowSeriesYearChar['SeriesName1'];
    }
    echo '
        </a></p>
        <div class="video-year">' . $rowSeriesYearChar['VedioQuality'] . '  ' . $rowSeriesYearChar['SeriesYear'] .  ' </div>
        </div>
      ';
  }

  // Searsh Series By Arabic Name Character

  while ($rowSeriesName2Char = $resultSeriesName2Caracter->fetch_assoc()) {
    // Generate Main Page
    $mainPage = $rowSeriesName2Char['SeriesName1'];
    $generateLink = str_replace(" ", "-", $mainPage);

    echo '
      <div class="box">
        <div class="cover">
          <img src="' . $rowSeriesName2Char['SeriesCover'] . '" alt="">
        </div>
        <p class="name"><a href="' . 'series-page.php?' . $generateLink . '">';
    if ($rowSeriesName2Char['SeriesLang'] == 'العربية') {
      echo $rowSeriesName2Char['SeriesName2'];
    } else {
      echo $rowSeriesName2Char['SeriesName1'];
    }
    echo '
        </a></p>
        <div class="video-year">' . $rowSeriesName2Char['VedioQuality'] . '  ' . $rowSeriesName2Char['SeriesYear'] .  ' </div>
        </div>
      ';
  }
  ?>
</div>