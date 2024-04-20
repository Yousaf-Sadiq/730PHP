
<?php
// $db = mysqli_connect("localhost","qphonice_admin","adminerms1234","qphonice_muz");
$db = mysqli_connect("localhost","root","","qphonice_muz");


// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
//   die();
  exit();
  
}
// echo 'test555dbconfig';
?>