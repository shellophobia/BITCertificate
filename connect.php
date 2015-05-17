<?php
$server="localhost";
$user="root";
$pass="";
$database="certify";

$con=mysqli_connect($server, $user, $pass, $database);

if(!$con)
echo 'database error';
?>