<?php
require_once dirname(__DIR__) . "/app/database.php";

use app\database\Mysqli as DB;
use app\database\helper as help;


$db = new DB;
$help = new help;

if (isset($_POST["insert"]) && !empty($_POST["insert"])) {

    // echo json_encode(["ok"]);
    $email = $help->filterData($_POST["Email"]);
    $password = $help->filterData($_POST["pswd"]);


    // echo json_encode([$email]);


}
?>