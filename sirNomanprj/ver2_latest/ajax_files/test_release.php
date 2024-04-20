<?php
session_start();
include ("../include/dbConfig.php");

$query = $db->query("SELECT * FROM releases WHERE user_id = " . $_SESSION['login_userid'] . " AND status ='draft' LIMIT 1");

$draft_data = "";
if (mysqli_num_rows($query) > 0) {
  $row = $query->fetch_assoc();
  // Clean the JSON string
  $cleanedJsonData = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $row['release_meta']);

  $draft_data = json_decode($cleanedJsonData, true);

  if (json_last_error() !== JSON_ERROR_NONE) {
    // var_dump($row['release_meta']);
    // echo "JSON decode error: " . json_last_error_msg();
  } else {
    // var_dump($draft_data);
  }

 if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["primary_artist_count"])) {
  $primary_artist_count = $_POST["primary_artist_count"];
  // echo " console.log('primary artist count' + " . $primary_artist_count . ");";




  $key = "track_primary_artist[{$primary_artist_count}][]";

  if (isset($draft_data[$key]) && !empty($draft_data[$key])) {
   if (is_array($draft_data[$key])) {
    // $track_primary_artist = json_encode($draft_data[$key]) . ";";
    $track_primary_artist = json_encode($draft_data[$key]);
   } else {
    // $track_primary_artist = "\"" . $draft_data[$key] . "\";";
    $track_primary_artist = json_encode([$draft_data[$key]]) ;
   }
   // return "  selectedArtists = $track_primary_artist";
   echo $track_primary_artist;
  } else {
   echo  $key ?: null;
  }
 }




// ===========feature count================
 
 if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["featuring_count"])) {
  $featuring_count = $_POST["featuring_count"];
  // echo " console.log('primary artist count' + " . $primary_artist_count . ");";




  $key = "track_featuring[{$featuring_count}][]";

  if (isset($draft_data[$key]) && !empty($draft_data[$key])) {
   if (is_array($draft_data[$key])) {
    // $track_primary_artist = json_encode($draft_data[$key]) . ";";
    $track_featuring = json_encode($draft_data[$key]);
   } else {
    // $track_primary_artist = "\"" . $draft_data[$key] . "\";";
    $track_featuring = json_encode([$draft_data[$key]]) ;
   }
   // return "  selectedArtists = $track_primary_artist";
   echo $track_featuring;
  } else {
   echo '';
  }
 }



 // ===================remixer =========


 
 if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["remixer_count"])) {
  $remixer_count = $_POST["remixer_count"];
  // echo " console.log('primary artist count' + " . $primary_artist_count . ");";




  $key = "track_remixer[{$remixer_count}][]";

  if (isset($draft_data[$key]) && !empty($draft_data[$key])) {
   if (is_array($draft_data[$key])) {
    // $track_primary_artist = json_encode($draft_data[$key]) . ";";
    $track_remixer = json_encode($draft_data[$key]);
   } else {
    // $track_primary_artist = "\"" . $draft_data[$key] . "\";";
    $track_remixer = json_encode([$draft_data[$key]]) ;
   }
   // return "  selectedArtists = $track_primary_artist";
   echo $track_remixer;
  } else {
   echo '';
  }
 }





 // =============================================================================
}



?>