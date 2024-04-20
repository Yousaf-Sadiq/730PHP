
    <style>
    .menu-vertical .app-brand {
        padding-left: 1rem;
    }
    .menu .app-brand.demo {
        height: 100px;
        margin-top: 12px;
    }
    .menu-link {
        font-size: 1rem !important;
    }
    .menu-sub .menu-link {
        font-size: 0.9rem !important;
    }
    </style>
       <?php 
       $uri = $_SERVER['REQUEST_URI'];
       
       $prefix = "/ver2/";
       
       ?>
       <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

<!-- ! Hide app brand if navbar-full -->
<div class="app-brand demo">
    <a href=""
        class="app-brand-link">
        <span class="app-brand-logo demo">
         <img class="rounded" src="icons/purple.jpeg" width="50">
        </span>
        
        <span class="menu-text ms-3" style="text-transform: capitalize ">
            <h4 class="mb-0">Q Phonic ENT</h4>
            <small>Control Panel</small>
        </span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
</div>

<div class="menu-inner-shadow"></div>

<ul class="menu-inner py-1 ps ps--active-y">

     <li class="menu-item <?php if($uri == $prefix."index.php" ||$uri == $prefix."" ){ echo "active"; } ?>">
        <a href="index.php" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div>Dashboard</div>
        </a>
    </li>



    
    
    <li class="menu-item <?php if($uri==$prefix."releases.php" || $uri==$prefix."create-releases.php" ){ ?>active open<?php } ?>">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-book"></i>
            <div>Releases</div>
        </a>

        <ul class="menu-sub">



            <li class="menu-item <?php if($uri == $prefix."create-releases.php"){echo "active";} ?>">
                <a href="create-releases.php"
                    class="menu-link">
                    <div>Create Release</div>
                </a>


            </li>



            <li class="menu-item <?php if($uri == $prefix."releases.php"){echo "active";} ?>">
                <a href="releases.php" class="menu-link">
                    <div>View Releases</div>
                </a>


            </li>


            </ul>
      
    </li>


    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Manage</span>
    </li>




    <li class="menu-item <?php if($_SERVER['REQUEST_URI'] == "/ver2/manage-artists.php"){ echo "active"; } ?>">
        <a href="manage-artists.php" class="menu-link">
            <i class="menu-icon tf-icons bx bxs-user-voice"></i>
            <div>Artists</div>
        </a>
    </li>
    <li class="menu-item <?php if($_SERVER['REQUEST_URI'] == "/ver2/manage-labels.php"){ echo "active"; } ?>">
        <a href="manage-labels.php" class="menu-link">
            <i class="menu-icon tf-icons bx bx-purchase-tag"></i>
            <div>Your Labels</div>
        </a>
    </li>
        <li class="menu-item <?php if($_SERVER['REQUEST_URI'] == "/ver2/statements.php"){ echo "active"; } ?>">
        <a href="statements.php" class="menu-link">
            <i class="menu-icon tf-icons bx bx-calendar-check"></i>
            <div>Account Statements</div>
        </a>
    </li>




    <li class="menu-item <?php if($_SERVER['REQUEST_URI'] == "/ver2/profile.php"){ echo "active"; } ?>">
        <a href="profile.php" class="menu-link">
            <i class="menu-icon tf-icons bx bx-user"></i>
            <div>My Account</div>
        </a>
    </li>


















    


    
    <!--<li class="menu-header small text-uppercase">-->
    <!--            <span class="menu-header-text">Miscellaneous</span>-->
    <!--        </li>-->
            


</ul>

</aside>
