<?php

define("ROOTPATH","http://localhost/");
define("FOLDER","php_work_630/php_oops/std_management");
define("DOMAIN1",ROOTPATH.FOLDER);

// admin ROUTE 
require_once __DIR__."/admin.php";

// instructor ROUTE 
require_once __DIR__."/instructor.php";

// Student ROUTE
require_once __DIR__."/student.php";


?>