<?php

//remove all session variables
require_once 'php_action/core.php';

//destroy the session
session_destroy();

header('location:http://localhost:8012/stock_system/index.php');

?>