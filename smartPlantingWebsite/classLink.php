<?php
include_once "classDatabase.php";

class Link
{
    public  $ID;
    public  $PhysicalAddress;
    public  $FriendlyAddress;
    public  $pagename;
    public $Links_ID;
    public $Content;
    public $Type_ID;
    public $NameOfType;

    public function __construct() {
    }
    public static function headerPerm()
    {
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
        $i=0;
        $Result;
        $email = $_SESSION['email'];
        $sql = "SELECT * FROM user WHERE Email='$email' AND IsDeleted=0";
        $result = mysqli_query($mysql,$sql);
            while($row = $result->fetch_assoc()){
                if($row==true)
                {
                    $Name=$row["FirstName"];
                    $usertype_ID=$row['usertype_ID'];
                    $sqltwo = "SELECT * FROM usertypelinks WHERE userType_ID='$usertype_ID' AND IsDeleted=0";
                    $resulttwo = mysqli_query($mysql,$sqltwo);
                        while($rowtwo = $resulttwo->fetch_assoc()){
                            if($rowtwo==true)
                            {
                                $links_ID=$rowtwo['links_ID'];
        
                                $sql = "SELECT * FROM links WHERE ID='$links_ID' AND IsDeleted=0";
                                $DataSet = mysqli_query($mysql,$sql) or die(mysql_error());
                                
                                while ($row = mysqli_fetch_array($DataSet))
                                {
                                    $MyObject= new Link();
                                    $MyObject->ID=$row["ID"];
                                    $MyObject->PhysicalAddress=$row["PhysicalAddress"];
                                    $MyObject->FriendlyAddress=$row["FriendlyAddress"];
                                    $Result[$i]=$MyObject;
                                    $i++;
                                }
                            }
                        }
                    }
                }
		return $Result;
        //$conn->close();
    }
    
}
?>