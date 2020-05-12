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

$landid=$_GET['landid'];
$today = date("Y-m-d H:i:s");
$conn=DB::getInstance();
$mysql=$conn->getConnection();
$conn=mysqli_query($mysql,"SET NAMES 'utf8'");
//DB::delete("land","ID='$landid' AND deleteRequest='1' AND IsDeleted=0");
DB::update("land","IsDeleted='1',LastUpdatedDateTime=' $today'","ID='$landid'");
$sql1 = "SELECT LastUpdatedDateTime FROM land WHERE LastUpdatedDateTime='$today' AND IsDeleted=1";
$DataSet = mysqli_query($mysql,$sql1);
if(mysqli_num_rows($DataSet)!=0)
{
     LandController::AcceptRejectCureentLand();
     AlertMessages::AlertMeassage("success","Sucessfully Deleted");
}
else
{
    LandController::AcceptRejectCureentLand();
    AlertMessages::AlertMeassage("danger","Something went wrong");
}
//header('location: ViewCurrentLandsRequests.php');


?>