<header>
      <!-- header-area-start -->
      <div class="main-wraper">
        <div class="main-container fixed-top">
          <div class="header header-expand-sm expand-header">
            <div class="header-left d-flex">
             <div class="logo"><a href="index-2.html"><img src="<?php echo DOMAIN1;?>/assets/img/logo/logo.png" alt="logo"></a></div>
              <!-- canvas_open -->
              <div class="canvas_open toggle-menu sidebar-collapse">
                <button class="menu-button">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(116, 116, 116, 1); transform: msFilter"><path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"></path></svg>
                </button>
              </div>
            </div>
            <!-- header-search -->
            <div class="header-search">
              <div class="search-form">
                <form action="#">
                  <div class="input">
                    <input type="text" name="search" placeholder="Search">
                    <div class="search-icon">
                      <button type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(116, 116, 116, 1); transform: msFilter;">
                          <path d="M19.023 16.977a35.13 35.13 0 0 1-1.367-1.384c-.372-.378-.596-.653-.596-.653l-2.8-1.337A6.962 6.962 0 0 0 16 9c0-3.859-3.14-7-7-7S2 5.141 2 9s3.14 7 7 7c1.763 0 3.37-.66 4.603-1.739l1.337 2.8s.275.224.653.596c.387.363.896.854 1.384 1.367l1.358 1.392.604.646 2.121-2.121-.646-.604c-.379-.372-.885-.866-1.391-1.36zM9 14c-2.757 0-5-2.243-5-5s2.243-5 5-5 5 2.243 5 5-2.243 5-5 5z"></path>
                        </svg>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!-- header-right -->
            <div class="header-right d-none d-lg-block">
              <ul class="navbar-item flex-row ml-auto">
                <!-- national-flag-start -->
                <?php require_once "flag-desktop.php"; ?>
                <!-- brands-table-start -->
                <li class="nav-item dropdown user-brands">
                  <button class="nav-link apps" data-bs-toggle="dropdown">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(116, 116, 116, 1); transform: msfilter">
                      <path d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm5 2h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1zm1-6h4v4h-4V5zM3 20a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v6zm2-5h4v4H5v-4zm8 5a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1h-6a1 1 0 0 0-1 1v6zm2-5h4v4h-4v-4z"></path>
                    </svg>
                  </button>
                  <div class="dropdown-menu country-dt apps" data-popper-placement="none">
                    <!-- single-apps -->
                    <div class="dp-dropdown single-dropdown mb-10">
                      <a href="#" class="dropdown-item">
                        <img src="assets/img/app/3.png" alt="drive">
                        <span>Google Drive</span>
                      </a>
                    </div>
                    <!-- single-apps -->
                    <div class="dp-dropdown single-dropdown mb-10">
                      <a href="#" class="dropdown-item">
                        <img src="assets/img/app/5.png" alt="github">
                        <span>Github</span>
                      </a>
                    </div>
                    <!-- single-apps -->
                    <div class="dp-dropdown single-dropdown mb-10">
                      <a href="#" class="dropdown-item">
                        <img src="assets/img/app/7.png" alt="figma">
                        <span>Figma</span>
                      </a>
                    </div>
                    <!-- single-apps -->
                    <div class="dp-dropdown single-dropdown mb-10">
                      <a href="#" class="dropdown-item">
                        <img src="assets/img/app/8.png" alt="twitter">
                        <span>Twitter</span>
                      </a>
                    </div>
                    <!-- single-apps -->
                    <div class="dp-dropdown single-dropdown mb-10">
                      <a href="#" class="dropdown-item">
                        <img src="assets/img/app/9.png" alt="calender">
                        <span>Calender</span>
                      </a>
                    </div>
                    <!-- single-apps -->
                    <div class="dp-dropdown single-dropdown mb-10">
                      <a href="#" class="dropdown-item">
                        <img src="assets/img/app/11.png" alt="gelary">
                        <span>Gelary</span>
                      </a>
                    </div>
                    <!-- single-apps -->
                    <div class="dp-dropdown single-dropdown">
                      <a href="#" class="dropdown-item">
                        <img src="assets/img/app/12.png" alt="pinterest">
                        <span>Pinterest</span>
                      </a>
                    </div>
                    <!-- single-apps -->
                    <div class="dp-dropdown single-dropdown">
                      <a href="#" class="dropdown-item">
                        <img src="assets/img/app/13.png" alt="linkedin">
                        <span>Linkedin</span>
                      </a>
                    </div>
                    <!-- single-apps -->
                    <div class="dp-dropdown single-dropdown">
                      <a href="#" class="dropdown-item">
                        <img src="assets/img/app/15.png" alt="youtube">
                        <span>Youtube</span>
                      </a>
                    </div>
                  </div>
                </li>
               

              
               <?php require_once "all_message.php"; ?>
               <?php require_once "notification.php"; ?>
               <?php require_once "_profile.php"; ?>
              </ul>
            </div>
            
            
            <?php require_once "flag-mobile.php"; ?>
          </div>
        </div>
      </div>
      <!-- header-area-end -->
    </header>