<?php

define("ROOTPATH","http://localhost/");
define("FOLDER","php_work_630/php_oops/std_management");
define("DOMAIN1",ROOTPATH.FOLDER);

// admin  ROUTE 


// COURSE Route 


define("admin_Course_action",DOMAIN1."/action/admin/course/form_action.php");
define("add_admin_Course",DOMAIN1."/admin/course/add_course.php");
define("all_admin_Course",DOMAIN1."/admin/course/all-course.php");

// STUDENT MANAGEMENT ROUTE BY ADMIN

define("admin_STD_action",DOMAIN1."/action/admin/std-user/form_action.php");
define("add_std",DOMAIN1."/admin/std-user/add-student.php");

?>