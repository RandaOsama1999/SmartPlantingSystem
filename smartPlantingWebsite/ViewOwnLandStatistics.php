<?php
session_start();
include_once "LandownerController.php";
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
$strategy=new Strategy("LOC");
$strategy->showReport($landid)
//LandownerController::viewReport($landid);
?>