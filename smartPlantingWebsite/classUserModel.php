<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
include_once "classDatabase.php";

class Users
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

    public $land_ID;
    public $plantType_ID;
    public $planttype;
    
    public function __construct() {
        $a = func_get_args(); 
        $i = func_num_args(); 
        if (method_exists($this,$f='__construct'.$i)) { 
            call_user_func_array(array($this,$f),$a); 
        } 
    }
    public function __construct1($id) {
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");

        if ($id !="")
		{	
			$sql="select * from user where ID=$id";
			$StudentDataSet = mysqli_query($mysql,$sql) or die(mysql_error());
			if ($row = mysqli_fetch_array($StudentDataSet))
			{
                $this->ID=$id;
				$this->FirstName=$row["FirstName"];
                $this->FamilyName=$row["LastName"];
                $this->DateOfBirth=$row["DateOfBirth"];
                $this->Mobile=$row["Mobile"];
                $this->Gender=$row["Gender"];
                $this->Email=$row["Email"];
                $this->Password=$row["Password"];
                $this->usertype_ID=$row["usertype_ID"];

                $sqltwo = "SELECT * FROM usertype WHERE ID=".$this->usertype_ID." AND IsDeleted=0";
                $resulttwo =mysqli_query($mysql,$sqltwo);
                if ($resulttwo->num_rows > 0) {
                    while($rowtwo = $resulttwo->fetch_assoc()) {
                        $this->usertype=$rowtwo["Type"];
                    }
                }
                $sqltw = "SELECT * FROM land WHERE IsDeleted=0 AND landowner_ID=$id AND state_ID='2'";
                $resulttw =mysqli_query($mysql,$sqltw);
                if ($resulttw->num_rows > 0) {
                    while($rowtw = $resulttw->fetch_assoc()) {
                        $this->land_ID=$rowtw["ID"];
                        $this->plantType_ID=$rowtw["plantType_ID"];
                        $sql = "SELECT * FROM plant WHERE ID=".$this->plantType_ID."";
                        $result = mysqli_query($mysql,$sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                                    
                                    $this->planttype=$row['plantName'];
                                }
                            } 
                        }
                    }
                }
			}
		
        
    }
    public function __construct2($id,$id2) {
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");

        if ($id !="")
		{	
			$sql="SELECT * from user where ID=$id2";
			$StudentDataSet = mysqli_query($mysql,$sql) or die(mysql_error());
			if ($row = mysqli_fetch_array($StudentDataSet))
			{
                $this->ID=$id;
				$this->FirstName=$row["FirstName"];
                $this->FamilyName=$row["LastName"];
                $this->DateOfBirth=$row["DateOfBirth"];
                $this->Mobile=$row["Mobile"];
                $this->Gender=$row["Gender"];
                $this->Email=$row["Email"];
                $this->Password=$row["Password"];
                $this->usertype_ID=$row["usertype_ID"];

                $sqltwo = "SELECT * FROM usertype WHERE ID=".$this->usertype_ID." AND IsDeleted=0";
                $resulttwo =mysqli_query($mysql,$sqltwo);
                if ($resulttwo->num_rows > 0) {
                    while($rowtwo = $resulttwo->fetch_assoc()) {
                        $this->usertype=$rowtwo["Type"];
                    }
                }
                
                }
                $sqltw = "SELECT * FROM land WHERE ID=$id";
                $resulttw =mysqli_query($mysql,$sqltw);
                if ($resulttw->num_rows > 0) {
                    while($rowtw = $resulttw->fetch_assoc()) {
                        $this->land_ID=$rowtw["ID"];
                        $this->plantType_ID=$rowtw["plantType_ID"];
                        $sql = "SELECT * FROM plant WHERE ID=".$this->plantType_ID."";
                        $result = mysqli_query($mysql,$sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                                    
                                    $this->planttype=$row['plantName'];
                                }
                            } 
                        }
                    }
			}
		
        
    }
    public static function Login ($email,$pass)
    {
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
        $passhash=md5($pass);
        $sql = "SELECT * FROM user WHERE Email='$email' AND Password='$passhash' AND IsDeleted=0";
        $result = mysqli_query($mysql,$sql);
        while($row = $result->fetch_assoc()){
            if($row==true)
            {
                $_SESSION['UserType_ID'] = $row['usertype_ID'];
                $_SESSION['email'] = $email;
                $_SESSION['id']=$row['ID'];
                echo '<script type="text/javascript">';
                echo 'window.location.href="updatemyself.php";';
                echo '</script>';
                        
            }
        }
    }
    public static function update(Users $user)
    {

        $id=$user->ID;
        $FirstName=$user->FirstName;
        $FamilyName=$user->FamilyName;
        $DateOfBirth=$user->DateOfBirth;
        $Mobile=$user->Mobile;
        $Gender=$user->Gender;

        date_default_timezone_set("Africa/Cairo");
        $today = date("Y-m-d H:i:s");
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
       DB::update("user","FirstName='$FirstName', LastName='$FamilyName', DateOfBirth='$DateOfBirth',Mobile='$Mobile', 
       Gender='$Gender',LastUpdatedDateTime='$today'","ID=$id AND IsDeleted=0");
       $sql1= "SELECT LastUpdatedDateTime FROM user WHERE LastUpdatedDateTime='$today'";
       $DataSet =mysqli_query($mysql,$sql1);
       
       if(mysqli_num_rows($DataSet)!=0)
       {
           return TRUE;
       }
       else
       {
           return FALSE;
       }
       echo '<script type="text/javascript">';
                echo 'window.location.href="updatemyself.php";';
                echo '</script>';
       
       // $conn->close();

    }
    public static function getdataTOupdate($id)
    {
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");

        $sql = "SELECT * FROM user WHERE ID=$id";
		
		$Result;
        $resulttwo = mysqli_query($mysql,$sql) or die($conn->error);
        while($rowtwo = $resulttwo->fetch_assoc()){
            if($rowtwo==true)
            {
                $MyObj= new Users($id);
                $Result=$MyObj;
            }
        }
        //echo "<script> alert('".$Result->FirstName."');</script>";
        return $Result;
        
       // $conn->close();

    }
    public static function add(Users $Users)
    {
       
       $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
        $FirstName=$Users->FirstName;
        $FamilyName=$Users->FamilyName;
        $DateOfBirth=$Users->DateOfBirth;
        $Mobile=$Users->Mobile;
        $Gender=$Users->Gender;
        $Email=$Users->Email;
        $Password=md5($Users->Password);
        $usertype_ID='1';
          
        date_default_timezone_set("Africa/Cairo");
        $today = date("Y-m-d H:i:s");
        //$aID=
        DB::add("user","usertype_ID,FirstName,LastName,DateOfBirth,Gender,Mobile,Email,Password,
        CreatedDateTime,LastUpdatedDateTime,IsDeleted","'$usertype_ID','$FirstName','$FamilyName','$DateOfBirth',
        '$Gender','$Mobile','$Email','$Password','$today','$today',0");
        //DB::addwithid("admin","user_ID","'$aID'");

        $sql="SELECT CreatedDateTime FROM user WHERE CreatedDateTime='$today'";
        $DataSet= mysqli_query($mysql,$sql);
        if(mysqli_num_rows($DataSet)!=0)
        {
            return TRUE;
        
        }
        else
        {
            return FALSE;
        }
    
        //$conn->close();
    }
  
    public static function SelectAll()
    {
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");

        $sql="SELECT * from user WHERE IsDeleted=0 AND usertype_ID=1 ";
		$StudentDataSet = mysqli_query($mysql,$sql) or die(mysql_error());
		
		$i=0;
		$Result;
		while ($row = mysqli_fetch_array($StudentDataSet))
		{
			$MyObj= new Users($row["ID"]);
			$Result[$i]=$MyObj;
			$i++;
		}
		return $Result;
       // $conn->close();
    }

    public static function SelectAllLandowners()
    {
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
        $sql="SELECT * from land WHERE IsDeleted=0 AND state_ID='2'";
		$StudentDataSet = mysqli_query($mysql,$sql) or die(mysql_error());
		
		$i=0;
        $Result;
        if(mysqli_num_rows($StudentDataSet)==0)
        {
            return null;
        }
        else
        {
            while ($row = mysqli_fetch_array($StudentDataSet))
            {
                $MyObj= new Users($row["ID"],$row["landowner_ID"]);
                $Result[$i]=$MyObj;
                $i++;
            }
            return $Result;
        // $conn->close();
        }
    }
    public static function Delete(Users $Users)
    {
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
        $Email=$Users->Email;
        DB::delete("user","Email='$Email'"); 

        $sql1= "SELECT IsDeleted FROM user WHERE IsDeleted='1'";
        $DataSet =mysqli_query($mysql,$sql1);
        if(mysqli_num_rows($DataSet)!=0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
        
        
        //$conn->close();
    }

}
?>