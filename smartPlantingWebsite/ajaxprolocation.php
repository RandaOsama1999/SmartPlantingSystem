<?php
include_once "classDatabase.php";
$conn=DB::getInstance();
$mysql=$conn->getConnection();
$conn=mysqli_query($mysql,"SET NAMES 'utf8'");

$sql = "SELECT location,ID FROM land WHERE landowner_ID =".$_POST["owner_id"].""; 

$result = mysqli_query($mysql,$sql);

   while($row = $result->fetch_assoc()){
    if($row==true)
    {
    echo '<option value="'.$row['ID'].'">'.$row['location'].'</option>';
    }
   }


?>