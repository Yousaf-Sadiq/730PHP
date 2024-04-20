<?php 
session_set_cookie_params(86400);
session_start();
include('include/dbConfig.php');



    if(strlen($_SESSION['login_userid'])==0){
        echo '<script>window.location="login.php"</script>';  
    }


if(isset($_POST['create'])){
    
    $upload = false;
    $error = false;
    $success = false;
    // echo '<pre>';
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
                        $fileNemeNew = uniqid('',true).".".$fileActualExt;
                      
                        //File destination
                        $fileDestination = 'releases_images/cover_art/'.$fileNemeNew;
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
        
            $audio_path = "releases_images/track_audios/".$_FILES['track_audio_file']['name'][$i];
            if(move_uploaded_file($_FILES['track_audio_file']['tmp_name'][$i], $audio_path)){
                $song_name = isset($_POST['track_song_name'][$i]) ? $_POST['track_song_name'][$i] : "";
                $mix_version = isset($_POST['track_mix_version'][$i]) ? $_POST['track_mix_version'][$i] : "";
                $primary_artist = isset($_POST['track_primary_artist'][$i]) ? $_POST['track_primary_artist'][$i] : "";
                $featuring = isset($_POST['track_featuring'][$i]) ? $_POST['track_featuring'][$i] : "";
                $remixer = isset($_POST['track_remixer'][$i]) ? $_POST['track_remixer'][$i] : "";
                $contributor = isset($_POST['track_contributor'][$i]) ? $_POST['track_contributor'][$i] : "";
                $primary_genre = isset($_POST['track_primary_genre'][$i]) ? $_POST['track_primary_genre'][$i] : "";
                $secondary_genre = isset($_POST['track_secondary_genre'][$i]) ? $_POST['track_secondary_genre'][$i] : "";
                $recording_year = isset($_POST['track_recording_year'][$i]) ? $_POST['track_recording_year'][$i] : "";
                $country_recording = isset($_POST['track_country_recording'][$i]) ? $_POST['track_country_recording'][$i] : "";
                $isrc_code = isset($_POST['track_isrc_code'][$i]) ? $_POST['track_isrc_code'][$i] : "";
                $price_tier = isset($_POST['track_price_tier'][$i]) ? $_POST['track_price_tier'][$i] : "";
                $album_only = isset($_POST['track_album_only'][$i]) ? $_POST['track_album_only'][$i] : "";
                $vocals = isset($_POST['track_vocals'][$i]) ? $_POST['track_vocals'][$i] : "";
                $explicit_status = isset($_POST['track_explicit_status'][$i]) ? $_POST['track_explicit_status'][$i] : "";
                
                
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
                                        '$contributor',
                                        '$primary_genre',
                                        '$secondary_genre',
                                        '$recording_year',
                                        '$country_recording',
                                        '$isrc_code',
                                        '$price_tier',
                                        '$album_only',
                                        '$vocals',
                                        '$explicit_status',
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



<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>View Release</title>
    <meta name="description"
        content="Most Powerful &amp; Comprehensive Bootstrap 5 HTML Admin Dashboard Template built for developers!" />
    <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
    <!-- laravel CRUD token -->
    <meta name="csrf-token" content="NAkv4GSUnfPXqyp3qBI0BHmCQFVjuX3uksB9sEaY">
    <!-- Canonical SEO -->
    <link rel="canonical"
        href="../../../themeselection.com/item/sneat-bootstrap-html-laravel-admin-template/index.html">
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
<link rel="stylesheet" href="./assets/vendor/libs/plyr/plyr.css" />

    <!-- Page Styles -->
<link rel="stylesheet" href="./assets/vendor/css/pages/page-profile.css" />
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
        .plyr--audio{
            padding: 10px 20px;
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
                    <?php $query = $db->query("SELECT * FROM releases WHERE rid='".$_GET['id']."' AND user_id = ".$_SESSION['login_userid']);
                    
                    while($row = $query->fetch_assoc()){
                        
                        $r_meta = json_decode($row['release_meta'], true);
                        // echo '<pre>';
                        // print_r($r_meta);
                    ?>
                        <!-- Content -->
                        <div class="container-xxl flex-grow-1 container-p-y">
                           <div class="row">
                              <div class="col-12">
                                <div class="card mb-4">
                                  <div class="user-profile-header-banner">
                                    <img src="/ver32/releases/<?php echo $row['rid']; ?>/<?php echo $r_meta['cover_art']; ?>" alt="Banner image" class="rounded-top">
                                    
                                  </div>
                                  <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                                    <!--<div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">-->
                                    <!--  <img src="./assets/img/avatars/1.png" alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img">-->
                                    <!--</div>-->
                                    <div class="flex-grow-1 mt-5">
                                      <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                                        <div class="user-profile-info">
                                          <h4><?php echo $r_meta["release_name"]; ?></h4>
                                          <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                            <li class="list-inline-item fw-semibold">
                                              
                                            </li>
                                            <li class="list-inline-item fw-semibold">
                                              
                                            </li>
                                            <li class="list-inline-item fw-semibold">
                                              <i class=''></i> <?php /* ->format('l jS \o\f F Y h:i:s A'); */  echo $row['created_at']; ?>
                                            </li>
                                          </ul>
                                        </div>
                                        <?php if($row['status']=="approved"){
                                        ?>
                                        <a href="javascript:void(0)" class="btn btn-success text-nowrap">
                                          <i class='bx bx-user-check'></i> Approved
                                        </a>
                                        <?php } else {
                                        ?>
                                        <a href="javascript:void(0)" class="btn btn-warning text-nowrap">
                                          <i class='bx bx-time'></i> Pending Approval
                                          </a>
                                        <?php
                                        }?>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="card mb-4">
                                      <div class="card-body">
                                        <small class="text-muted text-uppercase">Release Details</small>
                                        <ul class="list-unstyled mb-4 mt-3">
                                            <div class="user-profile-header-banner">
                                            <img src="/ver2/releases/<?php echo $row['rid']; ?>/<?php echo $r_meta['cover_art']; ?>" alt="Banner image" class="rounded-top"></div> 
                                          <li class="d-flex align-items-center mb-3"><i class="bx bx-grid"></i><span class="fw-semibold mx-2">Release Name:</span> <span><?php echo $r_meta['name']; ?></span></li>
                                          <li class="d-flex align-items-center mb-3"><i class="bx bx-grid"></i><span class="fw-semibold mx-2">Catalog:</span> <span><?php echo $r_meta['catalog']; ?></span></li>
                                          <li class="d-flex align-items-center mb-3"><i class="bx bx-barcode"></i><span class="fw-semibold mx-2">UPC Code:</span> <span><?php echo $r_meta['u_p_c_code']; ?></span></li>
                                          <li class="d-flex align-items-center mb-3"><i class="bx bx-star"></i><span class="fw-semibold mx-2">Compilation:</span> <span><?php echo $r_meta['compilation']; ?></span></li>
                                          <li class="d-flex mb-3" style="flex-direction: column"><div><i class="bx bx-user"></i><span class="fw-semibold mx-2">Artist Name:</span></div><span class="rounded mt-2 p-2 bg-dark text-white"><?php foreach($r_meta['artists'] as $artist ) { echo $artist."<br>"; } ?></span></li>
                                        </ul>
                                        <small class="text-muted text-uppercase"></small>
                                        <ul class="list-unstyled mb-4 mt-3">
                                          <li class="d-flex align-items-center mb-3"><i class="bx bx-cog"></i><span class="fw-semibold mx-2">Label:</span> <span><?php echo $r_meta['label_name']; ?></span></li>
                                          <li class="d-flex align-items-center mb-3"><i class="bx bx-grid"></i><span class="fw-semibold mx-2">Main Genre:</span> <span><?php echo $r_meta['main_genre']; ?></span></li>
                                          <li class="d-flex align-items-center mb-3"><i class="bx bx-grid-horizontal"></i><span class="fw-semibold mx-2">Genre:</span> <span><?php echo $r_meta['genre']; ?></span></li>
                                          <li class="d-flex align-items-center mb-3"><i class="bx bx-copyright"></i><span class="fw-semibold mx-2">CLine:</span> <span><?php echo $r_meta['cline']; ?></span></li>
                                          <li class="d-flex align-items-center mb-3"><i class="bx bxl-product-hunt"></i><span class="fw-semibold mx-2">PLine:</span> <span><?php echo $r_meta['pline']; ?></span></li>
                                          
                                        </ul>
                                         <small class="text-muted text-uppercase">Stores And Release Dates</small>
                                        <ul class="list-unstyled mb-4 mt-3">
                                          <li class="d-flex mb-3" style="flex-direction: column"><div><i class="bx bx-book"></i><span class="fw-semibold mx-2">Stores:</span> </div><span class="rounded mt-2 p-2 bg-dark text-white"><?php foreach($r_meta['stores'] as $store ) { echo $store."<br>"; } ?></span></li>
                                          <li class="d-flex align-items-center mb-3"><i class="bx bx-book"></i><span class="fw-semibold mx-2">Exclusive Platform:</span> <span><?php echo $r_meta['exclusive_platform']; ?></span></li>
                                          <li class="d-flex align-items-center mb-3"><i class="bx bx-book"></i><span class="fw-semibold mx-2">Exclusive Duration:</span> <span><?php echo $r_meta['exclusive_duration']; ?></span></li>
                                          <li class="d-flex align-items-center mb-3"><i class="bx bx-calendar-plus"></i><span class="fw-semibold mx-2">Pre-Order Date:</span> <span><?php echo $r_meta['i_tunes_pre_order_date']; ?></span></li>
                                          <li class="d-flex align-items-center mb-3"><i class="bx bx-calendar-alt"></i><span class="fw-semibold mx-2">Promo Date:</span> <span><?php echo $r_meta['exclusive_date']; ?></span></li>
                                          <li class="d-flex align-items-center mb-3"><i class="bx bx-calendar-check"></i><span class="fw-semibold mx-2">Live Date:</span> <span><?php echo $r_meta['release_date']; ?></span></li>
                                     
                                          
                                        </ul>
                                        <!--<small class="text-muted text-uppercase">Teams</small>-->
                                        <!--<ul class="list-unstyled mt-3 mb-0">-->
                                        <!--  <li class="d-flex align-items-center mb-3"><i class="bx bxl-github text-primary me-2"></i>-->
                                        <!--    <div class="d-flex flex-wrap"><span class="fw-semibold me-2">Backend Developer</span><span>(126 Members)</span></div>-->
                                        <!--  </li>-->
                                        <!--  <li class="d-flex align-items-center"><i class="bx bxl-react text-info me-2"></i>-->
                                        <!--    <div class="d-flex flex-wrap"><span class="fw-semibold me-2">React Developer</span><span>(98 Members)</span></div>-->
                                        <!--  </li>-->
                                        <!--</ul>-->
                                      </div>
                                    </div>
                              </div>
                              <div class="col-md-8">
                                  <div id="accordionPopoutIcon" class="accordion accordion-popout">
                                      <?php $active_check = true; 
                                      $track_count = 1;
                                      $q = $db->query("SELECT * FROM tracks WHERE rid='".$_GET['id']."'");
                                      while($r = $q->fetch_assoc()){
                                      ?>
                                      <div class="accordion-item card <?php if($active_check==true){ $active_check=false;?>active<?php } ?>" >
                                        <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionPopoutIconOne">
                                          <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionPopoutIcon-1" aria-controls="accordionPopoutIcon-1" aria-expanded="true">
                                            <i class="bx bx-podcase me-2"></i>
                                            Track no. <?php echo $track_count; ?> 
                                          </button>
                                          
                                        </h2>
                                
                                        <div id="accordionPopoutIcon-1" class="accordion-collapse collapse show" data-bs-parent="#accordionPopoutIcon" style="">
                                          <div class="accordion-body">
                                            <!--Lemon drops chocolate cake gummies carrot cake chupa chups muffin topping. Sesame snaps icing marzipan gummi-->
                                            <!--bears macaroon dragée danish caramels powder. Bear claw dragée pastry topping soufflé.-->
                                            
                                            <!--<small class="text-muted text-uppercase">Meta</small>-->
                                            <ul class="list-unstyled mb-4 mt-3">
                                              <li class="d-flex align-items-center mb-3"><i class="bx bx-music"></i><span class="fw-semibold mx-2">Name:</span> <span><?php echo $r['track_song_name']; ?></span></li>
                                              <li class="d-flex align-items-center mb-3"><i class="bx bx-podcast"></i><span class="fw-semibold mx-2">Mixed Version:</span> <span><?php echo $r['track_mix_version']; ?></span></li>
                                              <li class="d-flex align-items-center mb-3"><i class="bx bx-star"></i><span class="fw-semibold mx-2">Primary Artist:</span> <span><?php echo  $r['track_primary_artist']; ?></span></li>
                                              <li class="d-flex align-items-center mb-3"><i class="bx bx-user"></i><span class="fw-semibold mx-2">Featuring:</span> <span><?php echo  $r['track_featuring']; ?></span></li>
                                              <li class="d-flex align-items-center mb-3"><i class="bx bx-user"></i><span class="fw-semibold mx-2">Remixer:</span> <span><?php echo  $r['track_remixer']; ?></span></li>
                                              <li class="d-flex align-items-center mb-3"><i class="bx bx-user"></i><span class="fw-semibold mx-2">Composer:</span> <span><?php echo $r['track_contributor']; ?></span></li>
                                              <li class="d-flex align-items-center mb-3"><i class="bx bx-grid"></i><span class="fw-semibold mx-2">Main Genre:</span> <span><?php echo $r['track_primary_genre']; ?></span></li>
                                              <li class="d-flex align-items-center mb-3"><i class="bx bx-grid-horizontal"></i><span class="fw-semibold mx-2">Genre:</span> <span><?php echo $r['track_secondary_genre']; ?></span></li>
                                              <li class="d-flex align-items-center mb-3"><i class="bx bx-time"></i><span class="fw-semibold mx-2">Recording Year:</span> <span><?php echo $r['track_recording_year']; ?></span></li>
                                              <li class="d-flex align-items-center mb-3"><i class="bx bx-flag"></i><span class="fw-semibold mx-2">Country of Recording:</span> <span><?php echo $r['track_country_recording']; ?></span></li>
                                              <li class="d-flex align-items-center mb-3"><i class="bx bx-barcode"></i><span class="fw-semibold mx-2">ISRC Code:</span> <span><?php echo $r['track_isrc_code']; ?></span></li>
                                              <li class="d-flex align-items-center mb-3"><i class="bx bx-money"></i><span class="fw-semibold mx-2">Price Tier:</span> <span><?php echo $r['track_price_tier']; ?></span></li>
                                              <li class="d-flex align-items-center mb-3"><i class="bx bx-book"></i><span class="fw-semibold mx-2">Album Only:</span> <span><?php echo $r['track_album_only']; ?></span></li>
                                                 <!--<li class="d-flex align-items-center mb-3"><i class='bx bxs-bar-chart-alt-2' ></i><span class="fw-semibold mx-2">Track Vocals:</span> <span><?php echo $r['track_vocals']; ?></span></li>-->
                                              <li class="d-flex align-items-center mb-3"><i class="bx bx-checkbox"></i><span class="fw-semibold mx-2">Track explicit Status:</span> <span><?php echo $r['track_explicit_status']; ?></span></li>
                                              <li class="d-flex align-items-center mb-3"><i class="bx bxs-bar-chart-alt-2"></i><span class="fw-semibold mx-2">Vocal Language:</span> <span><?php echo $r['track_vocal_lang']; ?></span></li>
                                            </ul>
                                            
                                          </div>
                                        </div>
                                        <?php $file = explode($r['track_audio_file'] , ","); 
                                        
                                       // if(end($file)!=("jpg"||"png")) {?>
                                           <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audio Player with Waveform</title>
    <!-- Wavesurfer.js CSS -->
    <link rel="stylesheet" href="https://unpkg.com/wavesurfer.js/dist/wavesurfer.min.css">
</head>
<body>

<div id="waveform"></div>

<audio id="plyr-audio-player" style="display: none;">
    <source src="<?php echo str_replace('../', '', $r['track_audio_file']); ?>" type="audio/wav">
</audio>

<!-- Wavesurfer.js and its dependencies -->
<script src="https://unpkg.com/wavesurfer.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/4.2.0/plugin/wavesurfer.minimap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/4.2.0/plugin/wavesurfer.timeline.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var wavesurfer = WaveSurfer.create({
            container: '#waveform',
            waveColor: 'violet',
            
        });

        wavesurfer.load(document.querySelector('#plyr-audio-player source').getAttribute('src'));

        // Uncomment the following lines if you want to show controls for playback
        // wavesurfer.on('ready', function () {
        //     var playButton = document.createElement('button');
        //     playButton.textContent = 'Play';
        //     playButton.addEventListener('click', function () {
        //         wavesurfer.playPause();
        //     });
        //     document.body.appendChild(playButton);
        // });
    });
</script>

</body>
</html>

                                        <?php// } else {
                                            ?>
                                            <!--File is not an audio file-->
                                            <?php
                                        //}?>
                                        
                                      </div>
                                    <?php  
                                        $track_count++;
                                        } 
                                    ?>
                                      <!--<div class="accordion-item card">-->
                                      <!--  <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionPopoutIconTwo">-->
                                      <!--    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionPopoutIcon-2" aria-controls="accordionPopoutIcon-2" aria-expanded="false">-->
                                      <!--      <i class="bx bx-heart me-2"></i>-->
                                      <!--      Accordion Item 2-->
                                      <!--    </button>-->
                                      <!--  </h2>-->
                                      <!--  <div id="accordionPopoutIcon-2" class="accordion-collapse collapse" data-bs-parent="#accordionPopoutIcon" style="">-->
                                      <!--    <div class="accordion-body">-->
                                      <!--      Dessert ice cream donut oat cake jelly-o pie sugar plum cheesecake. Bear claw dragée oat cake dragée ice-->
                                      <!--      cream halvah tootsie roll. Danish cake oat cake pie macaroon tart donut gummies. Jelly beans candy canes carrot-->
                                      <!--      cake.-->
                                      <!--    </div>-->
                                      <!--  </div>-->
                                      <!--</div>-->
                                
                                      <!--<div class="accordion-item card">-->
                                      <!--  <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionPopoutIconThree">-->
                                      <!--    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionPopoutIcon-3" aria-expanded="false" aria-controls="accordionPopoutIcon-3">-->
                                      <!--      <i class="bx bx-lock-alt me-2"></i>-->
                                      <!--      Accordion Item 3-->
                                      <!--    </button>-->
                                      <!--  </h2>-->
                                      <!--  <div id="accordionPopoutIcon-3" class="accordion-collapse collapse" data-bs-parent="#accordionPopoutIcon" style="">-->
                                      <!--    <div class="accordion-body">-->
                                      <!--      Oat cake toffee chocolate bar jujubes. Marshmallow brownie lemon drops cheesecake. Bonbon gingerbread-->
                                      <!--      marshmallow sweet jelly beans muffin. Sweet roll bear claw candy canes oat cake dragée caramels.-->
                                      <!--    </div>-->
                                      <!--  </div>-->
                                      <!--</div>-->
                                    </div>
                              </div>
                            </div>
                            
    
                            <!-- pricingModal -->
                            <!--/ pricingModal -->
    
                        </div>
                        <!-- / Content -->
                    <?php } ?>
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
    <script src="./assets/js/pages-profile.js"></script>
    <script src="./assets/vendor/libs/plyr/plyr.js"></script>
    <script src="./assets/js/extended-ui-media-player.js"></script>
