<?php
session_set_cookie_params(86400);
session_start();
include('include/dbConfig.php');
//  yaha 

if (isset($_SESSION['user_login'])) {

    if(strlen($_SESSION['user_login'])!=0){
        echo '<script>window.location="index.php"</script>';  
    }

} else {
    if(isset($_POST['email'])){
       

        $username=$_POST['email'];
        echo $_POST['email']. $_POST['password'];
        $password=$_POST['password'];
        $Loginusername='';
        $q = "SELECT * FROM users WHERE user_email = '$username' AND user_pass='$password'";
        $ret=$db->query($q);
        while($row =$ret->fetch_assoc()){
            $Loginusername=$row['user_name'];
            $loginuserid = $row['user_id'];
        }
        // echo $Loginusername;
        $num=mysqli_num_rows($ret);
      
        if($num>0)
        {
            $_SESSION['user_login']=$Loginusername;
            $_SESSION['login_userid']=$loginuserid;
            echo '<script>window.location.href="index.php"</script>';
        }
        else
        {
            $error ="Invalid username or password";
        }
    }
    
}
 ?>
<!DOCTYPE html>

<html lang="en" class="light-style     customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/" data-base-url="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1" data-framework="laravel" data-template="blank-menu-theme-default-light">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Log In | Q Phonic Entertainment </title>
  <meta name="description" content="Most Powerful &amp; Comprehensive Bootstrap 5 HTML Admin Dashboard Template built for developers!" />
  <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
  <!-- laravel CRUD token -->
  <meta name="csrf-token" content="NAkv4GSUnfPXqyp3qBI0BHmCQFVjuX3uksB9sEaY">
  <!-- Canonical SEO -->
  <link rel="canonical" href="../../../../themeselection.com/item/sneat-bootstrap-html-laravel-admin-template/index.html">
  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="icons/purple.jpeg" />

  <!-- Include Styles -->
  <!-- BEGIN: Theme CSS-->
<!-- Fonts -->
<link rel="preconnect" href="../../../../fonts.googleapis.com/index.html">
<link rel="preconnect" href="../../../../fonts.gstatic.com/index.html" crossorigin>
<link href="../../../../fonts.googleapis.com/css28ebe.css?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet">

<link rel="stylesheet" href="./assets/vendor/fonts/boxiconse04f.css?id=7bed0c381d8a5b57f43c7bd313947977" />
<link rel="stylesheet" href="./assets/vendor/fonts/fontawesomeb34a.css?id=f55d5b6721febc124275199b7dddbb5b" />
<link rel="stylesheet" href="./assets/vendor/fonts/flag-iconsc977.css?id=7018802e2db10780041f73a184e4bebe" />

<!-- Core CSS -->
<link rel="stylesheet" href="./assets/vendor/css/rtl/core29d0.css?id=7ea028d8943e4d11544610602e504b70" class="template-customizer-core-css" />
<link rel="stylesheet" href="./assets/vendor/css/rtl/theme-defaultde12.css?id=3cdafbb15e4b7f9cbb567018a632af10" class="template-customizer-theme-css" />
<link rel="stylesheet" href="./assets/css/demo6e6a.css?id=8a804dae81f41c0f9fcbef2fa8316bdd" />


<link rel="stylesheet" href="./assets/vendor/libs/perfect-scrollbar/perfect-scrollbarb440.css?id=d9fa6469688548dca3b7e6bd32cb0dc6" />
<link rel="stylesheet" href="./assets/vendor/libs/typeahead-js/typeahead3881.css?id=8fc311b79b2aeabf94b343b6337656cf" />

<!-- Vendor Styles -->
<!-- Vendor -->
<link rel="stylesheet" href="./assets/vendor/libs/formvalidation/dist/css/formValidation.min.css" />


<!-- Page Styles -->
<!-- Page -->
<link rel="stylesheet" href="./assets/vendor/css/pages/page-auth.css">

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
      displayCustomizer: true,
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
  
<!-- Content -->
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
      <!-- Register -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
     
       <img src="icons/purple.jpeg" width="100" height="100" style="margin-left: 36%;border-radius: 50% ;">

          <!-- /Logo -->
          <h4 class="my-5 text-center">Welcome to Q Phonic ENT! 👋</h4>
          <!--<p class="mb-4">Please sign-in to your account and start the adventure</p>-->

          <form id="formAuthentication" class="mb-3" action="" method="POST">
            <div class="mb-3">
              <label for="email" class="form-label">Email or Username</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email or username" autofocus>
            </div>
            <div class="mb-3 form-password-toggle">
              <div class="d-flex justify-content-between">
                <label class="form-label" for="password">Password</label>
                <a href="">
                  <!--<small>Forgot Password?</small>-->
                </a>
              </div>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
            </div>
            <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember-me">
                <label class="form-check-label" for="remember-me">
                  Remember Me
                </label>
              </div>
            </div>
               
                        <?php if($error!="" ){ ?>
                            <center>
                                <span style="color: red">
                                    <?php echo $error;
                                    $error = "";
                                    ?>  
                                </span>
                            </center>
                        <?php } ?>  
                        
            <div class="mb-3">
              <button class="btn btn-primary d-grid w-100" name="loginsubmit" type="submit">Sign in</button>
            </div>
          </form>

          <!--<p class="text-center">-->
          <!--  <span>New on our platform?</span>-->
          <!--  <a href="">-->
          <!--    <span>Create an account</span>-->
          <!--  </a>-->
          <!--</p>-->

          <!--<div class="divider my-4">-->
          <!--  <div class="divider-text">or</div>-->
          <!--</div>-->

          <!--<div class="d-flex justify-content-center">-->
          <!--  <a href="javascript:;" class="btn btn-icon btn-label-facebook me-3">-->
          <!--    <i class="tf-icons bx bxl-facebook"></i>-->
          <!--  </a>-->

          <!--  <a href="javascript:;" class="btn btn-icon btn-label-google-plus me-3">-->
          <!--    <i class="tf-icons bx bxl-google-plus"></i>-->
          <!--  </a>-->

          <!--  <a href="javascript:;" class="btn btn-icon btn-label-twitter">-->
          <!--    <i class="tf-icons bx bxl-twitter"></i>-->
          <!--  </a>-->
          <!--</div>-->
        </div>
      </div>
      <!-- /Register -->
    </div>
  </div>
</div>
<!--/ Content -->

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
<script src="./assets/js/pages-auth.js"></script>
<!-- END: Page JS-->

</body>

</html>
