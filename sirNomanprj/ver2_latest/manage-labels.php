<?php 
session_set_cookie_params(86400);
session_start();
include('include/dbConfig.php');


    if(strlen($_SESSION['user_login'])==0){
        echo '<script>window.location="login.php"</script>';  
    }



if(isset($_POST['add_label'])){
    
    $upload = false;
    $error = false;
    $success = false;
    // echo '<pre>';
    $post_data = $_POST;
    $query = "INSERT INTO label_profiles (label_name, label_contact_name,label_email, user_id, created_at) VALUES ('".$_POST['label_name']."', '".$_POST['contact_name']."', '".$_POST['email']."', ".$_SESSION['login_userid'].", '".date('Y-m-d h:i:s')."')";
    // echo $query;
    if(mysqli_query($db, $query)){
        $success = true;
    }
            // die();
        // $values = json_encode($_POST, true);
        
        // $print= json_decode($values, true);
        // print_r($_FILES);
        // echo $_FILES['cover_art'];        

    
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

    <title>Manage Labels | Q Phonic Entertainment  </title>
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
                            <div class="col-md-12">
                                <?php if($success == true){ ?>
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                     Successful
                                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                      </button>
                                    </div>
                                <?php }?>
                            </div>
                            <!-- Basic Layout -->
							<div class="col-xxl">
								<div class="card mb-4">
									<div class="card-header d-flex align-items-center justify-content-between">
										<h5 class="mb-0">Add Label</h5> <small class="text-muted float-end"></small> </div>
									<div class="card-body">
										<form action="" method="post">
											<div class="row mb-3">
												<label class="col-sm-2 col-form-label" for="basic-default-name">Label Name</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="basic-default-name" name="label_name" placeholder="John Doe" required/> </div>
											</div>
											<div class="row mb-3">
												<label class="col-sm-2 col-form-label" for="basic-default-name">Contact Name</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="basic-default-name" name="contact_name" placeholder="John Doe" required/> </div>
											</div>
											<div class="row mb-3">
												<label class="col-sm-2 col-form-label" for="basic-default-company">Email Name</label>
												<div class="col-sm-10">
													<input type="email" class="form-control" id="basic-default-company" name="email" placeholder="ACME Inc." required/> </div>
											</div>
										
											<div class="row justify-content-end">
												<div class="col-sm-10">
													<button type="submit" name="add_label" class="btn btn-primary">Add</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
							
							<div class="col-md-12">
							    <!-- Basic Bootstrap Table -->
                                <div class="card">
                                  <h5 class="card-header">Manage your labels</h5>
                                  <div class="table-responsive text-nowrap">
                                    <table class="table">
                                      <thead>
                                        <tr>
                                          <th>Actions</th>
                                          <th>Sr. #</th>
                                          <th>Label Name</th>
                                          <th>Contact Name</th>
                                          <th>Contact Name</th>
                                        </tr>
                                      </thead>
                                      <tbody class="table-border-bottom-0">
                                        <?php
                                        $query = $db->query("SELECT * FROM label_profiles WHERE user_id = ".$_SESSION['login_userid']);
                                        $count = 1;
                                        if(mysqli_num_rows($query)!=0){
                                            while($row = $query->fetch_assoc()){ 
                                            ?>
                                                <tr data-label-row-id="<?php echo $row['label_id']; ?>">
                                                  <td>
                                                    <button type="button" class="btn btn-icon btn-danger delete_label" data-id="<?php echo $row['label_id']; ?>">
                                                        <span class="tf-icons bx bx-trash"></span>
                                                    </button>
                                                  </td>
                                                  <td>
                                                  <?php echo $count; ?> 
                                                  </td>
                                                  <td> 
                                                    <strong><?php echo $row['label_name']; ?> </strong></td>
                                                  <td><?php echo $row['label_contact_name']; ?> </td>
                                                  <td><?php echo $row['label_email']; ?> </td>
                                                </tr>
                                            <?php
                                            $count++;
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="4">
                                                    <center>No Labels are added yet</center>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                                <!--/ Basic Bootstrap Table -->
							</div>
							
							
							
							
                        </div>
                        

                        

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
    <script type="text/javascript">
    $(document).ready(function(){
       $(".delete_label").click(function(){
                // alert("yes");
                // $("#edit_modal_temp_div").addClass("preloader");
                
                delete_id = $(this).data("id");
                  $("tr[data-label-row-id='"+delete_id+"']").css('background', '#ff9c9c');
                $.ajax({
                  url: "ajax_files/delete_label.php",
                  method: "GET",
                  data: { id : delete_id },
                  success: function(data){
                    // alert("Data: " + data);
                    var response = jQuery.parseJSON(data);
                    console.log(response.result);
                    var new_data = response.result;
                    if(new_data.removed_records!=""){
                         setTimeout(
                          function() 
                          {
                            $("tr[data-label-row-id='"+delete_id+"']").fadeOut(300, function(){ 
                                $(this).remove();
                            });

                             
                          }, 1000);
                                
                        
                    }
                    
                  }
                });
                setTimeout(
                  function() 
                  {
                     $("#edit_modal_temp_div").removeClass("preloader");
                  }, 500);
                // console.log(modal_id);    
            }); 
    });
        
    </script>
  
</body>


</html>