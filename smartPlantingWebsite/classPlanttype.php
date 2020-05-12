<?php
include_once "classDatabase.php";
class Planttype
{
    public  $ID;
    public  $plantName;
    public  $plant_ID;
    public  $HourToBeOpened;
    public  $HourToBeClosed;
    public  $Temperature;

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
            $sql="select * from plant where ID='$id'";
             
            $StudentDataSet = mysqli_query($mysql,$sql) or die(mysql_error());
            if ($row = mysqli_fetch_array($StudentDataSet))
            {
                $this->plantName=$row["plantName"];
                $this->ID=$id;

            }

            $sql1="select * from timer where plant_ID=$id";
            $StudentDataSet1 = mysqli_query($mysql,$sql1) or die(mysql_error());
            if ($row = mysqli_fetch_array($StudentDataSet1))
            {
                $this->HourToBeOpened=$row["HourTobeOpened"];
                $this->HourToBeClosed=$row["HourTobeClosed"];
            }

            $sql2="select * from planttemperature where plant_ID=$id";
            $StudentDataSet2 = mysqli_query($mysql,$sql2) or die(mysql_error());
            if ($row = mysqli_fetch_array($StudentDataSet2))
            {
                $this->Temperature=$row["Temperature"];
            }
        }
        
    }
    public static function getdataTOupdate($id)
    {
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");

        $sql = "SELECT * FROM plant WHERE ID=$id";
		
		$Result;
        $resulttwo = mysqli_query($mysql,$sql) or die($conn->error);
        while($rowtwo = $resulttwo->fetch_assoc()){
            if($rowtwo==true)
            {
                $MyObj= new Planttype($id);
                $Result=$MyObj;
            }
        }
        //echo "<script> alert('".$Result->FirstName."');</script>";
		return $Result;
       // $conn->close();

    }
  public static function SelectAll()
    {
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
        $sql="select * from plant";
      
        $StudentDataSet = mysqli_query($mysql,$sql) or die(mysql_error());
        $i=0;
        $Result;
        while ($row = mysqli_fetch_array($StudentDataSet))
        {
          $MyObj= new Planttype($row["ID"]);
          $Result[$i]=$MyObj;
            $i++;
        }
        return $Result;    
    }
    public static function update($id,$temp, $houropen, $hourclosed)
    {
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
        
        date_default_timezone_set("Africa/Cairo");
        $today = date("Y-m-d H:i:s");
        DB::update("timer","HourTobeOpened='$houropen', HourTobeClosed='$hourclosed'","plant_ID='$id'");
        DB::update("planttemperature","Temperature='$temp'","plant_ID='$id'");

    //    echo '<script type="text/javascript">';
    //             echo 'window.location.href="ChoosePlantToViewStatistcsByAdmin.php";';
    //             echo '</script>';
        $sql="SELECT plant_ID FROM timer WHERE ID='$id' ";
        $DataSet= mysqli_query($mysql,$sql);
        if(mysqli_num_rows($DataSet)!=0)
        {
            return TRUE;
        
        }
        else
        {
            return FALSE;
        }

        
    }
  
    public static function add(Planttype $Plant)
    {
    
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
        $Name=$Plant->plantName;
        $HourToBeOpened=$Plant->HourToBeOpened;
        $HourToBeClosed=$Plant->HourToBeClosed;
        $Temperature=$Plant->Temperature;
        
        $pID=DB::addwithid("plant","plantName","'$Name'");
        DB::add("timer","plant_ID,HourTobeOpened,HourTobeClosed","'$pID','$HourToBeOpened','$HourToBeClosed'");
        DB::add("planttemperature","Temperature,plant_ID","'$Temperature','$pID'");
        

        $sql="SELECT ID FROM plant WHERE ID='$pID' ";
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
  
  
    public static function Delete(Planttype $Plant)
    {
        $ID=$Plant->ID;
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
        DB::delete2("timer","plant_ID='$ID'");
        DB::delete2("planttemperature","plant_ID='$ID'");  
        DB::delete2("plant","ID='$ID'"); 
        DB::delete2("plantneededled","Plant_ID='$ID'");   
        $sql = "SELECT ID FROM plant WHERE ID='$ID' ";
		$DataSet = mysqli_query($mysql,$sql) or die(mysql_error());
		$i=0;
        $Result;
        if(mysqli_num_rows($DataSet)==0)
        {
           return True;
        }
        else
        {
            return False;
        }
        

    }
    public static function ViewDropdown()
    {
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
        $sql = "SELECT * FROM plant";
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
                $MyObject= new Planttype();
                $MyObject->ID=$row["ID"];
                $MyObject->plantName=$row["plantName"];
                $Result[$i]=$MyObject;
                $i++;
            }
            return $Result;
        }
        //$conn->close();
    }
    public static function ViewDropdown2()
    {
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
        $sql = "SELECT * FROM ledlights";
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
                $MyObject= new Planttype();
                $MyObject->ID=$row["ID"];
                $MyObject->color=$row["color"];
                $Result[$i]=$MyObject;
                $i++;
            }
            return $Result;
         }
		
        //$conn->close();
    }
}
?>