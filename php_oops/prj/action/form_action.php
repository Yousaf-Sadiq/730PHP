<?php
require_once dirname(__DIR__) . "/app/database.php";

use app\database\Mysqli as DB;
use app\database\helper as help;


$db = new DB;
$help = new help;

if (isset($_POST["insert"]) && !empty($_POST["insert"])) {


    $status = [
        "error" => 0,
        "msg" => []
    ];
    // echo json_encode(["ok"]);
    $email = $help->filterData($_POST["Email"]);
    $password = $help->filterData($_POST["pswd"]);


    if (!isset($email) || empty($email)) {

        $status["error"]++;
        array_push($status["msg"], "EMAIL IS REQUIRED");
    } else {

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $status["error"]++;
            array_push($status["msg"], "EMAIL FORMAT INVALID");
        }
    }



    if (!isset($password) || empty($password)) {

        $status["error"]++;
        array_push($status["msg"], "PASSWORD IS REQUIRED");
    }




    if ($status["error"] > 0) {
        echo json_encode($status);

    }

    // echo json_encode([$email]);


}
?>