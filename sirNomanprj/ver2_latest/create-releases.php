<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
header("Access-Control-Allow-Origin: *");
session_start();
include ('include/dbConfig.php');


if (strlen($_SESSION['user_login']) == 0) {
  echo '<script>window.location="login.php"</script>';
}
if (isset($_POST['catalog']) || isset($_POST['save'])) {
  // Your existing code here

  // Save button clicked
  if (isset($_POST['save'])) {
    // Your database update code here
  }
}


if (isset($_POST['catalog'])) {


  // unset($post_data['create']);
  // unset($post_data['track_song_name']);
  // unset($post_data['track_mix_version']);

  // echo '<pre>';
  $post_data = $_POST;
  $rid = $_SESSION['draft_rid'];
  $post_data['cover_art'] = $_SESSION['cover_art'];
  unset($_POST['final_cover']);
  unset($_POST['create']);
  $post_data['final_cover'] = '';
  unset($post_data['final_cover']);
  $data = json_encode($post_data, true);
  //  print_r($data);

  if (mysqli_query($db, "UPDATE releases SET  release_meta = '$data' WHERE rid = '$rid'  ")) {
    // echo 'done';
  }
  // echo $rid;
  //     echo '<pre>';
  //     print_r($_POST);
  //     print_r($_SESSION);
  // die();
  for ($i = 0; $i <= count($_POST['track_name']); $i++) {

    $temp_file_id = $i + 1;


    $song_name = isset($_POST['track_name'][$i]) ? $_POST['track_name'][$i] : "";
    $mix_version = isset($_POST['track_mix_version'][$i]) ? $_POST['track_mix_version'][$i] : "";
    $primary_artist = isset($_POST['track_primary_artist'][$i]) ? implode(",", $_POST['track_primary_artist'][$i]) : "";
    $featuring = isset($_POST['track_featuring'][$i]) ? implode(",", $_POST['track_featuring'][$i]) : "";
    $remixer = isset($_POST['track_remixer'][$i]) ? implode(",", $_POST['track_remixer'][$i]) : "";
    $composer = isset($_POST['track_composer'][$i]) ? $_POST['track_composer'][$i] : "";
    $primary_genre = isset($_POST['track_main_genre'][$i]) ? $_POST['track_main_genre'][$i] : "";
    $secondary_genre = isset($_POST['track_genre'][$i]) ? $_POST['track_genre'][$i] : "";
    $recording_year = isset($_POST['track_recording_year'][$i]) ? $_POST['track_recording_year'][$i] : "";
    $country_recording = isset($_POST['track_country_recording'][$i]) ? $_POST['track_country_recording'][$i] : "";
    $isrc_code = isset($_POST['track_i_s_r_c_code'][$i]) ? $_POST['track_i_s_r_c_code'][$i] : "";
    $price_tier = isset($_POST['track_price_tier'][$i]) ? $_POST['track_price_tier'][$i] : "";
    $album_only = isset($_POST['track_album_only'][$i]) ? $_POST['track_album_only'][$i] : "";
    $vocals = isset($_POST['track_vocals'][$i]) ? $_POST['track_vocals'][$i] : "";
    $explicit_status = isset($_POST['track_explicit_status'][$i]) ? $_POST['track_explicit_status'][$i] : "";
    $vocal_lang = isset($_POST['track_vocal_language'][$i]) ? $_POST['track_vocal_language'][$i] : "";

    $query = "UPDATE tracks
                                   SET
                                        
                                        `track_song_name` =     '$song_name',
                                        `track_mix_version` = '$mix_version',
                                        `track_primary_artist` =     '$primary_artist',
                                        `track_featuring` =   '$featuring',
                                        `track_remixer` = '$remixer',
                                        `track_contributor` = '$composer',
                                        `track_primary_genre` =  '$primary_genre',
                                        `track_secondary_genre` =   '$secondary_genre',
                                        `track_recording_year` =  '$recording_year',
                                        `track_country_recording` = '$country_recording',
                                        `track_isrc_code` = '$isrc_code',
                                        `track_album_only` =  '$album_only',
                                        `track_vocals` =  '$vocals',
                                        `track_explicit_status` =  '$explicit_status',
                                        `track_vocal_lang` =  '$vocal_lang'
                                    WHERE rid = '$rid' AND file_id = '$temp_file_id'   
                                    ";
    // echo $query;
    if (mysqli_query($db, $query)) {
      // echo count($_POST['track_name']);
      mysqli_query($db, "DELETE FROM tracks WHERE rid = '$rid' AND file_id > '" . count($_POST['track_name']) . "'");

      $release_update = true;
    }

    // echo 'Done: '.$_FILES['track_audio_file']['name'][$i];


  }
  // die();
  // $values = json_encode($_POST, true);

  // $print= json_decode($values, true);
  // print_r($_FILES);
  // echo $_FILES['cover_art'];        


  if ($release_update == true) {
    if (mysqli_query($db, "UPDATE releases SET status = 'pending' WHERE rid = '$rid'")) {
      $_SESSION['draft_rid'] = '';
      unset($_SESSION['draft_rid']);
      $success == true;
    }
  }
  // unset($_SESSION["draft_id"]); 


  // die();

}

// unset($_SESSION["draft_id"]); 
// echo $_SESSION["draft_id"];
// die
$query = $db->query("SELECT * FROM releases WHERE user_id = " . $_SESSION['login_userid'] . " AND status ='draft' LIMIT 1");

$draft_data = "";
if (mysqli_num_rows($query) > 0) {
  $row = $query->fetch_assoc();
  // Clean the JSON string
  $cleanedJsonData = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $row['release_meta']);

  $draft_data = json_decode($cleanedJsonData, true);

  if (json_last_error() !== JSON_ERROR_NONE) {
    var_dump($row['release_meta']);
    echo "JSON decode error: " . json_last_error_msg();
  } else {
    // var_dump($draft_data);
  }

  // Encode specific data from draft_data["artists[]"]
  if (isset($draft_data["artists[]"])) {
    $draft_data2 = json_encode($draft_data["artists[]"]);
  } else {
    $draft_data2 = "''";
  }
}

// echo '<pre>';
// print_r($draft_data);
// echo '</pre>';

// die();




// ?>


<!DOCTYPE html>

