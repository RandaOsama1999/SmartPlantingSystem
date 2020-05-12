<?php
session_start();
include_once "classDatabase.php";
include_once "LandController.php";
include_once "AlertMessages.php";


if (!isset($_SESSION['email'])) {
    header('location: page-login.php');
}
if (isset($_GET['Logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header("location: page-login.php");
}

$landid=$_GET['landid'];

$RowID=$_GET['RowID'];
$conn=DB::getInstance();
$mysql=$conn->getConnection();
$conn=mysqli_query($mysql,"SET NAMES 'utf8'");
$today = date("Y-m-d H:i:s");

DB::update("landupdaterequests","state_ID='3',LastUpdatedDateTime='$today'","ID='$RowID' AND IsDeleted=0");

$sql1 = "SELECT LastUpdatedDateTime FROM landupdaterequests WHERE LastUpdatedDateTime='$today' ";
$DataSet = mysqli_query($mysql,$sql1);
if(mysqli_num_rows($DataSet)!=0)
{
    LandController::AcceptRejectUpdateRequests($landid);
    AlertMessages::AlertMeassage("success","Sucessfully Rejected");
}
else
{
    LandController::AcceptRejectUpdateRequests($landid);
    AlertMessages::AlertMeassage("danger","Somthing went wrong");
}

//header('location: viewupdaterequests.php?landid='.$landid.'');
?>