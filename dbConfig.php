<?php 

$server = "127.0.0.1:3306";
$username = "root";
$password = "";
$database = "todo";

$con = mysqli_connect($server,$username,$password,$database);


return $con;

?>