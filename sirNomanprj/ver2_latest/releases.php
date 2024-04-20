<?php 
session_set_cookie_params(86400);
session_start();
include('include/dbConfig.php');
// print_r($_SESSION);


    if(strlen($_SESSION['user_login'])==0){
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
     
    if(mysqli_query($db, "INSERT INTO releases (rid, release_meta, created_at) VALUES ('$release_uid', '$data', '".date('Y-m-d h:i:s')."' ) ")){
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

if (isset($_GET['compress'])){
    
    
    function Zip($source, $destination)
    {
        if (!extension_loaded('zip') || !file_exists($source)) {
            return false;
        }
    
        $zip = new ZipArchive();
        if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
            return false;
        }
    
        $source = str_replace('\\', '/', realpath($source));
    
        if (is_dir($source) === true)
        {
            $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);
    
            foreach ($files as $file)
            {
                $file = str_replace('\\', '/', $file);
    
                if( in_array(substr($file, strrpos($file, '/')+1), array('.', '..')) )
                    continue;
    
                $file = realpath($file);
    
                if (is_dir($file) === true)
                {
                    $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                }
                else if (is_file($file) === true)
                {
                    $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
                }
            }
        }
        else if (is_file($source) === true)
        {
            $zip->addFromString(basename($source), file_get_contents($source));
        }
        
        return $zip->close();
    } 
    
    $zip_name= "compressed_releases/".date("Y-m-d h:i:s")." ".$_GET['compress'].'.zip';
    
    Zip('releases/'.$_GET['compress']."/", $zip_name);
    header("location: ".$zip_name);
    exit;
}


