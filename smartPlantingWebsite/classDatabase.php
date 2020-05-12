<?php

class DB
{
    public $host;
    public $user ;
    public $pass ;
    public $dbname;
    public $myconn;
    public static $instance;

    public function __construct($hostname,$username,$password,$databasename)
    {
      $this->host=$hostname;
      $this->user=$username;
      $this->pass=$password;
      $this->dbname=$databasename;
      if(!isset(self::$instance))
         {
              self::$instance=$this;
              $this->myconn=new mysqli($this->host,$this->user,$this->pass,$this->dbname) or die("no connection");
         }
      
    }
    
    public static function getInstance(){
        if(!isset(self::$instance)){
            $db=new DB("localhost","root","","smartplanting");
            //echo "Object is created <br>";
            self::$instance=$db;
        }
        return self::$instance;
    }

    public function getConnection() {
		return $this->myconn;
	}
    
    public static function addwithid($table,$tabledata,$Values){
        
        $sql="INSERT INTO $table ($tabledata) VALUES($Values)";
       // $connection = new DB();
       $conn=DB::getInstance();
       $mysql=$conn->getConnection();
       $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
       $result=mysqli_query($mysql,$sql);
        $last_id = mysqli_insert_id($mysql);
        return $last_id;
    }
    public static function add($table,$tabledata,$Values){
        
        $sql="INSERT INTO $table ($tabledata) VALUES($Values)";
       // $connection = new DB();
       $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
        $result=mysqli_query($mysql,$sql);

    }
    public static function delete($table, $Where){
        date_default_timezone_set("Africa/Cairo");
        $today = date("Y-m-d H:i:s");
        $sql="UPDATE $table SET LastUpdatedDateTime='$today', IsDeleted = 1 WHERE ".$Where;
       // $connection = new DB();
       $conn=DB::getInstance();
       $mysql=$conn->getConnection();
       $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
        $result=mysqli_query($mysql,$sql);
    }
    public static function delete2($table, $Where){
        date_default_timezone_set("Africa/Cairo");
        $today = date("Y-m-d H:i:s");
        $sql="DELETE FROM $table WHERE ".$Where;
       // $connection = new DB();
       $conn=DB::getInstance();
       $mysql=$conn->getConnection();
       $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
        $result=mysqli_query($mysql,$sql);
    }
    public  static function update($table,$set,$Where){
        
        $sql="UPDATE $table SET $set WHERE ".$Where;
       // $connection = new DB();
       $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
       $result=mysqli_query($mysql,$sql);
    }


}
?>