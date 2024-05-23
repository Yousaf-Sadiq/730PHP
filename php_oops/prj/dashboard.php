<?php 
require_once dirname(__FILE__)."/layout/user/header.php";

use app\database\Mysqli as DB;


$obj = new DB;

$abc=[
    "email"=>"XYZ@gmail.com",
    "password"=>1234,
    "ptoken"=>1234
];

$obj->insert("users",$abc);
?>



<?php 
require_once dirname(__FILE__)."/layout/user/footer.php";

?>