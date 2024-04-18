<?php

define("SERVER","localhost");
define("USERNAME","root");
define("PASSWORD","");
define("DB","ecom2");


$conn = new mysqli(SERVER, USERNAME, PASSWORD, DB);

if ($conn) {

}
else{
    echo $conn->connect_error;
}

?>