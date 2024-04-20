<?php 

session_start();
include('../../include/dbConfig.php');
require_once('../../include/global_info.php');


?>

<!DOCTYPE html>

<html lang="en" class="light-style  layout-menu-fixed   " dir="ltr" data-theme="theme-default" data-assets-path="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/" data-base-url="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1" data-framework="laravel" data-template="vertical-menu-theme-default-light">


<!-- Mirrored from demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1/app/user/list by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 09 Sep 2022 16:43:12 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Manage Students | <?php echo $global_name; ?></title>
  <meta name="description" content="Most Powerful &amp; Comprehensive Bootstrap 5 HTML Admin Dashboard Template built for developers!" />
  <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
  <!-- laravel CRUD token -->
  <meta name="csrf-token" content="NAkv4GSUnfPXqyp3qBI0BHmCQFVjuX3uksB9sEaY">
  <!-- Canonical SEO -->
  <link rel="canonical" href="../../../../../themeselection.com/item/sneat-bootstrap-html-laravel-admin-template/index.html">
  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="/assets/img/favicon/favicon.ico" />

  <!-- Include Styles -->
  <!-- BEGIN: Theme CSS-->
<!-- Fonts -->
<link rel="preconnect" href="../../../../../fonts.googleapis.com/index.html">
<link rel="preconnect" href="../../../../../fonts.gstatic.com/index.html" crossorigin>
<link href="../../../../../fonts.googleapis.com/css28ebe.css?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet">

<link rel="stylesheet" href="/assets/vendor/fonts/boxiconse04f.css?id=7bed0c381d8a5b57f43c7bd313947977" />
<link rel="stylesheet" href="/assets/vendor/fonts/fontawesomeb34a.css?id=f55d5b6721febc124275199b7dddbb5b" />
<link rel="stylesheet" href="/assets/vendor/fonts/flag-iconsc977.css?id=7018802e2db10780041f73a184e4bebe" />

<!-- Core CSS -->
<link rel="stylesheet" href="/assets/vendor/css/rtl/core29d0.css?id=7ea028d8943e4d11544610602e504b70" class="template-customizer-core-css" />
<link rel="stylesheet" href="/assets/vendor/css/rtl/theme-defaultde12.css?id=3cdafbb15e4b7f9cbb567018a632af10" class="template-customizer-theme-css" />
<link rel="stylesheet" href="/assets/css/demo6e6a.css?id=8a804dae81f41c0f9fcbef2fa8316bdd" />


<link rel="stylesheet" href="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbarb440.css?id=d9fa6469688548dca3b7e6bd32cb0dc6" />
<link rel="stylesheet" href="/assets/vendor/libs/typeahead-js/typeahead3881.css?id=8fc311b79b2aeabf94b343b6337656cf" />

<!-- Vendor Styles -->
<link rel="stylesheet" href="/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css">
<link rel="stylesheet" href="/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css">
<link rel="stylesheet" href="/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css">
<link rel="stylesheet" href="/assets/vendor/libs/select2/select2.css" />
<link rel="stylesheet" href="/assets/vendor/libs/formvalidation/dist/css/formValidation.min.css" />



<!-- Page Styles -->

  <!-- Include Scripts for customizer, helper, analytics, config -->
  <!-- laravel style -->
<script src="/assets/vendor/js/helpers.js"></script>
<!-- beautify ignore:start -->
  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
  <script src="/assets/vendor/js/template-customizer.js"></script>

  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="/assets/js/config.js"></script>

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
  <div class="layout-wrapper layout-content-navbar ">
  <div class="layout-container">

  <?php include('../../include/aside.php'); ?>

    <!-- Layout page -->
    <div class="layout-page">
      <!-- BEGIN: Navbar-->
            <!-- Navbar -->
<?php include('../../include/nav.php'); ?>
  <!-- / Navbar -->
            <!-- END: Navbar-->


      <!-- Content wrapper -->
      <div class="content-wrapper">

        <!-- Content -->
                  <div class="container-xxl flex-grow-1 container-p-y">
            
            
