<?php

require_once dirname(__DIR__) . "/../include/header.php";
?>


<?php

if (isset($_POST["register"]) && !empty($_POST["register"])) {

    $user_name = filter_data($_POST["name"]);
    $email = filter_data($_POST["email"]);
    $password = filter_data($_POST["password"]);
    $Cfm_password = filter_data($_POST["Cfm_password"]);


    $status = [
        "error" => 0,
        "msg" => array()
    ];


    require_once  __DIR__ . '/error/register.php';



    if ($status["error"] > 0) {
    

        foreach($status["msg"] as $msg){
            ERROR_MSG($msg);
        }

        refresh_url(2,REGISTER);
    }

    else{
            
        }


    // =============================================================================
}

?>


<?php

require_once dirname(__DIR__) . "/../include/footer.php";
?>