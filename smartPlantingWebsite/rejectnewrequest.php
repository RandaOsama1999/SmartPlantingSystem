<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once "classDatabase.php";
include_once "LandController.php";
include_once "AlertMessages.php";
include_once "client.php";

if (!isset($_SESSION['email'])) {
    header('location: page-login.php');
}
if (isset($_GET['Logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header("location: page-login.php");
}



$landid=$_GET['landid'];
DB::update("land","state_ID='3',LastUpdatedDateTime='$today'","ID='$landid' AND IsDeleted=0");

//$_SESSION['landid']=$landid;
// $_SESSION['status']="rejected";
echo '<script type="text/javascript">';
echo 'window.location.href="client.php?landid='.$landid.'"';
echo '</script>';
?>