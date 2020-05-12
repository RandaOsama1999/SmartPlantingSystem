<?php
session_start();
include_once "LandController.php";
include_once "classDatabase.php";
if (!isset($_SESSION['email'])) {
    header('location: page-login.php');
}
if (isset($_GET['Logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header("location: page-login.php");
}
$landid=$_GET['landid'];
//print_r($_SESSION); 
LandController::AcceptRejectUpdateRequests($landid);
?>