<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
include_once "classDatabase.php";
include_once "Statistics_Interface.php";

include_once "classLandModel.php";
class Landowner implements Statistics
{

    public  $ID;
    public  $FirstName;
    public  $FamilyName;
    public  $DateOfBirth;
    public  $Mobile;
    public  $Gender;
    public  $Email;
    public  $Password;
    public  $usertype_ID;
    
    public function __construct() {
        $a = func_get_args(); 
        $i = func_num_args(); 
        if (method_exists($this,$f='__construct'.$i)) { 
            call_user_func_array(array($this,$f),$a); 
        } 
    }
    public static function SignUp($fname,$lname,$date,$gender,$mobile,$email,$pass1)
    {
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
        $passhash=md5($pass1);
        date_default_timezone_set("Africa/Cairo");
        $today = date("Y-m-d H:i:s");
        $sql="SELECT Email FROM user WHERE Email='$email'";
        $DataSet1 = mysqli_query($mysql,$sql);
        if(mysqli_num_rows($DataSet1)!=0)
        {
           return NULL;
        }
        else 
        {
            DB::add("user","usertype_ID,FirstName,LastName,DateOfBirth,Gender,Mobile,Email,Password,CreatedDateTime,LastUpdatedDateTime,IsDeleted",
            "'2','$fname','$lname','$date','$gender','$mobile','$email','$passhash','$today','$today',0");
            $sql = "SELECT CreatedDateTime FROM user WHERE CreatedDateTime='$today' ";
            $DataSet = mysqli_query($mysql,$sql);
            if(mysqli_num_rows($DataSet)!=0)
            {
              return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
    }
    public static function viewReport($landid){
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");

        $sql = "SELECT * FROM land WHERE IsDeleted=0 AND ID=$landid";
		$DataSet = mysqli_query($mysql,$sql) or die(mysql_error());
		
        $i=0;
        $size=0;
        $Result;
        if(mysqli_num_rows($DataSet)==0)
        {
           return null;
        }
        else
        {
            while ($row = mysqli_fetch_array($DataSet))
            {
                if($row==true)
                {
                $MyObj= new Land($landid,$size);
                $Result[$i]=$MyObj;
                }
            }
            return $Result;
        }

    }
}
?>