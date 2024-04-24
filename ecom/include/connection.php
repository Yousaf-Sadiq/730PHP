<?php 

define("HOSTNAME","localhost"); 
define("USERNAME","root"); 
define("PASSWORD",""); 
define("DB","ecom2"); 


$conn= new mysqli(HOSTNAME, USERNAME, PASSWORD, DB);

if ($conn) {
    // echo "established";
}
else{
    echo $conn->error;
}


?>