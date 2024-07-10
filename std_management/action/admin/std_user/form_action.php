<?php
require_once dirname(__DIR__) . "/../../app/database.php";
require_once dirname(__DIR__) . "/../../include/table_name.php";
use app\database\Mysqli as DB;
use app\database\helper as help;

$db = new DB;
$help = new help;

if (isset($_POST["inserts"]) && !empty($_POST["inserts"])) {


    $user_name = strtoupper($help->filterData($_POST["user_name"]));
    $email = $help->filterData($_POST["email"]);
    $pswd = $help->filterData($_POST["pswd"]);
    $course_id = $help->filterData($_POST["course_name"]);

    $status = [
        "error" => 0,
        "message" => []
    ];



    if (empty($course_id) || !isset($course_id)) {
        $status["error"]++;
        array_push($status["message"], "COURSE NAME IS REQUIRED");
    }

    if (empty($pswd) || !isset($pswd)) {
        $status["error"]++;
        array_push($status["message"], "PASSWORD IS REQUIRED");
    }

    if (empty($user_name) || !isset($user_name)) {
        $status["error"]++;
        array_push($status["message"], "USER NAME IS REQUIRED");
    }


    if (empty($email) || !isset($email)) {
        $status["error"]++;
        array_push($status["message"], "EMAIl IS REQUIRED");
    } else {

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $status["error"]++;
            array_push($status["message"], "EMAIl FORMAT INVALID");
        }
    }


    $check_email = "SELECT * FROM `" . STD . "` WHERE `email`= '{$email}'";
    $chk = $db->Mysql($check_email, true);

    if ($chk) {
        $status["error"]++;
        array_push($status["message"], "STUDENT EMAIL ALREADY EXIST");
    }


    if ($status["error"] > 0) {
        echo json_encode($status);
    } else {

        $hash = password_hash($pswd, PASSWORD_BCRYPT);
        $encrypt = base64_encode($pswd);
        $data = [
            "user_name" => $user_name,
            "email" => $email,
            "password" => $hash,
            "ptoken" => $encrypt
        ];


        echo $db->insert(STD, $data);


        $std_insert_id = $db->Get_insertID();

        $data_c = [
            "course_id" => $course_id,
            "std_id" => $std_insert_id,

        ];

        $db->insert(STD_COURSE, $data_c);


    }

}


if (isset($_POST["UPDATES"]) && !empty($_POST["UPDATES"])) {


    $course_name = strtoupper($help->filterData($_POST["course_name"]));
    $syllabus = $help->filterData($_POST["syllabus"]);
    $course_id = $help->filterData($_POST["_token_edit"]);

    $status = [
        "error" => 0,
        "msg" => []
    ];



    if (empty($course_name) || !isset($course_name)) {
        $status["error"]++;
        array_push($status["msg"], "COURSE NAME IS REQUIRED");
    }


    if (empty($syllabus) || !isset($syllabus)) {
        $status["error"]++;
        array_push($status["msg"], "SYLLABUS IS REQUIRED");
    }


    if ($status["error"] > 0) {
        echo json_encode($status);
    } else {

        $data = [
            "course_name" => $course_name,
            "syllabus" => $syllabus
        ];

        echo $db->update(COURSE, $data, " `course_id` = '{$course_id}' ");
    }

}


?>