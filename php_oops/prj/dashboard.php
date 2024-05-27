<?php 
require_once dirname(__FILE__)."/layout/user/header.php";

use app\database\Mysqli as DB;


$obj = new DB;
//  keys table columns   ]=> values database values
$abc=[
    "email"=>"XYZ@gmail.com",
    "password"=>1234,
    "ptoken"=>1234
];

echo $obj->insert("users",$abc);
?>



<?php 
require_once dirname(__FILE__)."/layout/user/footer.php";

?>