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
$rowid=$_GET['rowid'];
$landid=$_GET['landid'];
$item=$_GET['item'];
$new=$_GET['new'];
$ID=$_GET['ID'];
echo($landid);
echo($item);
echo($new);
if($item=="Location")
{
    $conn=DB::getInstance();
    $mysql=$conn->getConnection();
    $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
    date_default_timezone_set("Africa/Cairo");
    $today = date("Y-m-d H:i:s");

    DB::update("land","Location='$new', LastUpdatedDateTime='$today'","ID='$landid' AND IsDeleted=0");
    $sql="SELECT  LastUpdatedDateTime FROM land WHERE LastUpdatedDateTime='$today'";
    $DataSet = mysqli_query($mysql,$sql) or die(mysql_error());
    if(mysqli_num_rows($DataSet)!=0)
    {
        LandController::AcceptRejectUpdateRequests($landid);
        AlertMessages::AlertMeassage("success","Sucessfully Accepted");
    }
    else
    {
        AlertMessages::AlertMeassage("danger","Not Added");
    }
  
}
else if($item=="Plant Type")
{
    $conn=DB::getInstance();
    $mysql=$conn->getConnection();
    $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
    date_default_timezone_set("Africa/Cairo");
    $today = date("Y-m-d H:i:s");
    DB::update("land","plantType_ID='$new', LastUpdatedDateTime='$today'","ID='$landid' AND IsDeleted=0");
    $sql="SELECT  LastUpdatedDateTime FROM land WHERE LastUpdatedDateTime='$today'";
    $DataSet = mysqli_query($mysql,$sql) or die(mysql_error());
    if(mysqli_num_rows($DataSet)!=0)
    {
        LandController::AcceptRejectUpdateRequests($landid);
        AlertMessages::AlertMeassage("success","Sucessfully Accepted");
    }
    else
    {
        AlertMessages::AlertMeassage("danger","Not Added");
    }
}
else if($item=="Length")
{
    $conn=DB::getInstance();
    $mysql=$conn->getConnection();
    $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
    date_default_timezone_set("Africa/Cairo");
    $today = date("Y-m-d H:i:s");
    DB::update("land","greenhouse_L='$new', LastUpdatedDateTime='$today'","ID='$landid' AND IsDeleted=0");
    $sql="SELECT  LastUpdatedDateTime FROM land WHERE LastUpdatedDateTime='$today'";
    $DataSet = mysqli_query($mysql,$sql) or die(mysql_error());
    if(mysqli_num_rows($DataSet)!=0)
    {
        LandController::AcceptRejectUpdateRequests($landid);
        AlertMessages::AlertMeassage("success","Sucessfully Accepted");
    }
    else
    {
        AlertMessages::AlertMeassage("danger","Not Added");
    }
}
else if($item=="Width")
{
    $conn=DB::getInstance();
    $mysql=$conn->getConnection();
    $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
    date_default_timezone_set("Africa/Cairo");
    $today = date("Y-m-d H:i:s");
    DB::update("land","greenhouse_W='$new', LastUpdatedDateTime='$today'","ID='$landid' AND IsDeleted=0");
    $sql="SELECT  LastUpdatedDateTime FROM land WHERE LastUpdatedDateTime='$today'";
    $DataSet = mysqli_query($mysql,$sql) or die(mysql_error());
    if(mysqli_num_rows($DataSet)!=0)
    {
        LandController::AcceptRejectUpdateRequests($landid);
        AlertMessages::AlertMeassage("success","Sucessfully Accepted");
    }
    else
    {
        AlertMessages::AlertMeassage("danger","Not Added");
    }
}
else if($item=="Height")
{
    $conn=DB::getInstance();
    $mysql=$conn->getConnection();
    $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
    date_default_timezone_set("Africa/Cairo");
    $today = date("Y-m-d H:i:s");
    DB::update("land","greenhouse_H='$new', LastUpdatedDateTime='$today'","ID='$landid' AND IsDeleted=0");
    $sql="SELECT  LastUpdatedDateTime FROM land WHERE LastUpdatedDateTime='$today'";
    $DataSet = mysqli_query($mysql,$sql) or die(mysql_error());
    if(mysqli_num_rows($DataSet)!=0)
    {
        LandController::AcceptRejectUpdateRequests($landid);
        AlertMessages::AlertMeassage("success","Sucessfully Accepted");
    }
    else
    {
        AlertMessages::AlertMeassage("danger","Not Added");
    }
}
else if($item=="City")
{
    $conn=DB::getInstance();
    $mysql=$conn->getConnection();
    $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
    date_default_timezone_set("Africa/Cairo");
    $today = date("Y-m-d H:i:s");
    DB::update("land","address_ID='$new', LastUpdatedDateTime='$today'","ID='$landid' AND IsDeleted=0");
    $sql="SELECT  LastUpdatedDateTime FROM land WHERE LastUpdatedDateTime='$today'";
    $DataSet = mysqli_query($mysql,$sql) or die(mysql_error());
    if(mysqli_num_rows($DataSet)!=0)
    {
        LandController::AcceptRejectUpdateRequests($landid);
        AlertMessages::AlertMeassage("success","Sucessfully Accepted");
    }
    else
    {
        AlertMessages::AlertMeassage("danger","Not Added");
    }
}
 
DB::update("landupdaterequests","State_ID='2'","ID='$rowid' AND IsDeleted=0");
DB::update("land","updateRequest='0'","ID='$landid' AND IsDeleted=0");

 
// header('location: viewupdaterequests.php?landid='.$ID.'');
?>