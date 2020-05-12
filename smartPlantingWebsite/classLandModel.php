<?php
include_once "Statistics_Interface.php";

include_once "classDatabase.php";
class Land implements Statistics
{
    public  $ID;
    public  $landowner_ID;
    public  $address_ID;
    public  $location;
    public  $greenhouse_L;
    public  $greenhouse_W;
    public  $greenhouse_H;
    public  $plantType_ID;
    
    public $city;
    public $area;
    public $planttype;

    public  $IDarr=array();
    public $stageid;
    public $stage=array();
    public $percentage=array();
    public $Date=array();
    public $ledid;
    public $ledcolor=array();

    public $arrsize;

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
			$sqltot="SELECT * from land WHERE IsDeleted=0 AND ID=$id";
            $resulttot = mysqli_query($mysql,$sqltot);
            if ($resulttot->num_rows > 0) {
                while($rowtot = $resulttot->fetch_assoc()) {
                $this->ID=$id;
                $this->landowner_ID=$rowtot["landowner_ID"];
                $this->address_ID=$rowtot["address_ID"];
                $this->greenhouse_L=$rowtot["greenhouse_L"];
                $this->greenhouse_W=$rowtot["greenhouse_W"];
                $this->greenhouse_H=$rowtot["greenhouse_H"];
                $this->plantType_ID=$rowtot["plantType_ID"];
                $this->location=$rowtot["location"];


                $sqltwo = "SELECT * FROM address WHERE ID=".$this->address_ID."";
                $resulttwo =mysqli_query($mysql,$sqltwo);
                if ($resulttwo->num_rows > 0) {
                    while($rowtwo = $resulttwo->fetch_assoc()) {
                        $Parent_ID=$rowtwo['Parent_ID'];
                        if($Parent_ID>0)
                        {
                            $this->city=$rowtwo['Name'];
                            $sqlt = "SELECT * FROM address WHERE ID=$Parent_ID";
                            $resultt = mysqli_query($mysql,$sqlt);
                            if ($resultt->num_rows > 0) {
                                while($rowt = $resultt->fetch_assoc()) {
                                    $Parent_ID2=$rowt['Parent_ID'];
                                    if($Parent_ID2==0)
                                    {
                                        $this->area=$rowt['Name'];
                                        
                                    }
                                }
                            }
                        }
                    }
                }
                                        
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
    public function __construct2($id,$size) {
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
        if ($id !="")
		{	
			$sqltot="SELECT * from land WHERE IsDeleted=0 AND ID=$id";
            $resulttot = mysqli_query($mysql,$sqltot);
            if ($resulttot->num_rows > 0) {
                while($rowtot = $resulttot->fetch_assoc()) {
                    $this->plantType_ID=$rowtot["plantType_ID"];

                                        
                $sql = "SELECT * FROM plant WHERE ID=".$this->plantType_ID."";
                $result = mysqli_query($mysql,$sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                                            
                            $this->planttype=$row['plantName'];
                        }
                    } 
                
                $sqltest = "SELECT * FROM  testing_threshold WHERE Land_ID=$id";
                $resultest = mysqli_query($mysql,$sqltest);
                    if ($resultest->num_rows > 0) {
                        while($rowtest = $resultest->fetch_assoc()) {
                                            
                            $this->stageid=$rowtest['Stage_ID'];
                            array_push($this->percentage,$rowtest['Percentage']);
                            array_push($this->Date,$rowtest['Date']);
                            array_push($this->IDarr,$rowtot['ID']);

                            $sqlstage = "SELECT * FROM stages WHERE ID=".$this->stageid."";
                            $resultstage = mysqli_query($mysql,$sqlstage);
                                if ($resultstage->num_rows > 0) {
                                    while($rowstage = $resultstage->fetch_assoc()) {
                                            
                                        array_push($this->stage,$rowstage['Stage']);

                                    }
                                } 
                            }
                        }
                $sqlled = "SELECT * FROM ledsystem WHERE Land_ID=$id";
                $resultled = mysqli_query($mysql,$sqlled);
                    if ($resultled->num_rows > 0) {
                        while($rowled = $resultled->fetch_assoc()) {        
                            $this->ledid=$rowled['LED_ID'];
                            $sq = "SELECT * FROM ledlights WHERE ID=".$this->ledid."";
                            $resu = mysqli_query($mysql,$sq);
                                if ($resu->num_rows > 0) {
                                    while($ro = $resu->fetch_assoc()) {
                                                        
                                        array_push($this->ledcolor,$ro['color']);

                                    }
                                } 
                            }
                        }
                     
                    }
                } 
                $this->arrsize=sizeof($this->stage);  
        }
    }
    public static function AddLandRequest(Land $land)
    {
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
        $id=$land->ID;
        $landowner_ID=$land->landowner_ID;
        $address_ID=$land->address_ID;
        $location=$land->location;
        $greenhouse_L=$land->greenhouse_L;
        $greenhouse_W=$land->greenhouse_W;
        $greenhouse_H=$land->greenhouse_H;
        $plantType_ID=$land->plantType_ID;

        date_default_timezone_set("Africa/Cairo");
        $today = date("Y-m-d H:i:s");

        $sql1="SELECT landowner_ID ,address_ID, location FROM land WHERE landowner_ID='$landowner_ID'
        AND address_ID='$address_ID' AND location='$location'";
        $DataSet2 = mysqli_query($mysql,$sql1) or die(mysql_error());
        if(mysqli_num_rows($DataSet2)!=0)
        {
            return NULL;
        }
        elseif (mysqli_num_rows($DataSet2)==0)
        {
            DB::add("land","landowner_ID,address_ID,location,greenhouse_L,greenhouse_W,greenhouse_H,plantType_ID,state_ID,updateRequest,deleteRequest,CreatedDateTime,LastUpdatedDateTime,IsDeleted",
            "'$landowner_ID','$address_ID','$location','$greenhouse_L','$greenhouse_W','$greenhouse_H','$plantType_ID','1',0,0,'$today','$today',0");
            // echo '<script type="text/javascript">';
            //         echo 'window.location.href="AddLand.php";';
            //         echo '</script>';
            $sql="SELECT LastUpdatedDateTime FROM land WHERE LastUpdatedDateTime='$today'";
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
        
    }
    public static function ShowAllLandRequests()
    {
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");

        $sql = "SELECT * FROM land WHERE landowner_ID=".$_SESSION['id']." AND IsDeleted=0 AND state_ID='1'";
		$DataSet = mysqli_query($mysql,$sql) or die(mysql_error());
		if(mysqli_num_rows($DataSet)==0)
        {
           return null;
        }
        else
        {
            $i=0;
            $Result;
            while ($row = mysqli_fetch_array($DataSet))
            {
                $MyObj= new Land($row["ID"]);
                $Result[$i]=$MyObj;
                //echo "<script> alert('".$Result[$i]->Student_ID."');</script>";
                $i++;
            }
            return $Result;
        }
    }
    public static function ShowAllLandRequests2()
    {
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");

        $sql = "SELECT * FROM land WHERE landowner_ID=".$_SESSION['id']." AND IsDeleted=0 AND state_ID='2' AND deleteRequest='0'";
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
                $MyObj= new Land($row["ID"]);
                $Result[$i]=$MyObj;
                //echo "<script> alert('".$Result[$i]->Student_ID."');</script>";
                $i++;
            }
            return $Result;
        }
    }
    public static function updateRequestTO1 ($landid)
    {  
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
        
        date_default_timezone_set("Africa/Cairo");
        $today = date("Y-m-d H:i:s");
        DB::update("land","updateRequest='1'  LastUpdatedDateTime='$today'","ID='$landid' AND IsDeleted=0");
        $sql="SELECT  LastUpdatedDateTime FROM land WHERE LastUpdatedDateTime='$today'";
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
    public static function UpdateLandRequest($landid, $itemtobeupdated, $newvalue)
    {
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
        
        date_default_timezone_set("Africa/Cairo");
        $today = date("Y-m-d H:i:s");
        DB::update("land","updateRequest='1', LastUpdatedDateTime='$today'","ID='$landid' AND IsDeleted=0");
        DB::add("landupdaterequests","Land_ID,ItemToBeUpdated,NewValue,State_ID,CreatedDateTime,LastUpdatedDateTime,IsDeleted",
        "'$landid','$itemtobeupdated','$newvalue','1','$today','$today',0");
    //    echo '<script type="text/javascript">';
    //             echo 'window.location.href="ViewAllLands.php";';
    //             echo '</script>';
        $sql="SELECT  LastUpdatedDateTime FROM land WHERE LastUpdatedDateTime='$today'";
        $DataSet = mysqli_query($mysql,$sql) or die(mysql_error());
        if(mysqli_num_rows($DataSet)!=0)
        {
            $sql1=" SELECT CreatedDateTime FROM landupdaterequests WHERE CreatedDateTime='$today'";
            if(mysqli_num_rows($DataSet)!=0)
            {
                return TRUE;
            }
            else
             {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }

        
    }
    public static function getdataTOupdate($id)
    {
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");

        $sql = "SELECT * FROM land WHERE ID=$id";
        $resulttwo = mysqli_query($mysql,$sql) or die($conn->error);
        $Result; 
        if(mysqli_num_rows($resulttwo)==0)
        {
           return NULL;
        }
        else
        {
       
            while($rowtwo = $resulttwo->fetch_assoc()){
                if($rowtwo==true)
                {
                    $MyObj= new Land($id);
                    $Result=$MyObj;
                }
            }
            //echo "<script> alert('".$Result->FirstName."');</script>";
            return $Result;
        }
       // $conn->close();

    }
    public static function AcceptRejectLandRequests()
    {
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");

        $sql = "SELECT * FROM land WHERE IsDeleted=0 AND state_ID='1'";
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
                $MyObj= new Land($row["ID"]);
                $Result[$i]=$MyObj;
                //echo "<script> alert('".$Result[$i]->Student_ID."');</script>";
                $i++;
            }
            return $Result;
        }
    }
    public static function AcceptRejectCureentLand()
    {
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");

        $sql = "SELECT * FROM land WHERE IsDeleted=0 AND state_ID='2' AND (deleteRequest='1' OR updateRequest='1')";
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
                $MyObj= new Land($row["ID"]);
                $Result[$i]=$MyObj;
                //echo "<script> alert('".$Result[$i]->Student_ID."');</script>";
                $i++;
            }
            return $Result;
        }
    }
    
    public static function viewReport($landid){
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");

        $sql = "SELECT * FROM land WHERE IsDeleted=0 AND plantType_ID=$landid";
		$DataSet = mysqli_query($mysql,$sql) or die(mysql_error());
		 
        $i=0;
        $size=0;
		$Result;
		while ($row = mysqli_fetch_array($DataSet))
		{
            
			$MyObj= new Land($row["ID"],$size);
            $Result[$i]=$MyObj;
              $i++;
        }
       
		return $Result;
    }
}
?>