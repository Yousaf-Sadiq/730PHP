<?php 
session_set_cookie_params(86400);
session_start();
include('include/dbConfig.php');
// print_r($_SESSION);


    if(strlen($_SESSION['user_login'])==0){
        echo '<script>window.location="login.php"</script>';  
    }
$success =false;



if(isset($_POST['update_profile'])){
    $query = "UPDATE users SET first_name='".$_POST['fname']."', last_name='".$_POST['lname']."', user_phone='".$_POST['phone']."', user_pass='".$_POST['pass']."' WHERE user_id = ".$_SESSION['login_userid'];
    // echo $query;
    if(mysqli_query($db, $query)){
        $success = true;
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

    <title>My Account | Q Phonic Entertainment </title>
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
                           
                            <?php
                            if($success == true){
                                ?> 
                                <div class="col-md-4">
                                    <div class="alert alert-primary alert-dismissible" role="alert">
                                      Updated
                                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                      </button>
                                    </div>
                                 </div>
                                <?php
                            }
                            
                            ?>
                        <div class="col-md-12"></div>
                            <div class="col-xl-4">
                                 <div class="card mb-4">
                                  <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Status</h5> <small class="text-muted float-end"></small>
                                  </div>
                                  <div class="card-body">
                                           <div id="accountper"></div>
                                    </div>
                                    </div>
                            </div>
                             <div class="col-xl-8">
                                <h6 class="text-muted">My Account</h6>
                                <ul class="nav nav-pills flex-column flex-sm-row mb-4">
                                  <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user"></i> Profile</a></li>
                                    
                                </ul>
                                <?php 
                                $account_percentage = '';
                                 
                                $query = $db->query("SELECT * FROM users WHERE user_id = ".$_SESSION['login_userid']);
                                while($row = $query->fetch_assoc()){
                                $account_percentage = $row['acc_percentage'];
                                ?>
                                <div class="card mb-4">
                                  <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Account Settings</h5> <small class="text-muted float-end"></small>
                                  </div>
                                  <div class="card-body">
                                    <form method="post" action="">
                                      <div class="mb-3">
                                        <label class="form-label" for="basic-default-username">Username</label>
                                        <input type="text" class="form-control" id="basic-default-username" value="<?php echo $row['user_name'] ?>" disabled>
                                      </div>
                                      
                                      <div class="mb-3">
                                        <label class="form-label" for="basic-default-email">Email</label>
                                        <div class="input-group input-group-merge">
                                          <input type="text" id="basic-default-email" class="form-control" value="<?php echo $row['user_email'] ?>" aria-label="john.doe" aria-describedby="basic-default-email2" disabled>
                                          <!--<span class="input-group-text" id="basic-default-email2">@example.com</span>-->
                                        </div>
                                      
                                      </div>
                                      <div class="mb-3">
                                        <label class="form-label" for="basic-default-firstname">First Name</label>
                                        <input type="text" class="form-control" id="basic-default-fullname" placeholder="John Doe" name="fname" value="<?php echo $row['first_name']; ?>">
                                      </div>
                                      <div class="mb-3">
                                        <label class="form-label" for="basic-default-lastname">Last Name</label>
                                        <input type="text" class="form-control" id="basic-default-fullname" placeholder="John Doe" name="lname" value="<?php echo $row['last_name'] ?>">
                                      </div>
                                      
                                      <div class="mb-3">
                                        <label class="form-label" for="basic-default-phone">Phone No</label>
                                        <input type="text" id="basic-default-phone" class="form-control phone-mask" name="phone" value="<?php echo $row['user_phone'] ?>">
                                      </div>
                                      <div class="mb-3">
                                        <label class="form-label" for="basic-default-phone">Password</label>
                                        <input type="text" id="basic-default-phone" class="form-control phone-mask" placeholder="658 799 8941" name="pass" value="<?php echo $row['user_pass'] ?>">
                                      </div>
                                      <!-- <label class="form-label" for="basic-default-phone">Account Percentage</label>-->
                                      <!--<div class="progress">-->
                                      <!--  <div class="progress-bar" role="progressbar" style="width: <?php //echo $row['acc_percentage'] ?>%;" aria-valuenow="<?php //echo $row['acc_percentage'] ?>" aria-valuemin="0" aria-valuemax="100"><?php //echo $row['acc_percentage'] ?>%</div>-->
                                      <!--</div>-->
                                 
                                      <br>
                                      <button type="submit" class="btn btn-primary" name="update_profile">Save</button>
                                    </form>
                                  </div>
                                </div>
                                
                                <?php } ?>          
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
    
    <script>
        $(document).ready(function(){
            $(".export_btn").click(function(){
                var label = $(this).attr('data-label');
                var d = new Date();

                $.ajax({
                  url: "ajax_files/get_statements.php",
                  method: "GET",
                  data: { label : label , uid : <?php echo $_SESSION['login_userid']; ?>},
                  success: function(data){
                    // console.log("Data: " + data);
                    var response = jQuery.parseJSON(data);
                    var result = response.result;
                    var data = [];
                    
                    $.each(result, function(i, item) {
                    // alert(item.earnings);
                    data.push([item.label_name,item.year,item.month,item.earnings]);
                  });
                  console
                    var csv = 'Label Name,Year,Month,Earnings\n';
                    data.forEach(function(row) {
                            csv += row.join(',');
                            csv += "\n";
                    });
                 
                    console.log(csv);
                    var hiddenElement = document.createElement('a');
                    hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(csv);
                    hiddenElement.target = '_blank';
                    hiddenElement.download = label+" "+d.getDate()+'.csv';
                    hiddenElement.click();

                    // console.log(response.result);
                    // var new_data = response.result;
                    // if(new_data.removed_records!=""){
                    //     //  setTimeout(
                    //     //   function() 
                    //     //   {
                    //     //     $("tr[data-artist-row-id='"+delete_id+"']").fadeOut(300, function(){ 
                    //     //         $(this).remove();
                    //     //     });

                             
                    //     //   }, 1000);
                                
                        
                    // }
                    
                  }
                });
            });
        });
    </script>
    <script>
        "use strict";
! function() {
    let o, e, r, t, a, s, i, n, l, d;
    isDarkStyle ? (o = config.colors_dark.cardColor, e = config.colors_dark.headingColor, r = config.colors_dark.textMuted, t = config.colors_dark.bodyColor, s = config.colors_dark.borderColor, a = "dark", i = "#4f51c0", n = "#595cd9", l = "#8789ff", d = "#c3c4ff") : (o = config.colors.white, e = config.colors.headingColor, r = config.colors.textMuted, t = config.colors.bodyColor, s = config.colors.borderColor, a = "", i = "#e1e2ff", n = "#c3c4ff", l = "#a5a7ff", d = "#696cff");
    const c = {
        donut: {
            series1: config.colors.success,
            series2: "rgba(113, 221, 55, 0.6)",
            series3: "rgba(113, 221, 55, 0.4)",
            series4: "rgba(113, 221, 55, 0.2)"
        }
    };
    const p = document.querySelectorAll(".chart-progress");
    p && p.forEach((function(o) {
        const e = function(o, e) {
            return {
                chart: {
                    height: 55,
                    width: 45,
                    type: "radialBar"
                },
                plotOptions: {
                    radialBar: {
                        hollow: {
                            size: "25%"
                        },
                        dataLabels: {
                            show: !1
                        },
                        track: {
                            background: config.colors_label.secondary
                        }
                    }
                },
                colors: [o],
                grid: {
                    padding: {
                        top: -15,
                        bottom: -15,
                        left: -5,
                        right: -15
                    }
                },
                series: [e],
                labels: ["Progress"]
            }
        }(config.colors[o.dataset.color], o.dataset.series);
        new ApexCharts(o, e).render()
    }));
    const h = document.querySelector("#customerRatingsChart"),
        y = {
            chart: {
                height: 200,
                toolbar: {
                    show: !1
                },
                zoom: {
                    enabled: !1
                },
                type: "line",
                dropShadow: {
                    enabled: !0,
                    enabledOnSeries: [1],
                    top: 13,
                    left: 4,
                    blur: 3,
                    color: config.colors.primary,
                    opacity: .09
                }
            },
            series: [{
                name: "Last Month",
                data: [20, 54, 20, 38, 22, 28, 16, 19]
            }, {
                name: "This Month",
                data: [20, 32, 22, 65, 40, 46, 34, 70]
            }],
            stroke: {
                curve: "smooth",
                dashArray: [8, 0],
                width: [3, 4]
            },
            legend: {
                show: !1
            },
            colors: [s, config.colors.primary],
            grid: {
                show: !1,
                borderColor: s,
                padding: {
                    top: -20,
                    bottom: -10,
                    left: 0
                }
            },
            markers: {
                size: 6,
                colors: "transparent",
                strokeColors: "transparent",
                strokeWidth: 5,
                hover: {
                    size: 6
                },
                discrete: [{
                    fillColor: config.colors.white,
                    seriesIndex: 1,
                    dataPointIndex: 7,
                    strokeColor: config.colors.primary,
                    size: 6
                }, {
                    fillColor: config.colors.white,
                    seriesIndex: 1,
                    dataPointIndex: 3,
                    strokeColor: config.colors.black,
                    size: 6
                }]
            },
            xaxis: {
                labels: {
                    style: {
                        colors: r,
                        fontSize: "13px"
                    }
                },
                axisTicks: {
                    show: !1
                },
                categories: ["", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
                axisBorder: {
                    show: !1
                }
            },
            yaxis: {
                show: !1
            }
        };
    if (void 0 !== typeof h && null !== h) {
        new ApexCharts(h, y).render()
    }
    const g = document.querySelector("#salesActivityChart"),
        f = {
            chart: {
                type: "bar",
                height: 275,
                stacked: !0,
                toolbar: {
                    show: !1
                }
            },
            series: [{
                name: "PRODUCT A",
                data: [75, 50, 55, 60, 48, 82, 59]
            }, {
                name: "PRODUCT B",
                data: [25, 29, 32, 35, 34, 18, 30]
            }],
            plotOptions: {
                bar: {
                    horizontal: !1,
                    columnWidth: "40%",
                    borderRadius: 10,
                    startingShape: "rounded",
                    endingShape: "rounded"
                }
            },
            dataLabels: {
                enabled: !1
            },
            stroke: {
                curve: "smooth",
                width: 6,
                lineCap: "round",
                colors: [o]
            },
            legend: {
                show: !1
            },
            colors: [config.colors.danger, "#435971"],
            fill: {
                opacity: 1
            },
            grid: {
                show: !1,
                strokeDashArray: 7,
                padding: {
                    top: -10,
                    bottom: -12,
                    left: 0,
                    right: 0
                }
            },
            xaxis: {
                categories: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
                labels: {
                    show: !0,
                    style: {
                        colors: r,
                        fontSize: "13px"
                    }
                },
                axisBorder: {
                    show: !1
                },
                axisTicks: {
                    show: !1
                }
            },
            yaxis: {
                show: !1
            },
            responsive: [{
                breakpoint: 1440,
                options: {
                    plotOptions: {
                        bar: {
                            borderRadius: 10,
                            columnWidth: "50%"
                        }
                    }
                }
            }, {
                breakpoint: 1300,
                options: {
                    plotOptions: {
                        bar: {
                            borderRadius: 11,
                            columnWidth: "55%"
                        }
                    }
                }
            }, {
                breakpoint: 1200,
                options: {
                    plotOptions: {
                        bar: {
                            borderRadius: 10,
                            columnWidth: "45%"
                        }
                    }
                }
            }, {
                breakpoint: 1040,
                options: {
                    plotOptions: {
                        bar: {
                            borderRadius: 10,
                            columnWidth: "50%"
                        }
                    }
                }
            }, {
                breakpoint: 992,
                options: {
                    plotOptions: {
                        bar: {
                            borderRadius: 12,
                            columnWidth: "40%"
                        }
                    },
                    chart: {
                        type: "bar",
                        height: 320
                    }
                }
            }, {
                breakpoint: 768,
                options: {
                    plotOptions: {
                        bar: {
                            borderRadius: 11,
                            columnWidth: "25%"
                        }
                    }
                }
            }, {
                breakpoint: 576,
                options: {
                    plotOptions: {
                        bar: {
                            borderRadius: 10,
                            columnWidth: "35%"
                        }
                    }
                }
            }, {
                breakpoint: 440,
                options: {
                    plotOptions: {
                        bar: {
                            borderRadius: 10,
                            columnWidth: "45%"
                        }
                    }
                }
            }, {
                breakpoint: 360,
                options: {
                    plotOptions: {
                        bar: {
                            borderRadius: 8,
                            columnWidth: "50%"
                        }
                    }
                }
            }],
            states: {
                hover: {
                    filter: {
                        type: "none"
                    }
                },
                active: {
                    filter: {
                        type: "none"
                    }
                }
            }
        };
    if (void 0 !== typeof g && null !== g) {
        new ApexCharts(g, f).render()
    }
    const u = document.querySelector("#sessionsChart"),
        x = {
            chart: {
                height: 90,
                type: "area",
                toolbar: {
                    show: !1
                },
                sparkline: {
                    enabled: !0
                }
            },
            markers: {
                size: 6,
                colors: "transparent",
                strokeColors: "transparent",
                strokeWidth: 4,
                discrete: [{
                    fillColor: config.colors.white,
                    seriesIndex: 0,
                    dataPointIndex: 8,
                    strokeColor: config.colors.warning,
                    strokeWidth: 2,
                    size: 6,
                    radius: 8
                }],
                hover: {
                    size: 7
                }
            },
            grid: {
                show: !1,
                padding: {
                    right: 8
                }
            },
            colors: [config.colors.warning],
            fill: {
                type: "gradient",
                gradient: {
                    shade: a,
                    shadeIntensity: .8,
                    opacityFrom: .8,
                    opacityTo: .25,
                    stops: [0, 95, 100]
                }
            },
            dataLabels: {
                enabled: !1
            },
            stroke: {
                width: 2,
                curve: "straight"
            },
            series: [{
                data: [280, 280, 240, 240, 200, 200, 260, 260, 310]
            }],
            xaxis: {
                show: !1,
                lines: {
                    show: !1
                },
                labels: {
                    show: !1
                },
                axisBorder: {
                    show: !1
                }
            },
            yaxis: {
                show: !1
            }
        };
    if (void 0 !== typeof u && null !== u) {
        new ApexCharts(u, x).render()
    }
    const b = document.querySelector("#leadsReportChart"),
        m = {
            chart: {
                height: 157,
                width: 130,
                parentHeightOffset: 0,
                type: "donut"
            },
            labels: ["Electronic", "Sports", "Decor", "Fashion"],
            series: [45, 58, 30, 50],
            colors: [c.donut.series1, c.donut.series2, c.donut.series3, c.donut.series4],
            stroke: {
                width: 0
            },
            dataLabels: {
                enabled: !1,
                formatter: function(o, e) {
                    return parseInt(o) + "%"
                }
            },
            legend: {
                show: !1
            },
            tooltip: {
                theme: !1
            },
            grid: {
                padding: {
                    top: -5,
                    bottom: -13
                }
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: "75%",
                        labels: {
                            show: !0,
                            value: {
                                fontSize: "1.5rem",
                                fontFamily: "Public Sans",
                                color: e,
                                fontWeight: 500,
                                offsetY: -15,
                                formatter: function(o) {
                                    return parseInt(o) + "%"
                                }
                            },
                            name: {
                                offsetY: 20,
                                fontFamily: "Public Sans"
                            },
                            total: {
                                show: !0,
                                fontSize: ".7rem",
                                label: "1 Week",
                                color: t,
                                formatter: function(o) {
                                    return "32%"
                                }
                            }
                        }
                    }
                }
            }
        };
    if (void 0 !== typeof b && null !== b) {
        new ApexCharts(b, m).render()
    }
    const k = document.querySelector("#reportBarChart"),
        w = {
            chart: {
                height: 120,
                type: "bar",
                toolbar: {
                    show: !1
                }
            },
            plotOptions: {
                bar: {
                    barHeight: "60%",
                    columnWidth: "50%",
                    startingShape: "rounded",
                    endingShape: "rounded",
                    borderRadius: 4,
                    distributed: !0
                }
            },
            grid: {
                show: !1,
                padding: {
                    top: -35,
                    bottom: -10,
                    left: -10,
                    right: -10
                }
            },
            colors: [config.colors_label.primary, config.colors_label.primary, config.colors_label.primary, config.colors_label.primary, config.colors.primary, config.colors_label.primary, config.colors_label.primary],
            dataLabels: {
                enabled: !1
            },
            series: [{
                data: [40, 95, 60, 45, 90, 50, 75]
            }],
            legend: {
                show: !1
            },
            xaxis: {
                categories: ["Mo", "Tu", "We", "Th", "Fr", "Sa", "Su"],
                axisBorder: {
                    show: !1
                },
                axisTicks: {
                    show: !1
                },
                labels: {
                    style: {
                        colors: r,
                        fontSize: "13px"
                    }
                }
            },
            yaxis: {
                labels: {
                    show: !1
                }
            }
        };
    if (void 0 !== typeof k && null !== k) {
        new ApexCharts(k, w).render()
    }
    const C = document.querySelector("#salesAnalyticsChart");
    if (void 0 !== typeof C && null !== C) {
        new ApexCharts(C, {
            chart: {
                height: 350,
                type: "heatmap",
                parentHeightOffset: 0,
                offsetX: -10,
                toolbar: {
                    show: !1
                }
            },
            series: [{
                name: "1k",
                data: [{
                    x: "Jan",
                    y: "250"
                }, {
                    x: "Feb",
                    y: "350"
                }, {
                    x: "Mar",
                    y: "220"
                }, {
                    x: "Apr",
                    y: "290"
                }, {
                    x: "May",
                    y: "650"
                }, {
                    x: "Jun",
                    y: "260"
                }, {
                    x: "Jul",
                    y: "274"
                }, {
                    x: "Aug",
                    y: "850"
                }]
            }, {
                name: "2k",
                data: [{
                    x: "Jan",
                    y: "750"
                }, {
                    x: "Feb",
                    y: "3350"
                }, {
                    x: "Mar",
                    y: "1220"
                }, {
                    x: "Apr",
                    y: "1290"
                }, {
                    x: "May",
                    y: "1650"
                }, {
                    x: "Jun",
                    y: "1260"
                }, {
                    x: "Jul",
                    y: "1274"
                }, {
                    x: "Aug",
                    y: "850"
                }]
            }, {
                name: "3k",
                data: [{
                    x: "Jan",
                    y: "375"
                }, {
                    x: "Feb",
                    y: "1350"
                }, {
                    x: "Mar",
                    y: "3220"
                }, {
                    x: "Apr",
                    y: "2290"
                }, {
                    x: "May",
                    y: "2650"
                }, {
                    x: "Jun",
                    y: "2260"
                }, {
                    x: "Jul",
                    y: "1274"
                }, {
                    x: "Aug",
                    y: "815"
                }]
            }, {
                name: "4k",
                data: [{
                    x: "Jan",
                    y: "575"
                }, {
                    x: "Feb",
                    y: "1350"
                }, {
                    x: "Mar",
                    y: "2220"
                }, {
                    x: "Apr",
                    y: "3290"
                }, {
                    x: "May",
                    y: "3650"
                }, {
                    x: "Jun",
                    y: "2260"
                }, {
                    x: "Jul",
                    y: "1274"
                }, {
                    x: "Aug",
                    y: "315"
                }]
            }, {
                name: "5k",
                data: [{
                    x: "Jan",
                    y: "875"
                }, {
                    x: "Feb",
                    y: "1350"
                }, {
                    x: "Mar",
                    y: "2220"
                }, {
                    x: "Apr",
                    y: "3290"
                }, {
                    x: "May",
                    y: "3650"
                }, {
                    x: "Jun",
                    y: "2260"
                }, {
                    x: "Jul",
                    y: "1274"
                }, {
                    x: "Aug",
                    y: "965"
                }]
            }, {
                name: "6k",
                data: [{
                    x: "Jan",
                    y: "575"
                }, {
                    x: "Feb",
                    y: "1350"
                }, {
                    x: "Mar",
                    y: "2220"
                }, {
                    x: "Apr",
                    y: "2290"
                }, {
                    x: "May",
                    y: "2650"
                }, {
                    x: "Jun",
                    y: "3260"
                }, {
                    x: "Jul",
                    y: "1274"
                }, {
                    x: "Aug",
                    y: "815"
                }]
            }, {
                name: "7k",
                data: [{
                    x: "Jan",
                    y: "575"
                }, {
                    x: "Feb",
                    y: "1350"
                }, {
                    x: "Mar",
                    y: "1220"
                }, {
                    x: "Apr",
                    y: "1290"
                }, {
                    x: "May",
                    y: "1650"
                }, {
                    x: "Jun",
                    y: "1260"
                }, {
                    x: "Jul",
                    y: "3274"
                }, {
                    x: "Aug",
                    y: "815"
                }]
            }, {
                name: "8k",
                data: [{
                    x: "Jan",
                    y: "575"
                }, {
                    x: "Feb",
                    y: "350"
                }, {
                    x: "Mar",
                    y: "220"
                }, {
                    x: "Apr",
                    y: "290"
                }, {
                    x: "May",
                    y: "650"
                }, {
                    x: "Jun",
                    y: "260"
                }, {
                    x: "Jul",
                    y: "274"
                }, {
                    x: "Aug",
                    y: "815"
                }]
            }],
            plotOptions: {
                heatmap: {
                    enableShades: !1,
                    radius: "6px",
                    colorScale: {
                        ranges: [{
                            from: 0,
                            to: 1e3,
                            name: "1k",
                            color: i
                        }, {
                            from: 1001,
                            to: 2e3,
                            name: "2k",
                            color: n
                        }, {
                            from: 2001,
                            to: 3e3,
                            name: "3k",
                            color: l
                        }, {
                            from: 3001,
                            to: 4e3,
                            name: "4k",
                            color: d
                        }]
                    }
                }
            },
            dataLabels: {
                enabled: !1
            },
            stroke: {
                width: 4,
                colors: [o]
            },
            legend: {
                show: !1
            },
            grid: {
                show: !1,
                padding: {
                    top: -10,
                    left: 10,
                    right: -15,
                    bottom: 0
                }
            },
            xaxis: {
                labels: {
                    show: !0,
                    style: {
                        colors: r,
                        fontSize: "13px"
                    }
                },
                axisBorder: {
                    show: !1
                },
                axisTicks: {
                    show: !1
                }
            },
            yaxis: {
                labels: {
                    style: {
                        colors: r,
                        fontSize: "13px"
                    }
                }
            },
            responsive: [{
                breakpoint: 1441,
                options: {
                    chart: {
                        height: "325px"
                    },
                    grid: {
                        padding: {
                            right: -15
                        }
                    }
                }
            }, {
                breakpoint: 1045,
                options: {
                    chart: {
                        height: "300px"
                    },
                    grid: {
                        padding: {
                            right: -50
                        }
                    }
                }
            }, {
                breakpoint: 992,
                options: {
                    chart: {
                        height: "320px"
                    },
                    grid: {
                        padding: {
                            right: -50
                        }
                    }
                }
            }, {
                breakpoint: 767,
                options: {
                    chart: {
                        height: "400px"
                    },
                    grid: {
                        padding: {
                            right: 0
                        }
                    }
                }
            }, {
                breakpoint: 568,
                options: {
                    chart: {
                        height: "330px"
                    },
                    grid: {
                        padding: {
                            right: -20
                        }
                    }
                }
            }],
            states: {
                hover: {
                    filter: {
                        type: "none"
                    }
                },
                active: {
                    filter: {
                        type: "none"
                    }
                }
            }
        }).render()
    }
    const S = document.querySelector("#accountper"),
        A = {
            chart: {
                height: 340,
                type: "radialBar"
            },
            series: [<?=$account_percentage;?>],
            labels: ["Account Percentage"],
            plotOptions: {
                radialBar: {
                    startAngle: 0,
                    endAngle: 360,
                    strokeWidth: "70",
                    hollow: {
                        margin: 50,
                        size: "75%",
                        image: assetsPath + "img/icons/misc/arrow-star.png",
                        imageWidth: 65,
                        imageHeight: 55,
                        imageOffsetY: -35,
                        imageClipped: !1
                    },
                    track: {
                        strokeWidth: "50%",
                        background: s
                    },
                    dataLabels: {
                        show: !0,
                        name: {
                            offsetY: 60,
                            show: !0,
                            color: r,
                            fontSize: "15px"
                        },
                        value: {
                            formatter: function(o) {
                                return parseInt(o) + "%"
                            },
                            offsetY: 20,
                            color: e,
                            fontSize: "32px",
                            show: !0
                        }
                    }
                }
            },
            fill: {
                type: "solid",
                colors: config.colors.success
            },
            stroke: {
                lineCap: "round"
            },
            states: {
                hover: {
                    filter: {
                        type: "none"
                    }
                },
                active: {
                    filter: {
                        type: "none"
                    }
                }
            }
        };
    if (void 0 !== typeof S && null !== S) {
        new ApexCharts(S, A).render()
    }
}();
    </script>
  
</body>

</html>