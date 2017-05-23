<?php
// Start the session include the database connection and check if the users are note log in by directing to the log in page
session_start();

require_once 'db_connect.php';

//echo $_SESSION['userId'];

if(!$_SESSION['user_Id']){
    header('location: http://localhost:8012/stock_system/index.php');
}

?>