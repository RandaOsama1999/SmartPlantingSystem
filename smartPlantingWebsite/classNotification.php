<?php
include_once "classDatabase.php";
class Notification
{
    public $ID;
    public $User_ID;
    public $content_ID;
    public $land_ID;
    public $DateTime;

    public $content;
    public $location;

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
			$sqltot="SELECT * FROM notification WHERE ID=$id";
            $resulttot = mysqli_query($mysql,$sqltot);
            if ($resulttot->num_rows > 0) {
                while($rowtot = $resulttot->fetch_assoc()) {
                $this->ID=$id;
                $this->User_ID=$rowtot["user_ID"];
                $this->content_ID=$rowtot["content_ID"];
                $this->land_ID=$rowtot["land_ID"];
                $this->DateTime=$rowtot["DateTime"];


                $sqltwo = "SELECT * FROM content WHERE ID=".$this->content_ID."";
                $resulttwo =mysqli_query($mysql,$sqltwo);
                if ($resulttwo->num_rows > 0) {
                    while($rowtwo = $resulttwo->fetch_assoc()) {
                        $this->content=$rowtwo['content'];
                    }
                }
                                        
                $sql = "SELECT * FROM land WHERE ID=".$this->land_ID."";
                $result = mysqli_query($mysql,$sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {         
                            $this->location=$row['location'];
                        }
                    } 
                     
                    }
                }   
        }
    }
    public static function countnotifications()
    {
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
        $sql = "SELECT COUNT(ID) as notifcount FROM notification WHERE user_ID=".$_SESSION['id']."";
        $resulttwo =mysqli_query($mysql,$sql);
		if ($resulttwo->num_rows >= 0) {
            while($rowtwo = $resulttwo->fetch_assoc()) {
                $notifcount=$rowtwo['notifcount'];
            }
        }
		return $notifcount;
    }
    public static function viewnotifications()
    {
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");

        $sql = "SELECT * FROM notification WHERE user_ID=".$_SESSION['id']."";
		$DataSet = mysqli_query($mysql,$sql) or die(mysql_error());
		$i=0;
		$Result=array();
		while ($row = mysqli_fetch_array($DataSet))
		{
			$MyObj= new Notification($row["ID"]);
            $Result[$i]=$MyObj;
			$i++;
		}
		return $Result;
    }
}
?>