<!-- END: Page Vendor JS-->
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
                        tracks_html += '<div class="col-md-12"><h5>Track no. '+i+'</h5></div>';
                        tracks_html += '<div class="col-sm-12"><div class="input-group"><input type="file" class="form-control track_upload" id="track_audio_file'+i+'" name="track_audio_file[]" data-file-id="'+i+'" accept="audio/flac"><label class="input-group-text" for="track_audio_file'+i+'">Audio File</label></div></div>';
                        tracks_html += '<div class="col-md-6"><label class="form-label" for="track_song_name'+i+'">Song Name</label><input type="text" id="track_song_name'+i+'" name="track_song_name[]" class="form-control"></div>';
                        tracks_html += '<div class="col-md-6"><label class="form-label" for="track_mix_version'+i+'">Mix Version</label><input type="text" id="track_mix_version'+i+'" name="track_mix_version[]" class="form-control"></div>';
                        tracks_html += '<div class="col-md-6"><label class="form-label" for="track_primary_artist'+i+'">Primary Artist</label><input type="text" id="track_primary_artist'+i+'" name="track_primary_artist[]" class="form-control"></div>';
                        tracks_html += '<div class="col-md-6"><label class="form-label" for="track_featuring'+i+'">Featuring</label><input type="text" id="track_featuring'+i+'" name="track_featuring[]" class="form-control"></div>';
                        tracks_html += '<div class="col-md-6"><label class="form-label" for="track_remixer'+i+'">Remixer</label><input type="text" id="track_remixer'+i+'" name="track_remixer[]" class="form-control"></div>';
                        tracks_html += '<div class="col-md-6"><label class="form-label" for="track_contributor'+i+'">Contributor</label><input type="text" id="track_contributor'+i+'" name="track_contributor[]" class="form-control"></div>';
                        tracks_html += '<div class="col-md-6"><label class="form-label" for="track_primary_genre'+i+'">Primary Genre</label><input type="text" id="track_primary_genre'+i+'" name="track_primary_genre[]" class="form-control"></div>';
                        tracks_html += '<div class="col-md-6"><label class="form-label" for="track_secondary_genre'+i+'">Secondary Genre</label><input type="text" id="track_secondary_genre'+i+'" name="track_secondary_genre[]" class="form-control"></div>';
                        tracks_html += '<div class="col-md-6"><label class="form-label" for="track_recording_year'+i+'">Recording Year</label><input type="text" id="track_recording_year'+i+'" name="track_recording_year[]" class="form-control"></div>';
                        tracks_html += '<div class="col-md-6"><label class="form-label" for="track_country_recording'+i+'">Country Recording</label><input type="text" id="track_country_recording'+i+'" name="track_country_recording[]" class="form-control"></div>';
                        tracks_html += '<div class="col-md-6"><label class="form-label" for="track_isrc_code'+i+'">ISRC Code</label><input type="text" id="track_isrc_code'+i+'" name="track_isrc_code[]" class="form-control"></div>';
                        tracks_html += '<div class="col-md-6"><label class="form-label" for="track_price_tier'+i+'">Price Tier</label><input type="text" id="track_price_tier'+i+'" name="track_price_tier[]" class="form-control"></div>';
                        tracks_html += '<div class="col-md-6"><label class="form-label" for="track_album_only'+i+'">Album Only</label><br><input type="checkbox" id="track_album_only'+i+'" name="track_album_only[]" value="Yes" class="form-check-input"><input type="hidden" name="track_album_only[]" value="No"></div>';
                        tracks_html += '<div class="col-sm-6"><label class="form-label" for="track_vocals'+i+'">Vocals</label><select class="form-control" id="track_vocals'+i+'" name="track_vocals[]"><option value="Yes">Yes</option><option value="No">No</option></select></div>';
                        tracks_html += '<div class="col-sm-6"><label class="form-label" for="track_explicit_status'+i+'">Explicit Status</label><select class="form-control" id="track_explicit_status'+i+'" name="track_explicit_status[]"><option value="Yes">Yes</option><option value="No">No</option><option value="Censored">Censored</option></select></div>';
                        
                        
                        if(tracks_count>=1){
                            tracks_html +='<div class="col-md-12"><br></div>';
                        }
                    }
                    // tracks_html += next_prev_html;
                    $('#step_two_html_position').html("");
                    $('#step_two_html_position').html(tracks_html);
                }
               
           });
           $('#step_two_next').click(function(){
               if($('#social-links-validation').hasClass('active')){
                    // alert("yes");
                    
               }
               
           });
           $('#label_name').on('change', function(){
            //   console.log("e"); 
            var year = "2023";
            $("#pline").attr("value", year+" "+$(this).val());
            $("#cline").attr("value", year+" "+$(this).val());
           });
        });
    </script>

</body>

</html>