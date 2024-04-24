<div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline">Menu</span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    
                <li class="nav-item">
                <a href="">
                <div class="dropdown pb-4">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
                        <span class="d-none d-sm-inline mx-1"> <?php echo $row_fetch["user_name"] ?> </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                        <!-- <li><a class="dropdown-item" href="#">New project...</a></li> -->
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="<?php  echo PROFILE ?>">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="<?php echo LOGOUT ?>">Sign out</a></li>
                    </ul>
                </div>
                </a>
                </li>

                <!-- <li class="nav-item">
                        <a href="#" class="nav-link align-middle px-0">
                           <i class="fa fa-home" aria-hidden="true"></i>  <span class="ms-1 d-none d-sm-inline">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <i class="fa fa-thermometer-2" aria-hidden="true"></i> <span class="d-none d-sm-inline mx-1">Dashboard</span> <i class="fa fa-arrow-circle-o-down" aria-hidden="true"></i> </a>
                        <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Profile</span> 1 </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 2 </a>
                            </li>
                        </ul>
                    </li> -->
                    <li>
                        <a href="<?php echo Dashboard ?>" class="nav-link px-0 align-middle">
                        <i class="fa-solid fa-gauge"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span></a>
                    </li>
                    <li>
                        <a href="<?php echo PROFILE ?>" class="nav-link px-0 align-middle">
                            <i class="fa fa-gears" aria-hidden="true"></i> <span class="ms-1 d-none d-sm-inline">PROFILE</span></a>
                    </li>
                   
                    <li>
                        <a href="#" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Orders</span></a>
                    </li>
                   
                   
                    <li>
                        <a href="#" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Customers</span> </a>
                    </li>
                </ul>
                <hr>
                
            </div>
        </div>