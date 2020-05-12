<?php

include_once "classDatabase.php";
include_once "classLandModel.php";

class notification
{
    public $ID;
    public $landownerID;
    public $contentID;
    public $landID;
    public $Email;
    public $content;
    public $location;
    public $NoData;

    public function __construct() {
        $a = func_get_args(); 
        $i = func_num_args(); 
        if (method_exists($this,$f='__construct'.$i)) { 
            call_user_func_array(array($this,$f),$a); 
        } 
    }

    public   function __construct1($id)
    {
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
        if ($id>0)
        {	
            $sql="select * from notification where ID=$id";
             
            $StudentDataSet = mysqli_query($mysql,$sql) or die(mysql_error());
            if ($row = mysqli_fetch_array($StudentDataSet))
            {
                $this->landownerID=$row["landowner_ID"];
                $this->contentID=$row["content_id"];
                $this->landID=$row["land_ID"];
                $this->ID=$id; 
            }
           
        }
    }


    public static function addnew(notification $Notifi)
    {
        date_default_timezone_set("Africa/Cairo");
        $today = date("Y-m-d H:i:s");
        $landownerID=$Notifi->landownerID;
        $landID=$Notifi->landID;
        $content=$Notifi->content;
        date_default_timezone_set("Africa/Cairo");
        $today = date("Y-m-d H:i:s");
        DB::add("content","content,DateTime","'$content','$today'");
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
        $sql = "SELECT ID FROM content  WHERE DateTime='$today'" ;
        $DataSet = mysqli_query($mysql,$sql) or die(mysql_error());
        $row = mysqli_fetch_array($DataSet);
        $MyObject= new notification();
        $MyObject->contentID=$row["ID"];
        DB::add("notification","landowner_ID,content_ID,land_ID,DateTime","'$landownerID',' $MyObject->contentID','$landID','$today'");

    }

    public static function ViewAllDropdownEamil()
    {
        
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
        $sql = "SELECT Email,ID FROM user WHERE usertype_ID='2'" ;
      
		$DataSet = mysqli_query($mysql,$sql) or die(mysql_error());
		$i=0;
        $Result;
		while ($row = mysqli_fetch_array($DataSet))
		{
            $MyObject= new notification();
            $MyObject->ID=$row["ID"];
            $MyObject->Email=$row["Email"];
            $Result[$i]=$MyObject;
			$i++;
        }
       
        return $Result; 
    }

   public static function viewLandLocation()
   {
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
        $sql = "SELECT notification.ID,user.Email,land.location ,content.content 
         FROM `notification` INNER JOIN user ON notification.landowner_ID= user.ID INNER JOIN land
         ON notification.land_ID=land.ID INNER JOIN content ON notification.content_ID=content.ID 
         AND notification.IsDeleted=0"  ;
        $DataSet = mysqli_query($mysql,$sql) or die(mysql_error());
		$i=0;
        $Result;
        if(mysqli_num_rows($DataSet)==0)
        {
           return null;
        }
        else
        {
            while ($row = mysqli_fetch_array($DataSet))
         {  
             $MyObject= new notification();
             $MyObject->ID=$row["ID"];
             $MyObject->Email=$row["Email"];
             $MyObject->location=$row["location"];
             $MyObject->content=$row["content"];
             $Result[$i]=$MyObject;
             $i++;
            
         }
         return $Result;
        }
   }   
}




?>