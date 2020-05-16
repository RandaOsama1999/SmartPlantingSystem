<?php
session_start();
include_once "LandController.php";
include_once "classDatabase.php";
include_once 'Strategy.php';
if (!isset($_SESSION['email'])) {
    header('location: page-login.php');
}
if (isset($_GET['Logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header("location: page-login.php");
}
$landid=$_GET['landid'];
//$Test="1";
$strategy=new Strategy("LC");
$strategy->showReport($landid)
//LandController::viewReport($landid);
?>