<div class="row g-4 mb-4">
  <div class="col-sm-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span>Session</span>
            <div class="d-flex align-items-end mt-2">
              <h4 class="mb-0 me-2">21,459</h4>
              <small class="text-success">(+29%)</small>
            </div>
            <small>Total Users</small>
          </div>
          <span class="badge bg-label-primary rounded p-2">
            <i class="bx bx-user bx-sm"></i>
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span>Paid Users</span>
            <div class="d-flex align-items-end mt-2">
              <h4 class="mb-0 me-2">4,567</h4>
              <small class="text-success">(+18%)</small>
            </div>
            <small>Last week analytics </small>
          </div>
          <span class="badge bg-label-danger rounded p-2">
            <i class="bx bx-user-plus bx-sm"></i>
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span>Active Users</span>
            <div class="d-flex align-items-end mt-2">
              <h4 class="mb-0 me-2">19,860</h4>
              <small class="text-danger">(-14%)</small>
            </div>
            <small>Last week analytics</small>
          </div>
          <span class="badge bg-label-success rounded p-2">
            <i class="bx bx-group bx-sm"></i>
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span>Pending Users</span>
            <div class="d-flex align-items-end mt-2">
              <h4 class="mb-0 me-2">237</h4>
              <small class="text-success">(+42%)</small>
            </div>
            <small>Last week analytics</small>
          </div>
          <span class="badge bg-label-warning rounded p-2">
            <i class="bx bx-user-voice bx-sm"></i>
          </span>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Users List Table -->
<div class="card">
  <div class="card-header border-bottom">
    <h5 class="card-title">Search Filter</h5>
    <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">
      <div class="col-md-4 user_role"></div>
      <div class="col-md-4 user_plan"></div>
      <div class="col-md-4 user_status"></div>
    </div>
  </div>
  <div class="card-datatable table-responsive">
    <table class="datatables-users table border-top">
      <thead>
        <tr>
          <th>ID</th>
          <th>Status</th>
          <th>Name / Email</th>
          <th>Class</th>
          <th>Batch</th>
          
          <th>Type</th>
          <th>Overall score</th>
          
        </tr>
      </thead>
    </table>
  </div>
  <!-- Offcanvas to add new user -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add User</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0">
      <form class="add-new-user pt-0" id="addNewUserForm" onsubmit="return false">
        <div class="mb-3">
          <label class="form-label" for="add-user-fullname">Full Name</label>
          <input type="text" class="form-control" id="add-user-fullname" placeholder="John Doe" name="userFullname" aria-label="John Doe" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-user-email">Email</label>
          <input type="text" id="add-user-email" class="form-control" placeholder="john.doe@example.com" aria-label="john.doe@example.com" name="userEmail" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-user-contact">Contact</label>
          <input type="text" id="add-user-contact" class="form-control phone-mask" placeholder="+1 (609) 988-44-11" aria-label="john.doe@example.com" name="userContact" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-user-company">Company</label>
          <input type="text" id="add-user-company" class="form-control" placeholder="Web Developer" aria-label="jdoe1" name="companyName" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="country">Country</label>
          <select id="country" class="select2 form-select">
            <option value="">Select</option>
            <option value="Australia">Australia</option>
            <option value="Bangladesh">Bangladesh</option>
            <option value="Belarus">Belarus</option>
            <option value="Brazil">Brazil</option>
            <option value="Canada">Canada</option>
            <option value="China">China</option>
            <option value="France">France</option>
            <option value="Germany">Germany</option>
            <option value="India">India</option>
            <option value="Indonesia">Indonesia</option>
            <option value="Israel">Israel</option>
            <option value="Italy">Italy</option>
            <option value="Japan">Japan</option>
            <option value="Korea">Korea, Republic of</option>
            <option value="Mexico">Mexico</option>
            <option value="Philippines">Philippines</option>
            <option value="Russia">Russian Federation</option>
            <option value="South Africa">South Africa</option>
            <option value="Thailand">Thailand</option>
            <option value="Turkey">Turkey</option>
            <option value="Ukraine">Ukraine</option>
            <option value="United Arab Emirates">United Arab Emirates</option>
            <option value="United Kingdom">United Kingdom</option>
            <option value="United States">United States</option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label" for="user-role">User Role</label>
          <select id="user-role" class="form-select">
            <option value="subscriber">Subscriber</option>
            <option value="editor">Editor</option>
            <option value="maintainer">Maintainer</option>
            <option value="author">Author</option>
            <option value="admin">Admin</option>
          </select>
        </div>
        <div class="mb-4">
          <label class="form-label" for="user-plan">Select Plan</label>
          <select id="user-plan" class="form-select">
            <option value="basic">Basic</option>
            <option value="enterprise">Enterprise</option>
            <option value="company">Company</option>
            <option value="team">Team</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
      </form>
    </div>
  </div>
