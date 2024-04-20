<?php

session_start();

$_SESSION['user_login']='';
$_SESSION['login_userid'] = '';

session_destroy();
session_unset();


?>
<script>
    window.location.href="login.php";
</script>