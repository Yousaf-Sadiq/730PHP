<?php 


session_start();

include('include/dbConfig.php');

// if (!isset($_SESSION['user_login'])) {

    if(strlen($_SESSION['user_login'])==0){
        echo '<script>window.location="login.php"</script>';  
    }

// }

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

    <title>Dashboard | Q Phonic Entertainment </title>
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
    <link rel="stylesheet" href="./assets/vendor/libs/apex-charts/apex-charts.css">


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
                             <?php 
                                $account_percentage = '';
                                 
                                $query = $db->query("SELECT * FROM users WHERE user_id = ".$_SESSION['login_userid']);
                                while($row = $query->fetch_assoc()){
                                $account_percentage = $row['acc_percentage'];
                                ?>
                            <div class="col-lg-8 mb-4 order-0">
                                <div class="card">
                                    <div class="d-flex align-items-end row">
                                        <div class="col-sm-7">
                                            <div class="card-body">
                                                <h5 class="card-title text-primary">Welcome <?=$row['user_name']?>! 🎉</h5>
                                                <p class="mb-4">Your account has reached to <span class="fw-bold"><?=$account_percentage;?>%</span>.</p>

                                                <a href="profile.php" class="btn btn-sm btn-label-primary">View
                                                    Profile</a>
                                            </div>
                                        </div>
                                        <div class="col-sm-5 text-center text-sm-left">
                                            <div class="card-body pb-0 px-0 px-md-4">
                                                <img src=""
                                                    height="140" alt=""
                                                    >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php  }?>
                            <div class="col-md-12"></div>
                            <div class="col-lg-3 col-md-3">
                                 <div class="card">
                                    <div class="card-body">
                                        <div
                                            class="card-title d-flex align-items-start justify-content-between">
                                            <div class="avatar flex-shrink-0">
                                                <img src="./assets/img/icons/unicons/wallet-info.png"
                                                    alt="Credit Card" class="rounded">
                                            </div>
                                         
                                        </div>
                                        <span>Approved Releases </span>
                                        <?php
                                        $query = $db->query("SELECT * FROM releases WHERE status = 'approved' AND user_id = ".$_SESSION['login_userid']);
                                        
                                        ?>
                                        <h3 class="card-title text-nowrap mb-1"><?php echo mysqli_num_rows($query); ?></h3>
                                        <br>
                                         <a href="releases.php" class="btn btn-sm btn-label-primary">
                                                    View All</a>
                                        <!--<small class="text-success fw-semibold"><i-->
                                        <!--        class='bx bx-up-arrow-alt'></i> +28.42%</small>-->
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div
                                            class="card-title d-flex align-items-start justify-content-between">
                                            <div class="avatar flex-shrink-0">
                                                <img src="./assets/img/icons/unicons/wallet-info.png"
                                                    alt="Credit Card" class="rounded">
                                            </div>
                                         
                                        </div>
                                        <span>Submitted Releases</span>
                                        <?php
                                        $query = $db->query("SELECT * FROM releases WHERE status = 'pending' AND user_id = ".$_SESSION['login_userid']);
                                        
                                        ?>
                                        <h3 class="card-title text-nowrap mb-1"><?php echo mysqli_num_rows($query); ?></h3>
                                        <br>
                                         <a href="releases.php" class="btn btn-sm btn-label-primary">
                                                    View All</a>
                                        <!--<small class="text-success fw-semibold"><i-->
                                        <!--        class='bx bx-up-arrow-alt'></i> +28.42%</small>-->
                                    </div>
                                </div>
                            </div>
                             <div class="col-lg-3 col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div
                                            class="card-title d-flex align-items-start justify-content-between">
                                            <div class="avatar flex-shrink-0">
                                                <img src="./assets/img/icons/unicons/wallet-info.png"
                                                    alt="Credit Card" class="rounded">
                                            </div>
                                         
                                        </div>
                                        <span>Label Profiles</span>
                                        <?php
                                        $query = $db->query("SELECT * FROM label_profiles WHERE user_id = ".$_SESSION['login_userid']);
                                        
                                        ?>
                                        <h3 class="card-title text-nowrap mb-1"><?php echo mysqli_num_rows($query); ?></h3>
                                        <br>
                                         <a href="manage-labels.php" class="btn btn-sm btn-label-primary">
                                                    View All</a>
                                        <!--<small class="text-success fw-semibold"><i-->
                                        <!--        class='bx bx-up-arrow-alt'></i> +28.42%</small>-->
                                    </div>
                                </div>
                            </div>
                             <div class="col-lg-3 col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div
                                            class="card-title d-flex align-items-start justify-content-between">
                                            <div class="avatar flex-shrink-0">
                                                <img src="./assets/img/icons/unicons/wallet-info.png"
                                                    alt="Credit Card" class="rounded">
                                            </div>
                                         
                                        </div>
                                        <span>Artists</span>
                                        <?php
                                        $query = $db->query("SELECT * FROM artists WHERE user_id = ".$_SESSION['login_userid']);
                                        
                                        ?>
                                        <h3 class="card-title text-nowrap mb-1"><?php echo mysqli_num_rows($query); ?></h3>
                                        <br>
                                         <a href="manage-artists.php" class="btn btn-sm btn-label-primary">
                                                    View All</a>
                                        <!--<small class="text-success fw-semibold"><i-->
                                        <!--        class='bx bx-up-arrow-alt'></i> +28.42%</small>-->
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 mt-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div
                                            class="card-title d-flex align-items-start justify-content-between">
                                            <div class="avatar flex-shrink-0">
                                                <img src="./assets/img/icons/unicons/wallet-info.png"
                                                    alt="Credit Card" class="rounded">
                                            </div>
                                         
                                        </div>
                                        <span>Account Statements</span>
                                        <?php
                                        $query = $db->query("SELECT * FROM statements WHERE user_id = ".$_SESSION['login_userid']);
                                        
                                        ?>
                                        <h3 class="card-title text-nowrap mb-1"><?php echo mysqli_num_rows($query); ?></h3>
                                        <br>
                                         <a href="statements.php" class="btn btn-sm btn-label-primary">
                                                    View All</a>
                                        <!--<small class="text-success fw-semibold"><i-->
                                        <!--        class='bx bx-up-arrow-alt'></i> +28.42%</small>-->
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 mt-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div
                                            class="card-title d-flex align-items-start justify-content-between">
                                            <div class="avatar flex-shrink-0">
                                                <img src="./assets/img/icons/unicons/wallet-info.png"
                                                    alt="Credit Card" class="rounded">
                                            </div>
                                         
                                        </div>
                                        <span>Total Earnings</span>
                                        <?php
                                        $query = $db->query("SELECT sum(earnings) as total_earnings FROM statements WHERE user_id = ".$_SESSION['login_userid']);
                                        
                                        ?>
                                        <h3 class="card-title text-nowrap mb-1"><?php while($r = $query->fetch_assoc()){ echo number_format($r['total_earnings'],2);}?></h3>
                                        <br>
                                         <a href="statements.php" class="btn btn-sm btn-label-primary">
                                                    View All</a>
                                        <!--<small class="text-success fw-semibold"><i-->
                                        <!--        class='bx bx-up-arrow-alt'></i> +28.42%</small>-->
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

    </div>


    <!-- Include Scripts -->
    <!-- BEGIN: Vendor JS-->
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
    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Theme JS-->
    <script src="./assets/js/mainc3d7.js?id=3c628e87a9befaa350e1f822744b8142"></script>

    <!-- END: Theme JS-->
    <!-- Pricing Modal JS-->
    <!-- END: Pricing Modal JS-->
    <!-- BEGIN: Page JS-->
    <script src="./assets/js/dashboards-analytics.js"></script>
    <!-- END: Page JS-->

</body>

</html>