</div>

            <!-- pricingModal -->
                        <!--/ pricingModal -->

          </div>
          <!-- / Content -->

          <!-- Footer -->
                    <!-- Footer-->
<footer class="content-footer footer bg-footer-theme">
  <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
    <div class="mb-2 mb-md-0">
      © <script>
        document.write(new Date().getFullYear())

      </script>
      , made with ❤️ by <a href="https://themeselection.com/" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>
    </div>
    <div>
      <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
      <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>
      <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/laravel-introduction.html" target="_blank" class="footer-link me-4">Documentation</a>
      <a href="https://themeselection.com/support/" target="_blank" class="footer-link d-none d-sm-inline-block">Support</a>
    </div>
  </div>
</footer>
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
<script src="/assets/vendor/libs/jquery/jquery40f4.js?id=96645acf88116df9c36bef6153b3a51a"></script>
<script src="/assets/vendor/libs/popper/popper885d.js?id=c8510634b3d8cded74bbe30a2b593d87"></script>
<script src="/assets/vendor/js/bootstrap0983.js?id=1f50b74ded465d298b282b4562bdaf8c"></script>
<script src="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar4d5e.js?id=9d86308b7c41e76a7dc8472907865b83"></script>
<script src="/assets/vendor/libs/hammer/hammerc38e.js?id=2a80ebd1aa77a9e33ec54b68ee8de5e0"></script>
<script src="/assets/vendor/libs/i18n/i18n5fec.js?id=5dd0894a4cb5357ba8a20df3187b6d9b"></script>
<script src="/assets/vendor/libs/typeahead-js/typeaheada766.js?id=8c315d7e2e7b09a04d8e8efead923241"></script>
<script src="/assets/vendor/js/menu7d39.js?id=f45ec38086f86335b91fc2fdcaaadab8"></script>
<script src="/assets/vendor/libs/moment/moment.js"></script>
<script src="/assets/vendor/libs/datatables/jquery.dataTables.js"></script>
<script src="/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
<script src="/assets/vendor/libs/datatables-responsive/datatables.responsive.js"></script>
<script src="/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js"></script>
<script src="/assets/vendor/libs/datatables-buttons/datatables-buttons.js"></script>
<script src="/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.js"></script>
<script src="/assets/vendor/libs/jszip/jszip.js"></script>
<script src="/assets/vendor/libs/pdfmake/pdfmake.js"></script>
<script src="/assets/vendor/libs/datatables-buttons/buttons.html5.js"></script>
<script src="/assets/vendor/libs/datatables-buttons/buttons.print.js"></script>
<script src="/assets/vendor/libs/select2/select2.js"></script>
<script src="/assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js"></script>
<script src="/assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js"></script>
<script src="/assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js"></script>
<script src="/assets/vendor/libs/cleavejs/cleave.js"></script>
<script src="/assets/vendor/libs/cleavejs/cleave-phone.js"></script>
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="/assets/js/mainc3d7.js?id=3c628e87a9befaa350e1f822744b8142"></script>

<!-- END: Theme JS-->
<!-- Pricing Modal JS-->
<!-- END: Pricing Modal JS-->
<!-- BEGIN: Page JS-->
<script>
    "use strict";
