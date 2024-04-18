<?php

require_once dirname(__FILE__) . "/layout/header.php";
?>


<?php

if (isset($_POST["register"]) && !empty($_POST["register"])) {

    $user_name = filter_data($_POST["fname"])." ".filter_data($_POST["lname"]) ;
    $email = filter_data($_POST["email"]);
    $password = filter_data($_POST["password"]);
    $Confirm_password = filter_data($_POST["Confirm_password"]);


    $status = [
        "error" => 0,
        "msg" => array()
    ];


    require_once  __DIR__ . '/error/register.php';



    if ($status["error"] > 0) {
    

        foreach($status["msg"] as $msg){
            ERROR_MSG($msg);
        }

        refresh_url(2,HOME);
    }

    else{
            


        
        }


   
}

?>


<?php

require_once dirname(__FILE__) . "/layout/footer.php";


?>