<?php
session_start();
include_once "userController.php";
include_once "classDatabase.php";
include_once "LEDLightController.php";
if (!isset($_SESSION['email'])) {
    header('location: page-login.php');
}
if (isset($_GET['Logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header("location: page-login.php");
}
LedColorController::viewLedColors();
?>