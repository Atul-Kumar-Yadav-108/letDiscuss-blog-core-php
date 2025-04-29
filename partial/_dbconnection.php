<?php

$conn = mysqli_connect('localhost','root','','php_letdiscuss');

if(!$conn){
    die('DB Error! Under maintanence, sorry for inconvenience'.mysqli_connect_error());
}
// echo "Success";


?>