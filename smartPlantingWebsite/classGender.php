<?php
include_once "classDatabase.php";
class Gender
{
    public  $ID;
    public  $Gender;

    public function __construct() {
    }
    public static function ViewDropdown()
    {
        $conn=DB::getInstance();
        $mysql=$conn->getConnection();
        $conn=mysqli_query($mysql,"SET NAMES 'utf8'");
        $sql="SELECT * FROM gender";
		$DataSet = mysqli_query($mysql,$sql) or die(mysql_error());
		$i=0;
		$Result;
		while ($row = mysqli_fetch_array($DataSet))
		{
            $MyObject= new Gender();
            $MyObject->ID=$row["ID"];
            $MyObject->Grade=$row["gender"];
			$Result[$i]=$MyObject;
			$i++;
		}
		return $Result;
        //$conn->close();
    }
}
?>