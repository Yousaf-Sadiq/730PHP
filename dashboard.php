<?php 

require_once dirname(__FILE__)."/include/header.php";

if(!isset($_SESSION["email"]) || empty($_SESSION["email"])){

    redirect_url(REGISTER);
}

// session_destroy();
?>


<h1> WELCOME TO Dashboard</h1>

<div class="container-fluid">
    <div class="row flex-nowrap">

<?php      

require_once dirname(__FILE__).'/include/dashboard_sidenav.php';

?>


        <div class="col py-3">
            Content area...
        
        </div>





    </div>
</div>


<?php 

require_once dirname(__FILE__)."/include/footer.php";
?>