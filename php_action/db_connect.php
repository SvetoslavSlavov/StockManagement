<?php


$localhost = "127.0.0.1";
$username = "root";
$pasword = "";
$dbname  = "stock";

//create db connection
$connect = new mysqli($localhost,$username,$pasword,$dbname);
//check connection
if ($connect->connect_error){
    die("Connection Failed :" . $connect->connect_error);
}else{
    //echo "Successfully connected";
}
?>