<html lang="en" class="light-style  layout-menu-fixed   " dir="ltr" data-theme="theme-default"
  data-assets-path="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/"
  data-base-url="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1"
  data-framework="laravel" data-template="vertical-menu-theme-default-light">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
  <meta charset="utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Dynamic Release | Q Phonic ENT </title>
  <meta name="description"
    content="Most Powerful &amp; Comprehensive Bootstrap 5 HTML Admin Dashboard Template built for developers!" />
  <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
  <!-- laravel CRUD token -->
  <meta name="csrf-token" content="NAkv4GSUnfPXqyp3qBI0BHmCQFVjuX3uksB9sEaY">
  <!-- Canonical SEO -->
  <link rel="canonical" href="../../../themeselection.com/item/sneat-bootstrap-html-laravel-admin-template/index.html">
  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="icons/purple.jpeg" />

  <!-- Include Styles -->
  <!-- BEGIN: Theme CSS-->
  <!-- Fonts -->
  <link rel="preconnect" href="../../../fonts.googleapis.com/index.html">
  <link rel="preconnect" href="../../../fonts.gstatic.com/index.html" crossorigin>
  <link
    href="../../../fonts.googleapis.com/css28ebe.css?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap"
    rel="stylesheet">

  <link rel="stylesheet" href="./assets/vendor/fonts/boxiconse04f.css?id=7bed0c381d8a5b57f43c7bd313947977" />
  <link rel="stylesheet" href="./assets/vendor/fonts/fontawesomeb34a.css?id=f55d5b6721febc124275199b7dddbb5b" />
  <link rel="stylesheet" href="./assets/vendor/fonts/flag-iconsc977.css?id=7018802e2db10780041f73a184e4bebe" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="./assets/vendor/css/rtl/core29d0.css?id=7ea028d8943e4d11544610602e504b70"
    class="template-customizer-core-css" />
  <link rel="stylesheet" href="./assets/vendor/css/rtl/theme-defaultde12.css?id=3cdafbb15e4b7f9cbb567018a632af10"
    class="template-customizer-theme-css" />
  <link rel="stylesheet" href="./assets/css/demo6e6a.css?id=8a804dae81f41c0f9fcbef2fa8316bdd" />


  <link rel="stylesheet"
    href="./assets/vendor/libs/perfect-scrollbar/perfect-scrollbarb440.css?id=d9fa6469688548dca3b7e6bd32cb0dc6" />
  <link rel="stylesheet"
    href="./assets/vendor/libs/typeahead-js/typeahead3881.css?id=8fc311b79b2aeabf94b343b6337656cf" />
  <!-- Vendor Styles -->
  <link rel="stylesheet" href="./assets/vendor/libs/bs-stepper/bs-stepper.css" />
  <link rel="stylesheet" href="./assets/vendor/libs/bootstrap-select/bootstrap-select.css" />
  <link rel="stylesheet" href="./assets/vendor/libs/select2/select2.css" />
  <link rel="stylesheet" href="./assets/vendor/libs/formvalidation/dist/css/formValidation.min.css" />

  <style>
    #status-message {
      /* background-color: #f0f0f0; */
      background-color: #71DD37;
      /* Light grey background */
      color: #fff;
      /* Dark grey text color */
      padding: 10px 20px;
      /* Padding around text */
      border-radius: 5px;
      /* Rounded corners */
      position: fixed;
      /* Fixed positioning */
      top: 20px;
      /* Distance from the top of the viewport */
      right: 20px;
      /* Distance from the right of the viewport */
      z-index: 1000;
      /* To ensure it's above other content */
      text-align: center;
      /* Center-align text */
      font-size: 16px;
      /* Font size */
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      /* Light shadow */
      display: none;
      /* Initially hidden */
    }

    #status-message.show {
      display: block;
      /* Display when there's content */
    }
  </style>
  <!-- Page Styles -->

  <!-- Include Scripts for customizer, helper, analytics, config -->
  <!-- laravel style -->
  <script src="./assets/vendor/js/helpers.js"></script>
  <!-- beautify ignore:start -->
  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
  <script src="./assets/vendor/js/template-customizer.js"></script>

  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="./assets/js/config.js"></script>

  <script>
    window.templateCustomizer = new TemplateCustomizer({
      cssPath: '',
      themesPath: '',
      defaultShowDropdownOnHover: true, // true/false (for horizontal layout only)
      displayCustomizer: false,
      lang: 'en',
      pathResolver: function (path) {
        var resolvedPaths = {
          // Core stylesheets
          'core.css': 'https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/vendor/css/rtl/core.css?id=7ea028d8943e4d11544610602e504b70',
          'core-dark.css': 'https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/vendor/css/rtl/core-dark.css?id=4d3d0e2ab14ecbed2083861be9812a6f',

          // Themes
          'theme-default.css': 'https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/vendor/css/rtl/theme-default.css?id=3cdafbb15e4b7f9cbb567018a632af10',
          'theme-default-dark.css':
            'https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/vendor/css/rtl/theme-default-dark.css?id=05dbf7c059f1493714333faa2b3b9551',
          'theme-bordered.css': 'https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/vendor/css/rtl/theme-bordered.css?id=d6c71dfec8b2243aaa4ff471ffcb4e24',
          'theme-bordered-dark.css':
            'https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/vendor/css/rtl/theme-bordered-dark.css?id=f6ff29f111b4fa9e7eaf2b1123ef9dfe',
          'theme-semi-dark.css': 'https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/vendor/css/rtl/theme-semi-dark.css?id=ab4aad06ff175954e3058d7dc07cca0d',
          'theme-semi-dark-dark.css':
            'https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/vendor/css/rtl/theme-semi-dark-dark.css?id=366f5c60c757a1a9970a4c91c66b0cb2',
        }
        return resolvedPaths[path] || path;
      },
      'controls': ["rtl", "style", "layoutType", "showDropdownOnHover", "layoutNavbarFixed", "layoutFooterFixed", "themes"],
    });
  </script>
  <!-- beautify ignore:end -->

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async="async" src="https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'GA_MEASUREMENT_ID');
  </script>
  <style>
    .loader {
      /* position: fixed; */
      /* left: 0px; */
      /* top: 0px; */
      width: 100%;
      height: 100%;
      z-index: 9999;
      background-color: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100px;
      height: 100px;
      font-size: 17px;
    }
  </style>
</head>

