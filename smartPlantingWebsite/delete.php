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
//DB::delete("land","ID='$landid' AND IsDeleted=0");
        

$conn=DB::getInstance();
$mysql=$conn->getConnection();
$conn=mysqli_query($mysql,"SET NAMES 'utf8'");

$today = date("Y-m-d H:i:s");
DB::update("land","IsDeleted=1,LastUpdatedDateTime='$today'","ID='$landid'");
$sql1 = "SELECT LastUpdatedDateTime FROM land WHERE LastUpdatedDateTime='$today' ";
$DataSet = mysqli_query($mysql,$sql1);
if(mysqli_num_rows($DataSet)!=0)
{
    LandController::DeleteLandRequest();
    AlertMessages::AlertMeassage("success","Sucessfully Deleted");
   
}
else
{
    AlertMessages::AlertMeassage("danger","Somthing went wrong");
}
//header('location: DeleteLandRequest.php');
?>