$((function() {
        var e = $(".datatables-users"),
            t = $(".select2"),
            a = baseUrl + "app/user/view/account",
            n = {
                1: {
                    title: "Pending",
                    class: "bg-label-warning"
                },
                2: {
                    title: "Active",
                    class: "bg-label-success"
                },
                3: {
                    title: "Inactive",
                    class: "bg-label-secondary"
                }
            };
        if (t.length) {
            var s = t;
            s.wrap('<div class="position-relative"></div>').select2({
                placeholder: "Select Country",
                dropdownParent: s.parent()
            })
        }
        if (e.length) var o = e.DataTable({
            ajax: "json/students-list.php",
            columns: [{
                data: ""
            }, {
                data: "full_name"
            }, {
                data: "role"
            }, {
                data: "current_plan"
            }, {
                data: "billing"
            }, {
                data: "status"
            }, {
                data: "action"
            }],
            columnDefs: [{
                className: "control",
                searchable: !1,
                orderable: !1,
                responsivePriority: 2,
                targets: 0,
                render: function(e, t, a, n) {
                    return ""
                }
            }, {
                targets: 1,
                responsivePriority: 4,
                render: function(e, t, n, s) {
                    var o = n.full_name,
                        r = n.email,
                        l = n.avatar;
                    if (l) var i = '<img src="' + assetsPath + "/img/avatars/" + l + '" alt="Avatar" class="rounded-circle">';
                    else {
                        var c = ["success", "danger", "warning", "info", "dark", "primary", "secondary"][Math.floor(6 * Math.random())],
                            d = (o = n.full_name).match(/\b\w/g) || [];
                        i = '<span class="avatar-initial rounded-circle bg-label-' + c + '">' + (d = ((d.shift() || "") + (d.pop() || "")).toUpperCase()) + "</span>"
                    }
                    return '<div class="d-flex justify-content-start align-items-center user-name"><div class="avatar-wrapper"><div class="avatar avatar-sm me-3">' + i + '</div></div><div class="d-flex flex-column"><a href="' + a + '" class="text-body text-truncate"><span class="fw-semibold">' + o + '</span></a><small class="text-muted">' + r + "</small></div></div>"
                }
            }, {
                targets: 2,
                render: function(e, t, a, n) {
                    var s = a.role;
                    return "<span class='text-truncate d-flex align-items-center'>" + {
                        Subscriber: '<span class="badge badge-center rounded-pill bg-label-warning w-px-30 h-px-30 me-2"><i class="bx bx-user bx-xs"></i></span>',
                        Author: '<span class="badge badge-center rounded-pill bg-label-success w-px-30 h-px-30 me-2"><i class="bx bx-cog bx-xs"></i></span>',
                        Maintainer: '<span class="badge badge-center rounded-pill bg-label-primary w-px-30 h-px-30 me-2"><i class="bx bx-pie-chart-alt bx-xs"></i></span>',
                        Editor: '<span class="badge badge-center rounded-pill bg-label-info w-px-30 h-px-30 me-2"><i class="bx bx-edit bx-xs"></i></span>',
                        Admin: '<span class="badge badge-center rounded-pill bg-label-secondary w-px-30 h-px-30 me-2"><i class="bx bx-mobile-alt bx-xs"></i></span>'
                    } [s] + s + "</span>"
                }
            }, {
                targets: 3,
                render: function(e, t, a, n) {
                    return '<span class="fw-semibold">' + a.current_plan + "</span>"
                }
            }, {
                targets: 5,
                render: function(e, t, a, s) {
                    var o = a.status;
                    return '<span class="badge ' + n[o].class + '">' + n[o].title + "</span>"
                }
            }, {
                targets: -1,
                title: "Actions",
                searchable: !1,
                orderable: !1,
                render: function(e, t, n, s) {
                    return '<div class="d-inline-block text-nowrap"><button class="btn btn-sm btn-icon"><i class="bx bx-edit"></i></button><button class="btn btn-sm btn-icon delete-record"><i class="bx bx-trash"></i></button><button class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button><div class="dropdown-menu dropdown-menu-end m-0"><a href="' + a + '" class="dropdown-item">View</a><a href="javascript:;" class="dropdown-item">Suspend</a></div></div>'
                }
            }],
            order: [
                [1, "desc"]
            ],
            dom: '<"row mx-2"<"col-md-2"<"me-3"l>><"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0"fB>>>t<"row mx-2"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            language: {
                sLengthMenu: "_MENU_",
                search: "",
                searchPlaceholder: "Search.."
            },
            buttons: [{
                extend: "collection",
                className: "btn btn-label-secondary dropdown-toggle mx-3",
                text: '<i class="bx bx-upload me-2"></i>Export',
                buttons: [{
                    extend: "print",
                    text: '<i class="bx bx-printer me-2" ></i>Print',
                    className: "dropdown-item",
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5],
                        format: {
                            body: function(e, t, a) {
                                if (e.length <= 0) return e;
                                var n = $.parseHTML(e),
                                    s = "";
                                return $.each(n, (function(e, t) {
                                    void 0 !== t.classList && t.classList.contains("user-name") ? s += t.lastChild.firstChild.textContent : void 0 === t.innerText ? s += t.textContent : s += t.innerText
                                })), s
                            }
                        }
                    },
                    customize: function(e) {
                        $(e.document.body).css("color", config.colors.headingColor).css("border-color", config.colors.borderColor).css("background-color", config.colors.body), $(e.document.body).find("table").addClass("compact").css("color", "inherit").css("border-color", "inherit").css("background-color", "inherit")
                    }
                }, {
                    extend: "csv",
                    text: '<i class="bx bx-file me-2" ></i>Csv',
                    className: "dropdown-item",
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5],
                        format: {
                            body: function(e, t, a) {
                                if (e.length <= 0) return e;
                                var n = $.parseHTML(e),
                                    s = "";
                                return $.each(n, (function(e, t) {
                                    void 0 !== t.classList && t.classList.contains("user-name") ? s += t.lastChild.firstChild.textContent : void 0 === t.innerText ? s += t.textContent : s += t.innerText
                                })), s
                            }
                        }
                    }
                }, {
                    extend: "excel",
                    text: "Excel",
                    className: "dropdown-item",
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5],
                        format: {
                            body: function(e, t, a) {
                                if (e.length <= 0) return e;
                                var n = $.parseHTML(e),
                                    s = "";
                                return $.each(n, (function(e, t) {
                                    void 0 !== t.classList && t.classList.contains("user-name") ? s += t.lastChild.firstChild.textContent : void 0 === t.innerText ? s += t.textContent : s += t.innerText
                                })), s
                            }
                        }
                    }
                }, {
                    extend: "pdf",
                    text: '<i class="bx bxs-file-pdf me-2"></i>Pdf',
                    className: "dropdown-item",
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5],
                        format: {
                            body: function(e, t, a) {
                                if (e.length <= 0) return e;
                                var n = $.parseHTML(e),
                                    s = "";
                                return $.each(n, (function(e, t) {
                                    void 0 !== t.classList && t.classList.contains("user-name") ? s += t.lastChild.firstChild.textContent : void 0 === t.innerText ? s += t.textContent : s += t.innerText
                                })), s
                            }
                        }
                    }
                }, {
                    extend: "copy",
                    text: '<i class="bx bx-copy me-2" ></i>Copy',
                    className: "dropdown-item",
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5],
                        format: {
                            body: function(e, t, a) {
                                if (e.length <= 0) return e;
                                var n = $.parseHTML(e),
                                    s = "";
                                return $.each(n, (function(e, t) {
                                    void 0 !== t.classList && t.classList.contains("user-name") ? s += t.lastChild.firstChild.textContent : void 0 === t.innerText ? s += t.textContent : s += t.innerText
                                })), s
                            }
                        }
                    }
                }]
            }, {
                text: '<i class="bx bx-plus me-0 me-sm-2"></i><span class="d-none d-lg-inline-block">Add New User</span>',
                className: "add-new btn btn-primary",
                attr: {
                    "data-bs-toggle": "offcanvas",
                    "data-bs-target": "#offcanvasAddUser"
                }
            }],
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function(e) {
                            return "Details of " + e.data().full_name
                        }
                    }),
                    type: "column",
                    renderer: function(e, t, a) {
                        var n = $.map(a, (function(e, t) {
                            return "" !== e.title ? '<tr data-dt-row="' + e.rowIndex + '" data-dt-column="' + e.columnIndex + '"><td>' + e.title + ":</td> <td>" + e.data + "</td></tr>" : ""
                        })).join("");
                        return !!n && $('<table class="table"/><tbody />').append(n)
                    }
                }
            },
            initComplete: function() {
                this.api().columns(2).every((function() {
                    var e = this,
                        t = $('<select id="UserRole" class="form-select text-capitalize"><option value=""> Select Role </option></select>').appendTo(".user_role").on("change", (function() {
                            var t = $.fn.dataTable.util.escapeRegex($(this).val());
                            e.search(t ? "^" + t + "$" : "", !0, !1).draw()
                        }));
                    e.data().unique().sort().each((function(e, a) {
                        t.append('<option value="' + e + '">' + e + "</option>")
                    }))
                })), this.api().columns(3).every((function() {
                    var e = this,
                        t = $('<select id="UserPlan" class="form-select text-capitalize"><option value=""> Select Plan </option></select>').appendTo(".user_plan").on("change", (function() {
                            var t = $.fn.dataTable.util.escapeRegex($(this).val());
                            e.search(t ? "^" + t + "$" : "", !0, !1).draw()
                        }));
                    e.data().unique().sort().each((function(e, a) {
                        t.append('<option value="' + e + '">' + e + "</option>")
                    }))
                })), this.api().columns(5).every((function() {
                    var e = this,
                        t = $('<select id="FilterTransaction" class="form-select text-capitalize"><option value=""> Select Status </option></select>').appendTo(".user_status").on("change", (function() {
                            var t = $.fn.dataTable.util.escapeRegex($(this).val());
                            e.search(t ? "^" + t + "$" : "", !0, !1).draw()
                        }));
                    e.data().unique().sort().each((function(e, a) {
                        t.append('<option value="' + n[e].title + '" class="text-capitalize">' + n[e].title + "</option>")
                    }))
                }))
            }
        });
        $(".datatables-users tbody").on("click", ".delete-record", (function() {
            o.row($(this).parents("tr")).remove().draw()
        })), setTimeout((() => {
            $(".dataTables_filter .form-control").removeClass("form-control-sm"), $(".dataTables_length .form-select").removeClass("form-select-sm")
        }), 300)
    })),
    function() {
        const e = document.querySelectorAll(".phone-mask"),
            t = document.getElementById("addNewUserForm");
        e && e.forEach((function(e) {
            new Cleave(e, {
                phone: !0,
                phoneRegionCode: "US"
            })
        }));
        FormValidation.formValidation(t, {
            fields: {
                userFullname: {
                    validators: {
                        notEmpty: {
                            message: "Please enter fullname "
                        }
                    }
                },
                userEmail: {
                    validators: {
                        notEmpty: {
                            message: "Please enter your email"
                        },
                        emailAddress: {
                            message: "The value is not a valid email address"
                        }
                    }
                }
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger,
                bootstrap5: new FormValidation.plugins.Bootstrap5({
                    eleValidClass: "",
                    rowSelector: function(e, t) {
                        return ".mb-3"
                    }
                }),
                submitButton: new FormValidation.plugins.SubmitButton,
                autoFocus: new FormValidation.plugins.AutoFocus
            }
        })
    }();
    </script>
<!-- END: Page JS-->

</body>


<!-- Mirrored from demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1/app/user/list by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 09 Sep 2022 16:43:17 GMT -->
</html>
