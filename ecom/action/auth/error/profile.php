<?php 


if (!isset($user_name) || empty($user_name)) {
    $status["error"]++;

    array_push($status["msg"], "USERNAME IS REQUIRED");


} else {

    if (strlen($user_name) < 6) {
        $status["error"]++;

        array_push($status["msg"], "USERNAME Length  must be at least 6 characters.");
    }
}




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