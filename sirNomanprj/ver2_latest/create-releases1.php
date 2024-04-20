<?php 
session_set_cookie_params(86400);
session_start();
include('include/dbConfig.php');


    if(strlen($_SESSION['user_login'])==0){
        echo '<script>window.location="login.php"</script>';  
    }


if(isset($_POST['create'])){
    
    $upload = false;
    $error = false;
    $success = false;
    // echo '<pre>';
    // print_r($_POST);
    // die();
    $post_data = $_POST;
    $release_id_verify_unique == false;
    $release_uid = uniqid('r_', true);
    // echo $release_uid;
   while($release_id_verify_unique==false){
        $query = $db->query("SELECT * FROM releases WHERE rid = '$release_uid'");
        if(mysqli_num_rows($query)!=0){
            $release_uid = uniqid('r_', true);
        }else {
            $release_id_verify_unique = true;
        }
        
    }
    // echo $release_uid;
    
      $dir = "releases/";
  
    mkdir($dir.$release_uid, 0777, true);
     chmod($dir.$release_uid, 0777);
    $file = $_FILES['cover_art'];
    //Getting the file name of the uploaded file
    $fileName = $_FILES['cover_art']['name'];
    //Getting the Temporary file name of the uploaded file
    $fileTempName = $_FILES['cover_art']['tmp_name'];
    //Getting the file size of the uploaded file
    $fileSize = $_FILES['cover_art']['size'];
    //getting the no. of error in uploading the file
    $fileError = $_FILES['cover_art']['error'];
    //Getting the file type of the uploaded file
    $fileType = $_FILES['cover_art']['type'];

    //Getting the file ext
    $fileExt = explode('.',$fileName);
    $fileActualExt = strtolower(end($fileExt));

    //Array of Allowed file type
    $allowedExt = array("jpg","jpeg","png","pdf");
    if($_FILES['cover_art']['name'] != ""){
        //Checking, Is file extentation is in allowed extentation array
        if(in_array($fileActualExt, $allowedExt)){
            //Checking, Is there any file error
            if($fileError == 0){
                //Checking,The file size is bellow than the allowed file size
                if($fileSize < 10000000){
                    //Creating a unique name for file
                    if($_FILES["cover_art"]["name"]!=""){
                        $fileNemeNew = $_POST['catalog'].".".$fileActualExt;
                        mkdir($dir.$release_uid.'/', 0777 , true );
                        chmod($dir.$release_uid.'/', 0777);
                        $path = $dir.$release_uid.'/';
                        //File destination
                        $fileDestination = $path.$fileNemeNew;
                        //function to move temp location to permanent location
                        if (move_uploaded_file($fileTempName, $fileDestination)) {
                              
                            $post_data['cover_art'] = $fileNemeNew;
                            // echo "File Uploaded successfully";
                        } else {
                            echo "File Uploaded Error";
                        }
                    } else {
                        $post_data['cover_art'] = null;
                    }
                    //Message after success
                    
                }else{
                    //Message,If file size greater than allowed size
                    echo "File Size Limit beyond acceptance";
                }
            }else{
                //Message, If there is some error
                echo "Something Went Wrong Please try again!";
            }
        }else{
            //Message,If this is not a valid file type
            $errormsg = "You can't upload this extention of file";
            $error = true;
        }
    }
    // unset($post_data['create']);
    // unset($post_data['track_song_name']);
    // unset($post_data['track_mix_version']);
    
    // echo '<pre>';
         
     
     $data = json_encode($post_data, true);
    //  print_r($data);
     
    if(mysqli_query($db, "INSERT INTO releases (rid,user_id, release_meta, created_at) VALUES ('$release_uid',".$_SESSION['login_userid'].", '$data', '".date('Y-m-d h:i:s')."' ) ")){
        // echo 'done';
    }

    for($i = 0; $i<=count($_FILES['track_audio_file']['name']); $i++){
            mkdir($dir.$release_uid."/",0777,true);
            chmod($dir.$release_uid."/", 0777);
            $fileExt = explode('.',$_FILES['track_audio_file']['name'][$i]);
    $fileActualExt = strtolower(end($fileExt));
            $audio_path = $dir.$release_uid."/".$_POST['catalog']."_".($i+1).".".$fileActualExt;
            
            if(move_uploaded_file($_FILES['track_audio_file']['tmp_name'][$i], $audio_path)){
                $song_name = isset($_POST['track_name'][$i]) ? $_POST['track_name'][$i] : "";
                $mix_version = isset($_POST['track_mix_version'][$i]) ? $_POST['track_mix_version'][$i] : "";
                $primary_artist = isset($_POST['track_primary_artist'][$i]) ? implode("," ,$_POST['track_primary_artist'][$i]) : "";
                $featuring = isset($_POST['track_featuring'][$i]) ? implode("," ,$_POST['track_featuring'][$i]) : "";
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
                
                $query = "INSERT INTO `tracks`
                                    (
                                        `rid`,
                                        `track_audio_file`,
                                        `track_song_name`,
                                        `track_mix_version`,
                                        `track_primary_artist`,
                                        `track_featuring`,
                                        `track_remixer`,
                                        `track_contributor`,
                                        `track_primary_genre`,
                                        `track_secondary_genre`,
                                        `track_recording_year`,
                                        `track_country_recording`,
                                        `track_isrc_code`,
                                        `track_price_tier`,
                                        `track_album_only`,
                                        `track_vocals`,
                                        `track_explicit_status`,
                                        `track_vocal_lang`,
                                        `created_at`
                                    )
                                    VALUES(
                                        '$release_uid', 
                                        '$audio_path', 
                                        '$song_name',
                                        '$mix_version', 
                                        '$primary_artist', 
                                        '$featuring',
                                        '$remixer',
                                        '$composer',
                                        '$primary_genre',
                                        '$secondary_genre',
                                        '$recording_year',
                                        '$country_recording',
                                        '$isrc_code',
                                        '$price_tier',
                                        '$album_only',
                                        '$vocals',
                                        '$explicit_status',
                                        '$vocal_lang',
                                        '".date('Y-m-d h:i:s')."'
                                    )";
                // echo $query;
                if (mysqli_query($db, $query)){
                    $success = true;
                }
                
                // echo 'Done: '.$_FILES['track_audio_file']['name'][$i];
            }
        
        
    }
            // die();
        // $values = json_encode($_POST, true);
        
        // $print= json_decode($values, true);
        // print_r($_FILES);
        // echo $_FILES['cover_art'];        
    
    // die();
    
}


