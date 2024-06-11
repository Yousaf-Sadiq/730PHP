<?php
require_once dirname(__DIR__) . "/app/database.php";

use app\database\Mysqli as DB;
use app\database\helper as help;


$db = new DB;
$help = new help;

if (isset($_POST["insert"]) && !empty($_POST["insert"])) {


    $status = [
        "error" => 0,
        "message" => []
    ];
    // echo json_encode(["ok"]);
    $email = $help->filterData($_POST["Email"]);
    $password = $help->filterData($_POST["pswd"]);


    if (!isset($email) || empty($email)) {

        $status["error"]++;
        array_push($status["message"], "EMAIL IS REQUIRED");
    } else {

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $status["error"]++;
            array_push($status["message"], "EMAIL FORMAT INVALID");
        }
    }



    if (!isset($password) || empty($password)) {

        $status["error"]++;
        array_push($status["message"], "PASSWORD IS REQUIRED");
    }


    $check = $db->Mysql("SELECT * FROM `users` WHERE `email`='{$email}'", true);


    if ($check) {
        $status["error"]++;
        array_push($status["message"], "Email already Exist");
    }

    if ($status["error"] > 0) {
        echo json_encode($status);

    } else {

        // insert 

        $data = [
            "email" => $email,
            "password" => password_hash($password, PASSWORD_BCRYPT),
            "ptoken" => base64_encode($password),
            "role_id" => 3
        ];


        echo $db->insert("users", $data);
    }
    // echo json_encode([$email]);


}



if (isset($_POST["update"]) && !empty($_POST["update"])) {


    $status = [
        "error" => 0,
        "message" => []
    ];
    // echo json_encode(["ok"]);
    $email = $help->filterData($_POST["Email"]);
    $user_name = $help->filterData($_POST["user_name"]);
    $user_id = $help->filterData($_POST["_token"]);


    if (!isset($email) || empty($email)) {

        $status["error"]++;
        array_push($status["message"], "EMAIL IS REQUIRED");
    } else {

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $status["error"]++;
            array_push($status["message"], "EMAIL FORMAT INVALID");
        }
    }



    if (!isset($user_name) || empty($user_name)) {

        $status["error"]++;
        array_push($status["message"], "USER NAME IS REQUIRED");
    }


    $check = $db->Mysql("SELECT * FROM `users` WHERE `email`='{$email}' AND `user_id` <> {$user_id}", true);


    if ($check) {
        $status["error"]++;
        array_push($status["message"], "Email already Exist ");
    }

    if ($status["error"] > 0) {
        echo json_encode($status);

    } else {

        // update 

        $data = [
            "email" => $email,
            "user_name" => $user_name,

        ];


        echo $db->update("users", $data, "`user_id`='{$user_id}'");
    }
    // echo json_encode([$email]);


}




if (isset($_POST["DELETES"]) && !empty($_POST["DELETES"])) {


    $status = [
        "error" => 0,
        "msg" => []
    ];
    // echo json_encode(["ok"]);

    $user_id = $help->filterData($_POST["_token"]);



    if (!isset($user_id) || empty($user_id)) {

        $status["error"]++;
        array_push($status["msg"], "TOKEN IS REQUIRED");
    }


    $check_id = "SELECT * FROM `users` WHERE `user_id`='{$user_id}'";

    $exe_id = $db->Mysql($check_id, true);

    if ($exe_id) {

    } else {
        $status["error"]++;
        array_push($status["msg"], "TOKEN IS INVALID");
    }


    if ($status["error"] > 0) {
        echo json_encode($status);

    } else {

        // DELETE


        echo $db->delete("users", "`user_id`='{$user_id}'");
    }
    // echo json_encode([$email]);


}
?>