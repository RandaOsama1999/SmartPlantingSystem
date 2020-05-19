<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once "classDatabase.php";
include_once "AlertMessages.php";
include_once "LandController.php";
include_once "client.php";

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

echo '<script type="text/javascript">';
echo 'window.location.href="client.php?landid='.$landid.'"';
echo '</script>';

// header('location: ViewAllLandsRequests.php');

?>