?>


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

    ////<title>Create Release | Q Phonic ENT </title>
    ////<meta name="description"
        content="Most Powerful &amp; Comprehensive Bootstrap 5 HTML Admin Dashboard Template built for developers!" />
    /////<meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
    <!-- laravel CRUD token -->
    <meta name="csrf-token" content="NAkv4GSUnfPXqyp3qBI0BHmCQFVjuX3uksB9sEaY">
    <!-- Canonical SEO -->
    <link rel="canonical"
        href="../../../themeselection.com/item/sneat-bootstrap-html-laravel-admin-template/index.html">
    <!-- Favicon -->
   <link rel="icon" type="image/x-icon" href="icons/purple.jpeg"/>

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
      pathResolver: function(path) {
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
      'controls': ["rtl","style","layoutType","showDropdownOnHover","layoutNavbarFixed","layoutFooterFixed","themes"],
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
    <!-- Layout Content -->
    <div class="layout-wrapper layout-content-navbar ">
        <div class="layout-container">
          <?php include('include/aside.php'); ?>

            <!-- Layout page -->
            <div class="layout-page">
                <!-- BEGIN: Navbar-->
                <!-- Navbar -->
                <?php include('include/nav.php'); ?>          
                <!-- / Navbar -->
                <!-- END: Navbar-->


                <!-- Content wrapper -->
                <div class="content-wrapper">

                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">

                        <div class="row">
                            <div class="col-12">
                                  <?php if (isset($errormsg)){
                                    echo $errormsg;
                                  }?>
                            </div>    
                             <div class="col-12">
                                  <?php if ($success == true){
                                    ?>
                                    <div class="alert alert-primary alert-dismissible bg-success text-white" role="alert">Release created<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
                                    <?php
                                  }?>
                            </div>    
                          <div class="col-12">
                            <h5>Create a new Release</h5>
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
                                      <span class="bs-stepper-title">Release info</span>
                                      <span class="bs-stepper-subtitle">All about release</span>
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
                                      <span class="bs-stepper-subtitle">Releasing information </span>
                                    </span>
                                  </button>
                                </div>
                              </div>
                              <div class="bs-stepper-content">
                                <form action="create-releases.php" method="POST" enctype="multipart/form-data" id="wizard-validation-form" onSubmit="return false">
                                  <!-- Account Details -->
                                  <div id="account-details-validation" class="content">
                                    <div class="content-header mb-3">
                                      <h6 class="mb-0">Release Details</h6>
                                      <small>Describe your release</small>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                          <img id="previewImg" class="w-100 d-none" src="" alt="Placeholder">
                                     </div>
                                      <div class="col-sm-12">
                                        <div class="input-group">
                                          <input type="file" class="form-control" onchange="previewFile(this);" id="cover" name="cover_art" value="">
                                          <label class="input-group-text" for="coverart">Cover Art</label>
                                        </div>
                                     </div>
                                     <script>
                                         function previewFile(input){
        var file = $("#cover").get(0).files[0];
 
        if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
                $("#previewImg").attr("src", reader.result);
                $('#previewImg').removeClass("d-none");
            }
 
            reader.readAsDataURL(file);
        }
    }
                                     </script>
                             
                                      <div class="col-sm-6">
                                        <label class="form-label" for="release_name">Name</label>
                                        <input type="text" name="name" id="release_name" class="form-control" placeholder="Rock Muzic..." />
                                      </div>
                                      <div class="col-sm-6">
                                        <label class="form-label" for="catalog_no">Catalog</label>
                                        <input type="text" name="catalog" id="catalog_no" class="form-control" placeholder="e.g, 40501" aria-label="Catalog No." />
                                      </div>
                                      <div class="col-sm-6">
                                        <label class="form-label" for="upc">UPC Code</label>
                                        <input type="text" name="u_p_c_code" id="upc" class="form-control" placeholder="e.g, U1000001" aria-label="UPC" />
                                      </div> 
                                      
                                      <div class="col-sm-6">
                                        <div class="col-md">
                                            <small class="text-light fw-semibold">Compilation</small>
                                            <div class="form-check mt-3">
                                              <input name="compilation" class="form-check-input" type="radio" value="Standard_release" name="compilation" id="standard_release" checked>
                                              <label class="form-check-label" for="standard_release">
                                                Standard Release
                                              </label>
                                            </div>
                                            <div class="form-check">
                                              <input name="compilation" class="form-check-input" type="radio" value="Compilation" name="compilation" id="compilation">
                                              <label class="form-check-label" for="compilation">
                                                Compilation
                                              </label>
                                            </div>
                                          </div>
                                      </div>
                                      <div class="col-sm-6 bg-primary rounded">
                                        <label class="form-label text-white" for="upc" style="font-weight: 700;">Number of tracks</label>
                                        <input class="form-control" type="number" value="1" min="1" name="no_of_tracks" id="no_of_tracks">
                                        <!--<br>-->
                                      </div>
                                      <div class="col-sm-6">
                                        <label class="form-label" for="various_artists">Various Artists</label>
                                        <!--<input type="text" name="various_artists" id="various_artists" class="form-control" placeholder="e.g, Saleena, Zayn" aria-label="Various Artists" />-->
                                        <select class="select2" id="various_artists" name="various_artists">
                                            <option label=" "></option>
                                            <option value="No">No </option>
                                            <option value="Various">Various</option>
                                        </select>
                                      </div>
                                       <div class="col-sm-6">
                                        <label class="form-label" for="artist_name">Artist</label>
                                        <select class="select2" id="artist_name" name="artists[]" multiple>
                                            <option label=" "></option>
                                        <?php
                                            $query = $db->query("SELECT * FROM artists WHERE user_id = ".$_SESSION['login_userid']);
                                            if(mysqli_num_rows($query)!=0){    
                                                while($row = $query->fetch_assoc()){ 
                                        ?>
                                                    <option value="<?=$row['artist_name']?>"><?=$row['artist_name']?></option>
                                        <?php   }
                                            
                                            } else {
                                                ?>
                                                    <option value="No Labels are added yet" disabled>No Artists are added yet</option>
                                                <?php
                                            }
                                            ?>
                                         </select>
                                        <!--<input type="text" name="artist_name" id="artist_name" class="form-control" placeholder="e.g, John Doe" aria-label="Artist name" />-->
                                      </div>
                                      <div class="col-sm-6">
                                        <label class="form-label" for="label_name">Label Name</label>
                                        <select class="select2" id="label_name" name="label_name">
                                            <option label=" "></option>
                                        <?php
                                            $query = $db->query("SELECT * FROM label_profiles WHERE user_id = ".$_SESSION['login_userid']);
                                            if(mysqli_num_rows($query)!=0){    
                                                while($row = $query->fetch_assoc()){ 
                                        ?>
                                                    <option value="<?=$row['label_name']?>"><?=$row['label_name']?></option>
                                        <?php   }
                                            
                                            } else {
                                                ?>
                                                    <option value="No Labels are added yet" disabled>No Labels are added yet</option>
                                                <?php
                                            }
                                            ?>
                                         </select>
                                      </div>
                                       <div class="col-sm-6">
                                        <label class="form-label" for="main_genre">Main Genre</label>
                                        <select class="select2" id="main_genre" name="main_genre">
                                            <option label=" "></option>
                                        <?php
                                            $query = $db->query("SELECT * FROM main_genre");
                                            if(mysqli_num_rows($query)!=0){    
                                                while($row = $query->fetch_assoc()){ 
                                        ?>
                                                    <option value="<?=$row['title']?>"><?=$row['title']?></option>
                                        <?php   }
                                            
                                            } else {
                                                ?>
                                                    <option value="No genre are added yet" disabled>No Labels are added yet</option>
                                                <?php
                                            }
                                            ?>
                                         </select>
                                        <!--<input type="text" name="main_genre" id="main_genre" class="form-control" placeholder="e.g, Classical Music" aria-label="Main Genre" />-->
                                      </div>
                                      <div class="col-sm-6">
                                        <label class="form-label" for="sub_genre">Genre</label>
                                         <select class="select2" id="sub_genre" name="genre">
                                            <option label=" "> - Select Main Genre -</option>
                                        
                                             
                                         </select>
                                        <!--<input type="text" name="sub_genre" id="sub_genre" class="form-control" placeholder="e.g, Pop Music" aria-label="Sub Genre" />-->
                                      </div>
                                      <div class="col-sm-6">
                                        <label class="form-label" for="pricing_tier">Pricing Tier</label>
                                        <input type="text" name="pricing_tier" id="pricing_tier" class="form-control" placeholder="e.g, Pop Music" aria-label="Sub Genre" />
                                      </div>
                                      <div class="col-sm-6">
                                        <label class="form-label" for="pline">PLine</label>
                                        <input type="text" name="pline" id="pline" class="form-control" placeholder="" aria-label="PLine" />
                                      </div>
                                      <div class="col-sm-6">
                                        <label class="form-label" for="cline">CLine</label>
                                        <input type="text" name="cline" id="cline" class="form-control" placeholder="" aria-label="CLine" />
                                      </div>
                                         <div class="col-sm-6">
                                        <label class="form-label" for="languages_meta">Metadata Language </label>
                                       <select class="select2" id="languages_meta" name="metadata_language">
                                            <?php $query = $db->query("SELECT * FROM languages"); while($row = $query->fetch_assoc()) { echo '<option value="'.$row['name'].'">'.$row['name'].'</option>'; } ?>
                                             
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
                                        </button>
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
                                      <small>Create Tracklist</small>
                                    </div>
                                    <div class="row g-3" id="step_two_html_position"></div>
                                    <div class="row">
                                      <div class="col-12 d-flex justify-content-between">
                                        <button class="btn btn-primary btn-prev">
                                          <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                                          <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                        </button>
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
                                      <h6 class="mb-0">Partners & Dates</h6>
                                      <small>Partners Information</small>
                                    </div>
                                    <div class="row g-3">
                                        
                                       <?php $query = $db->query("SELECT * FROM exclusive_platforms"); 
                                        while($row = $query->fetch_assoc()) { ?>
                                          <div class="col-sm-2 d-flex">
                                            <input type="checkbox" name="stores[]" id="stores" value="<?php echo $row['title'];  ?>" class="form-check-input mx-2" />
                                             <label class="form-label" for="pre_order_date"><?php echo $row['title'];  ?></label>
                                          </div>
                                        <?php } ?>
                                      <div class="col-sm-6">
                                        <label class="form-label" for="exclusive_platform">Exclusive Platform</label>
                                        <select name="exclusive_platform" id="exclusive_platform" class="select2" >
                                            <option label=" ">- Select Platform -</option>
                                            <?php $query = $db->query("SELECT * FROM exclusive_platforms"); while($row = $query->fetch_assoc()) { echo '<option value="'.$row['title'].'">'.$row['title'].'</option>'; } ?>
                                        </select>
                                      </div>
                                       <div class="col-sm-6">
                                        <label class="form-label" for="exclusive_duration">Exclusive Duration</label>
                                        <select name="exclusive_duration" id="exclusive_duration" class="select2" >
                                            <option label=" ">- Select -</option>
                                             <option value="2">2 </option>
                                            <option value="4">4</option>
                                            
                                        </select>
                                      </div>
                                      <div class="col-sm-4">
                                        <label class="form-label" for="pre_order_date">Pre-Order date</label>
                                        <input type="date" name="i_tunes_pre_order_date" id="pre_order_date" class="form-control" />
                                      </div>
                                      <div class="col-sm-4">
                                        <label class="form-label" for="promo_date">Promo Date</label>
                                        <input type="date" name="exclusive_date" id="promo_date" class="form-control" />
                                      </div>
                                      <div class="col-sm-4">
                                        <label class="form-label" for="live_date">Live Date</label>
                                        <input type="date" name="release_date" id="live_date" class="form-control" />
                                      </div>
                                      <div class="col-12 d-flex justify-content-between">
                                        <button class="btn btn-primary btn-prev">
                                          <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                                          <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                        </button>
                                        <div class="loader d-none">
                                            <img src="https://jozmy.com/img/preloader/aabf6174f648272253f8afaff55f9bd5.gif" width="100px">
                                        
                                            Uploading...
                                        </div>
                                        <input type="submit" name="create" class="btn btn-success btn-next btn-submit" value="Submit">
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
                   <?php include("include/footer.php"); ?>
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
     <script src="./assets/vendor/libs/jquery/jquery40f4.js?id=96645acf88116df9c36bef6153b3a51a"></script>
    <script src="./assets/vendor/libs/popper/popper885d.js?id=c8510634b3d8cded74bbe30a2b593d87"></script>
    <script src="./assets/vendor/js/bootstrap0983.js?id=1f50b74ded465d298b282b4562bdaf8c"></script>
    <script src="./assets/vendor/libs/perfect-scrollbar/perfect-scrollbar4d5e.js?id=9d86308b7c41e76a7dc8472907865b83"></script>
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
    <!-- END: Page JS-->
    <script>
        $(document).ready(function(){
            var tracks_html = "";
            var tracks_count = 0;
            var no_of_tracks_allowed = 5;
            // var next_prev_html = ' <div class="col-12 d-flex justify-content-between"> <button class="btn btn-primary btn-prev"> <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i> <span class="align-middle d-sm-inline-block d-none">Previous</span> </button> <button class="btn btn-primary btn-next"> <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span> <i class="bx bx-chevron-right bx-sm me-sm-n2"></i> </button> </div>';
            $('#step_one_next').click(function(){
                
               if($('#personal-info-validation').hasClass('active')){
                    tracks_html="";
                    tracks_count = $('#no_of_tracks').val()<no_of_tracks_allowed ? $('#no_of_tracks').val() : no_of_tracks_allowed;
                    if($('#no_of_tracks').val()>no_of_tracks_allowed) {
                       $('#no_of_tracks').val(no_of_tracks_allowed);
                    //   tracks_html += '<div class="col-sm-2"></div>';
                       tracks_html += '<div class="alert alert-info alert-dismissible" role="alert">Only '+no_of_tracks_allowed+' Tracks are allowed<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                    //   tracks_html += '<div class="col-sm-2"></div>';
                    //   console.log($('#no_of_tracks').val());
                    }
                    // alert('yes');    
                    // WORKING HERE -- STEP 2 
                    for(var i = 1; i<=tracks_count; i++){
                        //tracks_html += '<div class="col-md-12"><h5>Track no. '+i+'</h5></div>';
                     //tracks_html += '<div class="col-sm-12"><div class="input-group"><input type="file" accept="audio/flac" class="form-control" id="track_audio_file' + i + '" name="track_audio_file[]"><label class="input-group-text" for="track_audio_file' + i + '">Audio File</label></div></div>';
                        //tracks_html += '<div class="col-md-6"><label class="form-label" for="track_song_name'+i+'">Name</label><input type="text" id="track_song_name'+i+'" name="track_name[]" class="form-control"></div>';
                        //tracks_html += '<div class="col-md-6"><label class="form-label" for="track_mix_version'+i+'">Mix Version</label><input type="text" id="track_mix_version'+i+'" name="track_mix_version[]" class="form-control"></div>';
                        //tracks_html += '<div class="col-md-6"><label class="form-label" for="track_primary_artist'+i+'">Primary Artist</label><select id="track_primary_artist'+i+'" name="track_primary_artist['+(i-1)+'][]" class="select2 primary_artist" multiple><option label=" "> - Select Primary Artists - </option><?php $query = $db->query("SELECT * FROM artists WHERE user_id = ".$_SESSION['login_userid']); while($row = $query->fetch_assoc()) { echo '<option value="'.$row['artist_name'].'">'.$row['artist_name'].'</option>'; } ?></select></div>';
                        //tracks_html += '<div class="col-md-6"><label class="form-label" for="track_featuring'+i+'">Featuring</label><select id="track_featuring'+i+'" name="track_featuring['+(i-1)+'][]" class="select2 featuring" multiple><option label=" "> - Select Featuring Artists - </option><?php $query = $db->query("SELECT * FROM artists WHERE user_id = ".$_SESSION['login_userid']); while($row = $query->fetch_assoc()) { echo '<option value="'.$row['artist_name'].'">'.$row['artist_name'].'</option>'; } ?></select></div>';
                        //tracks_html += '<div class="col-md-6"><label class="form-label" for="track_remixer'+i+'">Remixer</label><select id="track_remixer'+i+'" name="track_remixer['+(i-1)+'][]" class="select2 remixer" multiple><option label=" "> - Select Remixer - </option><?php $query = $db->query("SELECT * FROM artists WHERE user_id = ".$_SESSION['login_userid']); while($row = $query->fetch_assoc()) { echo '<option value="'.$row['artist_name'].'">'.$row['artist_name'].'</option>'; } ?></select></div>';
                        //tracks_html += '<div class="col-md-6"><label class="form-label" for="track_contributor'+i+'">Composer</label><select id="track_contributor'+i+'" name="track_composer[]" class="select2 composer"><option label=" "> - Select Remixer - </option><?php $query = $db->query("SELECT * FROM artists WHERE user_id = ".$_SESSION['login_userid']); while($row = $query->fetch_assoc()) { echo '<option value="'.$row['artist_realname'].'">'.$row['artist_realname'].'</option>'; } ?></select></div>';
                        //tracks_html += '<div class="col-md-6"><label class="form-label" for="track_primary_genre'+i+'">Main Genre</label><select id="track_primary_genre'+i+'" name="track_main_genre[]" class="select2 main_genre" data-id="'+i+'"><option label=" "> - Select Primary Genre - </option><?php $query = $db->query("SELECT * FROM main_genre"); while($row = $query->fetch_assoc()) { echo '<option value="'.$row['title'].'">'.$row['title'].'</option>'; } ?></select></div>';
                        //tracks_html += '<div class="col-md-6"><label class="form-label" for="track_secondary_genre'+i+'"> Genre</label><select id="track_secondary_genre'+i+'" name="track_genre[]" class="select2 secondary_genre"><option label=" ">- Select Primary Genre first -</option></select></div>';
                        //tracks_html += '<div class="col-md-6"><label class="form-label" for="track_recording_year'+i+'">Recording Year</label><input type="text" id="track_recording_year'+i+'" name="track_recording_year[]" class="form-control"></div>';
                        //tracks_html += '<div class="col-md-6"><label class="form-label" for="track_country_recording'+i+'">Country Recording</label><input type="text" id="track_country_recording'+i+'" name="track_country_recording[]" class="form-control"></div>';
                        //tracks_html += '<div class="col-md-6"><label class="form-label" for="track_isrc_code'+i+'">ISRC Code</label><input type="text" id="track_isrc_code'+i+'" name="track_i_s_r_c_code[]" class="form-control"></div>';
//                        tracks_html += '<div class="col-md-6"><label class="form-label" for="track_album_only'+i+'">Album Only</label><br><input type="checkbox" id="track_album_only'+i+'" name="track_album_only[]" value="Yes" class="form-check-input"><input type="hidden" name="track_album_only[]" value="No"></div>';
                        // tracks_html += '<div class="col-sm-6"><label class="form-label" for="track_vocals'+i+'">Vocals</label><select class="form-control" id="track_vocals'+i+'" name="track_vocals[]"><option value="Yes">Yes</option><option value="No">No</option></select></div>';
                        //tracks_html += '<div class="col-sm-6"><label class="form-label" for="track_explicit_status'+i+'">Explicit Status</label><select class="form-control" id="track_explicit_status'+i+'" name="track_explicit_status[]"><option value="Explicit">Explicit</option><option value="Non-Explicit">Non-Explicit</option><option value="Clean">Clean</option></select></div>';
                        //tracks_html += '<div class="col-md-6"><label class="form-label" for="track_primary_genre'+i+'">Vocal Language</label><select id="track_vocal_lang'+i+'" name="track_vocal_language[]" class="select2 vocal_language" data-id="'+i+'"><option label=" "> - Select - </option><?php $query = $db->query("SELECT * FROM languages"); while($row = $query->fetch_assoc()) { echo '<option value="'.$row['name'].'">'.$row['name'].'</option>'; } ?></select></div>';
                        
                        
                        //if(tracks_count>=1){
                            //tracks_html +='<div class="col-md-12"><br></div>';
                            
                        }
                    }
                    // console.log($("#step_two_html_position").html());
                    // return;
                    if($("#step_two_html_position").html() == "" ){
                        // tracks_html += next_prev_html;
                        $('#step_two_html_position').html("");
                        $('#step_two_html_position').html(tracks_html);
                        $(".main_genre").each(function(){
                           $(this).select2(); 
                        });
                        $(".secondary_genre").each(function(){
                            $(this).select2(); 
                        });
                        $(".primary_artist").each(function(){
                            $(this).select2(); 
                        });
                        $(".featuring").each(function(){
                            $(this).select2(); 
                        });
                        $(".remixer").each(function(){
                            $(this).select2(); 
                        });
                        $(".composer").each(function(){
                            $(this).select2(); 
                        });
                         $(".vocal_language").each(function(){
                            $(this).select2(); 
                        });
                        
                    }
                    
                    
                }
               
           });
           $('#step_two_next').click(function(){
               if($('#social-links-validation').hasClass('active')){
                    // alert("yes");
                    
               }
               
           });
           $('#main_genre').change(function(){
               var main_genre = $(this).val();
                $.ajax({
                  url:"ajax_files/get_sub_genre.php",
                  data: {main_genre:main_genre},
                  type:'GET',
                  success: function(data){
                    //   console.log(data);
                     $('#sub_genre').html(data);
                     $('#sub_genre').select2();
                     
                  }
                });

               
           });
          $(document).on('change', '.main_genre', function() {
            //   alert("trt");
               var main_genre = $(this).val();
               var id = $(this).data("id");
                $.ajax({
                  url:"ajax_files/get_sub_genre.php",
                  data: {main_genre:main_genre},
                  type:'GET',
                  success: function(data){
                    //   console.log(data);
                     $('#track_secondary_genre'+id).html(data);
                     $('#track_secondary_genre'+id).select2();
                     
                  }
                });

               
           });
           $("#no_of_tracks").on('change', function(){
               if($(this).val()>=1 && $(this).val()<=3  ){
                   $("#pricing_tier").val("F");
               } else {
                   $("#pricing_tier").val("B");
               }
               
               
           });
            $("input[type='submit']").click(function(){
              $(".loader").removeClass("d-none");
            });
           $('#label_name').on('change', function(){
            //   console.log("e"); 
            var year = "2022";
            $("#pline").attr("value", year+" "+$(this).val());
            $("#cline").attr("value", year+" "+$(this).val());
           });
        });
    </script>
    <script>
    window.onload = function() {
        history.replaceState("", "", "create-releases.php");
    }
</script>
</body>

</html>