<?php
require_once dirname(__DIR__) . "/../../app/database.php";
require_once dirname(__DIR__) . "/../../include/table_name.php";
use app\database\Mysqli as DB;
use app\database\helper as help;

$db = new DB;
$help = new help;

if (isset($_POST["inserts"]) && !empty($_POST["inserts"])) {


    $course_name = strtoupper($help->filterData($_POST["course_name"]));
    $syllabus = $help->filterData($_POST["syllabus"]);

    $status = [
        "error" => 0,
        "message" => []
    ];



    if (empty($course_name) || !isset($course_name)) {
        $status["error"]++;
        array_push($status["message"],"COURSE NAME IS REQUIRED");
    }

    
    if (empty($syllabus) || !isset($syllabus)) {
        $status["error"]++;
        array_push($status["message"],"SYLLABUS IS REQUIRED");
    }


    if ($status["error"] > 0) {
        echo json_encode($status);
    }
    else{

        $data=[
            "course_name"=>$course_name,
            "syllabus"=>$syllabus
        ];

        echo $db->insert(COURSE,$data);
    }

}


?>