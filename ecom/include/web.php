<?php 
// global route

define("ROOTPATH","http://localhost/");
define("ROOTPATH2",$_SERVER["DOCUMENT_ROOT"]);

define("folder","php_work_630/ecom");

// absolute url
define('absolute_upload', ROOTPATH.folder."/asset/images/upload");
// relative url
define('relative_upload', ROOTPATH2."/".folder."/asset/images/upload");



// routes
// for register.php 
define("REGISTER",ROOTPATH.folder."/register.php");
define("Dashboard",ROOTPATH.folder."/dashboard.php");
define("LOGOUT",ROOTPATH.folder."/logout.php");
define("HOME",ROOTPATH.folder."/home.php");
define("PROFILE",ROOTPATH.folder."/profile.php");

define("Register_submit",ROOTPATH.folder."/action/auth/form_action.php");
define("login_submit",ROOTPATH.folder."/action/auth/form_action.php");
define("Profile_submit",ROOTPATH.folder."/action/auth/form_action.php");

// for auth form_action.php


// for login
define("LOGIN",ROOTPATH.folder."/login.php");
?>