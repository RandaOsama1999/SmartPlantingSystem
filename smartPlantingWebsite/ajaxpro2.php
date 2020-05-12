<?php
include_once "classDatabase.php";
$conn=DB::getInstance();
$mysql=$conn->getConnection();
$conn=mysqli_query($mysql,"SET NAMES 'utf8'");

 if($_POST['city_id']=="1")
 {
   $sql = "SELECT * FROM address WHERE Parent_ID !='0'"; 
   
$result = mysqli_query($mysql,$sql);

while($row = $result->fetch_assoc()){
 if($row==true)
 {
   echo '<option value="'.$row['ID'].'">'.$row['Name'].'</option>';
 //echo '<option value="'.$row['ID'].'">'.$row['plantName'].'</option>';
 }
}
 }
 else if($_POST['city_id']=="6")
 {

   $sql2 = "SELECT * FROM plant "; 
   
   $result2 = mysqli_query($mysql,$sql2);

   while($row = $result2->fetch_assoc()){
    if($row==true)
    {
      
    echo '<option value="'.$row['ID'].'">'.$row['plantName'].'</option>';
    }
   }
 }






?>