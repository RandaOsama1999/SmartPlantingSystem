<?php
include_once "classDatabase.php";

class LedColors
{
    public $ID;
    public $color;
    public $CreatedDateTime;

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
        if ($id >0)
        {	
            $sql="select * from ledlights where ID=$id";
             
            $StudentDataSet = mysqli_query($mysql,$sql) or die(mysql_error());
            if ($row = mysqli_fetch_array($StudentDataSet))
            {
                $this->Name=$row["color"];
                $this->ID=$id; 
            }
        }
        
    }
    public static function ViewAllColors()
    {
       
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");

        $sql = "SELECT * FROM ledlights";
		$LinksDataSet = mysqli_query($mysql,$sql) or die(mysql_error());
		
		$i=0;
        $Result;
		while ($row = mysqli_fetch_array($LinksDataSet))
		{
            $MyObj= new LedColors($row["ID"]);
            $MyObj->color=$row["color"];
			$Result[$i]=$MyObj;
			$i++;
		}
		return $Result;
        //$conn->close();

    }
    public static function create(LedColors $ledcolor)
    {
        $color=$ledcolor->color;
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
        //date_default_timezone_set("Africa/Cairo");
        $today = date("Y-m-d H:i:s");
        $sql1 = "SELECT color FROM ledlights WHERE color='$color'";
        $DataSet1 = mysqli_query($mysql,$sql1);
        if(mysqli_num_rows($DataSet1)==0)
        {
            DB::add("ledlights","color","'$color'");
            return TRUE;
        }
        else 
        {
            return NULL;
        }
       
    }
    public static function plantled($Stage_ID,$LED_ID,$Plant_ID)
    {
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
        //date_default_timezone_set("Africa/Cairo");
        $today = date("Y-m-d H:i:s");
        $sql2="SELECT Plant_ID,LED_ID FROM  plantneededled WHERE Plant_ID='$Plant_ID' AND LED_ID='$LED_ID'";
        $DataSet = mysqli_query($mysql,$sql2);
        if(mysqli_num_rows($DataSet)==0)
        {
            DB::add("plantneededled","Stage_ID,Plant_ID,LED_ID","'$Stage_ID','$Plant_ID','$LED_ID'");
            return TRUE;
        }
        else 
        {
            return NULL;
        }
        
    }
    public static function delete(LedColors $ledcolor)
    {
        $id=$ledcolor->ID;
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
        $today = date("Y-m-d H:i:s");
        // DB::delete2("ledlights","ID='$id'");
        DB::delete2("ledlights","ID='$id'");
		return NULL;
    }
    public static function ViewDropdown()
    {
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
        $sql = "SELECT * FROM ledlights";
		$DataSet = mysqli_query($mysql,$sql);
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
                $MyObject= new LedColors();
                $MyObject->ID=$row["ID"];
                $MyObject->Type=$row["color"];
                $Result[$i]=$MyObject;
                $i++;
            }
            return $Result;
    }
        //$conn->close();
    }
    public static function ViewLedColorDropdown()
    {
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
        $sql = "SELECT * FROM ledlights";
		$DataSet = mysqli_query($mysql,$sql) ;
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
            $MyObject= new LedColors();
            $MyObject->ID=$row["ID"];
            $MyObject->color=$row["color"];
			$Result[$i]=$MyObject;
			$i++;
		}
        return $Result;
    }
        //$conn->close();
    }
    public static function viewplantled()
    {
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
        $sql = "SELECT * FROM ledlights";
		$DataSet = mysqli_query($mysql,$sql) ;
		$i=0;
		$Result;
		while ($row = mysqli_fetch_array($DataSet))
		{
            $MyObject= new LedColors();
            $MyObject->ID=$row["ID"];
            $MyObject->color=$row["color"];
			$Result[$i]=$MyObject;
			$i++;
		}
		return $Result;
        //$conn->close();
    }
}