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


    require_once __DIR__ . '/error/register.php';

    // check email if already exist or not 

    $sql = "SELECT * FROM `users` WHERE `email` = '{$email}'";

    $exe_check = $conn->query($sql);

    if ($exe_check->num_rows > 0) {
        $status["error"]++;

        array_push($status["msg"], "EMAIL Already exist");
    }


    if ($status["error"] > 0) {


        foreach ($status["msg"] as $msg) {
            ERROR_MSG($msg);
        }

        refresh_url(2, REGISTER);
    } else {


        $hash = password_hash($password, PASSWORD_BCRYPT);

        $encrypt = base64_encode($password);


        $insert = "INSERT INTO `users`( `user_name`, `email`, `password`, `ptoken`) 
                         VALUES ('{$user_name}','{$email}','{$hash}','{$encrypt}')";

        $insert_exe = $conn->query($insert);

        if ($insert_exe) {

            if ($conn->affected_rows > 0) {

                Sucuss_msg("YOUR DATA HAS BEEN REGISTERED");


                $_SESSION["email"] = $email;
                $_SESSION["user_id"] = $conn->insert_id; // is used to get latest inserted id

                refresh_url(2, Dashboard);

            }
        }


    }


    // =============================================================================
}



// =======================================

if (isset($_POST["login"]) && !empty($_POST["login"])) {

    
    $email = filter_data($_POST["email"]);
    $password = filter_data($_POST["password"]);



    $status = [
        "error" => 0,
        "msg" => array()
    ];


    require_once __DIR__ . '/error/login.php';


    if ($status["error"] > 0) {


        foreach ($status["msg"] as $msg) {
            ERROR_MSG($msg);
        }

        refresh_url(2, LOGIN);
    } else {


        $hash = password_hash($password, PASSWORD_BCRYPT);

        $encrypt = base64_encode($password);



         $sql = "SELECT * FROM `users` WHERE `email` = '{$email}' AND `ptoken`='{$encrypt}' ";

            
        $exe_check = $conn->query($sql);

        if ($exe_check->num_rows > 0) {

            $userData = $exe_check->fetch_assoc();

            $_SESSION["email"] = $userData["email"];
            $_SESSION["user_id"] = $userData["id"];


            Sucuss_msg("LOGIN SUCCUSSFULLY");

            refresh_url(2, Dashboard);


        }
        else{
            ERROR_MSG("YOU'R NOT REGISTERED IN OUR PORTAL");
            refresh_url(2, REGISTER);
        }






    }


    // =============================================================================
}
?>


<?php

require_once dirname(__DIR__) . "/../include/footer.php";
?>