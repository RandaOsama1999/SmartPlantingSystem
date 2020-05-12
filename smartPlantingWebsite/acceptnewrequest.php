<?php
session_start();
include_once "classDatabase.php";
include_once "AlertMessages.php";
include_once "LandController.php";

if (!isset($_SESSION['email'])) {
    header('location: page-login.php');
}
if (isset($_GET['Logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header("location: page-login.php");
}

$conn=DB::getInstance();
$mysql=$conn->getConnection();
$conn=mysqli_query($mysql,"SET NAMES 'utf8'");
$landid=$_GET['landid'];
$today = date("Y-m-d H:i:s");
DB::update("land","state_ID='2', LastUpdatedDateTime='$today'","ID='$landid' AND IsDeleted=0");

$sql1 = "SELECT LastUpdatedDateTime FROM land WHERE LastUpdatedDateTime='$today' ";
$DataSet = mysqli_query($mysql,$sql1);
if(mysqli_num_rows($DataSet)!=0)
{
    LandController::AcceptRejectLandRequests();
    AlertMessages::AlertMeassage("success","Sucessfully Accepted");
   
}
else
{
    LandController::AcceptRejectLandRequests();
    AlertMessages::AlertMeassage("danger","Not Accepted");
}
//header('location: ViewAllLandsRequests.php');
?>