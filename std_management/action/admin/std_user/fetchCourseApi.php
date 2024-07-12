<?php
require_once dirname(__DIR__) . "/../../app/database.php";
require_once dirname(__DIR__) . "/../../include/table_name.php";
use app\database\Mysqli as DB;
use app\database\helper as help;

$db = new DB;
$help = new help;

$db->select(COURSE, "*");

$row = $db->Getresult();

$id = $_POST["course_id"];


$html = [];

foreach ($row as $value) {

    if ($value["course_id"] == $id) {


        array_push($html, "<option selected  value='{$value["course_id"]}'> {$value["course_name"]} </option>");
   
   
    } 
    
    else {
        
        
        
        array_push($html, "<option   value='{$value["course_id"]}'> {$value["course_name"]} </option>");



    }
}

echo json_encode($html);

?>