<?php
include_once "classDatabase.php";
class LandUpdateRequest
{
    public  $ID;
    public  $Land_ID;
    public  $ItemToBeUpdated;
    public  $NewValue;
    public  $State_ID;
    

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
            $sql="select * from landupdaterequests where ID=$id";
             
            $StudentDataSet = mysqli_query($mysql,$sql) or die(mysql_error());
            if ($row = mysqli_fetch_array($StudentDataSet))
            {
                $this->State_ID=$row["State_ID"];    
                $this->Land_ID=$row["Land_ID"];
                $this->ItemToBeUpdated=$row["ItemToBeUpdated"];
                $this->NewValue=$row["NewValue"];
                $this->ID=$id; 
            }
        }
        

    }
    public static function AcceptRejectUpdateRequests($landid)
    {
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");

        $sql = "SELECT * FROM  landupdaterequests WHERE IsDeleted=0   AND state_ID='1' AND Land_ID=$landid";
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
                $MyObj= new LandUpdateRequest($row["ID"]);
                $Result[$i]=$MyObj;
            
                $i++;
            }
            return $Result;
        }
    }
}

?>