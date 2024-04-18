<?php 

require_once dirname(__FILE__)."/layout/header.php";

if(!isset($_SESSION["email"]) || empty($_SESSION["email"])){

    redirect_url(REGISTER);
}


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

require_once dirname(__FILE__)."/layout/footer.php";
?>