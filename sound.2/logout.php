<?php

require_once dirname(__FILE__) . "/layout/header.php";

if (!isset($_SESSION["email"]) || empty($_SESSION["email"])) {

    redirect_url(REGISTER);
}

session_destroy();

refresh_url(2, HOME);

?>


<h1> BYE!! BYE!!</h1>

<?php

require_once dirname(__FILE__) . "/layout/footer.php";
?>