<body>
  <div class="col-md-12">
    <div id="status-message"></div>
  </div>
  <!-- Layout Content -->
  <div class="layout-wrapper layout-content-navbar ">
    <div class="layout-container">
      <?php include ('include/aside.php'); ?>

      <!-- Layout page -->
      <div class="layout-page">
        <!-- BEGIN: Navbar-->
        <!-- Navbar -->
        <?php include ('include/nav.php'); ?>
        <!-- / Navbar -->
        <!-- END: Navbar-->


        <!-- Content wrapper -->
        <div class="content-wrapper">


          <!-- Content -->
          <div class="container-xxl flex-grow-1 container-p-y">

            <div class="row">

              <div class="col-12">


                <?php if (isset($errormsg)) {
                  echo $errormsg;
                } ?>
              </div>
              <div class="col-12">
                <?php if ($success = true) {
                  ?>
                  <div class="alert alert-primary alert-dismissible bg-success text-white" role="alert">
                    HEADS UP! Your
                    release is created and will be reviewed in 24-48hours. Releases can take from 7-10
                    working days to be
                    approved.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  <?php
                } ?>
              </div>
              <div class="col-12">
                <h5>Create A New Release</h5>
              </div>
              <!--<div class="loader d-none"><img src="https://jozmy.com/img/preloader/aabf6174f648272253f8afaff55f9bd5.gif" width="100px"></div>-->
              <!-- Validation Wizard -->
              <div class="col-12 mb-4">
                <!--<small class="text-light fw-semibold">Validation</small>-->
                <div id="wizard-validation" class="bs-stepper mt-2">
                  <div class="bs-stepper-header">
                    <div class="step" data-target="#account-details-validation">
                      <button type="button" class="step-trigger">
                        <span class="bs-stepper-circle">1</span>
                        <span class="bs-stepper-label mt-1">
                          <span class="bs-stepper-title">Release Info</span>
                          <span class="bs-stepper-subtitle">Release Metadata</span>
                          <span class="bs-stepper-subtitle">All Fields Required</span>
                        </span>
                      </button>
                    </div>
                    <div class="line">
                      <i class="bx bx-chevron-right"></i>
                    </div>
                    <div class="step" data-target="#personal-info-validation">
                      <button type="button" class="step-trigger">
                        <span class="bs-stepper-circle">2</span>
                        <span class="bs-stepper-label mt-1">
                          <span class="bs-stepper-title">Add Tracks</span>
                          <span class="bs-stepper-subtitle">Create Tracklist</span>
                          <span class="bs-stepper-subtitle">All Fields Required</span>
                        </span>
                      </button>
                    </div>
                    <div class="line">
                      <i class="bx bx-chevron-right"></i>
                    </div>
                    <div class="step" data-target="#social-links-validation">
                      <button type="button" class="step-trigger">
                        <span class="bs-stepper-circle">3</span>
                        <span class="bs-stepper-label mt-1">
                          <span class="bs-stepper-title">Partners & Dates</span>
                          <span class="bs-stepper-subtitle">Releasing information</span>
                          <span class="bs-stepper-subtitle">All Fields Required</span>
                        </span>
                      </button>
                    </div>
                  </div>
                  <div class="bs-stepper-content">
                    <form action="" method="POST" enctype="multipart/form-data" id="wizard-validation-form"
                      onSubmit="return false">
                      <!-- Account Details -->
                      <div id="account-details-validation" class="content">
                        <div class="content-header mb-3">
                          <h6 class="mb-0">Release Details</h6>

                          <small>To Ensure Your Release Is A Success Please Fillout "All
                            Required Fields On The Form, Do
                            Not Skip Pages While An Upload Is Processing</small>
                          <div class="col-sm-6">
                            <label class="form-label" for="catalog_no">Catalog <span
                                style="color: red;">(required)</span></label>
                            <input type="text" name="catalog"
                              value="<?php echo isset($draft_data) && isset($draft_data['catalog']) ? $draft_data['catalog'] : '' ?>"
                              id="catalog_no" class="form-control release-ajax" placeholder="e.g, 40501"
                              aria-label="Catalog No." required />
                          </div>
                        </div>
                        <div class="row g-3">
                          <div class="col-md-4">
                            <img id="previewImg" class="w-100 d-none" src="" alt="Placeholder">
                          </div>
                          <div class="col-sm-12">
                            <div class="input-group">
                              <input type="file" class="form-control" onchange="previewFile(this);" id="cover"
                                name="cover_art" value="">
                              <input type="hidden" name="final_cover" id="final_cover" value="">
                              <label class="input-group-text" for="coverart">Cover
                                Art<span style="color: red;">(required)</span></label></label>
                            </div>
                          </div>
                          <h5>Composer tk complete hogya hai </h5>
                          <script>
                            function open_downloads_menu() {
                              $(".downloads_menu, .downloads_menu_btn").addClass("show");
                              $(".downloads_menu").attr("data-bs-popper", "none");
                            }

                            function previewFile(input) {




                              var file = $("#cover").get(0).files[0];

                              if (file) {
                                var reader = new FileReader();

                                reader.onload = function () {
                                  $("#previewImg").attr("src", reader.result);
                                  $('#previewImg').removeClass("d-none");

                                }

                                reader.readAsDataURL(file);
                              }



                              console.log($('#cover').get(0).files[0].type);
                              var form_data = new FormData();

                              var image_number = 1;

                              var error = '';

                              // for(var count = 0; count < $('#cover').files.length; count++)  
                              // {
                              if (!['image/jpeg', 'image/png', 'video/mp4'].includes($(
                                '#cover').get(0).files[0].type)) {
                                error += '<div class="alert alert-danger"><b>' +
                                  image_number +
                                  '</b> Selected File must be .jpg or .png Only.</div>';
                              } else {
                                form_data.append("cover_art", $('#cover').get(0).files[0]);
                              }
                              form_data.append("catalog", $('#catalog_no').val());
                              form_data.append("cover_upload", 1);
                              //     image_number++;
                              // }

                              if (error != '') {
                                $('#uploaded_image').innerHTML = error;

                                $('#cover').value = '';
                              } else {
                                $("#cover_upload_status").show();
                                $('#progress_bar').css("display", "block");
                                $("#progress_bar").show();
                                $('#progress_bar_process').css("width", '0%');
                                $('#progress_bar_process').html('0% completed');
                                open_downloads_menu();

                                var ajax_request = new XMLHttpRequest();

                                ajax_request.open("POST", "ajax_files/dynamic_upload.php");

                                ajax_request.upload.addEventListener('progress', function (
                                  event) {

                                  var percent_completed = Math.round((event
                                    .loaded / event.total) * 100);

                                  $('#progress_bar_process').css("width",
                                    percent_completed + '%');

                                  $('#progress_bar_process').html(
                                    percent_completed + '% completed');

                                });

                                ajax_request.addEventListener('load', function (event) {

                                  $('#uploaded_image').html(
                                    '<div class="alert alert-success">Files Uploaded Successfully</div>'
                                  );
                                  var data = JSON.parse(this.response);
                                  $("#final_cover").val(data.cover_art);

                                  $("#uploaded_image").show();
                                  // $('#cover').val() = '';

                                });

                                ajax_request.send(form_data);
                              }
                            }
                          </script>

                          <div class="col-sm-6">
                            <label class="form-label" for="release_name">Name <span
                                style="color: red;">(required)</span></label>
                            <input type="text" name="name"
                              value="<?php echo isset($draft_data) && isset($draft_data['name']) ? $draft_data['name'] : '' ?>"
                              id="release_name" class="form-control" placeholder="Rock Muzic..." required />
                          </div>

                          <div class="col-sm-6">
                            <label class="form-label" for="upc">UPC <span style="color: red;">(required)</span></label>
                            <select name="u_p_c_code" id="upc" class="form-control" aria-label="UPC" required>
                              <option value="">Select option</option>
                              <option value="GET" <?php echo isset($draft_data) && isset($draft_data['u_p_c_code']) && $draft_data['u_p_c_code'] == 'GET' ? 'Selected' : '' ?>>
                                GET</option>
                            </select>


                          </div>

                          <div class="col-sm-6">
                            <div class="col-md">
                              <small class="text-light fw-semibold">Compilation <span
                                  style="color: red;">(required)</span></label></small>


                              <div class="form-check mt-3">
                                <input name="compilation" class="form-check-input" <?php echo isset($draft_data) && isset($draft_data['compilation']) && $draft_data['compilation'] == 'Standard_release' ? 'checked' : '' ?> type="radio" value="Standard_release" name="compilation"
                                  id="standard_release" checked>
                                <label class="form-check-label" for="standard_release">
                                  Standard Release
                                </label>
                              </div>
                              <div class="form-check">
                                <input name="compilation" class="form-check-input" <?php echo isset($draft_data) && isset($draft_data['compilation']) && $draft_data['compilation'] == 'Compilation' ? 'checked' : '' ?> type="radio" value="Compilation" name="compilation"
                                  id="compilation">
                                <label class="form-check-label" for="compilation">
                                  Compilation
                                </label>
                              </div>


                            </div>
                          </div>
                          <div class="col-sm-6 bg-primary rounded">
                            <label class="form-label text-white" for="upc" style="font-weight: 700;">Number of tracks
                              <span style="color: red;">(required)</span></label></label>
                            <input class="form-control" type="number"
                              value="<?php echo isset($draft_data) && isset($draft_data['no_of_tracks']) ? $draft_data['no_of_tracks'] : '1' ?>"
                              min="1" name="no_of_tracks" id="no_of_tracks">
                            <!--<br>-->
                          </div>

                          <div class="col-sm-6">
                            <label class="form-label" for="artists">Artist <span
                                style="color: red;">(required)</span></label>
                            <select class="select2" id="artist_name" name="artists[]" multiple>
                              <option label=" "></option>
                              <?php
                              $query = $db->query("SELECT * FROM artists WHERE user_id = " . $_SESSION['login_userid']);
                              if (mysqli_num_rows($query) != 0) {
                                while ($row = $query->fetch_assoc()) {
                                  ?>
                                  <option value="<?= $row['artist_name'] ?>">
                                    <?= $row['artist_name'] ?>
                                  </option>
                                <?php }
                              } else {
                                ?>
                                <option value="No Labels are added yet" disabled>No Artists
                                  are added yet</option>
                                <?php
                              }
                              ?>
                            </select>
                            <!--<input type="text" name="artist_name" id="artist_name" class="form-control" placeholder="e.g, John Doe" aria-label="Artist name" />-->
                          </div>
                          <div class="col-sm-6">
                            <label class="form-label" for="label_name">Label Name <span
                                style="color: red;">(required)</span></label>
                            <select class="select2" id="label_name" name="label_name">
                              <option label=" "></option>
                              <?php
                              $query = $db->query("SELECT * FROM label_profiles WHERE user_id = " . $_SESSION['login_userid']);
                              if (mysqli_num_rows($query) != 0) {
                                while ($row = $query->fetch_assoc()) {

                                  if (isset($draft_data["label_name"]) && !empty($draft_data["label_name"])) {
                                    if ($draft_data["label_name"] == $row['label_name']) {
                                      ?>
                                      <option selected value="<?= $row['label_name'] ?>">
                                        <?= $row['label_name'] ?>
                                      </option>
                                      <?php

                                    } else {
                                      ?>
                                      <option value="<?= $row['label_name'] ?>">
                                        <?= $row['label_name'] ?>
                                      </option>

                                      <?php

                                    }
                                  } else {

                                    echo "<option  value='{$row['label_name']}'>{$row['label_name']}</option>";
                                  }

                                }
                              } else {

                                echo '<option value="No Labels are added yet" disabled>No Labels are added yet</option>';
                              }
                              ?>
                            </select>
                          </div>
                          <div class="col-sm-6">
                            <label class="form-label" for="main_genre">Main Genre <span
                                style="color: red;">(required)</span></label>
                            <select class="select2" id="main_genre" name="main_genre">
                              <option label=" " value=""></option>
                              <?php
                              $query = $db->query("SELECT * FROM main_genre");
                              if (mysqli_num_rows($query) != 0) {
                                while ($row = $query->fetch_assoc()) {
                                  if (isset($draft_data["main_genre"]) && !empty($draft_data["main_genre"])) {
                                    if ($draft_data["main_genre"] == $row['title']) {
                                      // agar   $draft_data["main_genre"] == $row['title'] tu 
                              
                                      // yeh value ko skip krdai or neechai   
                                      ?>
                                      <option selected value="<?= $row['title'] ?>">
                                        <?= $row['title'] ?>
                                      </option>


                                      <?php

                                    } else {

                                      ?>
                                      <option value="<?= $row['title'] ?>"><?= $row['title'] ?>
                                      </option>

                                      <?php
                                    }
                                  } else {


                                    ?>
                                    <option value="<?= $row['title'] ?>"><?= $row['title'] ?>
                                    </option>
                                    <?php
                                  }
                                }
                              } else {
                                ?>
                                <option value="No genre are added yet" disabled>No Labels
                                  are added yet</option>
                                <?php
                              }
                              ?>
                            </select>
                            <!--<input type="text" name="main_genre" id="main_genre" class="form-control" placeholder="e.g, Classical Music" aria-label="Main Genre" />-->
                          </div>
                          <div class="col-sm-6">
                            <label class="form-label" for="sub_genre">Genre <span
                                style="color: red;">(required)</span></label>
                            <select class="select2" id="sub_genre" name="genre">
                              <option label=" "> - Select Main Genre -</option>


                            </select>
                            <!--<input type="text" name="sub_genre" id="sub_genre" class="form-control" placeholder="e.g, Pop Music" aria-label="Sub Genre" />-->
                          </div>

                          <div class="col-sm-6">
                            <label class="form-label" for="pline">PLine</label>
                            <input type="text"
                              value="<?php echo isset($draft_data["pline"]) ? $draft_data["pline"] : ""; ?>"
                              name="pline" id="pline" class="form-control" placeholder="" aria-label="PLine" />
                          </div>
                          <div class="col-sm-6">
                            <label class="form-label" for="cline">CLine</label>
                            <input type="text" name="cline"
                              value="<?php echo isset($draft_data["cline"]) ? $draft_data["pline"] : ""; ?>" id="cline"
                              class="form-control" placeholder="" aria-label="CLine" />
                          </div>
                          <div class="col-sm-6">
                            <label class="form-label" for="languages_meta">Metadata Language
                              <span style="color: red;">(required)</span></label>
                            <select class="select2" id="languages_meta" name="metadata_language">
                              <?php $query = $db->query("SELECT * FROM languages");
                              while ($row = $query->fetch_assoc()) {

                                if (isset($draft_data["metadata_language"]) && !empty($draft_data["main_genre"])) {
                                  if ($draft_data["metadata_language"] == $row['name']) {
                                    echo '<option selected value="' . $row['name'] . '">' . $row['name'] . '</option>';

                                  } else {
                                    echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
                                  }
                                } else {
                                  echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
                                }


                              } ?>
                            </select>

                          </div>
                          <!--<div class="col-sm-6 form-password-toggle">-->
                          <!--  <label class="form-label" for="formValidationPass">Password</label>-->
                          <!--  <div class="input-group input-group-merge">-->
                          <!--    <input type="password" id="formValidationPass" name="formValidationPass" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="formValidationPass2" />-->
                          <!--    <span class="input-group-text cursor-pointer" id="formValidationPass2"><i class="bx bx-hide"></i></span>-->
                          <!--  </div>-->
                          <!--</div>-->
                          <!--<div class="col-sm-6 form-password-toggle">-->
                          <!--  <label class="form-label" for="formValidationConfirmPass">Confirm Password</label>-->
                          <!--  <div class="input-group input-group-merge">-->
                          <!--    <input type="password" id="formValidationConfirmPass" name="formValidationConfirmPass" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="formValidationConfirmPass2" />-->
                          <!--    <span class="input-group-text cursor-pointer" id="formValidationConfirmPass2"><i class="bx bx-hide"></i></span>-->
                          <!--  </div>-->
                          <!--</div>-->
                          <div class="col-12 d-flex justify-content-between">
                            <button class="btn btn-label-secondary btn-prev" disabled>
                              <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                              <span class="align-middle d-sm-inline-block d-none">Previous</span>


                              <script>
                                function showSuccessMessage() {
                                  // Display the success message
                                  document.getElementById('successMessage').classList
                                    .remove('d-none');

                                  // Hide the success message after 3 seconds (3000 milliseconds)
                                  setTimeout(function () {
                                    document.getElementById('successMessage')
                                      .classList.add('d-none');
                                  }, 3000);
                                }
                              </script>
                              <!-- <button type="button" class="btn btn-warning btn-prev" name="save" onclick="showSuccessMessage()">
                                <span class="align-middle">Save</span>
                              </button> -->


                              <button class="btn btn-primary btn-next" id="step_one_next">
                                <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                              </button>
                          </div>
                        </div>
                      </div>
                      <!-- Personal Info -->
                      <div id="personal-info-validation" class="content">
                        <div class="content-header mb-3">
                          <h6 class="mb-0">Add Tracks</h6>
                          <small>To Ensure Your Release Is A Success Please Fillout "All
                            Required Fields On The Form, Do
                            Not Skip Pages While An Upload Is Processing</small>
                        </div>
                        <div class="row g-3" id="step_two_html_position"></div>
                        <div class="row">
                          <div class="col-12 d-flex justify-content-between">
                            <button class="btn btn-primary btn-prev">
                              <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                              <span class="align-middle d-sm-inline-block d-none">Previous</span>
                            </button>
                            <!-- <button type="button" class="btn btn-warning btn-prev" name="save" onclick="showSuccessMessage()">
                              <span class="align-middle">Save</span>
                            </button> -->
                            <button class="btn btn-primary btn-next" id="step_two_next">
                              <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                              <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                      <!-- Social Links -->
                      <div id="social-links-validation" class="content">
                        <div class="content-header mb-3">
                          <h6 class="mb-0">Partners & Dates <span style="color: red;">(required)</span></label></h6>
                          <small>Platform Information</small>
                        </div>
                        <div class="row g-3">

                          <?php $query = $db->query("SELECT * FROM exclusive_platforms");
                          while ($row = $query->fetch_assoc()) { ?>
                            <div class="col-sm-2 d-flex">
                              <input type="checkbox" name="stores[]" id="stores" value="<?php echo $row['title']; ?>"
                                class="form-check-input mx-2" />
                              <label class="form-label" for="pre_order_date"><?php echo $row['title']; ?></label>
                            </div>
                          <?php } ?>
                          <div class="col-sm-6">
                            <label class="form-label" for="exclusive_platform">Exclusive
                              Platform</label>
                            <select name="exclusive_platform" id="exclusive_platform" class="select2">
                              <option label=" ">- Select Platform -</option>
                              <?php $query = $db->query("SELECT * FROM exclusive_platforms");
                              while ($row = $query->fetch_assoc()) {
                                echo '<option value="' . $row['title'] . '">' . $row['title'] . '</option>';
                              } ?>
                            </select>
                          </div>
                          <div class="col-sm-6">
                            <label class="form-label" for="exclusive_duration">Exclusive
                              Duration</label>
                            <select name="exclusive_duration" id="exclusive_duration" class="select2">
                              <option label=" ">- Select -</option>
                              <option value="2">2 </option>
                              <option value="4">4</option>

                            </select>
                          </div>
                          <div class="col-sm-4">
                            <label class="form-label" for="pre_order_date">Pre-Order Date
                              <span style="color: red;">(required)</span></label></label>
                            <input type="date" name="i_tunes_pre_order_date" id="pre_order_date" class="form-control" />
                          </div>
                          <div class="col-sm-4">
                            <label class="form-label" for="promo_date">Promo Date</label>
                            <input type="date" name="exclusive_date" id="promo_date" class="form-control" />
                          </div>
                          <div class="col-sm-4">
                            <label class="form-label" for="live_date">Live Date <span
                                style="color: red;">(required)</span></label></label>
                            <input type="date" name="release_date" id="live_date" class="form-control" />
                          </div>
                          <div class="col-12 d-flex justify-content-between">
                            <button class="btn btn-primary btn-prev">
                              <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                              <span class="align-middle d-sm-inline-block d-none">Previous</span>
                            </button>
                            <button type="button" class="btn btn-warning btn-prev" name="save"
                              onclick="showSuccessMessage()">
                              <span class="align-middle">Save</span>
                            </button>
                          </div>
                          <script>
                            function showSuccessMessage() {
                              // Display the success message
                              document.getElementById('successMessage').classList.remove(
                                'd-none');

                              // Hide the success message after 3 seconds (3000 milliseconds)
                              setTimeout(function () {
                                document.getElementById('successMessage').classList
                                  .add('d-none');
                              }, 3000);
                            }
                          </script>
                          <div class="text-center">
                            <!-- <input type="button" name="create" class="btn btn-success btn-next btn-submit create_release" value="Submit"> -->
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- /Validation Wizard -->
            </div>


            <!-- pricingModal -->
            <!--/ pricingModal -->

          </div>
          <!-- / Content -->

          <!-- Footer -->
          <!-- Footer-->
          <?php include ("include/footer.php"); ?>
          <!--/ Footer-->
          <!-- / Footer -->
          <div class="content-backdrop fade"></div>
        </div>
        <!--/ Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>
  </div>
  <!-- / Layout wrapper -->
  <!--/ Layout Content -->



  <!-- Include Scripts -->
  <!-- BEGIN: Vendor JS-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="./assets/vendor/libs/jquery/jquery40f4.js?id=96645acf88116df9c36bef6153b3a51a"></script>
  <script src="./assets/vendor/libs/popper/popper885d.js?id=c8510634b3d8cded74bbe30a2b593d87"></script>
  <script src="./assets/vendor/js/bootstrap0983.js?id=1f50b74ded465d298b282b4562bdaf8c"></script>
  <script src="./assets/vendor/libs/perfect-scrollbar/perfect-scrollbar4d5e.js?id=9d86308b7c41e76a7dc8472907865b83">
  </script>
  <script src="./assets/vendor/libs/hammer/hammerc38e.js?id=2a80ebd1aa77a9e33ec54b68ee8de5e0"></script>
  <script src="./assets/vendor/libs/i18n/i18n5fec.js?id=5dd0894a4cb5357ba8a20df3187b6d9b"></script>
  <script src="./assets/vendor/libs/typeahead-js/typeaheada766.js?id=8c315d7e2e7b09a04d8e8efead923241"></script>
  <script src="./assets/vendor/js/menu7d39.js?id=f45ec38086f86335b91fc2fdcaaadab8"></script>
  <script src="./assets/vendor/libs/bs-stepper/bs-stepper.js"></script>
  <script src="./assets/vendor/libs/bootstrap-select/bootstrap-select.js"></script>
  <script src="./assets/vendor/libs/select2/select2.js"></script>
  <script src="./assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js"></script>
  <script src="./assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js"></script>
  <script src="./assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js"></script>
  <!-- END: Page Vendor JS-->
  <!-- BEGIN: Theme JS-->
  <script src="./assets/js/mainc3d7.js?id=3c628e87a9befaa350e1f822744b8142"></script>

  <!-- END: Theme JS-->
  <!-- Pricing Modal JS-->
  <!-- END: Pricing Modal JS-->
  <!-- BEGIN: Page JS-->
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/es6-shim/0.35.3/es6-shim.min.js"></script>-->

  <script src="./assets/js/form-wizard-numbered.js"></script>
  <script src="./assets/js/form-wizard-validation.js"></script>


  <script>


    $(document).ready(function () {
      // alert('hello');
      // alert('<?php echo $_SESSION['login_userid'] ?>');
      $('.release-ajaxdfsdf').blur(function () {
        // alert('hello')
        var inputData = $(this).val();

        if (inputData != '') {
          var userId = '<?php echo $_SESSION['login_userid'] ?>';

          $.ajax({
            url: 'ajax_files/save_new_release.php', // replace 'insertData.php' with your backend script URL
            method: 'post',
            data: {
              'catalog': inputData,
              'user_id': userId
            },
            success: function (response) {
              // Handle success response if needed
              console.log(response);
            },
            error: function (xhr, status, error) {
              // Handle error
              console.error(xhr.responseText);
            }
          });
        }
      });
    });
  </script>



  <!-- END: Page JS-->
  <script>
    $(document).ready(function () {
      // Add a sample tag programmatically
      // value change in artist tag 


      var artist = <?php echo $draft_data2 ?>;

      if (!Array.isArray(artist)) {
        artist = [<?php echo $draft_data2 ?>];
      }
      //  var sampleTagString  =  JSON.stringify(sampleTag1);
      artist.forEach(function (value) {
        $('#artist_name').append(new Option(value, value, true, true));
      });

      // $('#artist_name').append(new Option(sampleTagString , sampleTagString .id, true, true)).trigger('change');
      $('#artist_name').trigger('change');





      var tracks_html = "";
      var tracks_count = 0;
      var no_of_tracks_allowed = 5;
      // var next_prev_html = ' <div class="col-12 d-flex justify-content-between"> <button class="btn btn-primary btn-prev"> <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i> <span class="align-middle d-sm-inline-block d-none">Previous</span> </button> <button class="btn btn-primary btn-next"> <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span> <i class="bx bx-chevron-right bx-sm me-sm-n2"></i> </button> </div>';
      $('#step_one_next').click(function () {

        if ($('#personal-info-validation').hasClass('active')) {


          tracks_html = '<div class="row">';
          var tracks_download_html = "";

          tracks_count = $('#no_of_tracks').val() < no_of_tracks_allowed ? $('#no_of_tracks')
            .val() : no_of_tracks_allowed;
          if ($('#no_of_tracks').val() > no_of_tracks_allowed) {
            $('#no_of_tracks').val(no_of_tracks_allowed);
            //   tracks_html += '<div class="col-sm-2"></div>';
            tracks_html +=
              '<div class="alert alert-info alert-dismissible" role="alert">Only ' +
              no_of_tracks_allowed +
              ' Tracks are allowed<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            //   tracks_html += '<div class="col-sm-2"></div>';
            //   console.log($('#no_of_tracks').val());
          }


          // alert('yes');    
          // WORKING HERE -- STEP 2 
          for (var i = 1; i <= tracks_count; i++) {
            let index_for_input = (i - 1);



            tracks_download_html += '<li class="d-none" id="track_downloads_row' + i +
              '" data-track-download-row="' + i + '"><div class="progress" id="progress_bar' +
              i +
              '" style="display:none; "><div class="progress-bar" id="progress_bar_process' +
              i + '" role="progressbar" style="width:0%">0%</div></div></li>';


            tracks_html += '<div class="col-md-12"><h5>Track no. ' + i + '</h5></div>';

            // audio file 
            tracks_html +=
              '<div class="col-sm-12"><div class="input-group"><input type="file" class="form-control track_upload" id="track_audio_file' +
              i + '" name="track_audio_file[]" data-file-id="' + i +
              '" class="input-group-text" for="track_audio_file' + i +
              '" >Audio File <span style="color: red;">(required)</span></label></label></div></div>';
            //  track_name field
            <?php
            $track_name = "";
            if (isset($draft_data["track_name[]"]) && !empty($draft_data["track_name[]"])) {

              if (is_array($draft_data["track_name[]"])) {
                $track_name = json_encode($draft_data["track_name[]"]);

              } else {
                $track_name = "\"" . $draft_data["track_name[]"] . "\"";
              }

            } else {
              $track_name = "\"" . "\"";
            }
            ?>

            let track_name = <?php echo $track_name; ?>;
            if (Array.isArray(track_name)) {

              // console.log(track_name[index_for_input])

              tracks_html +=
                '<div class="col-md-6"><label class="form-label" for="track_song_name' + i +
                '">Name <span style="color: red;">(required)</span></label></label><input type="text" id="track_song_name' +
                i + '" name="track_name[]"  value="' + track_name[index_for_input] +
                '" class="form-control"<label></div>';

            } else {

              tracks_html +=
                '<div class="col-md-6"><label class="form-label" for="track_song_name' + i +
                '">Name <span style="color: red;">(required)</span></label></label><input type="text" id="track_song_name' +
                i + '" name="track_name[]"  value="' + track_name +
                '" class="form-control"<label></div>';

            }


            //  mix version
            <?php
            $track_mix_version = "";
            if (isset($draft_data["track_mix_version[]"]) && !empty($draft_data["track_mix_version[]"])) {

              if (is_array($draft_data["track_mix_version[]"])) {
                $track_mix_version = json_encode($draft_data["track_mix_version[]"]);

              } else {
                $track_mix_version = "\"" . $draft_data["track_mix_version[]"] . "\"";
              }
            } else {
              $track_mix_version = "\"" . "\"";
            }
            ?>

            let track_mix_version = <?php echo $track_mix_version; ?>;
            if (Array.isArray(track_mix_version)) {
              console.log(track_mix_version[index_for_input])
              tracks_html +=
                '<div class="col-md-6"><label class="form-label" for="track_mix_version' +
                i +
                '">Mix Version <span style="color: red;">(required)</span></label></label><input type="text"  value="' +
                track_mix_version[index_for_input] + '" id="track_mix_version' + i +
                '" name="track_mix_version[]" class="form-control"></div>';
            } else {
              tracks_html +=
                '<div class="col-md-6"><label class="form-label" for="track_mix_version' +
                i +
                '">Mix Version <span style="color: red;">(required)</span></label></label><input type="text"  value="' +
                track_mix_version + '" id="track_mix_version' + i +
                '" name="track_mix_version[]" class="form-control"></div>';
            }

            // track_primary_artist 
            tracks_html +=
              '<div class="col-md-6"><label class="form-label" for="track_primary_artist' +
              i +
              '">Primary Artist <span style="color: red;">(required)</span></label></label><select id="track_primary_artist' +
              i + '" name="track_primary_artist[' + (i - 1) + '][]" class="select2 primary_artist" multiple><option label=" "> - Select Primary Artists - </option><?php $query = $db->query("SELECT * FROM artists WHERE user_id = " . $_SESSION['login_userid']);
              while ($row = $query->fetch_assoc()) {
                echo '<option value="' . $row['artist_name'] . '">' . $row['artist_name'] . '</option>';
              } ?></select></div>';

            // ===================================================================================
            // these are done by ajax start write below where we use select2 function
            tracks_html +=
              '<div class="col-md-6"><label class="form-label" for="track_featuring' + i +
              '">Featuring <span style="color: red;">(required)</span></label></label><select id="track_featuring' +
              i + '" name="track_featuring[' + (i - 1) + '][]" class="select2 featuring" multiple><option label=" "> - Select Featuring Artists - </option><?php $query = $db->query("SELECT * FROM artists WHERE user_id = " . $_SESSION['login_userid']);
              while ($row = $query->fetch_assoc()) {
                echo '<option value="' . $row['artist_name'] . '">' . $row['artist_name'] . '</option>';
              } ?></select></div>';
            tracks_html +=
              '<div class="col-md-6"><label class="form-label" for="track_remixer' + i +
              '">Remixer <span style="color: red;">(required)</span></label></label><select id="track_remixer' +
              i + '" name="track_remixer[' + (i - 1) + '][]" class="select2 remixer" multiple><option label=" "> - Select Remixer - </option><?php $query = $db->query("SELECT * FROM artists WHERE user_id = " . $_SESSION['login_userid']);
              while ($row = $query->fetch_assoc()) {
                echo '<option value="' . $row['artist_name'] . '">' . $row['artist_name'] . '</option>';
              } ?></select></div>';
            // =================================ajax call end ===========================================
            <?php

            $track_composer = "";
            if (isset($draft_data["track_composer[]"]) && !empty($draft_data["track_composer[]"])) {
              if (is_array($draft_data["track_composer[]"])) {
                $track_composer = json_encode($draft_data["track_composer[]"]);
              } else {
                $track_composer = "\"" . $draft_data["track_composer[]"] . "\"";
              }
            } else {
              $track_composer = "\"" . "\"";
            }

            ?>
            // ===================================================================
            let track_composer = <?php echo $track_composer; ?>;
            tracks_html +=
              '<div class="col-md-6"><label class="form-label" for="track_contributor' + i +
              '">Composer <span style="color: red;">(required)</span></label><select id="track_contributor' +
              i +
              '" name="track_composer[]" class="select2 composer"><option label=" " value=" "> - Select Composer - </option>';

            <?php
            $query = $db->query("SELECT * FROM artists WHERE user_id = " . $_SESSION['login_userid']);
            while ($row = $query->fetch_assoc()) {
              $composer_realname = $row['artist_realname'];

              ?>
              if (tracks_count == 1) {

                if (track_composer == "<?php echo $composer_realname; ?>") {
                  <?php echo 'tracks_html += \'<option selected value="' . $composer_realname . '" ' . $selected . '>' . $composer_realname . '</option>\';'; ?>
                } else {
                  <?php echo 'tracks_html += \'<option value="' . $composer_realname . '" ' . '' . '>' . $composer_realname . '</option>\';'; ?>
                }

              } else {


                if (track_composer[index_for_input] == "<?php echo $composer_realname; ?>") {
                  <?php echo 'tracks_html += \'<option selected value="' . $composer_realname . '" ' . $selected . '>' . $composer_realname . '</option>\';'; ?>
                } else {
                  <?php echo 'tracks_html += \'<option value="' . $composer_realname . '" ' . '' . '>' . $composer_realname . '</option>\';'; ?>
                }

              }

            <?php } ?>

            tracks_html += '</select></div>';




            // =============================================================================

            //  =========================main genre =====================================



            <?php

            $track_primary_genre = "";
            if (isset($draft_data["track_main_genre[]"]) && !empty($draft_data["track_main_genre[]"])) {
              if (is_array($draft_data["track_main_genre[]"])) {
                $track_primary_genre = json_encode($draft_data["track_main_genre[]"]);
              } else {
                $track_primary_genre = "\"" . $draft_data["track_main_genre[]"] . "\"";
              }
            } else {
              $track_primary_genre = "\"" . "\"";
            }

            ?>
            // ===================================================================
            let track_primary_genre = <?php echo $track_primary_genre; ?>;

            tracks_html +=
              '<div class="col-md-6"><label class="form-label" for="track_primary_genre' + i +
              '">Main Genre <span style="color: red;">(required)</span></label></label><select data-count="' + index_for_input + '" id="track_primary_genre' +
              i + '" name="track_main_genre[]"  class="select2 main_genre" data-id="' + i + '"><option label=" "> - Select Primary Genre - </option>';

            <?php
            $query = $db->query("SELECT * FROM main_genre");
            while ($row = $query->fetch_assoc()) {
              $title_realname = $row['title'];

              ?>

              if (tracks_count == 1) {

                if (track_primary_genre == "<?php echo $title_realname; ?>") {
                  <?php echo 'tracks_html += \'<option selected value="' . $title_realname . '" ' . $selected . '>' . $title_realname . '</option>\';'; ?>
                } else {
                  <?php echo 'tracks_html += \'<option value="' . $title_realname . '" ' . '' . '>' . $title_realname . '</option>\';'; ?>
                }
              }
              else {
                // console.log("ok____"+track_primary_genre[index_for_input] )

                if (track_primary_genre[index_for_input] == "<?php echo $title_realname; ?>") {
                  <?php echo 'tracks_html += \'<option selected value="' . $title_realname . '" ' . $selected . '>' . $title_realname . '</option>\';'; ?>
                } else {
                  <?php echo 'tracks_html += \'<option value="' . $title_realname . '" ' . '' . '>' . $title_realname . '</option>\';'; ?>
                }
              }


            <?php } ?>

            tracks_html += '</select></div>';



            // =======================================================================

            tracks_html +=
              '<div class="col-md-6"><label class="form-label" for="track_secondary_genre' +
              i +
              '"> Genre <span style="color: red;">(required)</span></label></label><select id="track_secondary_genre' +
              i +
              '" name="track_genre[]" class="select2 secondary_genre"><option label=" ">- Select Primary Genre first -</option></select></div>';


            // tracks_html +=
            // '<div class="col-md-6"><label class="form-label" for="track_recording_year' +
            // i +
            // '">Recording Year <span style="color: red;">(required)</span></label></label><select id="track_recording_year' +
            // i +
            // '" name="track_recording_year[]" class="form-control"><option value="2019">2019</option><option value="2020">2020</option><option value="2021">2021</option><option value="2022">2022</option><option value="2023">2023</option><option value="2024">2024</option></select></div>';

            tracks_html +=
              '<div class="col-md-6"><label class="form-label" for="track_recording_year' +
              i +
              '">Recording Year <span style="color: red;">(required)</span></label></label><select id="track_recording_year' +
              i +
              '" name="track_recording_year[]" class="form-control">';

            const recordingYears = ['2019', '2020', '2021', '2022', '2023', '2024'];
            for (const year of recordingYears) {
              <?php
              if (isset($draft_data["track_recording_year[]"])) {
                # code...
                if (is_array($draft_data["track_recording_year[]"])) {
                  # code...
              
                  ?>
                  let yearValue = <?php echo json_encode($draft_data["track_recording_year[]"]) ?>;

                  var isSelected = yearValue[index_for_input] === year ? 'selected' : '';
                  tracks_html += '<option value="' + year + '" ' + isSelected + '>' + year + '</option>';

                <?php } else {

                  ?>
                  var isSelected = "<?php echo $draft_data["track_recording_year[]"] ?>" === year ? 'selected' : '';
                  tracks_html += '<option value="' + year + '" ' + isSelected + '>' + year + '</option>';

                  <?php
                }

              } else {
                ?>
                tracks_html += '<option value="' + year + '">' + year + '</option>';


                <?php
              } ?>
            }

            tracks_html += '</select></div>';


            tracks_html +=
              '<div class="col-md-6"><label class="form-label" for="track_album_only' + i +
              '">Album Only <span style="color: red;">(required)</span></label></label><br><input type="checkbox" id="track_album_only' +
              i +
              '" name="track_album_only[]" value="Yes" class="form-check-input"><input type="hidden" name="track_album_only[]" value="No"></div>';
            // tracks_html += '<div class="col-sm-6"><label class="form-label" for="track_vocals'+i+'">Vocals</label><select class="form-control" id="track_vocals'+i+'" name="track_vocals[]"><option value="Yes">Yes</option><option value="No">No</option></select></div>';
            tracks_html +=
              '<div class="col-sm-6"><label class="form-label" for="track_explicit_status' +
              i +
              '">Explicit Status <span style="color: red;">(required)</span></label></label><select class="form-control" id="track_explicit_status' +
              i +
              '" name="track_explicit_status[]"><option value="Explicit">Explicit</option><option value="Non-Explicit">Non-Explicit</option><option value="Clean">Clean</option></select></div>';
            tracks_html +=
              '<div class="col-md-6"><label class="form-label" for="track_primary_genre' + i +
              '">Vocal Language <span style="color: red;">(required)</span></label></label><select id="track_vocal_lang' +
              i + '" name="track_vocal_language[]" class="select2 vocal_language" data-id="' +
              i + '"><option label=" "> - Select - </option><?php $query = $db->query("SELECT * FROM languages");
              while ($row = $query->fetch_assoc()) {
                echo '<option value="' . $row['key'] . '">' . $row['name'] . '</option>';
              } ?></select></div>';


            if (tracks_count >= 1) {
              tracks_html += '<div class="col-md-12"><br></div>';

            }


          }

          $(document).ready(function () {
            $(".main_genre option:selected").each(function () {
              var main_genre = $(this).val();

              var id = $(this).parent("select").data("id");
              var count = $(this).parent("select").data("count");
              console.log(id)
              $.ajax({
                url: "ajax_files/get_sub_genre.php",
                data: {
                  main_genre: main_genre,
                  count: count

                },
                type: 'GET',
                success: function (data) {

                  $('#track_secondary_genre' + id).html(data);

                  // console.log(data)
                  $('#track_secondary_genre' + id).select2();
                }
              });
            });




          });

          // =======================================================================
          // console.log($("#step_two_html_position").html());
          // return;
          tracks_download_html += '</div>';

          if ($("#step_two_html_position").html() == "") {
            // tracks_html += next_prev_html;
            $('#step_two_html_position').html("");
            $('#step_two_html_position').html(tracks_html);

            $("#tracks_upload_status").html(tracks_download_html);

            $(".main_genre").each(function () {

              $(this).select2();
            });
            $(".secondary_genre").each(function () {
              $(this).select2();
            });

            <?php
            $primary_artist_count = 0;

            echo "var primaryArtistCount = $primary_artist_count;";

            ?>

            $(".primary_artist").each(function (abc) {
              var this_primary_artist = $(this)
              // var count = 
              var selectedArtists = '';
              $.ajax({
                type: "POST",
                url: "./ajax_files/test_release.php",
                data: {
                  primary_artist_count: primaryArtistCount++
                }, // Increment here
                success: function (response) {
                  console.log(response);
                  selectedArtists = JSON.parse(response);
                
                  // if (typeof JSON.parse(response) == "string") {
                  //   selectedArtists = response;
                  // }
                  // else {
                  //   selectedArtists = JSON.parse(response);
                  // }

                  // console.log(Array.isArray(JSON.parse(response))+"okadsjkdsjlkdsa")
                  // console.log("PHP variable updated successfully." + primaryArtistCount);
                  if (selectedArtists != '') {

                    if (Array.isArray(selectedArtists)) {


                      if (selectedArtists.length) {

                        for (let index = 0; index <
                          selectedArtists.length; index++) {
                          var option = new Option(
                            selectedArtists[index],
                            selectedArtists[index],
                            true, true);
                          $(this_primary_artist).append(
                            option);
                        }
                        console.log('primary artist count' +
                          primaryArtistCount);
                        $(this_primary_artist).trigger(
                          'change');
                      } else {
                        console.error(
                          "Element with id 'track_primary_artist" +
                          i + "' not found.");
                      }
                    } else {
                      console.log('#track_primary_artist' + i);
                      var option = new Option(selectedArtists,
                        selectedArtists, true, true);
                      $(this_primary_artist).append(option);
                      $(this_primary_artist).trigger('change');
                    }
                  }
                  else {
                    console.log("ok")
                  }
                },
                error: function (xhr, status, error) {
                  console.error("Error updating PHP variable:",
                    error);
                }
              });





              $(this).select2();

              // Increment the primary artist count and update it via AJAX


            });


            <?php
            $featuring_count = 0;

            echo "var featuringCount = $featuring_count;";

            ?>




            $(".featuring").each(function () {

              var this_featuring = $(this)

              var selectedfeaturing = '';
              $.ajax({
                type: "POST",
                url: "./ajax_files/test_release.php",
                data: {
                  featuring_count: featuringCount++
                }, // Increment here
                success: function (response) {
                  // selectedfeaturing = JSON.parse(response);


                  if (typeof response == "string") {
                    selectedfeaturing = response;
                  }
                  else {
                    selectedfeaturing = JSON.parse(response);
                  }

                  // console.log("PHP variable updated successfully." + primaryArtistCount);
                  if (selectedfeaturing != '') {

                    if (Array.isArray(selectedfeaturing)) {


                      if (selectedfeaturing.length) {

                        for (let index = 0; index <
                          selectedfeaturing.length; index++) {
                          var option = new Option(
                            selectedfeaturing[index],
                            selectedfeaturing[index],
                            true, true);
                          $(this_featuring).append(option);
                        }

                        $(this_featuring).trigger('change');
                      } else {
                        console.error(
                          "Element with id 'this_featuring" +
                          i + "' not found.");
                      }
                    } else {

                      var option = new Option(selectedfeaturing,
                        selectedfeaturing, true, true);
                      $(this_featuring).append(option);
                      $(this_featuring).trigger('change');
                    }
                  }
                },
                error: function (xhr, status, error) {
                  console.error("Error updating PHP variable:",
                    error);
                }
              });



              $(this).select2();
            });



            <?php
            $remixer_count = 0;

            echo "var remixerCount = $remixer_count;";

            ?>

            $(".remixer").each(function () {


              var this_remixer = $(this)
              // console.log("kk_" + remixerCount)
              var selectedRemixer = '';
              $.ajax({
                type: "POST",
                url: "./ajax_files/test_release.php",
                data: {
                  remixer_count: remixerCount++
                }, // Increment here
                success: function (response) {
                  selectedRemixer = JSON.parse(response);


                  if (typeof selectedRemixer == "string") {
                    selectedRemixer = response;
                  }
                  else {
                    selectedRemixer = JSON.parse(response);
                    // selectedRemixer = JSON.parse(response);
                    console.log("this_remixer" + selectedRemixer)

                  }

                  // console.log("PHP variable updated successfully." + primaryArtistCount);
                  if (selectedRemixer != '') {

                    if (Array.isArray(selectedRemixer)) {


                      if (selectedRemixer.length) {

                        for (let index = 0; index <
                          selectedRemixer.length; index++) {
                          var option = new Option(
                            selectedRemixer[index],
                            selectedRemixer[index],
                            true, true);
                          $(this_remixer).append(option);
                        }

                        $(this_remixer).trigger('change');
                      } else {
                        console.error(
                          "Element with id 'track_primary_artist" +
                          i + "' not found.");
                      }
                    } else {
                      var option = new Option(selectedRemixer,
                        selectedRemixer, true, true);
                      $(this_remixer).append(option);
                      $(this_remixer).trigger('change');
                    }
                  }
                },
                error: function (xhr, status, error) {
                  console.error("Error updating PHP variable:",
                    error);
                }
              });


              $(this).select2();
            });


            $(".composer").each(function () {
              $(this).select2();
            });
            $(".vocal_language").each(function () {
              $(this).select2();
            });

          }


        }

      });
      $('#step_two_next').click(function () {
        if ($('#social-links-validation').hasClass('active')) {
          // alert("yes");

        }

      });

      (() => {
        var main_genre = $('#main_genre').val();
        // var main_genre = $(this).val();
        var count = "genre";
        if (main_genre != "" && main_genre != undefined) {


          console.log(main_genre)
          $.ajax({
            url: "ajax_files/get_sub_genre.php",
            data: {
              main_genre: main_genre,
              count: count
            },
            type: 'GET',
            success: function (data) {
              //   console.log(data);
              $('#sub_genre').html(data);
              $('#sub_genre').select2();

            }
          });
        }
      })()

      $('#main_genre').change(function () {
        console.log("change")
        var main_genre = $(this).val();
        // var main_genre = $(this).val();
        var count = "genre";

        $.ajax({
          url: "ajax_files/get_sub_genre.php",
          data: {
            main_genre: main_genre,
            count: count
          },
          type: 'GET',
          success: function (data) {
            //   console.log(data);
            $('#sub_genre').html(data);
            $('#sub_genre').select2();

          }
        });


      });


      $(document).on('change', '.main_genre', function () {
        //   alert("trt");
        var main_genre = $(this).val();
        var id = $(this).data("id");
        var count = $(this).data("count");
        $.ajax({
          url: "ajax_files/get_sub_genre.php",
          data: {
            main_genre: main_genre,
            count: count
          },
          type: 'GET',
          success: function (data) {
            //   console.log(data);
            $('#track_secondary_genre' + id).html(data);
            $('#track_secondary_genre' + id).select2();

          }
        });


      });
      $("#no_of_tracks").on('change', function () {
        if ($(this).val() >= 1 && $(this).val() <= 3) {
          $("#pricing_tier").val("F");
        } else {
          $("#pricing_tier").val("B");
        }


      });
      $("#cover").click(function () {
        $("#progress_bar").hide();
        $("#uploaded_image").hide();
        if ($("#catalog_no").val() == "") {
          alert("Catalog No. is required");
          return false;
        }

      });
      $("input[type='submit']").click(function () {
        $(".loader").removeClass("d-none");
      });
      $('#label_name').on('change', function () {
        //   console.log("e"); 
        var year = "2024";
        $("#pline").attr("value", year + " " + $(this).val());
        $("#cline").attr("value", year + " " + $(this).val());
      });

      $(document).ready(function () {
        console.log("Document ready"); // Document ready check

        console.log("Element count:", $('#wizard-validation-form').length); // Check element existence
        let debounceTimer;

        $('#wizard-validation-form').on('blur  paste', 'input, select, textarea', function () {
          clearTimeout(debounceTimer);
          const fieldValue = $(this).val();

          debounceTimer = setTimeout(() => {
            console.log("Timeout function executing"); // Log timeout execution

            // Filter out empty or blank fields
            var data = $('#wizard-validation-form').serializeArray().filter(function (item) {
              return $.trim(item.value) !== '';
            });

            // Convert filtered data back to serialized string
            var serializedData = $.param(data);
            console.log(serializedData)

            if (serializedData !== '') { // Check if there is any non-blank data to send
              var dataToSend = $('#wizard-validation-form').serialize();

              $.ajax({
                url: "ajax_files/dynamic_upload.php",
                data: {
                  data: dataToSend
                },
                type: 'POST',
                beforeSend: function () {
                  $('#status-message').html('Saving...').addClass('show');
                },
                success: function (response) {
                  console.log("AJAX request successful", response); // Log success response

                  $('#status-message').html('Saved').addClass('show');

                  setTimeout(function () {
                    $('#status-message').removeClass('show');
                  }, 3000);

                },
                error: function (error) {
                  console.error("AJAX request failed", error); // Log error
                  $('#status-message').html('Error saving form').addClass('show');
                }
              });
            } else {
              console.log("No non-blank fields to save"); // Log if no non-blank fields
            }
          }, 1500); // Debounce time in milliseconds (e.g., 300ms)
        });

        // $('#wizard-validation-form').on('blur paste', 'input,select textarea', function () {
        //   console.log("Element blur or pasted"); // Log event trigger
        //   $('#status-message').html('Saving...').addClass('show');
        //   setTimeout(function () {
        //     console.log("Timeout function executing"); // Log timeout execution

        //     // Filter out empty or blank fields
        //     var data = $('#wizard-validation-form').serializeArray().filter(function (item) {
        //       return $.trim(item.value) !== '';
        //     });

        //     // Convert filtered data back to serialized string
        //     var serializedData = $.param(data);
        //     console.log(serializedData)

        //     if (serializedData !== '') { // Check if there is any non-blank data to send
        //       var data = $('#wizard-validation-form').serialize();
        //       // var data = serializedData;


        //       $.ajax({
        //         url: "ajax_files/dynamic_upload.php",
        //         data: {
        //           data: data
        //         },
        //         type: 'POST',
        //         success: function (response) {
        //           console.log("AJAX request successful",
        //             response); // Log success response

        //           $('#status-message').html('Saved').addClass('show');

        //           setTimeout(function () {
        //             $('#status-message').removeClass('show');
        //           }, 3000);

        //         },
        //         error: function (error) {
        //           console.error("AJAX request failed", error); // Log error
        //           $('#status-message').html('Error saving form').addClass('show');
        //         }
        //       });
        //     } else {
        //       console.log("No non-blank fields to save"); // Log if no non-blank fields
        //     }

        //   }, 5000);
        // });





        // $('#wizard-validation-form').on('change', 'select', function () {
        //   console.log("Element change or pasted"); // Log event trigger

        //   $('#status-message').html('Saving...').addClass('show');
        //   setTimeout(function () {
        //     console.log("Timeout function executing"); // Log timeout execution

        //     // Filter out empty or blank fields
        //     var data = $('#wizard-validation-form').serializeArray().filter(function (item) {
        //       return $.trim(item.value) !== '';
        //     });

        //     // Convert filtered data back to serialized string
        //     var serializedData = $.param(data);
        //     console.log(serializedData)

        //     if (serializedData !== '') { // Check if there is any non-blank data to send
        //       var data = $('#wizard-validation-form').serialize();
        //       // var data = serializedData;


        //       $.ajax({
        //         url: "ajax_files/dynamic_upload.php",
        //         data: {
        //           data: data
        //         },
        //         type: 'POST',
        //         success: function (response) {
        //           console.log("AJAX request successful",
        //             response); // Log success response

        //           $('#status-message').html('Saved').addClass('show');

        //           setTimeout(function () {
        //             $('#status-message').removeClass('show');
        //           }, 3000);

        //         },
        //         error: function (error) {
        //           console.error("AJAX request failed", error); // Log error
        //           $('#status-message').html('Error saving form').addClass('show');
        //         }
        //       });
        //     } else {
        //       console.log("No non-blank fields to save"); // Log if no non-blank fields
        //     }

        //   }, 10000);
        // });



      });




      $(document).on("click", ".create_release", function () {
        $("input[type='file']").each(function () {
          $(this).remove();

        });
        setTimeout(function () {
          $("form").submit();
        }, 4000);
      });


      $(document).on("change", ".track_upload", function () {




        console.log("hello");

        var file = $(this).get(0).files[0];
        var file_id = $(this).attr("data-file-id");
        if (file) {
          var reader = new FileReader();

          reader.onload = function () {
            // $("#previewImg").attr("src", reader.result);
            // $('#previewImg').removeClass("d-none");

          }

          reader.readAsDataURL(file);
        }



        console.log($(this).get(0).files[0].type);
        var form_data = new FormData();

        var image_number = 1;

        var error = '';

        // for(var count = 0; count < $('#cover').files.length; count++)  
        // {
        // if(!['image/jpeg', 'image/png', 'video/mp4'].includes($(this).get(0).files[0].type))
        // {
        //     error += '<div class="alert alert-danger"><b>'+image_number+'</b> Selected File must be .jpg or .png Only.</div>';
        // }
        // else
        // {
        form_data.append("track_file", $(this).get(0).files[0]);
        // }
        form_data.append("file_id", $(this).attr("data-file-id"));
        form_data.append("catalog", $('#catalog_no').val());
        //     image_number++;
        // }

        if (error != '') {
          // $('#uploaded_image').innerHTML = error;

          // $('#cover').value = '';
        } else {
          $("#tracks_upload_status").show();
          $('#progress_bar' + file_id).css("display", "block");
          $("#progress_bar" + file_id).show();

          $('#progress_bar_process' + file_id).css("width", '0%');

          $('#progress_bar_process' + file_id).html('0% completed');


          open_downloads_menu();
          $("#track_downloads_row" + file_id).attr("class",
            "list-group-item list-group-item-action dropdown-notifications-item");
          var ajax_request = new XMLHttpRequest();

          ajax_request.open("POST", "ajax_files/dynamic_upload.php");

          ajax_request.upload.addEventListener('progress', function (event) {

            var percent_completed = Math.round((event.loaded / event.total) * 101);

            $('#progress_bar_process' + file_id).css("width", percent_completed + '%');

            $('#progress_bar_process' + file_id).html(percent_completed +
              '% completed');

          });

          ajax_request.addEventListener('load', function (event) {

            // $('#uploaded_image').html( '<div class="alert alert-success">Files Uploaded Successfully</div>');
            var data = JSON.parse(this.response);
            // $("#final_cover").val(data.cover_art);

            // $("#uploaded_image").show();
            // $('#cover').val() = '';

          });

          ajax_request.send(form_data);
        }
      });








    });
  </script>


</body>
<style>
  #successMessage {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    z-index: 9999;
    /* Make sure it appears above other elements */
  }
</style>

<div id="successMessage" class="alert alert-success d-none" role="alert">
  Release information saved successfully!
</div>

</html>