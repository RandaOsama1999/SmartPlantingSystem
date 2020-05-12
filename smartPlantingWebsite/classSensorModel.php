<?php

include_once "classDatabase.php";
include_once "classLandModel.php";

class sensor
{
    public $ID;
    public $Type;

    public function __construct() {
        $a = func_get_args(); 
        $i = func_num_args(); 
        if (method_exists($this,$f='__construct'.$i)) { 
            call_user_func_array(array($this,$f),$a); 
        } 
    }

    public  function __construct1($id)
    {
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
        if ($id>0)
        {	
            $sql="select * from sensor where ID=$id";
             
            $StudentDataSet = mysqli_query($mysql,$sql) or die(mysql_error());
            if ($row = mysqli_fetch_array($StudentDataSet))
            {
                $this->Type=$row["Type"];
                $this->ID=$id; 
            }
           
        }
    }
    public static function addnew(Sensor $sensor)
    {
        date_default_timezone_set("Africa/Cairo");
        $today = date("Y-m-d H:i:s");
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
        $Type=$sensor->Type;
        $sql3="SELECT Type FROM sensors WHERE Type='$Type' ";
        $DataSet = mysqli_query($mysql,$sql3) or die(mysql_error());

        if(mysqli_num_rows($DataSet)==1)
        {
            return NULL;
        }
        else
        {
            DB::add("sensors","Type,CreatedDateTime,IsDeleted,LastUpdatedDateTime","'$Type','$today',0,' $today'");
            $conn=DB::getInstance();
            $mysql=$conn->getConnection();
            $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
            $sql="SELECT CreatedDateTime FROM sensors WHERE CreatedDateTime='$today' ";
            $DataSet = mysqli_query($mysql,$sql) or die(mysql_error());
            if(mysqli_num_rows($DataSet)==1)
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }

        

    }
    public static function deletesensor(Sensor $sensorID)
    {
        $sensorID=$_GET['sensorid'];
        $today = date("Y-m-d H:i:s");
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
        //DB::delete2("sensors","ID='$sensorID'");
        DB::update("sensors","IsDeleted='1',LastUpdatedDateTime='$today'","ID='$sensorID'");

        $sql="SELECT LastUpdatedDateTime FROM  sensors WHERE LastUpdatedDateTime='$today'";
        $DataSet = mysqli_query($mysql,$sql) or die(mysql_error());
        if(mysqli_num_rows($DataSet)!=0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
      
    }
    public static function viewsensors()
    {
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
        $sql="SELECT * FROM sensors";
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
                $MyObject= new sensor();
                $MyObject->ID=$row["ID"];
                $MyObject->Type=$row["Type"];
                $Result[$i]=$MyObject;
                $i++;
            }
            return $Result; 
         }
    }

}
?>