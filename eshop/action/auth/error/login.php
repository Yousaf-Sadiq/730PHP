<?php 






if (!isset($email) || empty($email)) {
    $status["error"]++;

    array_push($status["msg"], "EMAIL IS REQUIRED");


} else {


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $status["error"]++;

        array_push($status["msg"], "EMAIL FORMAT IS NOT VALID");

    }
}



if (!isset($password) || empty($password)) {
    $status["error"]++;

    array_push($status["msg"], "PASSWORD IS REQUIRED");


}




?>