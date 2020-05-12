<?php
session_start();
include_once "classDatabase.php";
include_once "AlertMessages.php";
include_once "SensorController.php";
include_once "classSensorModel.php";
include_once 'classSensorView.php';

if (!isset($_SESSION['email'])) {
    header('location: page-login.php');
}
if (isset($_GET['Logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header("location: page-login.php");
}

$sensorID=$_GET['sensorid'];

$data1=new sensor();
$data1->ID= $sensorID;
$Result= sensor::deletesensor($data1);
if($Result==TRUE)
{
    
    SensorController::Delete();
    AlertMessages::AlertMeassage("success","Sucessfully Deleted");
   
}
else
{
    AlertMessages::AlertMeassage("danger","Somthing went wrong");
}

?>