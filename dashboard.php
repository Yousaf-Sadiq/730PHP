<?php 

require_once dirname(__FILE__)."/include/header.php";

if(!isset($_SESSION["email"]) || empty($_SESSION["email"])){

    redirect_url(REGISTER);
}

// session_destroy();
?>


<h1> WELCOME TO Dashboard</h1>

<?php 

require_once dirname(__FILE__)."/include/footer.php";
?>