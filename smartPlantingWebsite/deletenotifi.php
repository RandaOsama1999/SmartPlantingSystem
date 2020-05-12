<?php
include_once "classDatabase.php";

$notificationID=$_GET['notificationid'];
DB::update("notification","IsDeleted='1'","ID='$notificationID'");
   
header('location: DeleteNotification.php');
?>