if(isset($_GET['action'])){
    $delete = false;
    if(mysqli_query($db, "UPDATE releases SET status = 'takedown' WHERE releases.rid='".$_GET['id']."'")){
       
            $delete = true;
    }
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

    <title>Releases | Q Phonic Entertainment </title>
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
   <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet">

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
                            <div class="col-md-6">
                                <?php if($delete==true){?>
                                <div class="alert alert-danger">
                                    Release taken down
                                </div>
                                <?php } ?>
                            </div>
                             <div class="col-xl-12">
                                <h6 class="text-muted"></h6>
                                <div class="card text-center">
                                  <div class="card-header">
                                    <ul class="nav nav-pills card-header-pills" role="tablist">
                                      <!--<li class="nav-item">-->
                                      <!--  <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#new-releases" aria-controls="navs-pills-within-card-active" aria-selected="true">New Releases</button>-->
                                      <!--</li>-->
                                      <li class="nav-item">
                                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#submitted-releases" aria-controls="navs-pills-within-card-link" aria-selected="false">All Releases</button>
                                      </li>
                                     
                                    </ul>
                                  </div>
                                  <div class="card-body">
                                    <div class="tab-content p-0">
                                      <div class="tab-pane fade " id="new-releases" role="tabpanel">
                                        <h4 class="card-title">New Releases</h4>
                                        <p class="card-text">View Or Delete Your Releases.</p>
                                        <!-- Bordered Table -->
                                            <div class="card">
                                              <!--<h5 class="card-header">Bordered Table</h5>-->
                                              <div class="card-body">
                                                <div class="table-responsive text-nowrap">
                                                  <table class="table table-bordered">
                                                    <thead>
                                                      <tr>
                                                        
                                                        <th>Actions</th>
                                                        <th>Release Name</th>
                                                        <th>Catalog No.</th>
                                                        <th>Status</th>
                                                        <th>Release Date</th>
                                                        
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $release_meta = '';
                                                        $query = $db->query("SELECT * FROM releases WHERE status = 'approved' AND user_id = ".$_SESSION['login_userid']." ORDER BY release_id DESC");
                                                        while($row = $query->fetch_assoc()){
                                                            $release_meta = '';
                                                             $release_meta = json_decode($row['release_meta'], true);
                                                        
                                                        ?>
                                                            <tr>
                                                                <td>
                                                                  <button type="button" class="btn btn-icon btn-danger">
                                                                    <span class="tf-icons bx bx-trash"></span>
                                                                  </button>
                                                                  <!--<a href="" class="btn btn-info">-->
                                                                  <a href="view-release.php?id=<?php echo $row['rid']; ?>" class="btn btn-info">
                                                                    <span class="tf-icons bx bx-file"></span> View
                                                                  </a>
                                                                </td>  
                                                                <td>
                                                                    <!--<i class="fab fa-angular fa-lg text-danger me-3"></i> -->
                                                                    <?php 
                                                                        if(file_exists($release_meta['cover_art']) && $release_meta['cover_art'] != "" ){
                                                                        ?>
                                                                        <img src="<?=$release_meta['cover_art']?>" width="40">
                                                                        <?php
                                                                        }
                                                                    ?>
                                                                    
                                                                    <strong><?=$release_meta['name']?></strong></td>
                                                                <td><?=$release_meta['catalog']?></td>
                                                                <td>
                                                                    <span class="badge bg-label-success me-1"><?=$row['status']?></span></td>
                                                                <td>
                                                                  <?=$row['created_at']?>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                        
                                                        }
                                                        ?>
                                                        
                                                      
                                                      
                                                    </tbody>
                                                  </table>
                                                </div>
                                              </div>
                                            </div>
                                            <!--/ Bordered Table -->
                                        <!--<a href="javascript:void(0)" class="btn btn-primary">Go somewhere</a>-->
                                      </div>
                                      <div class="tab-pane fade show active" id="submitted-releases" role="tabpanel">
                                         <h4 class="card-title">All Releases</h4>
                                        <p class="card-text">View Or Delete Your Releases.</p>
                                        <!-- Bordered Table -->
                                            <div class="card">
                                              <!--<h5 class="card-header">Bordered Table</h5>-->
                                              <div class="card-body">
                                                <div class="table-responsive text-nowrap">
                                                  <table class="table table-bordered">
                                                    <thead>
                                                      <tr>
                                                        
                                                        <th>Actions</th>
                                                        <th>Release Name</th>
                                                        <th>Catalog No.</th>
                                                        <th>Status</th>
                                                        <th>Release Date</th>
                                                        
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $release_meta = '';
                                                        $query = $db->query("SELECT * FROM releases WHERE  status NOT IN ('takedown', 'draft')  AND  user_id = ".$_SESSION['login_userid']." ORDER BY release_id DESC");
                                                        while($row = $query->fetch_assoc()){
                                                            $release_meta = '';
                                                             $release_meta = json_decode($row['release_meta'], true);
                                                        
                                                        ?>
                                                            <tr>
                                                                <td>
                                                                  <a href="releases.php?action=delete&id=<?php echo $row['rid'];?>" class="btn btn-icon btn-danger">
                                                                    <span class="tf-icons bx bx-trash"></span>
                                                                  </a>
                                                                  <a href="view-release.php?id=<?php echo $row['rid'];?>" class="btn btn-icon btn-info">
                                                                    <span class="tf-icons bx bx-info-circle"></span>
                                                                  </a>
                                                                </td>  
                                                                <td>
                                                                    <!--<i class="fab fa-angular fa-lg text-danger me-3"></i> -->
                                                                    <?php 
                                                                        if(file_exists("releases/".$row['rid']."/".$release_meta['cover_art']) && $release_meta['cover_art'] != "" ){
                                                                        ?>
                                                                        <img src="<?="releases/".$row['rid']."/".$release_meta['cover_art']?>" width="40">
                                                                        <?php
                                                                        }
                                                                    ?>
                                                                    
                                                                    <strong><?=$release_meta['name']?></strong></td>
                                                                <td><?=$release_meta['catalog']?></td>
                                                                <td>
                                                                    <?php
                                                                    $color = '';
                                                                    switch($row['status']){
                                                                        case 'pending':
                                                                            $color = 'warning';
                                                                            break;
                                                                        case 'approved':
                                                                            $color = 'success';
                                                                            break;
                                                                        default:
                                                                            $color = 'info';
                                                                            break;
                                                                    }
                                                                    
                                                                    ?>
                                                                    <span class="badge bg-label-<?=$color;?> me-1"><?=$row['status']?></span></td>
                                                                <td>
                                                                  <?=$row['created_at']?>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                        
                                                        }
                                                        ?>
                                                        
                                                      
                                                      
                                                    </tbody>
                                                  </table>
                                                </div>
                                              </div>
                                            </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
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

<script src="./assets/vendor/libs/jquery/jquery40f4.js?id=96645acf88116df9c36bef6153b3a51a"></script>
    <script src="./assets/vendor/libs/popper/popper885d.js?id=c8510634b3d8cded74bbe30a2b593d87"></script>
    <script src="./assets/vendor/js/bootstrap0983.js?id=1f50b74ded465d298b282b4562bdaf8c"></script>
    <script src="./assets/vendor/libs/perfect-scrollbar/perfect-scrollbar4d5e.js?id=9d86308b7c41e76a7dc8472907865b83">
    </script>
    <script src="./assets/vendor/libs/hammer/hammerc38e.js?id=2a80ebd1aa77a9e33ec54b68ee8de5e0"></script>
    <script src="./assets/vendor/libs/i18n/i18n5fec.js?id=5dd0894a4cb5357ba8a20df3187b6d9b"></script>
    <script src="./assets/vendor/libs/typeahead-js/typeaheada766.js?id=8c315d7e2e7b09a04d8e8efead923241"></script>
    <script src="./assets/vendor/js/menu7d39.js?id=f45ec38086f86335b91fc2fdcaaadab8"></script>
    <script src="./assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Include Scripts -->
    <!-- BEGIN: Vendor JS-->

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
        <script src="./assets/js/dashboards-analytics.js"></script>
    <!-- END: Page JS-->
  
</body>

</html>