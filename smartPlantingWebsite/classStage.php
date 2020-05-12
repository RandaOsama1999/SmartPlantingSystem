<?php
include_once "classDatabase.php";
class Stage
{
    public  $ID;
    public  $Stage;

    public function __construct() {
    }
    public static function ViewDropdown()
    {
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
        $sql="SELECT * FROM stages";
		$DataSet = mysqli_query($mysql,$sql) or die(mysql_error());
		$i=0;
		$Result;
		while ($row = mysqli_fetch_array($DataSet))
		{
            $MyObject= new Stage();
            $MyObject->ID=$row["ID"];
            $MyObject->Stage=$row["Stage"];
			$Result[$i]=$MyObject;
			$i++;
		}
		return $Result;
        //$conn->close();
    }
}
?>