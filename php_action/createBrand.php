<?php
//for the database connection and check if the user is log in
require_once 'core.php';
//create a array to pass the operation message to the json format
$valid['success'] = array('success'=> false,'message'=>array());
//check if the form is submitted and creates to variable to hold the brand name and status value and insert the information into the system

//if the form is submitted and create two variables to hold the information about brand name and brand status
if($_POST){
    $brandName = $_POST['brandName'];
    $brandStatus = $_POST['brandStatus'];

    $sql = "INSERT INTO brands (brand_name, brand_active, brand_status) VALUES ('$brandName','$brandStatus',1)";

    if ($connect->query($sql)===TRUE){
        $valid['success']=true;
        $valid['message']='Successfully Added';
    }else{
        $valid['success']=false;
        $valid['message']="Error while adding the brands";
    }

    $connect->close();

    echo json_encode($valid);
}// If $_POST